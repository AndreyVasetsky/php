<?php

function buildPage() {

    $template = file_get_contents('../templates/userOrders.html');

    $userId = giveUserId();

    $sql = "SELECT id, data, details, comment, deliveryAddress, status
            FROM orders
            WHERE userId = " . $userId;

    $res = mysqli_query(connect(), $sql);

    $content = '';

    while ($row = mysqli_fetch_assoc($res)) {

        $content .= '<div class="order">';

        // преобразовал json в массив массивов
        $currentOrder = json_decode($row['details'], true);

        $orderHtml = giveOrderHtml($currentOrder);

        $content .= <<<php
            <p>{$row['data']} - <span>Заказ № {$row['id']}</span> - <span>{$row['status']}</span> </p>
            {$orderHtml}
            <p class="info">комментарий к заказу</p>
            <p>{$row['comment']}</p>
            <p class="info">адрес доставки</h3>
            <p>{$row['deliveryAddress']}</p>
            <p>-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- </p>
php;
        $content .= '</div>';
    }


    include('userMenu.php');

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

    echo buildPage();
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