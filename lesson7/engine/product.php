<?php

function buildPage()
{
    $id = (int)$_GET['id'];

    $template = file_get_contents('../templates/product.html');

    $sql = "SELECT imgSrc, title, price, description
            FROM products
            WHERE id = " . $id;

    $res = mysqli_query(connect(), $sql);

    $row = mysqli_fetch_assoc($res);

    $content = <<<php
        <p class="title">{$row['title']}</p>
        <img src="{$row['imgSrc']}" alt="{$row['title']}">
        <p class="price">{$row['price']} <span>₽</span></p>
        <h3>Описание товара</h3>
        <p class="description">{$row['description']}</p>
        <a class="addToCart" href="?page=cart&action=addToCart&id={$id}">Добавить в корзину</a>
php;

    $sql = "SELECT username, review
            FROM product_reviews
            WHERE productId = " . $id;

    $res = mysqli_query(connect(), $sql);

    $reviews = '';

    while ($row = mysqli_fetch_assoc($res)) {
        $reviews .= <<<php
        <div class="review" >
           <p>{$row['username']}</p>
           <p> - {$row['review']}</p>
           <hr>
        </div>
php;
    }

    include('menu.php');

    $abbreviations = ['{MENU}', '{CONTENT}', '{ID}', '{REVIEWS}'];
    $replacements = [$menu, $content, $id, $reviews];

    $template = str_replace($abbreviations, $replacements, $template);

    return $template;
}

function defaultAction()
{
    echo buildPage();
}

function addReview()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $id = (int)$_GET['id'];
        $name = clearStr($_POST['name']);
        $review = clearStr($_POST['review']);

        $sql = "INSERT INTO product_reviews (username, review, productId)
                VALUES ('{$name}', '{$review}', '{$id}')";

        mysqli_query(connect(), $sql);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

}