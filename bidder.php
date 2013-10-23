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
        db0('DELETE FROM bidders WHERE id=?;', $_GET['delete']);
    } elseif(strlen($_GET['id'])) {
        // update
        foreach(array('name', 'online', 'address') as $pram) {
            if(strlen($_GET[$pram])) {
                db0("UPDATE bidders SET $pram=? WHERE id=?;", $_GET[$pram], $_GET['id']);
            }
        }
    } else {
        // new
        db0('INSERT INTO bidders (name, online, address) VALUES (?, ?, ?);',
                                                                                rie(ucwords(strtolower($_GET['name']))),
                                                                                rie($_GET['online']),
                                                                                rie(ucwords(strtolower($_GET['address'])))
                                                                            );
    }
?>
DONE