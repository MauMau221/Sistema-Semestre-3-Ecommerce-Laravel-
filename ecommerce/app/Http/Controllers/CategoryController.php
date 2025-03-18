<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $itens = Categoria::all();

        return view('home', ['itens' => $itens]);
    }
}
