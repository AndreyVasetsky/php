<?php

function buildPage() {
    $template = file_get_contents($dir . '../templates/registration.html');
    return $template;
}

function defaultAction()
{
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

        $_SESSION['authorization'] = SUCCESS;
        $_SESSION['nickname'] = $nickName;
        $_SESSION['email'] = $email;

        header('Location: ?page=productCatalog');

    }
}