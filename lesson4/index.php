<?php
include_once 'engine/userLogging.php';
include_once 'engine/createGallery.php';
?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Галерея</title>
        <link rel="stylesheet" href="public_html/css/style.css">

    </head>
    <body>
    <div class="wrapper">
        <div id="gallery" class="gallery">
            <?php createGallery($imgDir); ?>
        </div>
    </div>
    <div id="modal">
        <div id="modal__content">
            <button id="modal__close">x</button>
        </div>

    </div>

    <script src="public_html/js/modalWindow.js"></script>
    </body>
    </html>
