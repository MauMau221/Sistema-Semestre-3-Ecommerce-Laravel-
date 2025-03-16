<?php

namespace App\Http\Controllers;

use App\Models\Produto;

class HomeController extends Controller
{
    public function index()
    {
        $itens = Produto::all();

        return view('home', ['itens' => $itens]);
    }
    
    public function login()
    {
        return view('login.login');
    }
}
