<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $imgDir = PUBLIC_DIR . '/public_html/img/' . $_FILES['userfile']['name'];

    copy($_FILES['userfile']['tmp_name'], $imgDir);

    $imgSrc = 'public_html/img/' . $_FILES['userfile']['name'];
    $title = clearStr($_POST['title']);
    $price = clearStr($_POST['price']);

    $sql = "INSERT INTO products (imgSrc, title, price) VALUES ('{$imgSrc}', '{$title}', '{$price}')";
    mysqli_query(connect(), $sql);

    header('Location: ?page=2');
    exit();
}




