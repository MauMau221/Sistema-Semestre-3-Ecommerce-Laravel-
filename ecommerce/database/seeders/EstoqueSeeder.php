<?php

namespace Database\Seeders;

use App\Models\Estoque;
use App\Models\Produto;
use Illuminate\Database\Seeder;

class EstoqueSeeder extends Seeder
{
    public function run(): void
    {
        $cores = ['Azul', 'Preto', 'Branco', 'Vermelho', 'Verde'];
        $tamanhos = ['P', 'M', 'G', 'GG'];

        // Para cada produto, criar registros de estoque com diferentes cores e tamanhos
        Produto::all()->each(function ($produto) use ($cores, $tamanhos) {
            // Seleciona aleatoriamente 2-4 cores para cada produto
            $coresProduto = collect($cores)->random(rand(2, 4));
            
            foreach ($coresProduto as $cor) {
                // Para cada cor, cria estoque com diferentes tamanhos
                foreach ($tamanhos as $tamanho) {
                    Estoque::create([
                        'produto_id' => $produto->id,
                        'cor' => $cor,
                        'tamanho' => $tamanho,
                        'quantidade' => rand(5, 50) // Quantidade aleatória entre 5 e 50
                    ]);
                }
            }
        });
    }
} 