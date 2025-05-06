<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the user's favorite products.
     */
    public function index()
    {
        $userId = Auth::id();
        
        // Obtém IDs dos produtos favoritados pelo usuário atual
        $favoriteIds = Favorite::where('user_id', $userId)->pluck('produto_id');
        
        // Busca os produtos correspondentes aos IDs
        $favorites = Produto::whereIn('id', $favoriteIds)->paginate(12);
        
        return view('user.favorites', compact('favorites'));
    }

    /**
     * Add a product to user's favorites.
     */
    public function add(Request $request)
    {
        $validated = $request->validate([
            'produto_id' => 'required|exists:produtos,id',
        ]);

        $favorite = Favorite::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'produto_id' => $validated['produto_id'],
            ]
        );

        return redirect()->back()->with('success', 'Produto adicionado aos favoritos!');
    }

    /**
     * Remove a product from user's favorites.
     */
    public function remove(Request $request)
    {
        $validated = $request->validate([
            'produto_id' => 'required|exists:produtos,id',
        ]);

        Favorite::where('user_id', Auth::id())
            ->where('produto_id', $validated['produto_id'])
            ->delete();

        return redirect()->back()->with('success', 'Produto removido dos favoritos!');
    }

    /**
     * Toggle a product in user's favorites (add if not exists, remove if exists).
     */
    public function toggle(Request $request)
    {
        $validated = $request->validate([
            'produto_id' => 'required|exists:produtos,id',
        ]);
        
        $userId = Auth::id();
        $produtoId = $validated['produto_id'];
        
        // Verifica se o favorito já existe
        $exists = Favorite::where('user_id', $userId)
                          ->where('produto_id', $produtoId)
                          ->exists();
        
        if ($exists) {
            // Se já existe, remove
            Favorite::where('user_id', $userId)
                    ->where('produto_id', $produtoId)
                    ->delete();
            
            $message = 'Produto removido dos favoritos!';
        } else {
            // Se não existe, cria
            Favorite::create([
                'user_id' => $userId,
                'produto_id' => $produtoId,
            ]);
            
            $message = 'Produto adicionado aos favoritos!';
        }
        
        // Verifica novamente se o produto está nos favoritos (para debug)
        $checkExists = Favorite::where('user_id', $userId)
                              ->where('produto_id', $produtoId)
                              ->exists();
        
        // Redireciona de volta
        return redirect()->back()->with('success', $message);
    }
}
