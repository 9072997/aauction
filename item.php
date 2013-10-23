<?php
    function rie($val) {
        return isset($val) && strlen($val) ? $val : NULL;
    }
    
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    
    require_once('auth.inc.php');
    require_once('db.inc.php');
    if(isset($_GET['delete'])) {
        // delete
        db0('DELETE FROM items WHERE id=?;', $_GET['delete']);
    } elseif(strlen($_GET['id'])) {
        // update
        db0('UPDATE items SET updated=CURRENT_TIMESTAMP WHERE id=?;', $_GET['id']);
        foreach(array('item', 'imgid', 'descrip', 'bidder', 'price', 'center') as $pram) {
            if(strlen($_GET[$pram])) {
                db0("UPDATE items SET $pram=? WHERE id=?;", ucwords(strtolower($pram == 'price' ? $_GET[$pram]*100 : $_GET[$pram])), $_GET['id']);
            }
        }
    } else {
        // new
        db0('INSERT INTO items (item, imgid, descrip, bidder, price, updated, center) VALUES (?, ?, ?, ?, ?, CURRENT_TIMESTAMP);',
                                                                                rie(ucwords(strtolower($_GET['item']))),
                                                                                rie($_GET['imgid']),
                                                                                rie($_GET['descrip']),
                                                                                rie($_GET['bidder']),
                                                                                rie($_GET['price']*100),
                                                                                rie($_GET['center'])
                                                                            );
    }
?>
DONE