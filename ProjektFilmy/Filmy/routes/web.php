<?php

use App\Http\Controllers\FilmController;
use App\Http\Controllers\ListaController;
use App\Http\Controllers\RecenzjaController;
use App\Http\Controllers\OcenaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// Strona główna — przekierowanie do logowania
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('filmy.index');
    }
    return redirect()->route('login');
})->name('home');

// Filmy (publiczne)
Route::get('/filmy', [FilmController::class, 'index'])->name('filmy.index');
Route::get('/filmy/{film}', [FilmController::class, 'show'])->name('filmy.show');

// Wymagane logowanie
Route::middleware('auth')->group(function () {

    // Profil (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dodawanie i edycja filmów
    Route::get('/filmy/create', [FilmController::class, 'create'])->name('filmy.create');
    Route::post('/filmy', [FilmController::class, 'store'])->name('filmy.store');
    Route::get('/filmy/{film}/edit', [FilmController::class, 'edit'])->name('filmy.edit');
    Route::patch('/filmy/{film}', [FilmController::class, 'update'])->name('filmy.update');
    Route::delete('/filmy/{film}', [FilmController::class, 'destroy'])->name('filmy.destroy');

    // Lista użytkownika
    Route::get('/moja-lista', [ListaController::class, 'index'])->name('lista.index');
    Route::post('/lista/{film}', [ListaController::class, 'store'])->name('lista.store');
    Route::patch('/lista/{film}', [ListaController::class, 'update'])->name('lista.update');
    Route::delete('/lista/{film}', [ListaController::class, 'destroy'])->name('lista.destroy');

    // Oceny
    Route::post('/oceny/{film}', [OcenaController::class, 'store'])->name('oceny.store');
    Route::patch('/oceny/{film}', [OcenaController::class, 'update'])->name('oceny.update');

    // Recenzje
    Route::post('/recenzje/{film}', [RecenzjaController::class, 'store'])->name('recenzje.store');
    Route::delete('/recenzje/{recenzja}', [RecenzjaController::class, 'destroy'])->name('recenzje.destroy');

    // Panel admina
    Route::middleware('can:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::patch('/recenzje/{recenzja}/ukryj', [AdminController::class, 'ukryjRecenzje'])->name('recenzje.ukryj');
        Route::patch('/uzytkownicy/{user}/toggle', [AdminController::class, 'toggleUser'])->name('uzytkownicy.toggle');
    });
});

require __DIR__.'/auth.php';