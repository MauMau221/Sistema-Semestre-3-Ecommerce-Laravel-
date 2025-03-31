<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = [
        'user_id',
        'total',
        'status_id',
    ];



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Pedido pertence a um usuario
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id'); // Pedido pertence a um status
    }

    public function itens()
    {
        return $this->belongsTo(OrdemPedido::class, 'pedido_id'); // Pedido pertence a uma ordem de pedido
    }
}
