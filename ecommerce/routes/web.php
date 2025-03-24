<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/',[HomeController::class, 'index' ])->name('index.home');
Route::post('/search',[HomeController::class, 'search' ])->name('index.search');
Route::get('/login',[HomeController::class, 'login' ])->name('index.login');


Route::get('/categoria', [CategoryController::class, 'categorias'])->name('category.categorias');


Route::prefix('info')->group(function() {
    route::view('/contato', 'info.contato')->name('info.contato');
    route::view('/privacidade', 'info.privacidade')->name('info.privacidade');
    route::view('/quemsomos', 'info.quemsomos')->name('info.quemsomos');
    route::view('/termos', 'info.termos')->name('info.termos');
    route::view('/trocas', 'info.trocas')->name('info.trocas');
});

require __DIR__.'/auth.php';
