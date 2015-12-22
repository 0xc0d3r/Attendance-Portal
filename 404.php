<?php 
include "functions.php";
$p = $_SERVER['QUERY_STRING'];
echo "<!DOCTYPE html>\n<html>\n";
display_headers(" Error : 404 - Page Not Found!  ");
echo "\n<body>";
notfound("Page you are looking for is no longer available");
echo "\n</body>\n</html>";
?>
