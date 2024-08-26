<?php

use App\Http\Controllers\Todo\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TodoController::class, "index"])->name("todo.index");
Route::post('/', [TodoController::class, "store"])->name("todo.store");
Route::put('/{id}', [TodoController::class, "update"])->name("todo.update");
Route::delete('/{id}', [TodoController::class, "destroy"])->name("todo.delete");