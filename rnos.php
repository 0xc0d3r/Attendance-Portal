<?php 
session_start();
ob_start();
require "functions.php";

function crnos($class1){
	if(!check('CR') ) echo "Error : Page allowed only to CRs";
	else {
		include 'config/db.php';
		include 'config/settings.php';
		include 'config/globals.php';
		$branch = $globalbranch;
		
		$table = $branchyear.'_Students';
		$userid = $_SESSION['UserId'];
		$q = "select Branch,Class,Position from $table where Id = '$userid'";
		$res = mysql_query($q) or die(mysql_error());
		$row = mysql_fetch_array($res);
		
		$branch = $row['Branch'];
		$class = $row['Class'];
		if($class1 != $class) {
			echo "Error: Not authorised to access $branch$class1 details.";
		}
		else {
			$cnt = 1;
			$table = $branch.$class.'_Cache';
			$q = mysql_query("select `Id`,`RNo` from $table");
			$class_total = mysql_num_rows($q);
			while($row = mysql_fetch_array($q)) {
				echo $row['RNo'];
				if($cnt != $class_total) {
					echo ",";
					}
				$cnt++;
				}
			
			}
	}
}
if(!isset($_POST['Classno'])) echo "Error: Invalid no of input fields";	
else crnos(htmlentities($_POST['Classno']));
?>
