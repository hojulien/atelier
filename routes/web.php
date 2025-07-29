<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\AdminController;
use App\Models\Playlist;
use App\Http\Middleware\IsAdmin;

Route::get('/', function () {
    $adminPlaylists = Playlist::where('type', 'admin')->where('number_maps','>','0')->limit(10)->get();
    return view('welcome', ['playlists' => $adminPlaylists]);
})->name('home');

// NO PERMISSIONS - everyone can see these views
Route::get('/users/profile/{id}', [UserController::class, 'show'])->name('users.profile');
Route::get('/playlists', [PlaylistController::class, 'index'])->name('playlists.index');
Route::get('/playlists/show/{id}', [PlaylistController::class, 'show'])->name('playlists.show');
Route::get('/maps', [MapController::class, 'index'])->name('maps.index');
Route::get('/maps/details/{id}', [MapController::class, 'show'])->name('maps.details');

// GUESTS ONLY (login/register features)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginAction'])->name('loginAction');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerAction'])->name('registerAction');
});

// USERS ONLY (additional permissions are applied for edit/update, i.e policies)
// redirects to 404 if trying to access
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');

    Route::get('/playlists/create', [PlaylistController::class, 'create'])->name('playlists.create');
    Route::post('/playlists/store', [PlaylistController::class, 'store'])->name('playlists.store');
    Route::get('/playlists/addMaps/{id}', [PlaylistController::class, 'addMaps'])->name('playlists.addMaps');
    Route::post('/playlists/addMaps/{id}', [PlaylistController::class, 'updateMaps'])->name('playlists.updateMaps');
    Route::get('/playlists/edit/{id}', [PlaylistController::class, 'edit'])->name('playlists.edit');
    Route::put('/playlists/update/{id}', [PlaylistController::class, 'update'])->name('playlists.update');
    Route::delete('/playlists/delete/{id}', [PlaylistController::class, 'destroy'])->name('playlists.delete');

    Route::get('/suggestions/show/{id}', [SuggestionController::class, 'show'])->name('suggestions.show');
    Route::get('/suggestions/create', [SuggestionController::class, 'create'])->name('suggestions.create');
    Route::post('/suggestions/store', [SuggestionController::class, 'store'])->name('suggestions.store');

    Route::post('/maps/{id}/like', [UserController::class, 'like'])->name('maps.like');
    Route::delete('/maps/{id}/like', [UserController::class, 'unlike'])->name('maps.unlike');
});

// ADMINS ONLY - redirects to 403 (or login) if trying to access
Route::middleware([IsAdmin::class, 'auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    
    Route::get('/suggestions', [SuggestionController::class, 'index'])->name('suggestions.index');
    Route::get('/suggestions/edit/{id}', [SuggestionController::class, 'edit'])->name('suggestions.edit');
    Route::put('/suggestions/update/{id}', [SuggestionController::class, 'update'])->name('suggestions.update');
    Route::delete('/suggestions/archive/{id}', [SuggestionController::class, 'archive'])->name('suggestions.archive');
    Route::patch('/suggestions/restore/{id}', [SuggestionController::class, 'restore'])->name('suggestions.restore');
    Route::delete('/suggestions/delete/{id}', [SuggestionController::class, 'destroy'])->name('suggestions.delete');

    Route::get('/maps/add', [MapController::class, 'add'])->name('maps.add');
    Route::post('/maps/store', [MapController::class, 'store'])->name('maps.store');
    Route::get('/maps/edit/{id}', [MapController::class, 'edit'])->name('maps.edit');
    Route::put('/maps/update/{id}', [MapController::class, 'update'])->name('maps.update');
    Route::delete('/maps/delete/{id}', [MapController::class, 'destroy'])->name('maps.delete');
});

// OTHER ROUTES
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});