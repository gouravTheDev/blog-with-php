<?php 
define("MYSQL_HOST", "172.16.1.52");
// define("MYSQL_HOST", "localhost");
define("MYSQL_USER", "root");
// define("MYSQL_USER", "b_frp");
define("MYSQL_PASS", "0000");
define("MYSQL_DB", "DISCUSSION_FORUM");

$link = new mysqli(MYSQL_HOST,MYSQL_USER,MYSQL_PASS,MYSQL_DB);
if ($link->connect_error) $errorm="connection failed: " . $link->connect_error;
$link->set_charset("utf8");

 ?>