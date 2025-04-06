<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Session::get('cart', []);
        return view('cart.cart', compact('cart'));

    }

    public function adicionar(Request $request)
    {
        $produto = Produto::find($request->produto_id);
        $cart = Session::get('cart', []);

        //Se o produto ja existe no carrinho aumenta a quantidade
        if(isset($cart[$produto->id])) {
            $cart[$produto->id]['quantidade'] += $request->quantidade;
        } else {
            //Se não adiciona um item novo
            $cart[$produto->id] = [
                'id' => $produto->id,
                'nome' => $produto->nome,
                'preco' => $produto->preco,
                'quantidade' => $request->quantidade,
            ];
        }

        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Produto adicionado na sacola de compras');
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function checkout(string $id)
    {
        //
    }
}
