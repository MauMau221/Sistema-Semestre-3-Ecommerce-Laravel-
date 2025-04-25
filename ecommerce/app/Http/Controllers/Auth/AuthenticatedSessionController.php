<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Library\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Library\GoogleClient;


class AuthenticatedSessionController extends Controller
{

    public function index()
    {
        $googleClient = new GoogleClient();
        $googleClient->init();

        if ($googleClient->authorized()) {
            $auth = new Authenticate();
            return $auth->authGoogle($googleClient->getData()); // getData() retorna os dados que o google tras apos realizar o login 
        }

        return view('login.login', ['authUrl' => $googleClient->generateAuthLink()]);
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

            return redirect()->intended()->with('success', 'Você foi logado(a) com sucesso!');
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

        return redirect()->route('home.home')->with('erro', 'Logout feito com sucesso!');
    }
}
