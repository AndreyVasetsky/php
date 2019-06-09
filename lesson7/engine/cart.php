<?php

function buildPage()
{
    $template = file_get_contents('../templates/cart.html');
    $total = 0;

    if (empty($_SESSION['cart'])) {
        $cart = '<tr><td colspan="7">Ваша корзина пуста</td></tr>';
    } else {

        $idList = implode(', ', array_keys($_SESSION['cart']));

        $sql = "SELECT id, imgSrc, title, price
                FROM products
                WHERE id IN ({$idList})";

        $res = mysqli_query(connect(), $sql);

        $cart = '';

        while ($row = mysqli_fetch_assoc($res)) {

            $totalPrice = $row['price'] * $_SESSION['cart'][$row['id']];
            $total += $totalPrice;

            $cart .= <<<php
            <tr>
                <td><a href="?page=cart&action=removeFromCart&id={$row['id']}">X</a></td>
                <td><img src="{$row['imgSrc']}" alt="{$row['title']}"></td>
                <td>{$row['price']} ₽</td>
                <td>{$row['title']}</td>
                <td>{$_SESSION['cart'][$row['id']]}</td>
                <td>
                    <a href="?page=cart&action=addToCart&id={$row['id']}">+</a>
                    <a href="?page=cart&action=reduceQuantity&id={$row['id']}">-</a>
                </td>
                <td>{$totalPrice} ₽</td>
            </tr>
php;
        }
    }

    include('menu.php');

    $abbreviations = ['{MENU}', '{CART}', '{TOTAL}'];
    $replacements = [$menu, $cart, $total];

    $template = str_replace($abbreviations, $replacements, $template);

    return $template;
}

function defaultAction()
{
    echo buildPage();
}


function addToCart()
{

    $id = (int)$_GET['id'];

    if ($_SESSION['cart'][$id]) {
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function reduceQuantity()
{

    $id = (int)$_GET['id'];

    if ($_SESSION['cart'][$id] > 1) {
        $_SESSION['cart'][$id]--;
    } else {
        unset($_SESSION['cart'][$id]);
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function removeFromCart()
{

    $id = (int)$_GET['id'];

    if ($_SESSION['cart'][$id]) {
        unset($_SESSION['cart'][$id]);
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
