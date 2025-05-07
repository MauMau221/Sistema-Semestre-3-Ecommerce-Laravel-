<?php

namespace Database\Seeders;

use App\Models\Produto;
use App\Models\Estoque;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcessoriosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriaId = 7; // ID da categoria "acessorios"
        
        $produtos = [
            [
                'nome' => 'Cinto de Couro',
                'desc' => 'Cinto de couro legítimo com fivela metálica, clássico e duradouro.',
                'preco' => 79.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => 'produtos/acessorios/cinto-couro.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Boné Aba Reta',
                'desc' => 'Boné aba reta com ajuste snapback, moderno e versátil.',
                'preco' => 59.90,
                'desconto' => 10.00,
                'status' => true,
                'url' => 'produtos/acessorios/bone-aba-reta.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Carteira Slim',
                'desc' => 'Carteira slim com compartimentos para cartões e porta documentos.',
                'preco' => 49.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => 'produtos/acessorios/carteira-slim.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Relógio Casual',
                'desc' => 'Relógio casual com pulseira em couro e mostrador analógico.',
                'preco' => 159.90,
                'desconto' => 20.00,
                'status' => true,
                'url' => 'produtos/acessorios/relogio-casual.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Mochila Urbana',
                'desc' => 'Mochila urbana com compartimento para notebook e bolsos externos.',
                'preco' => 129.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => 'produtos/acessorios/mochila-urbana.jpg',
                'categoria_id' => $categoriaId
            ]
        ];

        foreach ($produtos as $produto) {
            $novoProduto = Produto::create($produto);
            
            // Adicionar estoque para cada produto com diferentes cores
            $cores = ['Preto', 'Marrom', 'Azul', 'Cinza'];
            
            // Acessórios nem sempre têm tamanhos tradicionais
            if (strpos($produto['nome'], 'Cinto') !== false) {
                $tamanhos = ['85cm', '90cm', '95cm', '100cm', '105cm'];
            } elseif (strpos($produto['nome'], 'Boné') !== false) {
                $tamanhos = ['Único'];
            } elseif (strpos($produto['nome'], 'Carteira') !== false) {
                $tamanhos = ['Único'];
            } elseif (strpos($produto['nome'], 'Relógio') !== false) {
                $tamanhos = ['Único'];
            } elseif (strpos($produto['nome'], 'Mochila') !== false) {
                $tamanhos = ['Único'];
            } else {
                $tamanhos = ['Único'];
            }
            
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