<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// CRUD

// CREATE User
Route::post('/register', [AuthController::class, 'createUser'])->name('register');
// READ
Route::post('/login', [AuthController::class, 'userLogin'])->name('login');
