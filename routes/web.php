<?php

use App\Http\Controllers\SpkoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SpkoController::class, 'index']);
Route::get('/create', [SpkoController::class, 'createGet']);
Route::post('/create', [SpkoController::class, 'createPost']);
Route::get('/update/{id}', [SpkoController::class, 'updateGet']);
Route::post('/update/{id}', [SpkoController::class, 'updatePost']);

Route::get('/print/{id}', [SpkoController::class, 'print']);