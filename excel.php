<?php
include "functions.php"; 
if(!check('BA')) echo "Your are not authorised to print the contents";
else  {
$date = date('h-M-Y');
$title = $_POST['Title1'];
$name=str_replace(" ","",$title."_".$date.".xls");
header("Content-Type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=$name;");
echo "<table>".$_POST["sheet"]."</table>";
}
?>
