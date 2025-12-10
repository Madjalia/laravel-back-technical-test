<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;


Route::get('/orders', [OrderController::class, 'index']); 
Route::get('/orders/{order}', [OrderController::class, 'show']);
Route::post('/orders', [OrderController::class, 'store']);
Route::put('/orders/{order}', [OrderController::class, 'update']);
Route::delete('/orders/{order}', [OrderController::class, 'destroy']);