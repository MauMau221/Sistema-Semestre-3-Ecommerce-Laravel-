<?php

namespace Database\Seeders;

use App\Models\Produto;
use App\Models\Estoque;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PolosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriaId = 5; // ID da categoria "polos"
        
        $produtos = [
            [
                'nome' => 'Polo Básica',
                'desc' => 'Camisa polo básica em algodão piquet, confortável e elegante.',
                'preco' => 89.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => 'produtos/polos/polo-basica.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Polo Listrada',
                'desc' => 'Camisa polo com listras horizontais, estilo clássico e sofisticado.',
                'preco' => 99.90,
                'desconto' => 10.00,
                'status' => true,
                'url' => 'produtos/polos/polo-listrada.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Polo Manga Longa',
                'desc' => 'Camisa polo de manga longa, ideal para clima ameno e ocasiões casuais.',
                'preco' => 119.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => 'produtos/polos/polo-manga-longa.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Polo Esportiva',
                'desc' => 'Camisa polo esportiva com tecido dry fit, perfeita para atividades físicas.',
                'preco' => 109.90,
                'desconto' => 15.00,
                'status' => true,
                'url' => 'produtos/polos/polo-esportiva.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Polo Premium',
                'desc' => 'Camisa polo premium com detalhes diferenciados e tecido de alta qualidade.',
                'preco' => 149.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => 'produtos/polos/polo-premium.jpg',
                'categoria_id' => $categoriaId
            ]
        ];

        foreach ($produtos as $produto) {
            $novoProduto = Produto::create($produto);
            
            // Adicionar estoque para cada produto com diferentes cores e tamanhos
            $cores = ['Azul', 'Vermelho', 'Preto', 'Branco', 'Verde'];
            $tamanhos = ['P', 'M', 'G', 'GG'];
            
            foreach ($cores as $cor) {
                foreach ($tamanhos as $tamanho) {
                    Estoque::create([
                        'produto_id' => $novoProduto->id,
                        'cor' => $cor,
                        'tamanho' => $tamanho,
                        'quantidade' => rand(5, 25)
                    ]);
                }
            }
        }
    }
} 