<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// 1. Wyświetlanie formularza
Route::get('/kalkulator', function () {
    return view('kalkulator');
});

// 2. Obsługa obliczeń
Route::post('/kalkulator', function (Request $request) {
    $kwota = $request->input('kwota');
    $lata = $request->input('lata');
    $oprocentowanie = $request->input('oprocentowanie');

    $messages = [];

    if ($kwota == null || $lata == null || $oprocentowanie == null) {
        $messages[] = 'Błędne wywołanie aplikacji. Brak parametrów.';
    }

    if (empty($messages)) {
        if (!is_numeric($kwota)) $messages[] = 'Kwota nie jest liczbą';
        if (!is_numeric($lata)) $messages[] = 'Lata nie są liczbą';
        if (!is_numeric($oprocentowanie)) $messages[] = 'Oprocentowanie nie jest liczbą';
    }

    $result = null;

    if (empty($messages)) {
        $kwota = floatval($kwota);
        $lata = floatval($lata);
        $oprocentowanie = floatval($oprocentowanie);

        $result = ($kwota + ($kwota * $oprocentowanie / 100)) / ($lata * 12);
        $result = number_format($result, 2, '.', '');
    }

    return view('kalkulator', [
        'kwota' => $kwota,
        'lata' => $lata,
        'oprocentowanie' => $oprocentowanie,
        'result' => $result,
        'messages' => $messages
    ]);
});