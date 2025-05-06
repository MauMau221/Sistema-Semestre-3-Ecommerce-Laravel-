<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Mostra a lista de endereços do usuário
     */
    public function index()
    {
        $user = Auth::user();
        $addresses = $user->addresses;
        
        return view('user.addresses.index', compact('addresses'));
    }
    
    /**
     * Mostra o formulário para criar um novo endereço
     */
    public function create()
    {
        return view('user.addresses.create');
    }
    
    /**
     * Salva um novo endereço no banco de dados
     */
    public function store(Request $request)
    {
        $request->validate([
            'cep' => 'required|string|max:10',
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:20',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|size:2',
            'endereco_principal' => 'sometimes|boolean'
        ]);
        
        $user = Auth::user();
        
        // Se este for marcado como endereço principal, desmarca os outros
        if ($request->has('endereco_principal') && $request->endereco_principal) {
            Address::where('user_id', $user->id)
                  ->update(['endereco_principal' => false]);
        }
        
        // Cria o endereço
        $address = new Address($request->all());
        $address->user_id = $user->id;
        $address->save();
        
        return redirect()->route('user.addresses.index')
                        ->with('success', 'Endereço adicionado com sucesso!');
    }
    
    /**
     * Mostra o formulário para editar um endereço
     */
    public function edit($id)
    {
        $user = Auth::user();
        $address = Address::where('id', $id)
                        ->where('user_id', $user->id)
                        ->firstOrFail();
        
        return view('user.addresses.edit', compact('address'));
    }
    
    /**
     * Atualiza um endereço no banco de dados
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'cep' => 'required|string|max:10',
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:20',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|size:2',
            'endereco_principal' => 'sometimes|boolean'
        ]);
        
        $user = Auth::user();
        $address = Address::where('id', $id)
                        ->where('user_id', $user->id)
                        ->firstOrFail();
        
        // Se este for marcado como endereço principal, desmarca os outros
        if ($request->has('endereco_principal') && $request->endereco_principal) {
            Address::where('user_id', $user->id)
                  ->where('id', '!=', $id)
                  ->update(['endereco_principal' => false]);
        }
        
        $address->update($request->all());
        
        return redirect()->route('user.addresses.index')
                        ->with('success', 'Endereço atualizado com sucesso!');
    }
    
    /**
     * Remove um endereço do banco de dados
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $address = Address::where('id', $id)
                        ->where('user_id', $user->id)
                        ->firstOrFail();
        
        $address->delete();
        
        return redirect()->route('user.addresses.index')
                        ->with('success', 'Endereço removido com sucesso!');
    }
    
    /**
     * Define um endereço como principal
     */
    public function setMain($id)
    {
        $user = Auth::user();
        
        // Desmarca todos os endereços como principais
        Address::where('user_id', $user->id)
               ->update(['endereco_principal' => false]);
        
        // Marca o endereço selecionado como principal
        $address = Address::where('id', $id)
                         ->where('user_id', $user->id)
                         ->firstOrFail();
        $address->endereco_principal = true;
        $address->save();
        
        return redirect()->route('user.addresses.index')
                        ->with('success', 'Endereço principal definido com sucesso!');
    }
}
