<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/users', [UserController::class, 'index']);


Route::get('/product', [ProductController::class, 'index']);
Route::post('/product', [ProductController::class, 'store']);


Route::get('/', function () {
    return response()->json([
        'success' => true
    ]);
});

