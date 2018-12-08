<?php
$mysql_hostname = "127.0.0.1";
$mysql_user = "root";
$mysql_password = "stuti1807";
$mysql_database = "dbgadgetMarketbasket";
$prefix = "";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
mysql_select_db($mysql_database, $bd) or die("Could not select database");
?>