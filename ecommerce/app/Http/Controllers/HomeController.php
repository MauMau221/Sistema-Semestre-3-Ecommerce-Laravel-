<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $itens = Produto::all();

        return view('home', ['itens' => $itens]);
    }
}
