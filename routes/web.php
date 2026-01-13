<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Halaman Utama dengan nama 'dashboard' agar Jetstream tidak error
Route::get('/', [PageController::class, 'index'])->name('dashboard');

// Route untuk Guest (Tips & Recipe Detail)
Route::get('/recipe/{recipe}', [PageController::class, 'showRecipe'])->name('recipe.show');
Route::get('/tips/{tip}', [PageController::class, 'showTip'])->name('tips.show');

// Route yang membutuhkan Login
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/my-profile', [UserController::class, 'index'])->name('user.profile');
    Route::post('/recipe/{recipe}/comment', [PageController::class, 'storeComment'])->name('comment.store');
});
