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
        $categoria = Categoria::find('blusas');

        $produtos = $categoria->produtos;

        return view('pages.camisas', ['itens' => $produtos]);
    }

    public function camisetas()
    {
        $categoria = Categoria::find('camisetas');

        $produtos = $categoria->produtos;

        return view('pages.camisetas', ['itens' => $produtos]);
    }

    public function calcas()
    {
        $categoria = Categoria::find('calcas');

        $produtos = $categoria->produtos;

        return view('pages.calcas', ['itens' => $produtos]);
    }

    public function calcados()
    {
        $categoria = Categoria::find('calcados');

        $produtos = $categoria->produtos;

        return view('pages.calcados', ['itens' => $produtos]);
    }

    public function polos()
    {
        $categoria = Categoria::find('polos');

        $produtos = $categoria->produtos;

        return view('pages.polos', ['itens' => $produtos]);
    }

    public function jaquetas()
    {
        $categoria = Categoria::find('jaquetas');

        $produtos = $categoria->produtos;

        return view('pages.acessorios', ['itens' => $produtos]);
    }
}
