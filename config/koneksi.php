<?php

error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ALL ^ E_DEPRECATED);

$dbhost = "localhost";

$dbuser = "root";

$dbpass = "";

$dbname = "perpantam";

$db = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


?>
