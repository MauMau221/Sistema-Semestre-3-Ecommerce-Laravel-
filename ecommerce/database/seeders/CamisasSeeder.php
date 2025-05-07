<?php

namespace Database\Seeders;

use App\Models\Produto;
use App\Models\Estoque;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CamisasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriaId = 1; // ID da categoria "camisas"
        
        $produtos = [
            [
                'nome' => 'Camisa Social Branca',
                'desc' => 'Camisa social branca de algodão, corte slim fit, ideal para ocasiões formais.',
                'preco' => 129.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => 'produtos/camisas/camisa-social-branca.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Camisa Xadrez',
                'desc' => 'Camisa xadrez em flanela, perfeita para um visual casual e despojado.',
                'preco' => 99.90,
                'desconto' => 10.00,
                'status' => true,
                'url' => 'produtos/camisas/camisa-xadrez.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Camisa Jeans',
                'desc' => 'Camisa jeans lavada, com bolsos frontais e fechamento com botões de pressão.',
                'preco' => 149.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => 'produtos/camisas/camisa-jeans.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Camisa Estampada',
                'desc' => 'Camisa com estampa exclusiva, tecido leve e confortável para o verão.',
                'preco' => 119.90,
                'desconto' => 15.00,
                'status' => true,
                'url' => 'produtos/camisas/camisa-estampada.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Camisa Manga Curta',
                'desc' => 'Camisa de manga curta em algodão, ideal para dias quentes.',
                'preco' => 89.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => 'produtos/camisas/camisa-manga-curta.jpg',
                'categoria_id' => $categoriaId
            ]
        ];

        foreach ($produtos as $produto) {
            $novoProduto = Produto::create($produto);
            
            // Adicionar estoque para cada produto com diferentes cores e tamanhos
            $cores = ['Branco', 'Preto', 'Azul', 'Vermelho'];
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