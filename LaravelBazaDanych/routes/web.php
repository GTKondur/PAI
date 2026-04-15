<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return redirect('/kalkulator');
});


Route::get('/kalkulator', function () {
    return view('kalkulator');
})->middleware(['auth'])->name('kalkulator');


Route::post('/kalkulator', function (Request $request) {
   
})->middleware(['auth']);


Route::post('/kalkulator', function (Request $request) {
    $user = Auth::user();
    $kwota = $request->input('kwota');
    
    // Jeśli kwota > 100 000, admin
    if ($kwota > 100000 && $user->role !== 'admin') {
        return back()->with('messages', ['Błąd: Kwoty powyżej 100 000 PLN może zatwierdzać tylko Administrator!']);
    }

    // Jeśli kwota > 50 000, pracownik
    if ($kwota > 50000 && !in_array($user->role, ['worker', 'admin'])) {
        return back()->with('messages', ['Błąd: Jako zwykły użytkownik nie masz uprawnień do takich kwot.']);
    }

    $procent = 0.05;
    $wynik = $kwota + ($kwota * $procent);

    return view('kalkulator', [
        'result' => $wynik,
        'kwota' => $kwota
    ]);
})->middleware(['auth']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';