<?php 
date_default_timezone_set('Asia/Kolkata');
include 'globals.php';

$con = mysql_connect($db_host,$db_user,$db_pass);
if(!$con) die().mysql_error();
if(!mysql_select_db($db_name)) die().mysql_error();

?>
