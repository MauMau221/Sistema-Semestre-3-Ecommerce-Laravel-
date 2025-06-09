<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Services\EstoqueService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Categoria;

class ProductController extends Controller
{
    protected $estoqueService;

    public function __construct(EstoqueService $estoqueService)
    {
        $this->estoqueService = $estoqueService;
    }

    // Método para exibir todos os produtos na página inicial
    public function index()
    {
        $produtos = Produto::all();
        return view('home', ['itens' => $produtos]);
    }

    // Método para exibir detalhes de um produto específico
    public function show(string $id)
    {
        $produto = Produto::findOrFail($id);
        $produtoCat = $produto->categoria_id;
        $nomeCat = Categoria::find($produtoCat)->nome;

        // Busca produtos relacionados da mesma categoria
        $relacionados = Produto::where('categoria_id', $produtoCat)
            ->where('id', '!=', $id)
            ->get();

        return view('product.show', [
            'produto' => $produto,
            'relacionados' => $relacionados,
            'nomeCat' => $nomeCat
        ]);
    }

    // Método principal para busca e filtros de produtos
    public function search(Request $request)
    {
        $query = Produto::query();

        // Filtro de pesquisa por nome do produto
        if ($request->has('search')) {
            $query->where('nome', 'LIKE', "%{$request->search}%");
        }

        // Filtro por categoria (quando vem da listagem por categoria)
        if ($request->has('nome')) {
            $categoria = Categoria::where('nome', $request->nome)->first();
            if ($categoria) {
                $query->where('categoria_id', $categoria->id);
            }
        }

        // Filtro de Preço: Permite selecionar faixas de preço específicas
        if ($request->has('preco')) {
            $query->where(function ($q) use ($request) {
                foreach ($request->preco as $faixaPreco) {
                    switch ($faixaPreco) {
                        case '0-150':
                            $q->orWhereBetween('preco', [0, 150]);
                            break;
                        case '151-250':
                            $q->orWhereBetween('preco', [151, 250]);
                            break;
                        case '251-350':
                            $q->orWhereBetween('preco', [251, 350]);
                            break;
                        case '351+':
                            $q->orWhere('preco', '>', 350);
                            break;
                    }
                }
            });
        }

        // Filtro de Cor: Busca produtos com as cores selecionadas no estoque
        if ($request->has('cor')) {
            $query->whereHas('estoque', function ($q) use ($request) {
                $q->whereIn('cor', $request->cor);
            });
        }

        // Filtro de Tamanho: Busca produtos com os tamanhos selecionados no estoque
        if ($request->has('tamanho')) {
            $query->whereHas('estoque', function ($q) use ($request) {
                $q->whereIn('tamanho', $request->tamanho);
            });
        }
        // Ordenação
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('preco', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('preco', 'desc');
                    break;
                case 'discount':
                    $query->where('desconto', '>', 0)
                          ->orderBy('desconto', 'desc');
                    break;
                default:
                    // Por padrão, pode-se ordenar por relevância ou outro critério
                    break;
            }
        }

        // with: Carrega as categorias de cada produto
        $produtos = $query->with('categoria')->paginate(8)->appends($request->except('page'));

        // Obtém o nome da categoria para exibição
        $categoriaNome = '';
        if ($request->has('nome')) {
            $categoriaNome = $request->nome;
        } elseif ($request->has('categoria_id')) {
            $categoria = Categoria::find($request->categoria_id);
            $categoriaNome = $categoria ? $categoria->nome : '';
        } else {
            $primeiroProduto = $produtos->items()[0] ?? null;
            if ($primeiroProduto && $primeiroProduto->categoria) {
                $categoriaNome = $primeiroProduto->categoria->nome;
            }
        }

        // Prepara os dados para a view
        $dadosCategoria = [
            'nome' => $categoriaNome,
            'produtos' => $produtos,
            'isSearch' => $request->has('search')
        ];

        return view('pages.listar', ['dadosCategoria' => $dadosCategoria]);
    }

    // Método para verificar disponibilidade de estoque
    public function verificarEstoque(Request $request, $id)
    {

        $produto = Produto::find($id);
        $estoqueDisponivel = $produto->qtdDisponivel($request->cor, $request->tamanho); // Acessa o atributo calculado

        return response()->json([
            'quantidade' => $estoqueDisponivel ? $estoqueDisponivel : 0
        ]);
    }
}
