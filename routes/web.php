<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\MapController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');

Route::get('/suggestions', [SuggestionController::class, 'index'])->name('suggestions.index');
Route::get('/playlists', [PlaylistController::class, 'index'])->name('playlists.index');

Route::get('/maps', [MapController::class, 'index'])->name('maps.index');
Route::get('/maps/create', [MapController::class, 'create'])->name('maps.create');
Route::post('/maps/store', [MapController::class, 'store'])->name('maps.store');