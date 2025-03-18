<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Estoque;

class EstoqueFactory extends Factory
{
    protected $model = Estoque::class;

    public function definition(): array
    {
        return [
            'produto_id' => null, // Definido na Factory de Produto
            'quantidade' => $this->faker->numberBetween(10, 100),
        ];
    }
}
