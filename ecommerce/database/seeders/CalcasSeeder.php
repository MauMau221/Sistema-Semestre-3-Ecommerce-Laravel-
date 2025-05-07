<?php

namespace Database\Seeders;

use App\Models\Produto;
use App\Models\Estoque;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CalcasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriaId = 3; // ID da categoria "calcas"
        
        $produtos = [
            [
                'nome' => 'Calça Jeans Skinny',
                'desc' => 'Calça jeans skinny com elastano, modelagem ajustada ao corpo e confortável.',
                'preco' => 149.90,
                'desconto' => 20.00,
                'status' => true,
                'url' => 'produtos/calcas/calca-jeans-skinny.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Calça Jeans Reta',
                'desc' => 'Calça jeans de corte reto tradicional, confortável para o dia a dia.',
                'preco' => 139.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => 'produtos/calcas/calca-jeans-reta.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Calça Moletom',
                'desc' => 'Calça de moletom com elástico na cintura, perfeita para momentos de lazer.',
                'preco' => 99.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => 'produtos/calcas/calca-moletom.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Calça Social Slim',
                'desc' => 'Calça social slim fit, elegante e moderna para ocasiões formais.',
                'preco' => 179.90,
                'desconto' => 15.00,
                'status' => true,
                'url' => 'produtos/calcas/calca-social-slim.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Calça Cargo',
                'desc' => 'Calça cargo com bolsos laterais, estilo militar e urbano.',
                'preco' => 159.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => 'produtos/calcas/calca-cargo.jpg',
                'categoria_id' => $categoriaId
            ]
        ];

        foreach ($produtos as $produto) {
            $novoProduto = Produto::create($produto);
            
            // Adicionar estoque para cada produto com diferentes cores e tamanhos
            $cores = ['Azul Escuro', 'Preto', 'Cinza', 'Caqui'];
            $tamanhos = ['38', '40', '42', '44', '46'];
            
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