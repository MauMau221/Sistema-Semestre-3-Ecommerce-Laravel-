<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('status')->insert([
            ['nome' => 'Pendente', 'descricao' => 'Pedido aguardando processamento', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Em processamento', 'descricao' => 'Pedido em processamento', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Enviado', 'descricao' => 'Pedido enviado para entrega', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Entregue', 'descricao' => 'Pedido entregue com sucesso', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Cancelado', 'descricao' => 'Pedido cancelado', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
} 