<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Todo;

Route::get('/', [Todo::class, 'index']);
Route::post('/todos', [Todo::class, 'store']);
Route::put('/todos/{id}', [Todo::class, 'update']);
Route::put('/todos/{id}', [Todo::class, 'complete']);
Route::delete('/todos/{id}', [Todo::class, 'destroy']);
