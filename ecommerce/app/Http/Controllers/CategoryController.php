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
        $categoria = Categoria::find(1);

        $produtos = $categoria->produtos;

        return view('pages.camisas', ['itens' => $produtos]);
    }

    public function camisetas()
    {
        $categoria = Categoria::find(2);

        $produtos = $categoria->produtos;

        return view('pages.camisetas', ['itens' => $produtos]);
    }

    public function calcas()
    {
        $categoria = Categoria::find(3);

        $produtos = $categoria->produtos;

        return view('pages.calcas', ['itens' => $produtos]);
    }

    public function calcados()
    {
        $categoria = Categoria::find(4);

        $produtos = $categoria->produtos;

        return view('pages.calcados', ['itens' => $produtos]);
    }

    public function polos()
    {
        $categoria = Categoria::find(5);

        $produtos = $categoria->produtos;

        return view('pages.polos', ['itens' => $produtos]);
    }

    public function jaquetas()
    {
        $categoria = Categoria::find(6);

        $produtos = $categoria->produtos;

        return view('pages.jaquetas', ['itens' => $produtos]);
    }
}
