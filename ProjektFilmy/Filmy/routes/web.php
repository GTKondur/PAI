<?php

use App\Http\Controllers\FilmController;
use App\Http\Controllers\ListaController;
use App\Http\Controllers\RecenzjaController;
use App\Http\Controllers\OcenaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GatunekController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('filmy.index');
    }
    return redirect()->route('login');
})->name('home');

Route::get('/filmy', [FilmController::class, 'index'])->name('filmy.index');

Route::middleware(['auth', 'can:moderator'])->group(function () {
    Route::get('/filmy/create', [FilmController::class, 'create'])->name('filmy.create');
    Route::post('/filmy', [FilmController::class, 'store'])->name('filmy.store');
    Route::get('/filmy/{film}/edit', [FilmController::class, 'edit'])->name('filmy.edit');
    Route::patch('/filmy/{film}', [FilmController::class, 'update'])->name('filmy.update');
    Route::delete('/filmy/{film}', [FilmController::class, 'destroy'])->name('filmy.destroy');

    Route::get('/gatunki', [GatunekController::class, 'index'])->name('gatunki.index');
    Route::post('/gatunki', [GatunekController::class, 'store'])->name('gatunki.store');
    Route::delete('/gatunki/{gatunek}', [GatunekController::class, 'destroy'])->name('gatunki.destroy');
});

Route::get('/filmy/{film}', [FilmController::class, 'show'])->name('filmy.show');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/moja-lista', [ListaController::class, 'index'])->name('lista.index');
    Route::post('/lista/{film}', [ListaController::class, 'store'])->name('lista.store');
    Route::patch('/lista/{film}', [ListaController::class, 'update'])->name('lista.update');
    Route::delete('/lista/{film}', [ListaController::class, 'destroy'])->name('lista.destroy');

    Route::post('/oceny/{film}', [OcenaController::class, 'store'])->name('oceny.store');
    Route::patch('/oceny/{film}', [OcenaController::class, 'update'])->name('oceny.update');

    Route::post('/recenzje/{film}', [RecenzjaController::class, 'store'])->name('recenzje.store');
    Route::patch('/recenzje/{recenzja}', [RecenzjaController::class, 'update'])->name('recenzje.update');
    Route::delete('/recenzje/{recenzja}', [RecenzjaController::class, 'destroy'])->name('recenzje.destroy');
    Route::patch('/recenzje/{recenzja}/ukryj', [RecenzjaController::class, 'ukryj'])->name('recenzje.ukryj');

    Route::middleware('can:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::patch('/recenzje/{recenzja}/ukryj', [AdminController::class, 'ukryjRecenzje'])->name('recenzje.ukryj');
        Route::patch('/uzytkownicy/{user}/toggle', [AdminController::class, 'toggleUser'])->name('uzytkownicy.toggle');
        Route::patch('/uzytkownicy/{user}/rola', [AdminController::class, 'zmienRole'])->name('uzytkownicy.rola');
        Route::delete('/uzytkownicy/{user}', [AdminController::class, 'usunUzytkownika'])->name('uzytkownicy.usun');
    });
});

require __DIR__.'/auth.php';
