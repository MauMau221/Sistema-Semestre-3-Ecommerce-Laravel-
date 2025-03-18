<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;

class HomeController extends Controller
{
    public function index()
    {
        $produto = Produto::find(2);
        $categoria = $produto->categoria;
        dd($categoria);

        return view('home', ['itens' => $itens]);
    }

    public function login()
    {
        return view('login.login');
    }
}
