<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ProdutosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produtos = [
            [
                'nome' => 'Camiseta Básica',
                'desc' => 'Camiseta básica de algodão, confortável e versátil para o dia a dia.',
                'preco' => 49.90,
                'categoria_id' => 1
            ],
            [
                'nome' => 'Calça Jeans Slim',
                'desc' => 'Calça jeans slim fit, com elastano para maior conforto.',
                'preco' => 129.90,
                'categoria_id' => 1
            ],
            [
                'nome' => 'Tênis Casual',
                'desc' => 'Tênis casual com solado confortável e design moderno.',
                'preco' => 199.90,
                'categoria_id' => 2
            ],
            [
                'nome' => 'Vestido Floral',
                'desc' => 'Vestido floral com tecido leve e fluido, perfeito para o verão.',
                'preco' => 159.90,
                'categoria_id' => 3
            ],
            [
                'nome' => 'Blazer Social',
                'desc' => 'Blazer social com corte moderno e tecido de qualidade.',
                'preco' => 299.90,
                'categoria_id' => 1
            ],
            [
                'nome' => 'Moletom com Capuz',
                'desc' => 'Moletom confortável com capuz e bolsos frontais.',
                'preco' => 89.90,
                'categoria_id' => 1
            ],
            [
                'nome' => 'Bermuda Jeans',
                'desc' => 'Bermuda jeans com corte reto e bolsos frontais.',
                'preco' => 79.90,
                'categoria_id' => 1
            ],
            [
                'nome' => 'Sapato Social',
                'desc' => 'Sapato social em couro legítimo com acabamento premium.',
                'preco' => 249.90,
                'categoria_id' => 2
            ],
            [
                'nome' => 'Blusa de Tricô',
                'desc' => 'Blusa de tricô com detalhes em ponto fantasia.',
                'preco' => 119.90,
                'categoria_id' => 3
            ],
            [
                'nome' => 'Jaqueta de Couro',
                'desc' => 'Jaqueta de couro sintético com forro interno.',
                'preco' => 199.90,
                'categoria_id' => 1
            ]
        ];

        foreach ($produtos as $produto) {
            Produto::create($produto);
        }
    }
}
