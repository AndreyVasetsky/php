<?php

$sql = "SELECT id, imgSrc, title, price FROM products";
$res = mysqli_query(connect(), $sql);

$content = '';

while ($row = mysqli_fetch_assoc($res)) {
    $content .= <<<php
        <div class="product" >
           <p class="title">{$row['title']}</p>
            <img src="{$row['imgSrc']}" alt="{$row['title']}" data-id="{$row['id']}">
            <p class="price">{$row['price']} <span>₽</span></p>
        </div>
php;
}
