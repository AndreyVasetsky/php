<?php

function createGallery()
{
    $link = mysqli_connect(
        'localhost',
        'root',
        '',
        'geekbrains'
    );

    $sql = "SELECT id, src, alt FROM gallery ORDER BY gallery.views DESC";
    $res = mysqli_query($link, $sql); // or die(mysqli_error($link));

    $content = '';

    while ($row = mysqli_fetch_assoc($res)) {
        $content .= "<img src=\"{$row['src']}\" alt=\"{$row['alt']}\" data-id=\"{$row['id']}\">";
    }

    echo $content;

    mysqli_close($link);
}




