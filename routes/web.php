<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Home route - returns welcome view
Route::get('/', function () {
    return view('welcome');
});

// User CRUD Routes
// GET /users - List all users
Route::get('/users', [UserController::class, 'index'])->name('users.index');

// GET /users/create - Show user creation form info
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

// POST /users - Create new user
Route::post('/users', [UserController::class, 'store'])->name('users.store');

// GET /users/{id} - Show specific user
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

// GET /users/{id}/edit - Show user edit form info
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');

// PUT /users/{id} - Update user (full update)
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

// PATCH /users/{id} - Update user (partial update)
Route::patch('/users/{id}', [UserController::class, 'update'])->name('users.update.patch');

// DELETE /users/{id} - Delete user (soft delete)
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');