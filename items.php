<?php
    function rie($val) {
        return isset($val) && strlen($val) ? $val : '&nbsp';
    }
    
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    
    require_once('auth.inc.php');
    require_once('db.inc.php');
    $items=(isset($_GET['center']) && strlen(($_GET['center'])) ?
        db('SELECT id, item, imgid, descrip, bidder, price, updated, center FROM items WHERE center=? ORDER BY updated NULLS FIRST;', $_GET['center'])
    :
        db('SELECT id, item, imgid, descrip, bidder, price, updated, center FROM items ORDER BY updated NULLS FIRST;')
    );
    foreach($items as $item) {
        echo '<tr onclick="del(' . rie($item->id) . ');">' .
            '<th>' . rie($item->id) . '</th>' .
            '<th>' . rie($item->item) . '</th>' .
            '<td>' . (isset($item->imgid) ? '<img src="art/' . $item->imgid . '.png" style="height: 50px;" />' : '&nbsp') . '</td>' .
            '<td>' . rie($item->descrip) . '</td>' .
            '<td>' . (
                isset($item->bidder) ? 
                    $item->bidder . (
                    is_null($name=db1('SELECT name FROM bidders WHERE id=?;', $item->bidder)->name) ? 
                        ''
                    :
                        '(' . $name . ')'
                    )
                :
                    '&nbsp'
            ) . '</td>' .
            '<td>' . (isset($item->price) ? '$' . number_format($item->price/100, 2) : '&nbsp') . '</td>' .
            '<td class="hidden">' . rie($item->updated) . '</td>' .
            '<td class="hidden">' . rie($item->center) . '</td>' .
        '</tr>';
    }
?>
<!-- EOF --!>