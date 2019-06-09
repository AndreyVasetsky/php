<?php

function buildPage($role)
{
    $template = file_get_contents('../templates/account.html');

    if ($role === 'admin') {
        include('adminMenu.php');
    } else {
        include('userMenu.php');
    }

    $content = "Добрый день {$_SESSION['nickname']}";

    $abbreviations = ['{MENU}', '{CONTENT}'];
    $replacements = [$menu, $content];

    $template = str_replace($abbreviations, $replacements, $template);

    return $template;
}

function defaultAction()
{
    if (!authorizationCheck()) {
        header('Location: ?page=authentication');
    }

    if (adminCheck()) {
        echo buildPage('admin');
    } else {
        echo buildPage('user');
    }

}

