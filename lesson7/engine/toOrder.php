<?php

function buildPage()
{
    $template = file_get_contents('../templates/toOrder.html');

//    $order

    include('menu.php');

    $abbreviations = ['{MENU}'];
    $replacements = [$menu];

    $template = str_replace($abbreviations, $replacements, $template);

    return $template;
}

function defaultAction()
{
    if (cartIsEmpty()) {
        header('Location: ?page=productCatalog');
        exit();
    }

    if (authorizationCheck()) {
        echo buildPage();
    } else {
        header('Location: ?page=authentication');
    }
}

function checkout()
{

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // -----------------------------------------------------
        // получаем ID пользователя
        // -----------------------------------------------------
        $sql = "SELECT id 
                FROM users
                WHERE email = '{$_SESSION['email']}'";

        $res = mysqli_query(connect(), $sql);

        $row = mysqli_fetch_assoc($res);

        $userId = $row['id'];

        // -----------------------------------------------------
        // формируем json для $details
        // -----------------------------------------------------
        $idList = implode(', ', array_keys($_SESSION['cart']));

        $sql = "SELECT id, imgSrc, title, price
                FROM products
                WHERE id IN ({$idList})";

        $res = mysqli_query(connect(), $sql);

        $details = [];

        while ($row = mysqli_fetch_assoc($res)) {

            $details[$row['id']] = [
                "title" => $row['title'],
                "price" => $row['price'],
                "count" => $_SESSION['cart'][$row['id']]
            ];

        }

//        $details = json_encode($details);
        $details = json_encode($details, JSON_UNESCAPED_UNICODE);

        // -----------------------------------------------------
        // получаем данные из $_POST
        // -----------------------------------------------------
        $comment = clearStr($_POST['comment']);
        $deliveryAddress = clearStr($_POST['deliveryAddress']);

        // -----------------------------------------------------
        // заносим данные в orders
        // -----------------------------------------------------
        $sql = "INSERT INTO orders(userId, details, comment, deliveryAddress)
                VALUES ('{$userId}','{$details}','{$comment}','{$deliveryAddress}')";

        mysqli_query(connect(), $sql) or die(mysqli_error(connect()));

        // -----------------------------------------------------
        // очищаем корзину в $_SESSION
        // -----------------------------------------------------
        unset($_SESSION['cart']);

        header('Location: ?page=productCatalog');

    }
}