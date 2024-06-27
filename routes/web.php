<?php

use App\Http\Controllers\SpkoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SpkoController::class, 'index']);
Route::get('/create', [SpkoController::class, 'createGet']);
Route::post('/create', [SpkoController::class, 'createPost']);
Route::get('/update/{id}', [SpkoController::class, 'updateGet']);
Route::put('/update/{id}', [SpkoController::class, 'updatePost']);
Route::delete('/delete/{id}', [SpkoController::class, 'delete']);

Route::get('/print/{id}', [SpkoController::class, 'print']);