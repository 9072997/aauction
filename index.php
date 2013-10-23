<?php
    function rie($val) {
        return isset($val) && strlen($val) ? $val : NULL;
    }
    
    function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 50; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
    }
    
    require_once('db.inc.php');
    if(isset($_COOKIE['code'])) { // if we have a cookie code
        $code = $_COOKIE['code'];
    } elseif(isset($_GET['name']) && strlen($_GET['name']) && isset($_GET['address']) && strlen($_GET['address'])) { // create a new user
        db0('INSERT INTO bidders (name, online, address, code) VALUES (?, TRUE, ?, ?);', rie($_GET['name']), rie($_GET['address']), $code = randomPassword());
        setcookie('code', $code, time()+86400);
    } else { // no login info!
        header('Location: login.html');
        die('<a href="login.php">REDIRECT</a>');
    }
    
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
<meta name="Description" content="A free open source web design by Christina Chun.  Free for anyone to use as long as credits are intact. " />
<meta name="Keywords" content="Open source web design by Christina Chunopen source web design,, christina chun, christinachun.com, www.christinachun.com" />
<meta name="Copyright" content="Christina Chun" />
<meta name="Designed By" content="ChristinaChun.com" />
<meta name="Language" content="English" />
<title>LISA Art Walk</title>

<!-- All Images Created And Copyrighted By Christina Chun Unless Noted Otherwise.  All rights Reserved. -->

<style type="text/css" title="layout" media="screen"> @import url("style.css"); </style>
<style>
    .hidden {
        display: none;
    }
</style>
</head>

<body>
<div id="container">
	<div class="contentheader"></div>
				<div class="content">
				<br />
                <div id="items"></div>
				</div>
		</div>
</div>
			<div class="bottom"></div>
			<div class="footer">
			Designed By <a href="http://www.christinachun.com" title="Christina Chun - Digital Artist &amp; Web Designer">Christina Chun</a> &copy; 2005-2006</div>

        <script>
            if (window.XMLHttpRequest) {
                request = new XMLHttpRequest();
            } else {
                request = new ActiveXObject('Microsoft.XMLHTTP');
            }
            
            request.onreadystatechange = function() {
                if(request.readyState==4) {
                    if(request.status==200) {
                        document.getElementById('items').innerHTML = '<table border="1"><caption>Items</caption><thead><tr><th>Id</th><th>Item</th><th>ImgId</th><th>Descrip</th><th>Bidder</th><th>Price</th><th class="hidden">Updated</th><th class="hidden">Center</th></tr></thead><tbody>' + request.responseText + '</tbody></table>';
                    }
                    setTimeout(function(){
                        request.open('GET', 'items.php', true);
                        request.send();
                    }, 2000);
                }
            }
            
            request.open('GET', 'items.php', true);
            request.send();
            
            function del(id) { // this is really bid
                var request;
                if (window.XMLHttpRequest) {
                    request = new XMLHttpRequest();
                } else {
                    request = new ActiveXObject('Microsoft.XMLHTTP');
                }
                
                request.open('GET', 'bid.php?code=<?php echo $code; ?>&id=' + id + '&price=' + prompt('Enter Bid Amount').replace('$', ''), true);
                request.send();
            }
        </script>
</body>
</html>
