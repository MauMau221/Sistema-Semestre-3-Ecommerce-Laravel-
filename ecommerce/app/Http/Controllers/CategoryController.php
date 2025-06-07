<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Método para exibir todas as categorias na página inicial
    public function index()
    {
        $categorias = Categoria::all();
        return view('home', ['itens' => $categorias]);
    }

    // Método principal para listar produtos de uma categoria específica
    public function categorias(Request $request)
    {
        // Obtém o nome da categoria da URL e busca no banco
        $nomeCategoria = $request->query('nome');
        $categoria = Categoria::where('nome', $nomeCategoria)->firstOrFail();

        // Inicia a query base com filtros essenciais
        $query = Produto::where('categoria_id', $categoria->id)
            ->where('status', true);

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
                case 'new_arrivals':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                    // Por padrão, pode-se ordenar por relevância ou outro critério
                    break;
            }
        }

        // Paginação: Divide os resultados em páginas de 8 produtos
        $produtos = $query->paginate(8)->withQueryString();

        // Prepara os dados para a view
        $dadosCategoria = [
            'nome' => ucfirst($nomeCategoria),
            'produtos' => $produtos,
            'id' => $categoria->id
        ];

        // Retorna a view com os dados organizados
        return view('pages.listar', [
            'dadosCategoria' => $dadosCategoria,
            'categoria' => $nomeCategoria
        ]);
    }
}
