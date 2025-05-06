<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('status', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('descricao')->nullable();
            $table->timestamps();
        });
        
        // Inserir os status padrão
        DB::table('status')->insert([
            ['nome' => 'Pendente', 'descricao' => 'Pedido aguardando processamento', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Em processamento', 'descricao' => 'Pedido em processamento', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Enviado', 'descricao' => 'Pedido enviado para entrega', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Entregue', 'descricao' => 'Pedido entregue com sucesso', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Cancelado', 'descricao' => 'Pedido cancelado', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status');
    }
}; 