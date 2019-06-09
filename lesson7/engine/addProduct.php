<?php

function buildPage()
{
    $template = file_get_contents('../templates/addProduct.html');

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

function addProduct()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $imgDir = 'img/' . $_FILES['userfile']['name'];
        copy($_FILES['userfile']['tmp_name'], $imgDir);

        $imgSrc = 'img/' . $_FILES['userfile']['name'];
        $title = clearStr($_POST['title']);
        $price = (int)clearStr($_POST['price']);
        $description = clearStr($_POST['description']);

        $sql = "INSERT INTO products (imgSrc, title, price, description)
                VALUES ('{$imgSrc}', '{$title}', '{$price}', '{$description}')";

        mysqli_query(connect(), $sql);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

