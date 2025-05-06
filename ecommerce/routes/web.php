<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/cart/checkout',[CartController::class, 'checkout' ])->name('cart.checkout');
    Route::get('/cart/buy',[CartController::class, 'buy' ])->name('cart.buy');
    Route::get('/minha-conta', [UserController::class, 'profile'])->name('user.profile');
    Route::post('/minha-conta', [UserController::class, 'updateProfile'])->name('user.update-profile');
    Route::get('/meus-pedidos', [UserController::class, 'orders'])->name('user.orders');
    Route::get('/meus-pedidos/{id}', [UserController::class, 'orderDetails'])->name('user.order-details');
    
    // Rotas para gerenciamento de endereços
    Route::get('/meus-enderecos', [AddressController::class, 'index'])->name('user.addresses.index');
    Route::get('/meus-enderecos/novo', [AddressController::class, 'create'])->name('user.addresses.create');
    Route::post('/meus-enderecos', [AddressController::class, 'store'])->name('user.addresses.store');
    Route::get('/meus-enderecos/{id}/editar', [AddressController::class, 'edit'])->name('user.addresses.edit');
    Route::put('/meus-enderecos/{id}', [AddressController::class, 'update'])->name('user.addresses.update');
    Route::delete('/meus-enderecos/{id}', [AddressController::class, 'destroy'])->name('user.addresses.destroy');
    Route::post('/meus-enderecos/{id}/principal', [AddressController::class, 'setMain'])->name('user.addresses.set-main');
});

Route::get('/',[HomeController::class, 'index' ])->name('home.home');

Route::post('/search',[ProductController::class, 'search' ])->name('product.search');
Route::get('/produto/{id}',[ProductController::class, 'show' ])->name('product.show');
Route::get('/produto/{id}/estoque', [ProductController::class, 'verificarEstoque']);

Route::get('/categoria', [CategoryController::class, 'categorias'])->name('category.categorias');

Route::get('/cart',[CartController::class, 'index' ])->name('cart.cart');
Route::post('/cart/add',[CartController::class, 'adicionar' ])->name('cart.add');
Route::post('/cart/update',[CartController::class, 'atualizar' ])->name('cart.update');
Route::post('/cart/remove',[CartController::class, 'remover' ])->name('cart.remove');
Route::post('/cart/finalizar', [CartController::class, 'finalizar'])->name('cart.finalizar');

Route::prefix('info')->group(function() {
    route::view('/contato', 'info.contato')->name('info.contato');
    route::view('/privacidade', 'info.privacidade')->name('info.privacidade');
    route::view('/quemsomos', 'info.quemsomos')->name('info.quemsomos');
    route::view('/termos', 'info.termos')->name('info.termos');
    route::view('/trocas', 'info.trocas')->name('info.trocas');
});


require __DIR__.'/auth.php';
