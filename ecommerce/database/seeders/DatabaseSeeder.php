<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $this->call(UsersSeeder::class);
        
        $this->call([
            // UsersSeeder::class,
            CategoriasSeeder::class,
            //ProdutosSeeder::class,
            UsersSeeder::class,
            StatusSeeder::class,
            EstoqueSeeder::class,
            CamisasSeeder::class,
            CamisetasSeeder::class,
            PolosSeeder::class,
            JaquetasSeeder::class,
            CalcasSeeder::class,
            CalcadosSeeder::class,
            AcessoriosSeeder::class,
            // Execute o ImagemProdutoSeeder após os outros seeders que criam produtos
            ImagemProdutoSeeder::class,
            // Processamento de imagens para as novas categorias
            ImagensAdicionaisSeeder::class,
            // Adiciona novos produtos para categorias sem produtos
            NovosProdutosSeeder::class,
        ]);


    }
}
