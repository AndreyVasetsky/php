<?php
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
        <?php createGallery(); ?>
    </div>
</div>
<script src="public_html/js/imageRequest.js"></script>
</body>
</html>
