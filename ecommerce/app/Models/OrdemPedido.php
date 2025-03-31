<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdemPedido extends Model
{
    protected $table = 'ordem_pedidos';
    protected $fillable = [
        'pedido_id',
        'produto_id',
        'quantidade',
        'preco_unitario',
        'subtotal',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}
