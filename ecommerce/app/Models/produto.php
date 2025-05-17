<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Estoque;
use App\Models\Favorite;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $fillable = [
        'nome',
        'desc',
        'preco',
        'status',
        'url',
        'categoria_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function estoque()
    {
        return $this->hasMany(Estoque::class);
    }
    
    /**
     * Get the users who favorited this product.
     */
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites', 'produto_id', 'user_id')
                    ->withTimestamps();
    }
    
    /**
     * Check if the product is favorited by a specific user.
     */
    public function isFavoritedBy($userId)
    {
        if (!$userId) {
            return false;
        }
        
        // Verificar se a tabela favorites existe antes de fazer a consulta
        try {
            // Verifica diretamente se existe um registro na tabela favorites
            return Favorite::where('user_id', $userId)
                         ->where('produto_id', $this->id)
                         ->exists();
        } catch (\Exception $e) {
            // Se ocorrer algum erro (tabela não existe, etc.), retorna false
            return false;
        }
    }
}
