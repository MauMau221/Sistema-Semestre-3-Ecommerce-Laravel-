<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Services\EstoqueService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $estoqueService;

    public function __construct(EstoqueService $estoqueService)
    {
        $this->estoqueService = $estoqueService;
    }

    public function index()
    {
        return Produto::all();
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $produto = Produto::create($data);

        return $produto;
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
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
