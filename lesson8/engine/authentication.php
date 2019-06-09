<?php

function buildPage() {
    $template = file_get_contents('../templates/authentication.html');
    return $template;
}

function defaultAction()
{
    echo buildPage();
}

function authentication()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (empty($_POST['password']) || empty($_POST['email'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

        $email = clearStr($_POST['email']);

        $sql = "SELECT nickname, password
                FROM users
                WHERE email = '$email'";

        $res = mysqli_query(connect(), $sql);

        $row = mysqli_fetch_assoc($res);

        $password = md5($_POST['password'] . SOL);

        if ($password == $row['password']) {

            $_SESSION['authorization'] = SUCCESS;
            $_SESSION['nickname'] = $row['nickname'];
            $_SESSION['email'] = $email;

            header('Location: ?page=productCatalog');
        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}



