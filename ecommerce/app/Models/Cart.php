<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';

    protected $fillable = [
        'user_id',
        'produto_id',
        'quantidade',
        'preco_unitario',
    ];

    public function produtos()
    {
        return $this->hasMany(Produto::class, 'produto_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }
}
