<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = clearStr($_POST['name']);
    $review = clearStr($_POST['review']);

    $sql = "INSERT INTO productreviews (name, review, productId) VALUES ('{$name}', '{$review}', '{$id}')";

    mysqli_query(connect(), $sql);
    header('Location: ?page=3&id=' . $id);
    exit;
}



$sql = "SELECT imgSrc, title, price FROM products WHERE id = " . $id;
$res = mysqli_query(connect(), $sql);

$row = mysqli_fetch_assoc($res);

$content .= <<<php
        <p class="title">{$row['title']}</p>
        <img src="{$row['imgSrc']}" alt="{$row['title']}">
        <p class="price">{$row['price']} <span>₽</span></p>
php;



include_once 'addReview.php';