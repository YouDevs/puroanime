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


Route::get('/admin/anime', [App\Http\Controllers\Admin\AnimeController::class, 'index'])->name('admin.anime.index');
Route::get('/admin/anime/create', [App\Http\Controllers\Admin\AnimeController::class, 'create'])->name('admin.anime.create');
Route::get('/admin/anime/{anime}/edit', [App\Http\Controllers\Admin\AnimeController::class, 'edit'])->name('admin.anime.edit');
Route::get('/admin/anime/{anime}/destroy', [App\Http\Controllers\Admin\AnimeController::class, 'destroy'])->name('admin.anime.destroy');
Route::post('/admin/anime/store', [App\Http\Controllers\Admin\AnimeController::class, 'store'])->name('admin.anime.store');
Route::put('/admin/anime/{anime}/update', [App\Http\Controllers\Admin\AnimeController::class, 'update'])->name('admin.anime.update');



