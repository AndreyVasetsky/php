<?php

function buildPage()
{
    $template = file_get_contents('../templates/editProduct.html');

    $id = (int)$_GET['id'];

    $sql = "SELECT imgSrc, title, price, description, availability
            FROM products
            WHERE id = " . $id;

    $res = mysqli_query(connect(), $sql);

    $row = mysqli_fetch_assoc($res);

    $yes = '';
    $no = '';

    $row['availability'] == 'yes' ? $yes = 'checked' : $no = 'checked';

    $content = <<<php
        <img class="editImg" src="{$row['imgSrc']}" alt="{$row['title']}">
        <form method="post" action="?page=editProduct&action=toUpdate&id={$id}" enctype="multipart/form-data" class="addProduct">
            <input name="title" type="text" value = "{$row['title']}">
            <input name="userfile" type="file">
            <input name="price" type="text" value = "{$row['price']}">
            <textarea name="description" rows="3">{$row['description']}</textarea>
            <label><input name="availability" type="radio" value="yes" {$yes}>в продаже</label>
            <label><input name="availability" type="radio" value="no" {$no}>недоступен</label>
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

function toUpdate()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $id = (int)$_GET['id'];

        $title = clearStr($_POST['title']);
        $price = (int)clearStr($_POST['price']);
        $description = clearStr($_POST['description']);
        $availability = clearStr($_POST['availability']);

        // если не выбирали файл с картинкой
        if (empty($_FILES['userfile']['name'])) {

            $sql = "UPDATE products
                    SET title='{$title}',price='{$price}',description='{$description}',availability='{$availability}'
                    WHERE id = '{$id}'";

        } else {

            $imgDir = 'img/' . $_FILES['userfile']['name'];
            copy($_FILES['userfile']['tmp_name'], $imgDir);

            $imgSrc = 'img/' . $_FILES['userfile']['name'];

            $sql = "UPDATE products
                    SET imgSrc='{$imgSrc}', title='{$title}',price='{$price}',description='{$description}',availability='{$availability}'
                    WHERE id = '{$id}'";

        }

        mysqli_query(connect(), $sql);

        header('Location: ?page=products');
    }
}