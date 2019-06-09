<?php
// этот файл является точкой входа

// создадим константу с уазанием пути к корню нашего сайта
const PUBLIC_DIR = __DIR__;

// подключим файл с настройками и необходимыми функциями
include('config/settings.php');

// сохраняем параметры приходящих запросов в переменные
$page = (int)$_GET['page'];
$id = (int)$_GET['id'];

// своебразный роутинг
// в зависимости от параметра запроса загружаем нужную страничку,
// которая сгенерирует переменную $content
// считываем в $file нужный шаблон
switch ($page) {
    case 1:
        include('engine/productCatalog.php');
        $template = file_get_contents('templates/productCatalog.html');
        break;
    case 2:
        include('engine/addProduct.php');
        $template = file_get_contents('templates/addProduct.html');
        break;
    case 3:
        include('engine/productPage.php');
        $template = file_get_contents('templates/productPage.html');
        break;
    case 4:
        include('engine/calculator.php');
        $template = file_get_contents('templates/calculator.html');
        break;
    default:
        include('engine/productCatalog.php');
        $template = file_get_contents('templates/productCatalog.html');
}

$menu = file_get_contents('templates/menu.html');

// выводим считанный шаблон с замененными кусочкоми
echo str_replace(['{MENU}', '{CONTENT}', '{REVIEWS}'], [$menu, $content, $reviews], $template);
