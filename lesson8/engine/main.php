<?php

// подключаем вспомогательный файл
include('../config/services.php');

// стартуем новую либо возобновляем существующую сессию
session_start();

// создаем переменные со значениями переданными в параметрах,
// либо присваиваем им значения по умолчанию
$page = ! empty($_GET['page']) ? $_GET['page'] : 'default';
$action = ! empty($_GET['action']) ? $_GET['action'] : 'defaultAction';

// у нас нет слэша в конце константы - добавляем его
$dir = __DIR__ . '/';

// если страницы с таким названием нет?
// - возвращаем $page значение по умолчанию
if (! file_exists($dir . $page . '.php')) {
    $page = 'productCatalog';
}

// подключаем логику страницы
include($dir . $page . '.php');

// если нет такого обработчика?
// - возвращаем $action значение по умолчанию
if (! function_exists($action)) {
    $action = 'defaultAction';
}

// запускаем наш обработчик
$action();


//$msg = '';
//if (! empty($_SESSION['msg'])) {
//    $msg = $_SESSION['msg'];
//    unset($_SESSION['msg']);
//}



