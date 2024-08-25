<?php

use App\Http\Controllers\Todo\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TodoController::class, "index"])->name("todo.index");
Route::post('/', [TodoController::class, "store"])->name("todo.store");