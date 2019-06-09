<?php

function buildPage()
{
    $template = file_get_contents('../templates/editUser.html');

    $id = (int)$_GET['id'];

    $sql = "SELECT nickname, email, password, role
            FROM users
            WHERE id = " . $id;

    $res = mysqli_query(connect(), $sql);

    $row = mysqli_fetch_assoc($res);

    $content = <<<php
        <form method="post" action="?page=editUser&action=toUpdate&id={$id}" class="">
            <input name="nickname" type="text" value = "{$row['nickname']}">
            <input name="email" type="text" value = "{$row['email']}">
            <input name="password" type="text" value = "{$row['password']}">
            <input name="role" type="text" value = "{$row['role']}">
            
            <input type="submit" value="Обновить данные" >
        </form>
php;


    include('adminMenu.php');

    $abbreviations = ['{MENU}', '{CONTENT}'];
    $replacements = [$menu, $content];

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

function toUpdate() {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $id = (int)$_GET['id'];

        $nickname = clearStr($_POST['nickname']);
        $email = clearStr($_POST['email']);
        $password = clearStr($_POST['password']);
        $role = clearStr($_POST['$availability']);

        $sql = "UPDATE users
                SET nickname='{$nickname}',email='{$email}',password='{$password}',role='{$role}'
                WHERE id = '{$id}'";

        mysqli_query(connect(), $sql);

        header('Location: ?page=users');
    }

}

