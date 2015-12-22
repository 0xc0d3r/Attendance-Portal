<?php 
include("functions.php");
if(!check("CR") && !check("BA")) {
	echo "Error : Not authorised to perform this action";
}
else {
	if(isset($_POST['RNo1'])){
		
		include 'config/db.php';
		include 'config/settings.php';
		include 'config/globals.php';
		
		$rno = htmlentities(addslashes($_POST['RNo1']));
		$date = htmlentities(addslashes($_POST['Date1']));
		$period = htmlentities(addslashes($_POST['Period1']));
		$new_value = htmlentities(addslashes($_POST['Value1']));
		$cls1 = htmlentities(addslashes($_POST['Class1']));
		
		$class = substr($cls1,-1);
		if($rno == "" or strlen(trim($rno)) == 0) {
			echo "Error : input value rno is missing ...";
			die();
			}
		if($date == "" or strlen(trim($date)) == 0) {
			echo "Error : input value date is missing ...";
			die();
			}
		if($period == "" or strlen(trim($period)) == 0) {
			echo "Error : input value period is missing ...";
			die();
			}
		if($new_value == "" or strlen(trim($new_value)) == 0) {
			echo "Error : input value new value to updated is missing ...";
			die();
			}
		if($cls1 == "" or strlen(trim($cls1)) == 0) {
			echo "Error : input value class  is missing ...";
			die();
			}
		
		$dbname = $branchyear.'_Users';
		$table = $branchyear.'_Students';
		//if(!mysql_select_db($dbname)) die(mysql_error());
		
		$userid = $_SESSION['UserId'];
		$q = "select Branch,Class,Position from $table where Id = '$userid'";
		$res = mysql_query($q) or die(mysql_error());
		$row = mysql_fetch_array($res);
		if($row['Position'] == "BA") {
			$branch = $globalbranch;
			$class = $cls1;	
			}
		else {
			$branch = $row['Branch'];
			$class = $row['Class'];
			if($cls1 != $class){
				echo "'Error: Nor authorised to access $cls1 details";
				die();
				}
				
			}
		
		$table=$branch.$class."_Dates";
		$q	= mysql_query("select * from $table where Date = '$date' ");
		if(mysql_num_rows($q) == 0 )
			echo "'Error: Invalid  Date in Database";
		else {
			$row = mysql_fetch_array($q);
			if($row[$period.'_Con'] == 'ok') 
				echo "'Error: unable to update $period already confirmed";
			else if($row[$period] != 'ok') 
				echo "'Error: unable to update $period attendance not yet uploaded";
			else {
				$table=$branch.$class."_Cache";
				$q = mysql_query("update $table set `$date"."_".$period."` = '$new_value' where `RNo` = '$rno';") 
				or die("Error : mysql error - ".mysql_error());
				insert_log($_SESSION['UserId']." updated rno $rno attendace for the date $date");
				echo "$rnos $period attendance updated ...";
					
				
			}
		}
	}
}
?>
