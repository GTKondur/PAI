<?php

require_once _ROOT_PATH.'/lib/Smarty/libs/Smarty.class.php';

$smarty = new Smarty\Smarty();

$smarty->setTemplateDir([
    _ROOT_PATH.'/app',
    _ROOT_PATH.'/templates'
]);

$smarty->setCompileDir(_ROOT_PATH.'/templates_c');
$smarty->setCacheDir(_ROOT_PATH.'/cache');


$form['kwota'] = $_REQUEST['kwota'] ?? '';
$form['lata'] = $_REQUEST['lata'] ?? '';
$form['oprocentowanie'] = $_REQUEST['oprocentowanie'] ?? '';

$messages = [];
$result = null;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($form['kwota'] === '') $messages[] = 'Nie podano kwoty';
    if ($form['lata'] === '') $messages[] = 'Nie podano lat';
    if ($form['oprocentowanie'] === '') $messages[] = 'Nie podano oprocentowania';

    if (empty($messages)) {
        if (!is_numeric($form['kwota'])) $messages[] = 'Kwota musi być liczbą';
        if (!is_numeric($form['lata'])) $messages[] = 'Lata muszą być liczbą';
        if (!is_numeric($form['oprocentowanie'])) $messages[] = 'Oprocentowanie musi być liczbą';
    }

    if (empty($messages)) {
        $P = floatval($form['kwota']);
        $n = intval($form['lata']) * 12;
        $r = floatval($form['oprocentowanie']) / 100 / 12;

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


$smarty->assign('app_url', _APP_URL);
$smarty->assign('form', $form);
$smarty->assign('messages', $messages);
$smarty->assign('result', $result);


$smarty->display(_ROOT_PATH.'/app/calc.html');