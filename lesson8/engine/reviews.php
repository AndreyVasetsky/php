<?php

function buildPage()
{
    $template = file_get_contents('../templates/reviews.html');

    $sql = "SELECT id, username, review, reviewData, productId
            FROM product_reviews
            WHERE status = 'new'";

    $res = mysqli_query(connect(), $sql);

    $content = <<<php
        <table class="users">
            <tr>
                <td>дата написания</td>
                <td>прозвище</td>
                <td>отзыв</td>
                <td>id товара</td>
                <td>одобрить</td>
                <td>удалить</td>
            </tr>
php;

    while ($row = mysqli_fetch_assoc($res)) {
        $content .= <<<php
        <tr>
            <td>{$row['reviewData']}</td>
            <td>{$row['username']}</td>
            <td>{$row['review']}</td>
            <td>{$row['productId']}</td>
            <td><a class="good" href="?page=reviews&action=toApprove&id={$row['id']}">одобрить</a></td>
            <td><a class="bad" href="?page=reviews&action=removeReview&id={$row['id']}">X</a></td>
        </tr>
php;
    }

    $content .= '</table>';

    include('adminMenu.php');

    $abbreviations = ['{MENU}', '{CONTENT}'];
    $replacements = [$menu, $content];

    $template = str_replace($abbreviations, $replacements, $template);

    return $template;
}

function defaultAction()
{
    if (!authorizationCheck()) {
        header('Location: ?page=authentication');
        exit();
    }

    if (!adminCheck()) {
        header('Location: ?page=account');
        exit();
    }

    echo buildPage();
}

function toApprove() {

    $id = $_GET['id'];

    $sql = "UPDATE product_reviews
            SET status = 'approved'
            WHERE id = " . $id;

    mysqli_query(connect(), $sql);

    header('Location: ' . $_SERVER['HTTP_REFERER']);

}

function removeReview() {

    $id = (int)$_GET['id'];

    $sql = "DELETE FROM product_reviews
            WHERE id = " . $id;

    mysqli_query(connect(), $sql);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}