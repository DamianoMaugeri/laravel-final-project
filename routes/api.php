<?php

use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

//========================== rotte per i film 

Route::get('movies',[MovieController::class, 'index']);

Route::get('movies/{movie}',[MovieController::class, 'show']);

// Route::get('movies/{movie}/stream',[MovieController::class, 'stream']);


// ====================== rotte per le reviews

// middleware('auth:sanctum')->

Route::middleware([])->group(function () {
    
    // Rotte protette per reviews
    Route::apiResource('reviews', ReviewController::class)->only([
        'store', 'update', 'destroy'
    ]);

    // Rotta protetta per like toggle
    Route::post('movies/{movie}/like', [LikeController::class, 'toggle'])->name('movies.like.toggle'); // forse bisogna rimuovere il toggle dal name
});

// ========================= rotte per  i likes



//============================== rotte per l'autenticazione 

