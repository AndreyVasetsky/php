<?php

function buildPage()
{
    $template = file_get_contents('../templates/productCatalog.html');

    $sql = "SELECT id, imgSrc, title, price, availability
            FROM products";

    $res = mysqli_query(connect(), $sql);

    $content = '';

    while ($row = mysqli_fetch_assoc($res)) {

        if($row['availability'] != 'yes') {continue;}

        $content .= <<<php
        <div class="product" >
           <p class="title">{$row['title']}</p>
           <img src="{$row['imgSrc']}" alt="{$row['title']}" data-id="{$row['id']}">
           <p class="price">{$row['price']} <span>₽</span></p>
        </div>
php;
    }

    include('menu.php');

    $abbreviations = ['{MENU}', '{CONTENT}'];
    $replacements = [$menu, $content];

    $template = str_replace($abbreviations, $replacements, $template);

    return $template;

}

function defaultAction()
{
    echo buildPage();
}


