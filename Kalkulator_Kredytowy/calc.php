<?php
$kwota = '';
$lata = '';
$oprocentowanie = '';
$messages = [];
$result = null;

$kwota = $_REQUEST['kwota'] ?? '';
$lata = $_REQUEST['lata'] ?? '';
$oprocentowanie = $_REQUEST['oprocentowanie'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($kwota == "") {
        $messages[] = 'Nie podano kwoty kredytu';
    }
    if ($lata == "") {
        $messages[] = 'Nie podano liczby lat';
    }
    if ($oprocentowanie == "") {
        $messages[] = 'Nie podano oprocentowania';
    }

    if (empty($messages)) {
        if (!is_numeric($kwota)) {
            $messages[] = 'Kwota musi być liczbą';
        }
        if (!is_numeric($lata)) {
            $messages[] = 'Liczba lat musi być liczbą';
        }
        if (!is_numeric($oprocentowanie)) {
            $messages[] = 'Oprocentowanie musi być liczbą';
        }
    }

    if (empty($messages)) {
        $P = floatval($kwota);
        $n = intval($lata) * 12;
        $r = floatval($oprocentowanie) / 100 / 12;

        $result = round($P * $r * pow(1 + $r, $n) / (pow(1 + $r, $n) - 1), 2);
    }
}

include 'calc_view.php';