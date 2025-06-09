<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;

class HomeController extends Controller
{
    public function index()
    {
        // Obter produtos por categoria
        $produtosPorCategoria = [];
        
        // Lista de categorias que queremos exibir
        $categorias = ['camisas', 'polos', 'camisetas', 'acessorios', 'blusas'];
        
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
        
        
        // Buscar produtos com desconto para a aba de ofertas
        $produtosComDesconto = Produto::where('desconto', '>', 0)
            ->where('status', true)
            ->orderBy('desconto', 'desc')
            ->take(4)
            ->get();
        
        // Buscar produtos da categoria jaquetas para a aba de novidades
        $categoriaJaquetas = Categoria::where('nome', 'jaquetas')->first();
        $produtosJaquetas = [];
        
        if ($categoriaJaquetas) {
            $produtosJaquetas = Produto::where('categoria_id', $categoriaJaquetas->id)
                ->where('status', true)
                ->limit(4)
                ->get();
        }
        
        return view('home', [
            'produtosPorCategoria' => $produtosPorCategoria,
            'produtosComDesconto' => $produtosComDesconto,
            'produtosJaquetas' => $produtosJaquetas
        ]);
    }

}
