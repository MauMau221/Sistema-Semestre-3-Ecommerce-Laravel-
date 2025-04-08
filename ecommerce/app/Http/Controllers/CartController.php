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
        $total = 0;
        foreach ($cart as $id => $item) { //Traz os valores correspondente ao ID e coloca dentro e $item
            $subtotal = $item['preco'] * $item['quantidade'];

            $total += $subtotal;
        }
        return view('cart.cart', compact('cart', 'total'));
    }

    public function adicionar(Request $request)
    {
        $produto = Produto::find($request->produto_id);
        $cart = Session::get('cart', []);

        //Se o produto ja existe no carrinho aumenta a quantidade
        if (isset($cart[$produto->id])) {
            $cart[$produto->id]['quantidade'] += $request->quantidade;
        } else {
            //Se não adiciona um item novo
            $cart[$produto->id] = [
                'id' => $produto->id,
                'nome' => $produto->nome,
                'preco' => $produto->preco,
                'quantidade' => $request->quantidade,
            ];
            
            if ($request->quantidade == 0 || $request->quantidade === null) {
                $cart[$produto->id]['quantidade'] += 1;
            }
        }

        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Produto adicionado na sacola de compras');
    }

    public function atualizar(Request $request)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$request->produto_id])) {
            $cart[$request->produto_id]['quantidade'] = $request->quantidade;
            Session::put('cart', $cart);
        }

        redirect()->back()->with('success', 'Sacola atualizada!');
    }

    public function remover(Request $request)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$request->produto_id])) {
            unset($cart[$request->produto_id]); //Se existir remove ele do carrinho
            Session::put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Produto removido da sacola!');
    }

    public function checkout(string $id)
    {
        //
    }
}
