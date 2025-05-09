<?php

namespace Database\Seeders;

use App\Models\Produto;
use App\Models\Estoque;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CamisasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriaId = 1; // ID da categoria "camisas"
        
        // Busca todas as imagens disponíveis na pasta storage/app/public/image/camisas
        $imagensCamisas = [];
        $path = 'image/cards/camisas';
        $fullPath = storage_path('app/public/' . $path);
        
        if (File::exists($fullPath)) {
            $files = File::files($fullPath);
            foreach ($files as $file) {
                $extension = File::extension($file);
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                    $imagensCamisas[] = $file;
                }
            }
        }
        
        $produtos = [
            [
                'nome' => 'Camisa Social Branca',
                'desc' => 'Camisa social branca de algodão, corte slim fit, ideal para ocasiões formais.',
                'preco' => 129.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => null, // Será definido abaixo
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Camisa Xadrez',
                'desc' => 'Camisa xadrez em flanela, perfeita para um visual casual e despojado.',
                'preco' => 99.90,
                'desconto' => 10.00,
                'status' => true,
                'url' => null, // Será definido abaixo
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Camisa Jeans',
                'desc' => 'Camisa jeans lavada, com bolsos frontais e fechamento com botões de pressão.',
                'preco' => 149.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => null, // Será definido abaixo
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Camisa Estampada',
                'desc' => 'Camisa com estampa exclusiva, tecido leve e confortável para o verão.',
                'preco' => 119.90,
                'desconto' => 15.00,
                'status' => true,
                'url' => null, // Será definido abaixo
                'categoria_id' => $categoriaId
            ],
            [
                'nome' => 'Camisa Manga Curta',
                'desc' => 'Camisa de manga curta em algodão, ideal para dias quentes.',
                'preco' => 89.90,
                'desconto' => 0.00,
                'status' => true,
                'url' => null, // Será definido abaixo
                'categoria_id' => $categoriaId
            ]
        ];

        // Associa imagens aos produtos
        foreach ($produtos as $index => &$produto) {
            if (isset($imagensCamisas[$index])) {
                // Cria o caminho relativo para o storage
                $relativePath = $path . '/' . File::basename($imagensCamisas[$index]);
                $produto['url'] = $relativePath;
            } else {
                // Imagem padrão caso não tenha imagem disponível
                $produto['url'] = 'image/default-product.jpg';
            }
        }

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