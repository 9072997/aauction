<?php
    function rie($val) {
        return isset($val) && strlen($val) ? $val : NULL;
    }
    
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        
    require_once('db.inc.php');
    if(strlen($_GET['id']) && strlen($_GET['price']) && strlen($_GET['code'])) {
         db0('UPDATE items SET bidder=(SELECT id FROM bidders WHERE code=?), price=?, updated=NULL WHERE id=? AND price<?;',
                                                                                        $_GET['code'],
                                                                                        $_GET['price']*100,
                                                                                        $_GET['id'],
                                                                                        $_GET['price']*100);
    }
?>
DONE