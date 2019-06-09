<?php

// используется для создания хэшей методом md5
// путем добавления перед генерацией
const SOL = 'WxtUQzj7';

// хэш md5(SUCCESS.SOL)
const SUCCESS = '39f807dcb56d53f15bf94a84932f8ede';

// возвращает переменную, содержащую ссылку на базу данных
function connect()
{
    static $link;
    if (empty($link)) {
        $link = mysqli_connect('localhost', 'root', '', 'geekbrains');
    }
    return $link;
}

// очистка строки от пробелов и инъекций кода
function clearStr($str)
{
    return mysqli_real_escape_string(connect(), strip_tags(trim($str)));
}

// проверка авторизации
function authorizationCheck()
{
    if (empty($_SESSION['authorization']) || $_SESSION['authorization'] != SUCCESS) {
        return false;
    }
    return true;
}

// корзина пустая?
function cartIsEmpty()
{
    if (!empty($_SESSION['cart'])) {
        return false;
    }
    return true;
}

// выход
function logout()
{
    if (authorizationCheck()) {
        session_unset();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}

// проверка на права админа
function adminCheck()
{
    $sql = "SELECT role
            FROM users
            WHERE email = '{$_SESSION['email']}'";

    $res = mysqli_query(connect(), $sql);
    $row = mysqli_fetch_assoc($res);

    if ($row['role'] !== 'admin') {
        return false;
    }
    return true;
}

// получить ID текущего пользователя
function giveUserId() {

    $sql = "SELECT id
            FROM users
            WHERE email = '{$_SESSION['email']}'";

    $res = mysqli_query(connect(), $sql) or die(mysqli_error(connect()));
    $row = mysqli_fetch_assoc($res);

    return $row['id'];
}




