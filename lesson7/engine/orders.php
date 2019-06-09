<?php

function buildPage() {

    $template = file_get_contents('../templates/orders.html');

    $sql = "SELECT id, userId, data, details, comment, deliveryAddress, status
            FROM orders";

    $res = mysqli_query(connect(), $sql);

    $content = '';

    while ($row = mysqli_fetch_assoc($res)) {

        $content .= '<div class="order">';

        // преобразовал json в массив массивов
        $currentOrder = json_decode($row['details'], true);

        $orderHtml = giveOrderHtml($currentOrder);

        $content .= <<<php
            <p>
                {$row['data']} - <span>Заказ № {$row['id']}</span> - <span>{$row['status']}</span>
                 - <a class="statusChange" href="?page=orders&action=changeOrderStatus&id={$row['id']}">изменить статус</a>
            </p>
            {$orderHtml}
            <p class="info">комментарий к заказу</p>
            <p>{$row['comment']}</p>
            <p class="info">адрес доставки</h3>
            <p>{$row['deliveryAddress']}</p>
            
            <p>-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- </p>
php;
        $content .= '</div>';
    }

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

function changeOrderStatus() {

    $orderId = $_GET['id'];

    $sql = "SELECT status
            FROM orders
            WHERE id = '{$orderId}'";

    $res = mysqli_query(connect(), $sql);
    $row = mysqli_fetch_assoc($res);

    if ($row['status'] === 'accepted') {
        $sql = "UPDATE orders
                SET status='in processing'
                WHERE id = '{$orderId}'";
    } else {
        $sql = "UPDATE orders
                SET status='accepted'
                WHERE id = '{$orderId}'";
    }

    mysqli_query(connect(), $sql);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}


function giveOrderHtml($arr) {

    $totalPrice = 0;
    $total = 0;

    $html = <<<php
        <table class="cart">
            <tr>
                <td>артикул товара</td>
                <td>название</td>
                <td>цена за шт.</td>
                <td>кол-во</td>
                <td>общая цена</td>
            </tr>
php;

    foreach ($arr as $key => $value) {

        $totalPrice = $value['price'] * $value['count'];
        $total += $totalPrice;

        $html .= <<<php
                <tr>
                    <td>{$key}</td>
                    <td>{$value['title']}</td>
                    <td>{$value['price']}</td>
                    <td>{$value['count']}</td>
                    <td>{$totalPrice}</td>
                </tr>
php;
    }

    $html .= <<<php
        </table>
        <div class="total">Итого: <span>{$total}</span> ₽</div>
php;

    return $html;

}
