<?php

if (!empty($_GET['imgId'])) {
    $imgId = (int)$_GET['imgId'];

    $link = mysqli_connect(
        'localhost',
        'root',
        '',
        'geekbrains'
    );

    $sql = "SELECT * FROM gallery WHERE id = $imgId";
    $res = mysqli_query($link, $sql); // or die(mysqli_error($link));

    $content = '';

    $row = mysqli_fetch_assoc($res);

    $content .= "<img src=\"{$row['src']}\" alt=\"{$row['alt']}\" data-views=\"{$row['views']}\" data-id=\"{$row['id']}\">";
    $content .= "<p>просмотров:" . ($row['views'] + 1) . "</p>";

    $row['views']++;

    $sql = "UPDATE gallery SET views = " . ($row['views']++) . " WHERE id = $imgId";
    $res = mysqli_query($link, $sql);


    mysqli_close($link);
}