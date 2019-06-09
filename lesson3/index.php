<?php

$menu = [
    'Главная' => '',
    'Новости' => [
        'Новости о спорте' => '',
        'Новости о политеке' => '',
        'Новости о мире' => ''
    ],
    'Контакты' => '',
    'Справка' => ''
];


function createMenu($arr)
{
    $content = '';

    foreach ($arr as $key => $value) {
        if (is_array($value)) {
            $subContent = createSubMenu($value);
            $content .= "<div><a><span>$key</span></a>$subContent</div>";
        } else {
            $content .= "<div><a><span>$key</span></a></div>";
        }
    };

    echo $content;
}

function createSubMenu($arr)
{
    $content = '<div>';
    foreach ($arr as $key => $value) {
        $content .= "<a>$key</a>";
    };
    $content .= '</div>';

    return $content;
}

?>


<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=ISO-8859-5">
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic);

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #ebebeb;
            overflow-x: hidden;
            text-align: center;
        }

        header {
            width: 100%;
            height: 50px;
            background-color: #f44355;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
        }

        header > nav > div {
            float: left;
            width: 16.6666%;
            height: 100%;
            position: relative;
        }

        header > nav > div > a {
            text-align: center;
            width: 100%;
            height: 100%;
            display: block;
            line-height: 50px;
            color: #fbfbfb;
            transition: background-color 0.2s ease;
            text-transform: uppercase;
        }

        header > nav > div:hover > a {
            background-color: rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        header > nav > div > div {
            display: none;
            overflow: hidden;
            background-color: white;
            min-width: 200%;
            position: absolute;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
            padding: 10px;
        }

        header > nav > div:not(:first-of-type):not(:last-of-type) > div {
            left: -50%;
            border-radius: 0 0 3px 3px;
        }

        header > nav > div:first-of-type > div {
            left: 0;
            border-radius: 0 0 3px 0;
        }

        header > nav > div:last-of-type > div {
            right: 0;
            border-radius: 0 0 0 3px;
        }

        header > nav > div:hover > div {
            display: block;
        }

        header > nav > div > div > a {
            display: block;
            float: left;
            padding: 8px 10px;
            width: 46%;
            margin: 2%;
            text-align: center;
            background-color: #f44355;
            color: #fbfbfb;
            border-radius: 2px;
            transition: background-color 0.2s ease;
        }

        header > nav > div > div > a:hover {
            background-color: #212121;
            cursor: pointer;
        }

        h1 {
            margin-top: 100px;
            font-weight: 100;
        }

        p {
            color: #aaa;
            font-weight: 300;
        }

        @media (max-width: 600px) {
            header > nav > div > div > a {
                margin: 5px 0;
                width: 100%;
            }

            header > nav > div > a > span {
                display: none;
            }
        }
    </style>
</head>
<body>
<header>
    <nav>
        <?php createMenu($menu); ?>
    </nav>
</header>
<h1>Заголовок</h1>
<p>Информация</p>
<br>
<?php

// ----------------------------------------------------------

// С помощью цикла while вывести  все числа
// в промежутке от 0 до 100, которые делятся на 3 без остатка.

$i = 0;
while ($i < 100) {
    if ($i % 3 == 0) echo $i . " ";
    $i++;
}

echo "<br><br><hr><br>";

// ----------------------------------------------------------

// С помощью цикла do…while
// написать  функцию для вывода чисел от 0 до 10,
// чтобы результат выглядел так:
// 0 – это ноль.
// 1 – нечётное число.
// 2 – чётное число.
// 3 – нечётное число

function roadToTen()
{
    $i = 0;

    do {
        if ($i == 0) {
            echo $i . " - это ноль.<br>";
            $i++;
            continue;
        }
        if ($i % 2 == 0) {
            echo $i . " - чётное число.<br>";
        } else {
            echo $i . " - нечётное число.<br>";
        }

        $i++;
    } while ($i < 10);
}

roadToTen();

echo "<br><hr><br>";

// ----------------------------------------------------------

// Объявить  массив, в котором  в качестве ключей будут использоваться названия областей,
// а в качестве значений – массивы с названиями городов из соответствующей области.
// Вывести  в цикле значения массива, чтобы результат был таким:
// Московская область:
// Москва, Зеленоград, Клин.
// Ленинградская область:
// Санкт-Петербург, Всеволожск, Павловск, Кронштадт.
// Рязанская область…(названия городов можно найти на maps.yandex.ru)

$regions = [
    'Московская область' => ['Москва', 'Зеленоград', 'Клин'],
    'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Кронштадт', 'Крабштадт']
];

