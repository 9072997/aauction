<?php
    function rie($string) {
        return strlen($string) ? $string : '&nbsp';
    }
    
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    
    require_once('db.inc.php');
    $items=db('SELECT id, last, first, item, price FROM items ORDER BY last, first, price, id;');
    foreach($items as $item) {
        echo '<tr onclick="del(' . rie($item->id) . ');">' .
            '<th>' . rie($item->id) . '</th>' .
            '<td>' . rie($item->last) . '</td>' .
            '<td>' . rie($item->first) . '</td>' .
            '<td>' . 
                (isset($item->last) ? 
                    (isset($item->first) ? 
                        '$' . number_format(db1('SELECT SUM(price) FROM items WHERE last=? AND first=?;', $item->last, $item->first)->sum/100, 2)
                    :
                        '$' . number_format(db1('SELECT SUM(price) FROM items WHERE last=?;', $item->last)->sum/100, 2)
                    )
                :
                    (isset($item->first) ? 
                        '$' . number_format(db1('SELECT SUM(price) FROM items WHERE first=?;', $item->first)->sum/100, 2)
                    :
                        '&nbsp'
                    )
                ) .
            '</td>' .
            '<td>' . rie($item->item) . '</td>' .
            '<td>' . (isset($item->price) ? '$' . number_format($item->price/100, 2) : '&nbsp') . '</td>' .
        '</tr>';
    }
?>
<!-- EOF --!>
