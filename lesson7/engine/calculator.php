<?php

function buildPage()
{

    $template = file_get_contents('../templates/calculator.html');

    $result = !empty($_GET['result']) ? $_GET['result'] : '';

    include('menu.php');

    $abbreviations = ['{MENU}', '{RESULT}'];
    $replacements = [$menu, $result];

    $template = str_replace($abbreviations, $replacements, $template);

    return $template;
}

function defaultAction()
{
    echo buildPage();
}

function toCalculate()
{
    if (!empty($_GET['expression'])) {

        $strToCalculate = $_GET['expression'];
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

        header('Location: ?page=calculator&result=' . $result);

    } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

}


