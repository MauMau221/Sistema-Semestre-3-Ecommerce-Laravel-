<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Estoque; // Corrigindo a importação

class Produto extends Model
{
    use HasFactory;

    // Definir explicitamente o nome da tabela se for necessário
    protected $table = 'produtos';

    // Relacionamento um-para-um com Estoque
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // Relacionamento com Estoque
    public function estoque()
    {
        return $this->hasOne(Estoque::class);
    }
}
