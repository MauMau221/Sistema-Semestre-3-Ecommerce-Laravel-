<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/cart/checkout',[CartController::class, 'checkout' ])->name('cart.checkout');
});

Route::get('/',[HomeController::class, 'index' ])->name('home.home');

Route::post('/search',[ProductController::class, 'search' ])->name('product.search');
Route::get('/produto/{id}',[ProductController::class, 'show' ])->name('product.show');

Route::get('/categoria', [CategoryController::class, 'categorias'])->name('category.categorias');

Route::get('/cart',[CartController::class, 'index' ])->name('cart.cart');
Route::post('/cart/add',[CartController::class, 'adicionar' ])->name('cart.add');
Route::post('/cart/update',[CartController::class, 'atualizar' ])->name('cart.update');
Route::post('/cart/remove',[CartController::class, 'remover' ])->name('cart.remove');

Route::prefix('info')->group(function() {
    route::view('/contato', 'info.contato')->name('info.contato');
    route::view('/privacidade', 'info.privacidade')->name('info.privacidade');
    route::view('/quemsomos', 'info.quemsomos')->name('info.quemsomos');
    route::view('/termos', 'info.termos')->name('info.termos');
    route::view('/trocas', 'info.trocas')->name('info.trocas');
});


require __DIR__.'/auth.php';
