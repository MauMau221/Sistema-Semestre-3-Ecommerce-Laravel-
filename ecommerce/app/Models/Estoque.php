<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    protected $table = 'estoque'; // Defina o nome da tabela se necessário
    protected $fillable = ['produto_id', 'quantidade']; // Adicione os campos que podem ser preenchidos
}
