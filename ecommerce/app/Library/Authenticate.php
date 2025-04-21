<?php

namespace App\Library;

use App\Models\User;
use Illuminate\Support\Facades\Auth;


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

        Auth::login($userFound);
        return redirect('/')->with('success', 'Login realizado com sucesso');
    }
}
