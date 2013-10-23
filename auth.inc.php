<?php
    if(!isset($_COOKIE['password']) || $_COOKIE['password'] != 'PASSWORD')  {
        if(!isset($_POST['password']) || $_POST['password'] != 'PASSWORD') {
            die('<!DOCTYPE html>
                <html lang="en">
                    <head>
                        <meta charset="utf-8">
                        <title>Bidders</title>
                    </head>
                    <body>
                        <form method="post">
                            <input type="password" name="password" />
                            <input type="submit" value="login" />
                        </form>
                    </body>
                </html>
            ');
        } else {
            setcookie('password', $_POST['password'], time()+86400);
        }
    }
?>
