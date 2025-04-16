<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function index()
    {
        $produtos = Produto::all();

        return view('home', ['itens' => $produtos]);
    }

    public function show(string $id)
    {   
        $produto = Produto::findOrFail($id);

        $produtoCat = $produto->categoria_id;

        $relacionados = Produto::where('categoria_id', $produtoCat)->where('id', '!=', $id)->get();

        return view('product.show', ['produto' => $produto, 'relacionados' => $relacionados]);
    }

    public function search(Request $request)
    {
        $pesquisa = $request->search;
        $produtos = Produto::where('nome', 'LIKE', "%{$pesquisa}%")->paginate(5);
        return view('pages.listar', ['itens' => $produtos, 'categoria' => $pesquisa]);
    }
}
