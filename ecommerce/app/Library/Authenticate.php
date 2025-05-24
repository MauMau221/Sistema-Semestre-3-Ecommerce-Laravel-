<?php

namespace App\Library;

use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class Authenticate
{
    public function authGoogle($data)
    {
        $user = new User;
        $userFound = $user->where('email', $data->email)->first();
        if (!$userFound) {
            $user->insert([
                'name' => $data->givenName,
                'email' => $data->email,
                'avatar' => $data->picture,
            ]);
            $userFound = $user->where('email', $data->email)->first();
        }

        // Antes de fazer o login, transfere os itens do carrinho da sessão para o banco
        $cart = Session::get('cart', []);
        if (!empty($cart)) {
            foreach ($cart as $produtoId => $item) {
                Cart::updateOrCreate(
                    [
                        'user_id' => $userFound->id,
                        'produto_id' => $produtoId,
                    ],
                    [
                        'quantidade' => $item['quantidade'],
                        'preco_unitario' => $item['preco'],
                    ]
                );
            }
        }

        Auth::login($userFound);
        return redirect('/')->with('success', 'Login realizado com sucesso');
    }
}
