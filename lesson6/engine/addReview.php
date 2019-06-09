<?php

$sql = "SELECT name, review FROM productreviews WHERE productId = " . $id;
$res = mysqli_query(connect(), $sql);

while ($row = mysqli_fetch_assoc($res)) {
    $reviews .= <<<php
        <div class="review" >
           <p>{$row['name']}</p>
           <p> - {$row['review']}</p>
           <hr>
        </div>
php;
}