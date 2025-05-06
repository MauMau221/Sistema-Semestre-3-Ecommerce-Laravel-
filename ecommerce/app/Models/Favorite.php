<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'produto_id',
    ];
    
    /**
     * Get the user that owns the favorite.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the product that is favorited.
     */
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
