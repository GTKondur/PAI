<?php

$kwota = $_REQUEST['kwota'] ?? '';
$lata = $_REQUEST['lata'] ?? '';
$oprocentowanie = $_REQUEST['oprocentowanie'] ?? '';

$messages = [];
$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Walidacja typów i zakresów robimy dalej, żeby zebrać wszystkie błędy.
    if ($kwota === "") {
        $messages[] = 'Nie podano kwoty kredytu';
    } elseif (!is_numeric($kwota)) {
        $messages[] = 'Kwota musi być liczbą';
    }

    if ($lata === "") {
        $messages[] = 'Nie podano liczby lat';
    } elseif (!is_numeric($lata)) {
        $messages[] = 'Liczba lat musi być liczbą';
    }

    if ($oprocentowanie === "") {
        $messages[] = 'Nie podano oprocentowania';
    } elseif (!is_numeric($oprocentowanie)) {
        $messages[] = 'Oprocentowanie musi być liczbą';
    }

    $kwotaVal = null;
    $lataVal = null;
    $oprocentowanieVal = null;

    if (!empty($kwota) && is_numeric($kwota)) {
        $kwotaVal = floatval($kwota);
        if ($kwotaVal <= 0) {
            $messages[] = 'Kwota kredytu musi być większa od 0';
        }
    }

    if (!empty($lata) && is_numeric($lata)) {
        $lataVal = intval($lata);
        if ($lataVal <= 0) {
            $messages[] = 'Liczba lat musi być większa od 0';
        }
    }

    if (!empty($oprocentowanie) && is_numeric($oprocentowanie)) {
        $oprocentowanieVal = floatval($oprocentowanie);
        if ($oprocentowanieVal < 0) {
            $messages[] = 'Oprocentowanie nie może być ujemne';
        }
    }

    if (empty($messages)) {
        $P = $kwotaVal;
        $n = $lataVal * 12;
        $r = $oprocentowanieVal / 100 / 12;

        if ($r == 0) {
            $result = round($P / $n, 2);
        } else {
            $result = round(
                $P * $r * pow(1 + $r, $n) /
                (pow(1 + $r, $n) - 1),
                2
            );
        }
    }
}

include 'calc_view.php';