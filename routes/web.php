<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\Tmdb\TmdbController;

Route::get('/', [TmdbController::class, 'getPopular'])->name('movies.popular');
Route::get('/movies/search', [TmdbController::class, 'search'])->name('movies.search');
