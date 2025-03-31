<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    
    public function index()
    {
        return view('login.login');
    }

    public function create()
    {
        return view('login.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            return redirect()->route('home.home')->with('success', 'Você foi logado(a) com sucesso!');
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas são inválidas.',
        ]);
    }

    public function destroy()
    {
        
        Auth::guard('web')->logout();

        session()->invalidate();

        session()->regenerateToken();

        return redirect()->route('home.home');
    }
}
