<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Categoria;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::create([
            'nome' => 'camisas',
            'descricao' => 'camisas bacana',
            'status' => 1,
        ]);

        Categoria::create([
            'nome' => 'camisetas',
            'descricao' => 'camisetas bacana',
            'status' => 1,
        ]);

        Categoria::create([
            'nome' => 'calcas',
            'descricao' => 'calcas bacana',
            'status' => 1,
        ]);

        Categoria::create([
            'nome' => 'calcados',
            'descricao' => 'calcados bacana',
            'status' => 1,
        ]);

        Categoria::create([
            'nome' => 'polos',
            'descricao' => 'polos bacana',
            'status' => 1,
        ]);

        Categoria::create([
            'nome' => 'jaquetas',
            'descricao' => 'jaquetas bacana',
            'status' => 1,
        ]);

        Categoria::create([
            'nome' => 'acessorios',
            'descricao' => 'acessorios bacana',
            'status' => 1,
        ]);

        Categoria::create([
            'nome' => 'blusas',
            'descricao' => 'acessorios bacana',
            'status' => 1,
        ]);

        Categoria::factory(5)->create();
    }
}
