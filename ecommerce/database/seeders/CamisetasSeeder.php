<?php

namespace Database\Seeders;

use App\Models\Produto;
use App\Models\Estoque;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CamisetasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriaId = 2; // ID da categoria "camisetas"
        
        $produtos = [
            [
                'nome' => 'Camiseta Básica Preta',
                'desc' => 'Camiseta básica preta em algodão de alta qualidade, modelagem regular fit.',
                'preco' => 59.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => 'produtos/camisetas/camiseta-basica-preta.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Camiseta Gola V',
                'desc' => 'Camiseta com gola V, fabricada em algodão macio e confortável.',
                'preco' => 64.90,
                'desconto' => 5.00,
                'status' => true,
                'url' => 'produtos/camisetas/camiseta-gola-v.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Camiseta Estampada Vintage',
                'desc' => 'Camiseta com estampa vintage, perfeita para um visual despojado.',
                'preco' => 79.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => 'produtos/camisetas/camiseta-estampada-vintage.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Camiseta Listrada',
                'desc' => 'Camiseta com listras horizontais, moderna e versátil.',
                'preco' => 69.90,
                'desconto' => 10.00,
                'status' => true,
                'url' => 'produtos/camisetas/camiseta-listrada.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Camiseta Manga Longa',
                'desc' => 'Camiseta de manga longa em algodão, ideal para dias mais frios.',
                'preco' => 89.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => 'produtos/camisetas/camiseta-manga-longa.jpg',
                'categoria_id' => $categoriaId
            ]
        ];

        foreach ($produtos as $produto) {
            $novoProduto = Produto::create($produto);
            
            // Adicionar estoque para cada produto com diferentes cores e tamanhos
            $cores = ['Branco', 'Preto', 'Cinza', 'Azul Marinho'];
            $tamanhos = ['P', 'M', 'G', 'GG'];
            
            foreach ($cores as $cor) {
                foreach ($tamanhos as $tamanho) {
                    Estoque::create([
                        'produto_id' => $novoProduto->id,
                        'cor' => $cor,
                        'tamanho' => $tamanho,
                        'quantidade' => rand(5, 30)
                    ]);
                }
            }
        }
    }
} 