<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Estoque;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'desc',
        'preco',
        'status',
        'url',
        'categoria_id',
    ];

    protected $table = 'produtos';

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function estoque()
    {
        return $this->hasOne(Estoque::class);
    }
}
