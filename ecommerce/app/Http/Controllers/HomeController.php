<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();

        return view('home', ['produtos' => $produtos]);
    }

    public function login()
    {
        return view('login.login');
    }

    public function cart()
    {
        return view('cart.cart');
    }
}
