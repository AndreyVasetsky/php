<?php

function buildPage()
{
    $template = file_get_contents('../templates/products.html');

    $sql = "SELECT id, imgSrc, title, price, availability
            FROM products";

    $res = mysqli_query(connect(), $sql);

    $content = '';

    while ($row = mysqli_fetch_assoc($res)) {
        $content .= <<<php
            <tr>
                <td><a href="?page=products&action=removeProduct&id={$row['id']}">X</a></td>
                <td><img src="{$row['imgSrc']}" alt="{$row['title']}" data-id="{$row['id']}"></td>
                <td><p class="price">{$row['price']} <span>₽</span></p></td>
                <td><p class="title">{$row['title']}</p></td>
                <td>{$row['availability']}</td>
                <td><a href="?page=editProduct&id={$row['id']}">изменить</a></td>
            </tr>
php;
    }

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

function removeProduct()
{
    $id = (int)$_GET['id'];

    $sql = "DELETE FROM products
            WHERE id = " . $id;

    $res = mysqli_query(connect(), $sql);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}


