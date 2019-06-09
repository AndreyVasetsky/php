<?php

$imgDir = "public_html/img";

function createGallery($imgDir)
{
    $imgArr = scandir($imgDir);

    $content = '';

    for ($i = 0; $i < count($imgArr); $i++) {
        if ($imgArr[$i] == '.' || $imgArr[$i] == '..') continue;
        $content .= "<img src=\"$imgDir/$imgArr[$i]\" alt=\"котик\">";
    }

    echo $content;
}

