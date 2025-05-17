<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Obter produtos por categoria
        $produtosPorCategoria = [];
        
        // Lista de categorias que queremos exibir
        $categorias = ['camisas', 'polos', 'camisetas', 'acessorios'];
        
        foreach ($categorias as $nomeCategoria) {
            $categoria = Categoria::where('nome', $nomeCategoria)->first();
            
            if ($categoria) {
                // Obter até 10 produtos desta categoria
                $produtos = Produto::where('categoria_id', $categoria->id)
                                   ->where('status', true)
                                   ->limit(10)
                                   ->get();
                
                if ($produtos->count() > 0) {
                    $produtosPorCategoria[$nomeCategoria] = [
                        'nome' => ucfirst($nomeCategoria),
                        'produtos' => $produtos,
                        'id' => $categoria->id
                    ];
                }
            }
        }
        
        // Fallback para o comportamento anterior caso não encontre categorias
        $todosProdutos = Produto::where('status', true)->get();
        
        return view('home', [
            'produtosPorCategoria' => $produtosPorCategoria,
            'produtos' => $todosProdutos // Mantendo compatibilidade com código existente
        ]);
    }

}
