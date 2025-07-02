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
Route::get('/suggestions/create', [SuggestionController::class, 'create'])->name('suggestions.create');
Route::post('/suggestions/store', [SuggestionController::class, 'store'])->name('suggestions.store');

Route::get('/playlists', [PlaylistController::class, 'index'])->name('playlists.index');
Route::get('/playlists/create', [PlaylistController::class, 'create'])->name('playlists.create');
Route::post('/playlists/store', [PlaylistController::class, 'store'])->name('playlists.store');

Route::get('/maps', [MapController::class, 'index'])->name('maps.index');
Route::get('/maps/create', [MapController::class, 'create'])->name('maps.create');
Route::post('/maps/store', [MapController::class, 'store'])->name('maps.store');