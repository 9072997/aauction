<?php
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    
    require_once('auth.inc.php');
    require_once('db.inc.php');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Bidders</title>
    </head>
    <body>
        <a href="bidders.html">Bidders</a><br />
        <a href="items.html">Items</a><br />
        <?php
            $centers = db('SELECT DISTINCT center FROM items;');
            foreach($centers as $center) {
                echo '<a href="items.html?center=' . $center->center . '">Center ' . $center->center . '</a>';
            }
        ?>
        <a href="items.html"></a>
    </body>
</html>