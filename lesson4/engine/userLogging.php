<?php
$userLogFile = 'data/user_log.txt';
$dataDir = 'data';

// формируем строку для записи
$str = date("H:i:s d.m.Y") . " - username" . PHP_EOL;

if (file_exists($userLogFile)) {

    // получаем строку с содержимым нашего лог файла
    $fileContentStr = file_get_contents($userLogFile);

    // на основе полученного содержимого создаем массив строк
    $fileContentArr = explode(PHP_EOL, $fileContentStr);

    // если в этом массиве есть 10 записей
    if (count($fileContentArr) == 10) {

        // считываем в массив содержимое директории
        $dataDirArr = scandir($dataDir);

        // ищем цифры в последнем файле папки
        preg_match('/\d+/u', end($dataDirArr), $matches);

        // копируем накопившиеся 10 строчек в новый файлик
        file_put_contents("$dataDir/user_log".($matches[0] + 1).".txt", $fileContentStr);

        // перезаписываем основной лог файл
        file_put_contents($userLogFile, $str);

    } else {
        // добавляем запись в лог файл
        file_put_contents($userLogFile, $str, FILE_APPEND);
    }
} else {
    // перезаписываем основной лог файл
    file_put_contents($userLogFile, $str);
}

