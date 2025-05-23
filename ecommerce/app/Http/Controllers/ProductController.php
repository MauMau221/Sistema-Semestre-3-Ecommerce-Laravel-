<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Services\EstoqueService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Categoria;

class ProductController extends Controller
{
    protected $estoqueService;

    public function __construct(EstoqueService $estoqueService)
    {
        $this->estoqueService = $estoqueService;
    }
    
    public function index()
    {
        $produtos = Produto::all();

        return view('home', ['itens' => $produtos]);
    }

    public function show(string $id)
    {   
        $produto = Produto::findOrFail($id);

        $produtoCat = $produto->categoria_id;
        $nomeCat = Categoria::find($produtoCat)->nome;

        $relacionados = Produto::where('categoria_id', $produtoCat)->where('id', '!=', $id)->get();

        return view('product.show', ['produto' => $produto, 'relacionados' => $relacionados, 'nomeCat' => $nomeCat]);
    }

    public function search(Request $request)
    {
        $pesquisa = $request->search;
        $produtos = Produto::where('nome', 'LIKE', "%{$pesquisa}%")->paginate(5);
        return view('pages.listar', ['itens' => $produtos, 'categoria' => $pesquisa]);
    }

    public function verificarEstoque(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);
        $estoque = $produto->estoque()
            ->where('cor', $request->cor)
            ->where('tamanho', $request->tamanho)
            ->first();

        return response()->json([
            'quantidade' => $estoque ? $estoque->quantidade : 0
        ]);
    }
}
