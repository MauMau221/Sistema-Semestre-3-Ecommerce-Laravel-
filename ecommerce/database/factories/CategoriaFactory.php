<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categoria;

class CategoriaFactory extends Factory
{
    protected $model = Categoria::class;

    public function definition(): array
    {
        return [
            // 'nome' => 'camisas',
            // 'descricao' => 'camisas de manga longa',            'status' => true

            
            'nome' => $this->faker->word,
            'descricao' => $this->faker->sentence, // Adicionando um valor aleatório
            'status' => $this->faker->boolean(80), // 80% de chance de ser "true"
        ];
    }
}
