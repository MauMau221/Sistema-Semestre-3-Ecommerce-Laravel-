<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Mostra a página de perfil do usuário para edição
     */
    public function profile()
    {
        $user = Auth::user();
        $addresses = $user->addresses;
        $mainAddress = $user->addresses()->where('endereco_principal', true)->first();
        
        return view('user.profile', compact('user', 'addresses', 'mainAddress'));
    }

    /**
     * Atualiza os dados do usuário
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'current_password' => ['nullable', 'required_with:password', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('A senha atual está incorreta.');
                }
            }],
            'password' => ['nullable', 'min:8', 'confirmed'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();
        
        return redirect()->route('user.profile')->with('success', 'Perfil atualizado com sucesso!');
    }

    /**
     * Lista os pedidos do usuário
     */
    public function orders()
    {
        $user = Auth::user();
        $pedidos = Pedido::where('user_id', $user->id)
                        ->orderBy('created_at', 'desc')
                        ->get();
        
        return view('user.orders', compact('pedidos'));
    }

    /**
     * Mostra os detalhes de um pedido específico
     */
    public function orderDetails($id)
    {
        $user = Auth::user();
        $pedido = Pedido::where('id', $id)
                        ->where('user_id', $user->id)
                        ->firstOrFail();
        
        $itens = $pedido->itens; // Carrega os itens do pedido através do relacionamento
        
        return view('user.order_details', compact('pedido', 'itens'));
    }
} 