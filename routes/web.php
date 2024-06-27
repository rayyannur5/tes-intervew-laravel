<?php

use App\Http\Controllers\SpkoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SpkoController::class, 'index']);
Route::get('/create', [SpkoController::class, 'createGet']);
Route::post('/create', [SpkoController::class, 'createPost']);