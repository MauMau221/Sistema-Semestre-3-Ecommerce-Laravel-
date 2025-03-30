<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';

    protected $fillable = [
        'qtd',
        'produto_id',
        'user_id',
    ];

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
