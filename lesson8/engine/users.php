<?php

function buildPage()
{
    $template = file_get_contents('../templates/users.html');

    $sql = "SELECT id, nickname, email, password, role
            FROM users";

    $res = mysqli_query(connect(), $sql);

    $content = <<<php
        <table class="users">
            <tr><td>nickname</td>
                <td>email</td>
                <td>password</td>
                <td>role</td>
                <td>редактировать</td>
                <td>удалить</td>
            </tr>
php;

    while ($row = mysqli_fetch_assoc($res)) {
        $content .= <<<php
        <tr>
            <td>{$row['nickname']}</td>
            <td>{$row['email']}</td>
            <td>{$row['password']}</td>
            <td>{$row['role']}</td>
            <td><a class="good" href="?page=editUser&id={$row['id']}">редактировать</a></td>
            <td><a class="bad" href="?page=users&action=removeUser&id={$row['id']}">удалить</a></td>
        </tr>
php;
    }

    $content .= '</table>';

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

function removeUser() {
    $id = (int)$_GET['id'];

    $sql = "DELETE FROM users
            WHERE id = " . $id;

    $res = mysqli_query(connect(), $sql);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}