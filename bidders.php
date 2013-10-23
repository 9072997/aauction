<?php
    function rie($val) {
        return isset($val) && strlen($val) ? $val : '&nbsp';
    }
    
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    
    require_once('auth.inc.php');
    require_once('db.inc.php');
    $bidders=db('SELECT id, name, online, address FROM bidders ORDER BY online, name;');
    foreach($bidders as $bidder) {
        echo '<tr onclick="del(' . rie($bidder->id) . ');">' .
            '<th>' . rie($bidder->id) . '</th>' .
            '<th>' . rie($bidder->name) . '</th>' .
            '<td>' . ($bidder->online ? 'YES' : 'NO') . '</td>' .
            '<td>$' . number_format(db1('SELECT SUM(price) FROM items WHERE bidder=?', $bidder->id)->sum/100, 2) . '</td>' .
            '<td>' . rie($bidder->address) . '</td>' .
        '</tr>';
    }
?>
<!-- EOF --!>