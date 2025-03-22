<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/product', [ProductController::class, 'index']);
Route::post('/product', [ProductController::class, 'store']);


Route::get('/category', [CategoryController::class, 'index']);
Route::post('/category', [CategoryController::class, 'store']);


Route::get('/', function () {
    return response()->json([
        'success' => true
    ]);
});

