<?php
session_start();
require "functions.php";


include 'config/globals.php';
include_once 'config/settings.php';
function viewcr($branch1,$class1,$gender1) {
	
	include 'config/settings.php';
	include 'config/db.php';
	$dbname = $branchyear.'_Users';
	$table = $branchyear.'_CRs';
	//if(!mysql_select_db($dbname)) die(mysql_error());
	
	$q = "select * from $table where (Branch = '".$branch1."' and Class = '".$class1."') and Gender = '".$gender1."' ;";
	$res = mysql_query($q) or die(mysql_error());
	$n = mysql_num_rows($res);
	$row = mysql_fetch_array($res);
	$d = $dict[$row['Gender'].'1'];
	$name = ucwords(strtolower($row['Name']));
	$key = $row['Key'];
	$id = $row['Id'];
	
	
	echo "<table class='table table-hover table-bordered'>
	<tr><th class=span2>Id</th><td>$id</td></tr>
	<tr><th>Name</th><td>$name</td></tr>
	<tr><th>Class</th><td>$branch1$class1</td></tr>
	<tr><th>Gender</th><td>$d</td></tr>
	<tr><th>Key</th><td>$key</td></tr></table>";
	echo <<< a
	<center><a href='key.php'><button  class="btn btn-primary">Go Back </button></a></center><br><br><br>
a;

	}

if(!check('BA')) echo "Error : You are not authorised to perform this operation";
else {

	display_headers("Attendance Portal - CRs Security Key Details ");
	echo "\n<body>";
	menu();
	echo <<< a
	<div class='container'>
		<div id='error'></div>
		<div class='row'>
a;
	echo '<div class="span9"><div class="well well-large" style="background:#FFF;">';
	echo <<< a
	<div id="step1" class="span8">     
		<h5 class='text-info'>Security Key Details of CRs @ $globalbranch </h5>
	</div>
				
a;
	
	echo '<h6> &emsp;&emsp;&emsp; - &emsp; Browse Details of CRs by Class and Gender </h6>';
	if(!isset($_POST['view'])) {
	
	echo <<< a
	<form action="key.php" method='post' onsubmit='return check_cls();'>
	 <div class="row">
		
		<div class="span4" style="padding-top:5px;">
			<h5>Class </h5>
			<select class="span4" name='cls' id='Cls'>
			<option value=''>Class</option>
a;
echo $classno;
		for($cl = 1;$cl<=$classno;$cl++) echo "<option value=$cl >$globalbranch$cl</option>";
			
	echo <<< a
			</select> <br>
			<h5 >Gender </h5>
			<select class="span4" name='Gender' id='gen'>
			<option value=''>Gender</option>
			<option value="M">Boys</option>
			<option value="F">Girsl</option>
			</select>
		</div>
	</div><br>
	<input type="submit" class="btn btn-primary " name='view' value='Browse &rarr;' /><br><br><br>
	</form>
a;
	}
	else {
	echo '<br><br>';
	//print_r($_POST);
	$branch1 = $globalbranch;
	$class1 = addslashes($_POST['cls']);
	$gender1 = addslashes($_POST['Gender']);
	
	if(strlen(trim($class1))==0)
	{
		echo "<script>show_error('Error : Class should not be null');</script>";
		exit;
	}
	if(strlen(trim($gender1))==0)
	{
		echo "<script>show_error('Error : CR Gender should not be null');</script>";
		exit;
	}
	
	
	viewcr($branch1,$class1,$gender1);
	
	}
		echo "</div></div><div class='span3'>"; 
	sidepanel();
	echo "</div></div>";  
	display_footer();
	echo "\n</body>\n</html>";	
	}

?>
