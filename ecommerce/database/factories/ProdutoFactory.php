<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Produto;
use App\Models\Categoria;
use App\Models\Estoque;

class ProdutoFactory extends Factory
{
    protected $model = Produto::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->word,
            'desc' => $this->faker->sentence,
            'preco' => $this->faker->randomFloat(2, 1, 100),
            'categoria_id' => Categoria::factory(), // Cria uma categoria automaticamente
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Produto $produto) {
            Estoque::factory()->create([
                'produto_id' => $produto->id,
                'quantidade' => $this->faker->numberBetween(10, 100),
            ]);
        });
    }
}
