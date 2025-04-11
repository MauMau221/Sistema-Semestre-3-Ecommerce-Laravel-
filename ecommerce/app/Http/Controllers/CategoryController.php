<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
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
        
        $produtos = $categoria->produtos()->paginate(8)->withQueryString();
        return view('pages.listar', [
            'itens' => $produtos,
            'categoria' => $nomeCategoria
        ]);
    }

}
