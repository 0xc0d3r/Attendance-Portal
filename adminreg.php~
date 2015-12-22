<?php
session_start();
require('functions.php');

function menu_adminreg(){
	echo <<< menu
	<!-- Fixed navbar -->
	<div class="navbar navbar-fixed-top navbar-inverse">
	  <div class="navbar-inner">
		<div class="container">
			<div class="nav-collapse collapse">
				<ul class="nav">
					<li class='active'><a class="brand " href="#" ><i class='icon-cloud'></i> Attendance Portal </a></li>
				</ul>
				<ul class="nav pull-right">
					<li class='active'><a href="adminreg.php" ><i class="icon-user "></i>&nbsp; Admin Registration&nbsp; </a></li>
				</ul>
			</div>
		</div>
	  </div>
	</div>
	<!-- end of fixed Nav bar--> 
menu;
}

function show_regform(){
	echo <<< form
	<style>body{background-color: #f5f5f5;}</style>
	<div class="container"><br>
	<div id="error" ></div>
	<div class="span2"></div>
	<div class="row " >
		<div id="adminreg" class="span6 well well-large" style='background :white; border:1px silver solid;'>
			<center><h3>Admin Registration</h3></center>
			<form class="form-signin" action="adminreg.php" method="post" onsubmit="return validate_adminreg();" style="border:0px;">
				<h5>Fullname : </h5> 
				<input type="text" class="input-block-level" placeholder="Full Name" name="fname" id="fname">
				<h5>User Id: </h5> 
				<input type="text" class="input-block-level" placeholder="User Id" name="UserId" id="UserId">
				<h5>Password: </h5> 
				<input type="password" class="input-block-level" placeholder="Password" name="Password" id="Password">
				<h5>Confirm Password: </h5> 
				<input type="password" class="input-block-level" placeholder="Re-enter Password" name="CPassword" id="CPassword">
				<h5>Gender : </h5>  
				<label class="radio inline"><input type="radio"  value="M" name="Gender" id="Male" /> Male </label>
				<label class="radio inline"><input type="radio"  value="F" name="Gender" id="Female" /> Female </label> <br><br>
				<h5>Phone No. : </h5> 
				<input type="text" class="input-block-level" placeholder="Phone No." name="phno" id="phno" maxlength=10 ><br><br>
				<input class="btn  btn-primary" type="submit" name='register' value="Register&rarr;" />
			</form>
		</div>
	<div class="span2"></div>
	</div>
	</div>
form;
}
function adminReg($title){
	if(check_login()) header("location:index.php");
	else{
		include 'config/db.php';
		include 'config/settings.php';
		include 'config/globals.php';
		$dbname = $branchyear.'_Users';
		$table = $branchyear.'_Students';
		$table1 = $branchyear.'_Admins';
		//if(!mysql_select_db($dbname)) die(mysql_error());		
		echo "<!DOCTYPE html>\n<html>\n";
		display_headers($title);
		echo "\n<body>";
		menu1("adminreg.php","Registration","user");
		show_regform();
	}
	
}

adminReg("Admin -Registration");

if(isset($_POST['register'])){
	include 'config/db.php';
	include 'config/settings.php';
	include 'config/globals.php';
	$dbname = $branchyear.'_Users';
	$table = $branchyear.'_Students';
	$table1 = $branchyear.'_Admins';
	//if(!mysql_select_db($dbname)) die(mysql_error());	
	$userid = mysql_real_escape_string($_POST['UserId']);
	$rno = 0;
	$name = mysql_real_escape_string($_POST['fname']);
	$gender = addslashes($_POST['Gender']);
	$branch = $globalbranch;
	$class  = NULL;
	$passwd = md5(addslashes($_POST['Password']));
	$phno = addslashes($_POST['phno']);
	if(strlen(trim($userid))==0)
	{
		echo "<script>show_error('Error : UserId should not be null');</script>";
		exit;
	}
	if(strlen(trim($name))==0)
	{
		echo "<script>show_error('Error : Name should not be null');</script>";
		exit;
	}
	if(strlen(trim($gender))==0)
	{
		echo "<script>show_error('Error : Gender should not be null');</script>";
		exit;
	}
	if(strlen(trim($phno))==0)
	{
		echo "<script>show_error('Error : Phone No should not be null');</script>";
		exit;
	}
	if(strlen(trim($passwd))<7)
	{
		echo "<script>show_error('Error : Password Length Must Be Lessthan or equals to 7');</script>";
		exit;
	}
	
	
	$Picture = "assets/img/avatar.jpg";
	$check = mysql_query("SELECT Id From ".$table1." WHERE Id='$userid';") or die(mysql_error());
	$query="INSERT INTO ".$table." VALUES ('$userid','$rno','$name','$gender','$branch','$class','$passwd','$Picture','$phno','BA');";
	$query1 = "INSERT INTO ".$table1." VALUES ('$userid','$name','$gender','$branch');";
	if(mysql_num_rows($check) == 0)
		if(mysql_query($query) && mysql_query($query1)){
			//insert_log("$userid regestred as admin ");
			echo "<script>show_success('Registration done successfully. <a href=\'login.php\'>click here</a> to login');</script>";
			}
		else die(mysql_error());
	else echo "<script>show_error('User Id \"$userid\" already exists.');</script>";
}

?>
