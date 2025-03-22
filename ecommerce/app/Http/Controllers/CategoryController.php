<?php

namespace App\Http\Controllers;

use App\Models\Categoria;

class CategoryController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();

        return view('home', ['itens' => $categorias]);
    }

    public function camisas()
    {
        $categoria = Categoria::where('nome', 'camisas')->firstOrFail();

        $produtos = $categoria->produtos;

        return view('pages.camisas', ['itens' => $produtos]);
    }

    public function blusas()
    {
        $categoria = Categoria::where('nome', 'blusas')->firstOrFail();
        $produtos = $categoria->produtos;

        return view('pages.blusas', ['itens' => $produtos]);
    }

    public function camisetas()
    {
        $categoria = Categoria::where('nome', 'camisetas')->firstOrFail();
        $produtos = $categoria->produtos;

        return view('pages.camisetas', ['itens' => $produtos]);
    }

    public function calcas()
    {
        $categoria = Categoria::where('nome', 'calcas')->firstOrFail();
        $produtos = $categoria->produtos;

        return view('pages.calcas', ['itens' => $produtos]);
    }

    public function calcados()
    {
        $categoria = Categoria::where('nome', 'calcados')->firstOrFail();
        $produtos = $categoria->produtos;

        return view('pages.calcados', ['itens' => $produtos]);
    }

    public function polos()
    {
        $categoria = Categoria::where('nome', 'polos')->firstOrFail();
        $produtos = $categoria->produtos;

        return view('pages.polos', ['itens' => $produtos]);
    }

    public function jaquetas()
    {
        $categoria = Categoria::where('nome', 'jaquetas')->firstOrFail();
        $produtos = $categoria->produtos;

        return view('pages.acessorios', ['itens' => $produtos]);
    }
}
