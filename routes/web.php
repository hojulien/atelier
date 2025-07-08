<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\MapController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginAction'])->name('loginAction');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerAction'])->name('registerAction');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/show/{id}', [UserController::class, 'show'])->name('users.show');
// Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
// Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');

Route::get('/suggestions', [SuggestionController::class, 'index'])->name('suggestions.index');
Route::get('/suggestions/show/{id}', [SuggestionController::class, 'show'])->name('suggestions.show');
Route::get('/suggestions/create', [SuggestionController::class, 'create'])->name('suggestions.create');
Route::post('/suggestions/store', [SuggestionController::class, 'store'])->name('suggestions.store');
Route::get('/suggestions/edit/{id}', [SuggestionController::class, 'edit'])->name('suggestions.edit');
Route::put('/suggestions/update/{id}', [SuggestionController::class, 'update'])->name('suggestions.update');
Route::delete('/suggestions/delete/{id}', [SuggestionController::class, 'destroy'])->name('suggestions.delete');

Route::get('/playlists', [PlaylistController::class, 'index'])->name('playlists.index');
Route::get('/playlists/show/{id}', [PlaylistController::class, 'show'])->name('playlists.show');
Route::get('/playlists/create', [PlaylistController::class, 'create'])->name('playlists.create');
Route::post('/playlists/store', [PlaylistController::class, 'store'])->name('playlists.store');
Route::get('/playlists/edit/{id}', [PlaylistController::class, 'edit'])->name('playlists.edit');
Route::put('/playlists/update/{id}', [PlaylistController::class, 'update'])->name('playlists.update');
Route::delete('/playlists/delete/{id}', [PlaylistController::class, 'destroy'])->name('playlists.delete');

Route::get('/maps', [MapController::class, 'index'])->name('maps.index');
Route::get('/maps/show/{id}', [MapController::class, 'show'])->name('maps.show');
Route::get('/maps/create', [MapController::class, 'create'])->name('maps.create');
Route::post('/maps/store', [MapController::class, 'store'])->name('maps.store');
Route::get('/maps/edit/{id}', [MapController::class, 'edit'])->name('maps.edit');
Route::put('/maps/update/{id}', [MapController::class, 'update'])->name('maps.update');
Route::delete('/maps/delete/{id}', [MapController::class, 'destroy'])->name('maps.delete');