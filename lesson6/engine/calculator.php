<?php

if (!empty($_GET['calculate'])) {

    $strToCalculate = $_GET['calculate'];
        $regexp = '/^([+-]?\d*[.]?\d+)([-+*\/]?)(\d*[.]?\d+)$/u';

    if (preg_match($regexp, $strToCalculate, $matches)) {

        if ($matches[2] === "/" && $matches[3] === "0") {
            $result = 'деление на 0';
        } else {
            switch ($matches[2]) {
                case "+":
                    $result = $matches[1] + $matches[3];
                    break;
                case "-":
                    $result = $matches[1] - $matches[3];
                    break;
                case "*":
                    $result = $matches[1] * $matches[3];
                    break;
                case "/":
                    $result = $matches[1] / $matches[3];
                    break;
                default:
                    $result = 'неизвестная операция';
            }
        }

    } else {
        $result = 'некорректное выражение';
    }
//    header('Location: ?page=4');
//    exit();
}

$content = <<<php
    <div class="calculator" id="calculator">
        <form id="calcForm">
            <input type="text" name="calculate" id="expression" placeholder="{$result}">
            <div>7</div>
            <div>8</div>
            <div>9</div>
            <div>/</div>
            <div>4</div>
            <div>5</div>
            <div>6</div>
            <div>*</div>
            <div>1</div>
            <div>2</div>
            <div>3</div>
            <div>-</div>
            <div>0</div>
            <div>.</div>
            <div>=</div>
            <div>+</div>
        </form>
    </div>
php;
