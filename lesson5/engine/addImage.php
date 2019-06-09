<?php

if (!empty($_GET['img-src']) && !empty($_GET['img-alt'])) {
    $imgSrc = $_GET['img-src'];
    $imgAlt = $_GET['img-alt'];

    $link = mysqli_connect(
        'localhost',
        'root',
        '',
        'geekbrains'
    );

    $sql = "INSERT INTO gallery (src, alt) VALUES ('{$imgSrc}', '{$imgAlt}')";
    mysqli_query($link, $sql);

    header('Location: /');

    mysqli_close($link);
}
