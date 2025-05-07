<?php

namespace Database\Seeders;

use App\Models\Produto;
use App\Models\Estoque;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CalcadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriaId = 4; // ID da categoria "calcados"
        
        $produtos = [
            [
                'nome' => 'Tênis Casual',
                'desc' => 'Tênis casual moderno, leve e confortável para o dia a dia.',
                'preco' => 199.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => 'produtos/calcados/tenis-casual.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Tênis Esportivo',
                'desc' => 'Tênis esportivo com amortecimento, ideal para corridas e treinos.',
                'preco' => 249.90,
                'desconto' => 30.00,
                'status' => true,
                'url' => 'produtos/calcados/tenis-esportivo.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Sapato Social',
                'desc' => 'Sapato social em couro legítimo, elegante e confortável.',
                'preco' => 279.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => 'produtos/calcados/sapato-social.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Chinelo de Dedo',
                'desc' => 'Chinelo de dedo confortável para uso casual ou na praia.',
                'preco' => 49.90,
                'desconto' => 5.00,
                'status' => true,
                'url' => 'produtos/calcados/chinelo-dedo.jpg',
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Bota Casual',
                'desc' => 'Bota casual em couro sintético, ideal para o inverno.',
                'preco' => 229.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => 'produtos/calcados/bota-casual.jpg',
                'categoria_id' => $categoriaId
            ]
        ];

        foreach ($produtos as $produto) {
            $novoProduto = Produto::create($produto);
            
            // Adicionar estoque para cada produto com diferentes cores e tamanhos
            $cores = ['Preto', 'Marrom', 'Branco', 'Cinza'];
            $tamanhos = ['36', '37', '38', '39', '40', '41', '42', '43', '44'];
            
            foreach ($cores as $cor) {
                foreach ($tamanhos as $tamanho) {
                    Estoque::create([
                        'produto_id' => $novoProduto->id,
                        'cor' => $cor,
                        'tamanho' => $tamanho,
                        'quantidade' => rand(3, 20)
                    ]);
                }
            }
        }
    }
} 