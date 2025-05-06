<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';

    protected $fillable = [
        'nome',
        'descricao',
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class); //Um status para muitos pedidos 
    }
}
