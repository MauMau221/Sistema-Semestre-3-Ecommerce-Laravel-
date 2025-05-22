<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();

        return view('home', ['itens' => $categorias]);
    }

    public function categorias(Request $request)
    {
        $nomeCategoria = $request->query('nome');
        $categoria = Categoria::where('nome', $nomeCategoria)->firstOrFail();

        // Obter produtos paginados da categoria
        $produtos = Produto::where('categoria_id', $categoria->id)
                           ->where('status', true)
                           ->paginate(8)
                           ->withQueryString();

        $dadosCategoria = [
            'nome' => ucfirst($nomeCategoria),
            'produtos' => $produtos,
            'id' => $categoria->id
        ];

        return view('pages.listar', [
            'dadosCategoria' => $dadosCategoria,
            'categoria' => $nomeCategoria
        ]);
    }

}