foreach ($regions as $key => $value) {
    echo $key . ": <br>" . implode(', ', $value) . ".<br>";
};

echo "<br><hr><br>";

// ----------------------------------------------------------

// Объявить  массив, индексами которого являются буквы русского языка,
// а значениями – соответствующие латинские буквосочетания
// ('а'=> 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', …, 'э' => 'e', 'ю' => 'yu', 'я' => 'ya').
// Написать  функцию транслитерации строк.

function translitWord($word)
{
    $word = mb_strtolower($word, 'UTF-8');

    $alphabet = [
        'а' => 'a',
        'б' => 'b',
        'в' => 'v',
        'г' => 'g',
        'д' => 'd',
        'е' => 'e',
        'ё' => 'yo',
        'ж' => 'zh',
        'з' => 'z',
        'и' => 'i',
        'й' => 'j',
        'к' => 'k',
        'л' => 'l',
        'м' => 'm',
        'н' => 'n',
        'о' => 'o',
        'п' => 'p',
        'р' => 'r',
        'с' => 's',
        'т' => 't',
        'у' => 'u',
        'ф' => 'f',
        'х' => 'kh',
        'ц' => 'ts',
        'ч' => 'ch',
        'ш' => 'sh',
        'щ' => 'shh',
        'ъ' => "\"",
        'ы' => 'y',
        'ь' => "'",
        'э' => 'e',
        'ю' => 'yu',
        'я' => 'ya'
    ];
    $newWord = '';

    $arrayOfLetters = preg_split('//u', $word, -1, PREG_SPLIT_NO_EMPTY);

    for ($i = 0; $i < count($arrayOfLetters); $i++) {
        $symbol = $arrayOfLetters[$i];

        if ($alphabet[$symbol]) {
            $newWord .= $alphabet[$symbol];
        } else {
            $newWord .= $symbol;
        }
    }
    return $newWord;
}


// принимает строку на русском языке
// возвращает текст транслитом
function translit($str)
{
    // превращаем переданную строку в массив
    $arr = explode(' ', $str);

    // применяем коллбэк к каждому элементу, создаем новый массив
    $newArr = array_map("translitWord", $arr);

    // возвращаем строку
    return implode(' ', $newArr);
}

$testString = "Php - это не язык для Домохозяек. php - язык для Детского садика!";

echo translit($testString);

echo "<br><br><hr><br>";

// ----------------------------------------------------------

// Написать  функцию, которая заменяет в строке пробелы на подчеркивания
// и возвращает видоизмененную строчку.

$str = str_replace(' ', '_', $str);

// ----------------------------------------------------------

// Вывести  с помощью цикла for числа от 0 до 9, НЕ используя тело цикла.

for ($i = 0; $i < 10; print $i . " ", $i++) {
}

echo "<br><br><hr><br>";

// ----------------------------------------------------------

// Повторить  третье задание,
// но вывести  на экран только города, начинающиеся с буквы «К»

foreach ($regions as $key => $value) {
    $arr = preg_grep('/\bК[а-яёА-ЯЁ]+/u', $value);

    echo $key . ": <br>" . implode(', ', $arr) . ".<br>";
};

echo "<br><br><hr><br>";

// ----------------------------------------------------------

// Объединить  две ранее написанные функции в одну,
// которая получает строку на русском языке,
// производит транслитерацию и замену пробелов на подчеркивания
// (аналогичная задача решается при конструировании url-адресов
// на основе названия статьи в блогах).


function superText($ruStr)
{
    $newStr = translit($ruStr);
    $newStr = str_replace(' ', '_', $newStr);

    echo $newStr;
}

superText($testString);

// ----------------------------------------------------------

?>

</body>
</html>