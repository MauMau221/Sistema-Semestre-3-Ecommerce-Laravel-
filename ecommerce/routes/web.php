<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/',[HomeController::class, 'index' ])->name('index.home');
Route::post('/search',[HomeController::class, 'search' ])->name('index.search');
Route::get('/login',[HomeController::class, 'login' ])->name('index.login');


Route::get('/camisas', [CategoryController::class, 'camisas'])->name('category.camisas');
Route::get('/camisetas', [CategoryController::class, 'camisetas'])->name('category.camisetas');
Route::get('/blusas', [CategoryController::class, 'blusas'])->name('category.blusas');
Route::get('/calcas', [CategoryController::class, 'calcas'])->name('category.calcas');
Route::get('/calcados', [CategoryController::class, 'calcados'])->name('category.calcados');
Route::get('/polos', [CategoryController::class, 'polos'])->name('category.polos');
Route::get('/jaquetas', [CategoryController::class, 'jaquetas'])->name('category.jaquetas');
Route::get('/acessorios', [CategoryController::class, 'jaquetas'])->name('category.acessorios');


Route::prefix('info')->group(function() {
    route::view('/contato', 'info.contato')->name('info.contato');
    route::view('/privacidade', 'info.privacidade')->name('info.privacidade');
    route::view('/quemsomos', 'info.quemsomos')->name('info.quemsomos');
    route::view('/termos', 'info.termos')->name('info.termos');
    route::view('/trocas', 'info.trocas')->name('info.trocas');
});

require __DIR__.'/auth.php';
