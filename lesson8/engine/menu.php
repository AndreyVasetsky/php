<?php

if (authorizationCheck()) {
    $menu = <<<php
    <ul class="menu">
        <li><a href="?page=productCatalog">Каталог товаров</a></li>
        <li><a href="?page=cart">Корзина</a></li>
        <li><a href="?page=calculator">Калькулятор</a></li>
        <li><a class="nick" href="?page=account">{$_SESSION['nickname']}</a> / <a class="logout" href="?action=logout">выход</a></li>
    </ul>
php;
} else {
    $menu = <<<php
    <ul class="menu">
        <li><a href="?page=productCatalog">Каталог товаров</a></li>
        <li><a href="?page=cart">Корзина</a></li>
        <li><a href="?page=calculator">Калькулятор</a></li>
        <li><a class="auth" href="?page=authentication">вход / регистрация</a></li>
    </ul>
php;
}

