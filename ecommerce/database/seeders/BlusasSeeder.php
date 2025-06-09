<?php

namespace Database\Seeders;

use App\Models\Produto;
use App\Models\Estoque;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlusasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriaId = 8; // ID da categoria "blusas"
        
        $produtos = [
            [
                'nome' => 'Blusa Básica',
                'desc' => 'Blusa básica em malha de algodão, confortável e versátil.',
                'preco' => 79.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => 'produtos/blusas/blusa-basica.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Blusa Tricot',
                'desc' => 'Blusa em tricot com detalhes em renda, elegante e sofisticada.',
                'preco' => 129.90,
                'desconto' => 15.00,
                'status' => true,
                'url' => 'produtos/blusas/blusa-tricot.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Blusa Manga Longa',
                'desc' => 'Blusa de manga longa em malha fina, perfeita para o dia a dia.',
                'preco' => 99.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => 'produtos/blusas/blusa-manga-longa.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Blusa Transpassada',
                'desc' => 'Blusa transpassada com botões, estilo casual e moderno.',
                'preco' => 119.90,
                'desconto' => 20.00,
                'status' => true,
                'url' => 'produtos/blusas/blusa-transpassada.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Blusa Cropped',
                'desc' => 'Blusa cropped com detalhes em renda, ideal para looks despojados.',
                'preco' => 89.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => 'produtos/blusas/blusa-cropped.jpg',
                'categoria_id' => $categoriaId
            ]
        ];

        foreach ($produtos as $produto) {
            $novoProduto = Produto::create($produto);
            
            // Adicionar estoque para cada produto com diferentes cores e tamanhos
            $cores = ['Preto', 'Branco', 'Rosa', 'Azul', 'Verde'];
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