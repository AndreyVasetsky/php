<?php

function buildPage() {
    $template = file_get_contents('../templates/addUser.html');

    include('adminMenu.php');

    $abbreviations = ['{MENU}'];
    $replacements = [$menu];

    $template = str_replace($abbreviations, $replacements, $template);

    return $template;
}

function defaultAction()
{
    if (!authorizationCheck()) {
        header('Location: ?page=authentication');
        exit();
    }

    if (!adminCheck()) {
        header('Location: ?page=account');
        exit();
    }

    echo buildPage();
}

function toRegister()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (empty($_POST['password']) || empty($_POST['email']) || empty($_POST['nickName'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

        $nickName = clearStr($_POST['nickName']);
        $email = clearStr($_POST['email']);

        $password = clearStr($_POST['password']);
        $password = md5($password . SOL);

        $sql = "INSERT INTO users (nickname, email, password, registered)
                VALUES ('{$nickName}', '{$email}', '{$password}', NOW())";

        mysqli_query(connect(), $sql);

        header('Location: ' . $_SERVER['HTTP_REFERER']);

    }
}
