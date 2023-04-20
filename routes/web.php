<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\AnimeController::class, 'index'])->name('anime.index');
Route::get('/{id}', [App\Http\Controllers\AnimeController::class, 'show'])->name('anime.show');
Route::get('/{id}/episodios', [App\Http\Controllers\AnimeController::class, 'show'])->name('anime.episodes');
Route::post('/{id}/rating', [App\Http\Controllers\AnimeController::class, 'storeRating'])->name('anime.rating.store');
