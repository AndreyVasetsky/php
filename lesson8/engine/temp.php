<?php


function buildPage()
{
    $template = file_get_contents('../templates/products.html');

    $sql = "SELECT id, imgSrc, title, price
            FROM products";

    $res = mysqli_query(connect(), $sql);

    $content = '';

    while ($row = mysqli_fetch_assoc($res)) {
        $content .= <<<php
        <div class="product" >
           <p class="title">{$row['title']}</p>
           <img src="{$row['imgSrc']}" alt="{$row['title']}" data-id="{$row['id']}">
           <a href="?page=products&action=removeProduct&id={$row['id']}">удалить</a>
           <a href="?page=editProduct&id={$row['id']}">изменить</a>
           <p class="price">{$row['price']} <span>₽</span></p>
        </div>
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


