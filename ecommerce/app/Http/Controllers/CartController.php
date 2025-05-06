<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Produto;
use App\Models\Pedido;
use App\Models\OrdemPedido;
use App\Services\EstoqueService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    protected $estoqueService;

    public function __construct(EstoqueService $estoqueService)
    {
        $this->estoqueService = $estoqueService;
    }

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

        // Verifica se existe estoque disponível
        if (!$this->estoqueService->verificarDisponibilidade(
            $produto->id,
            $request->quantidade,
            $request->cor,
            $request->tamanho
        )) {
            return redirect()->back()->with('error', 'Quantidade indisponível em estoque');
        }

        //Se o produto ja existe no carrinho aumenta a quantidade
        if (isset($cart[$produto->id])) {
            $novaQuantidade = $cart[$produto->id]['quantidade'] + $request->quantidade;
            
            // Verifica se a nova quantidade total não excede o estoque
            if (!$this->estoqueService->verificarDisponibilidade(
                $produto->id,
                $novaQuantidade,
                $request->cor,
                $request->tamanho
            )) {
                return redirect()->back()->with('error', 'Quantidade indisponível em estoque');
            }
            
            $cart[$produto->id]['quantidade'] = $novaQuantidade;
        } else {
            //Se não adiciona um item novo
            $cart[$produto->id] = [
                'id' => $produto->id,
                'nome' => $produto->nome,
                'preco' => $produto->preco,
                'quantidade' => $request->quantidade,
                'cor' => $request->cor,
                'tamanho' => $request->tamanho
            ];

            if ($request->quantidade == 0 || $request->quantidade === null) {
                $cart[$produto->id]['quantidade'] = 1;
            }
        }
        // salva a URL anterior antes de redirecionar pro carrinho
        session(['url_anterior' => url()->previous()]);

        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Produto adicionado na sacola de compras');
    }

    public function atualizar(Request $request)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$request->produto_id])) {
            $produto = Produto::find($request->produto_id);
            
            // Verifica se a nova quantidade está disponível em estoque
            if (!$this->estoqueService->verificarDisponibilidade(
                $produto->id,
                $request->quantidade,
                $cart[$request->produto_id]['cor'],
                $cart[$request->produto_id]['tamanho']
            )) {
                return redirect()->back()->with('error', 'Quantidade indisponível em estoque');
            }

            $cart[$request->produto_id]['quantidade'] = $request->quantidade;
            Session::put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Sacola atualizada!');
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

    public function checkout()
    {
        $cart = Session::get('cart', []);
        $total = 0;
        foreach ($cart as $id => $item) { //Traz os valores correspondente ao ID e coloca dentro e $item
            $subtotal = $item['preco'] * $item['quantidade'];

            $total += $subtotal;
        }
        
        $user = null;
        $mainAddress = null;
        
        if (Auth::check()) {
            $user = Auth::user();
            $mainAddress = $user->addresses()->where('endereco_principal', true)->first();
        }
        
        return view('cart.checkout', compact('cart', 'total', 'user', 'mainAddress'));
    }
    public function buy()
    {
        $cart = Session::get('cart', []);
        $total = 0;
        foreach ($cart as $id => $item) { //Traz os valores correspondente ao ID e coloca dentro e $item
            $subtotal = $item['preco'] * $item['quantidade'];

            $total += $subtotal;
        }
        return view('cart.buy', compact('cart', 'total'));
    }

    public function finalizar(Request $request)
    {
        $cart = Session::get('cart', []);
        $total = 0;
        
        // Calcular o total
        foreach ($cart as $item) {
            $total += $item['preco'] * $item['quantidade'];
        }
        
        try {
            // Iniciar transação para garantir a integridade dos dados
            DB::beginTransaction();
            
            // Criar o pedido
            $pedido = new Pedido();
            $pedido->user_id = Auth::check() ? Auth::id() : null;
            $pedido->total = $total;
            $pedido->status_id = 1; // Status inicial (pendente)
            $pedido->save();
            
            // Processar cada item do carrinho
            foreach ($cart as $id => $item) {
                // Criar o item do pedido
                OrdemPedido::create([
                    'pedido_id' => $pedido->id,
                    'produto_id' => $item['id'],
                    'quantidade' => $item['quantidade'],
                    'preco_unitario' => $item['preco'],
                    'subtotal' => $item['preco'] * $item['quantidade'],
                    'cor' => $item['cor'] ?? null,
                    'tamanho' => $item['tamanho'] ?? null
                ]);
            
                // Atualizar o estoque para cada item
                $this->estoqueService->atualizarEstoque(
                    $item['id'],
                    $item['quantidade'],
                    $item['cor'] ?? null,
                    $item['tamanho'] ?? null
                );
            }
            
            // Finaliza a transação
            DB::commit();
            
            // Limpa o carrinho
            Session::forget('cart');
            
            return redirect()->route('user.orders')->with('success', 'Seu pedido foi realizado com sucesso! Você pode acompanhar o status pelo menu "Meus Pedidos".');
        } catch (\Exception $e) {
            // Em caso de erro, desfaz as alterações no banco
            DB::rollBack();
            
            return redirect()->back()->with('error', 'Erro ao finalizar pedido: ' . $e->getMessage());
        }
    }
}

