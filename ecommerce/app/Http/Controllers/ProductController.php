<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = Produto::all();

        return view('home', ['itens' => $produtos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   
        $produto = Produto::findOrFail($id);

        $produtoCat = $produto->categoria_id;

        $relacionados = Produto::where('categoria_id', $produtoCat)->where('id', '!=', $id)->get();

        return view('product.show', ['produto' => $produto, 'relacionados' => $relacionados]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search(Request $request)
    {
        $pesquisa = $request->search;
        $produtos = Produto::where('nome', 'LIKE', "%{$pesquisa}%")->get();
        return view('pages.search', ['produtos' => $produtos]);
    }
}
