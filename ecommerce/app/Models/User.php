<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    /**
     * Get the addresses for the user.
     */
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
    
    /**
     * Get the user's main address.
     */
    public function mainAddress()
    {
        return $this->hasMany(Address::class)->where('endereco_principal', true)->first();
    }
    
    /**
     * Get the user's favorites.
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    
    /**
     * Get the favorite products for the user.
     */
    public function favoriteProducts()
    {
        return $this->belongsToMany(Produto::class, 'favorites', 'user_id', 'produto_id')
                    ->withTimestamps();
    }
}
