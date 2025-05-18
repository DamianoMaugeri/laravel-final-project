<?php

use App\Http\Controllers\LikeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::resource("movies", MovieController::class)
->middleware(['auth','verified']);


// Tutti possono vedere le recensioni
Route::resource('movies.reviews', ReviewController::class)->only(['index', 'show']);

// Solo utenti autenticati possono creare/modificare/eliminare
Route::middleware('auth')->group(function () {
    Route::resource('movies.reviews', ReviewController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
});


Route::post('/movies/{movie}/like', [LikeController::class, 'toggle'])->middleware('auth')->name('movies.like');




require __DIR__.'/auth.php';
