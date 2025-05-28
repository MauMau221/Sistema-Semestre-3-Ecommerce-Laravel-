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

    public function index()
    {
        $produtos = Produto::all();

        return view('home', ['itens' => $produtos]);
    }

    public function show(string $id)
    {
        $produto = Produto::findOrFail($id);

        $produtoCat = $produto->categoria_id;
        $nomeCat = Categoria::find($produtoCat)->nome;

        $relacionados = Produto::where('categoria_id', $produtoCat)->where('id', '!=', $id)->get();

        return view('product.show', ['produto' => $produto, 'relacionados' => $relacionados, 'nomeCat' => $nomeCat]);
    }

    public function search(Request $request)
    {
        $pesquisa = $request->search;
        $query = Produto::where('nome', 'LIKE', "%{$pesquisa}%");

        // Aplica os filtros apenas se estiverem presentes na requisição
        if ($request->has('tamanho')) {
            $query->where('tamanho', $request->tamanho);
        }
        if ($request->has('cor')) {
            $query->where('cor', $request->cor);
        }
        if ($request->has('preco')) {
            $query->where('preco', $request->preco);
        }
        if ($request->has('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        // Obtém os resultados paginados
        $produtos = $query->paginate(8)->appends($request->except('page'));

        // Obtém o nome da categoria do primeiro produto para as imagens
        $categoriaNome = $produtos->isNotEmpty() ? $produtos->first()->categoria->nome : '';

        $dadosCategoria = [
            'nome' => $categoriaNome,
            'produtos' => $produtos,
            'isSearch' => true // Flag para identificar que é uma busca
        ];

        return view('pages.listar', ['dadosCategoria' => $dadosCategoria]);
    }

    public function verificarEstoque(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);
        $estoque = $produto->estoque()
            ->where('cor', $request->cor)
            ->where('tamanho', $request->tamanho)
            ->first();

        return response()->json([
            'quantidade' => $estoque ? $estoque->quantidade : 0
        ]);
    }
}
