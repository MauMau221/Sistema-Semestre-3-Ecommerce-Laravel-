<?php

namespace Database\Seeders;

use App\Models\Produto;
use App\Models\Estoque;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JaquetasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriaId = 6; // ID da categoria "jaquetas"
        
        $produtos = [
            [
                'nome' => 'Jaqueta Jeans',
                'desc' => 'Jaqueta jeans clássica, versátil e durável para o dia a dia.',
                'preco' => 199.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => 'produtos/jaquetas/jaqueta-jeans.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Jaqueta de Couro',
                'desc' => 'Jaqueta de couro sintético, estilo biker com forro macio.',
                'preco' => 249.90,
                'desconto' => 30.00,
                'status' => true,
                'url' => 'produtos/jaquetas/jaqueta-couro.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Jaqueta Corta Vento',
                'desc' => 'Jaqueta corta vento leve e impermeável, perfeita para dias chuvosos.',
                'preco' => 159.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => 'produtos/jaquetas/jaqueta-corta-vento.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Jaqueta Bomber',
                'desc' => 'Jaqueta bomber estilo militar, moderna e confortável.',
                'preco' => 189.90,
                'desconto' => 20.00,
                'status' => true,
                'url' => 'produtos/jaquetas/jaqueta-bomber.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Jaqueta Acolchoada',
                'desc' => 'Jaqueta acolchoada com enchimento térmico, ideal para o inverno.',
                'preco' => 229.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => 'produtos/jaquetas/jaqueta-acolchoada.jpg',
                'categoria_id' => $categoriaId
            ]
        ];

        foreach ($produtos as $produto) {
            $novoProduto = Produto::create($produto);
            
            // Adicionar estoque para cada produto com diferentes cores e tamanhos
            $cores = ['Preto', 'Marrom', 'Azul Escuro', 'Verde Militar'];
            $tamanhos = ['P', 'M', 'G', 'GG'];
            
            foreach ($cores as $cor) {
                foreach ($tamanhos as $tamanho) {
                    Estoque::create([
                        'produto_id' => $novoProduto->id,
                        'cor' => $cor,
                        'tamanho' => $tamanho,
                        'quantidade' => rand(3, 15)
                    ]);
                }
            }
        }
    }
} 