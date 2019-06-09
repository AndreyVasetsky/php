<?php

// 1
$a = 1;
$b = 2;

if ($a > 0 && $b > 0) {
    echo $a - $b;
} else if ($a < 0 && $b < 0) {
    echo $a * $b;
} else {
    echo $a + $b;
}

// 2
$a = rand(0, 15);

switch ($a) {
    case 0:
        echo 0;
    case 1:
        echo 1;
    case 2:
        echo 2;
    case 3:
        echo 3;
    case 4:
        echo 4;
    case 5:
        echo 5;
    case 6:
        echo 6;
    case 7:
        echo 7;
    case 8:
        echo 8;
    case 9:
        echo 9;
    case 10:
        echo 10;
    case 11:
        echo 11;
    case 12:
        echo 12;
    case 13:
        echo 13;
    case 14:
        echo 14;
    case 15:
        echo 15;
        break;
    default:
        echo "число вне диапазона";
}

// 3
function addition($a, $b) {
    return $a + $b;
}
function subtraction($a, $b) {
    return $a - $b;
}
function multiplication($a, $b) {
    return $a * $b;
}
function division($a, $b) {
    return $a / $b;
}

// 4
function mathOperation($arg1, $arg2, $operation) {

    switch ($operation) {
        case "+":
            return addition($arg1, $arg2);
        case "-":
            return subtraction($arg1, $arg2);
        case "*":
            return multiplication($arg1, $arg2);
        case "/":
            return division($arg1, $arg2);
        default:
            echo "неизвестная операция";
    }

}

// 5

$today = date("m.d.Y");

// в нужном месте шаблона вставляем <?= $today; ?>
