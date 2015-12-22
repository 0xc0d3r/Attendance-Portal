<?php
session_start();
require('functions.php');

function show_form(){
	echo <<< form
	<style>body{background-color: #f5f5f5;}</style>
	<div class="container"><br>
	<div id="error" ></div>
	<div class="row" >
		<div class="span2"></div>
		<div id="login" class="span6 well well-large" style='background :white; border:1px silver solid;'>
			<center><h3>Admin Forgot Password</h3></center>
			<form class="form-signin" action="adminforgot.php" method="post" onsubmit="return validate_adminforgot();" style="border:0px;">
			<h5>User Id : </h5>
			<input type="text" class="input-block-level" placeholder="User Id" name='UserId' id='Uid'>
			<h5>New Password : </h5>
			<input type="password" class="input-block-level" placeholder="New Password" name='Pass1' id='pass1'>
			<h5>Confirm Password : </h5>
			<input type="password" class="input-block-level" placeholder="Re-enter new Password" name='Pass2' id='pass2'><br><br>
			<input class="btn  btn-primary " type="submit" name='forgot' value = 'Continue &nbsp;&rarr;' />
			<input class="btn btn-danger pull-right" onclick="window.location.href='login.php'" type='button' value="Log in &darr;" />
			</form>
		</div>
		<div class="span2"></div>
	</div>
	</div>
form;
}

function adminForgot($title){
	if(check_login()) header("location:./?sub");
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
		menu1("adminforgot.php","Forgot Password","unlock");
		show_form();
	}
}

adminForgot("Admin - Forgot Password");

if(isset($_POST['forgot'])){
	include 'config/db.php';
	include 'config/settings.php';
	include 'config/globals.php';
	$dbname = $branchyear.'_Users';
	$table = $branchyear.'_Students';
	$table1 = $branchyear.'_Admins';
	$userid = mysql_real_escape_string($_POST['UserId']);
	$passwd = md5(addslashes($_POST['Pass1']));
	if(strlen(trim($userid))==0)
	{
		echo "<script>show_error('Error : User id should not be null');</script>";
		exit;
	}
	if(strlen(trim($passwd))<7)
	{
		echo "<script>show_error('Error : Password Length Must Be Lessthan or equals to 7');</script>";
		exit;
	}
	$check = mysql_query("SELECT Id FROM ".$table1." WHERE Id='$userid';") or die(mysql_error());
	if(mysql_num_rows($check) == 1){
		$update = "UPDATE ".$table." SET Password='$passwd' WHERE Id='$userid';";
		if(mysql_query($update))
			echo "<script>show_success('Password changed successfully. <a href=\'login.php\'>click here</a> to login');</script>";
		else die(mysql_error());
	}
	else echo "<script>show_error('User Id \"$userid\" does not exist.');</script>";	
}

?>
