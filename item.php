<?php
    function rie($string) {
        return isset($string) ? $string : 'NULL';
    }
    
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    
    require_once('db.inc.php');
    if(isset($_GET['delete'])) {
        // delete
        db0('DELETE FROM items WHERE id=?;', $_GET['delete']);
    } elseif(strlen($_GET['id'])) {
        // update
        foreach(array('last', 'first', 'item', 'price') as $pram) {
            if(strlen($_GET[$pram])) {
                db0("UPDATE items SET $pram=? WHERE id=?;", ucwords(strtolower($pram == 'price' ? $_GET[$pram]*100 : $_GET[$pram])), $_GET['id']);
            }
        }
    } else {
        // new
        db0('INSERT INTO items (last, first, item, price) VALUES (?, ?, ?, ?);', rie(ucwords(strtolower($_GET['last']))),
                                                                                rie(ucwords(strtolower($_GET['first']))),
                                                                                rie(ucwords(strtolower($_GET['item']))),
                                                                                rie($_GET['price']*100));
    }
?>
DONE