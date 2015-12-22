<?php
session_start();
require "functions.php";

function viewcr($branch,$class,$gender) {
	
	include 'config/db.php';
	include 'config/settings.php';
	include 'config/globals.php';
	
	$dbname = $branchyear.'_Users';
	$table = $branchyear.'_CRs';
	//if(!mysql_select_db($dbname)) die(mysql_error());
	
	$q = "select Id, Name, Gender, Branch, Class from $table where (Branch = '$branch' and Class = '$class') and Gender = '$gender' ;";
	$res = mysql_query($q) or die(mysql_error());
	$n = mysql_num_rows($res);
	$row = mysql_fetch_array($res);
	$d = $dict[$row['Gender'].'1'];
	$name = ucwords(strtolower($row['Name']));
	$branch = $row['Branch'];
	$class = $row['Class'];
	echo "Do you want to replace <b>$name</b>, <b>$d</b> CR of <b> $branch$class </b>";    
	}

if(!check('BA')) echo "Error : You are not authorised to perform this operation";
else {
	if(isset($_POST['view'])) {
		$branch = addslashes($_POST['Branch']);
		$class = addslashes($_POST['Classno']);
		$gender = addslashes($_POST['Gender']);
		viewcr($branch,$class,$gender);
		}
	else echo "Error : Invalid input";	
	}

?>
