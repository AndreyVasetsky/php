<!-- ------------------------------------------->
<!-- 4 - Используя имеющийся HTML шаблон, сделать так,-->
<!-- чтобы главная страница генерировалась через PHP.-->
<!-- Создать блок переменных в начале страницы.-->
<!-- Сделать так, чтобы h1, title и текущий год генерировались-->
<!-- в блоке контента из созданных переменных.-->
<!-- ------------------------------------------->

<?php
$title = 'Вкладка 1';
$h1Content = 'Заголовок первого уровня';
$currentYear = date("y");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
</head>
<body>

<h1><?php echo $h1Content; ?></h1>
<p>текущий год: <?php echo "20$currentYear"; ?> </p>

<div>
    <?php
    // -----------------------------------------
    // 3 - Объяснит ь , как работает данный код:
    // -----------------------------------------

    $a = 5;
    $b = '05';

    // произошло динамическое преобразование типов
    // строка была преобразована к числу
    var_dump($a == $b);
        ?>
</div>
<div>
    <?php
    // была попытка преобразования типа с нашей стороны с его указанием
    // но так как var_dump выводит в скобках тип ,
    // то получилось почти тоже самое, только без кавычек
    var_dump(( int )'012345');
    ?>
</div>
<div>
    <?php
    // по причине использования строгого равенства, которое требует точного совпадения типов
    var_dump(( float )123.0 === ( int )123.0);   // Почему false?
    echo "<br>";
    ?>
</div>
<div>
    <?php

    // строка преобразована к false и число 0 тоже преобразован к false
    var_dump(( int )0 === ( int )'hello, world');   // Почему true?
    echo "<br>";
    ?>
</div>

</body>
</html>





