<?php
session_start();
ob_start();
require "functions.php";




function display_loginform() {

	echo <<< a
	<style>body {
        background-color: #f5f5f5;
      }</style>
    
	<div class="container">
	<br>
	<div id="error" ></div>
	<div class="row " >
		<div class="span4"></div>
		<div id="login" class="span4 well" style='background :white; border:1px silver solid;'>
			
			<form class="form-signin" action="login.php" method="post" onsubmit="return check_login();" style="border:0px;">
			
			<h5>User Id </h5>
			<input type="text" class="input-block-level" placeholder="User Id" name="UserId" id="UserId">
			<h5>Password  </h5> 
			<input type="password" class="input-block-level" placeholder="Password" name="Password" id="Password"><br>
			<input class="btn  btn-primary" type="submit" name='Login' value = "Log in &rarr;" style='margin-top:10px;'/>
			<small class='pull-right' style='margin-top:15px;'> &emsp;<a href='forgot.php'>Forgot Password &darr;</a> </small>
			
			</form>
		</div>
		<div class="span4"></div>
	</div>
	</div>
a;
}


function login($title) {
    if(check_login()) {
        header('location:./?sub');
    }
    else {
		
		include 'config/db.php';
		include 'config/settings.php';
		include 'config/globals.php';
		
		echo "<!DOCTYPE html>\n<html>\n";
		display_headers($title);
		echo "\n<body>";
		menu1("login.php","Login","user");
		display_loginform();
		
		$dbname = $branchyear.'_Users';
		$table = $branchyear.'_Students';
		//if(!mysql_select_db($dbname)) die(mysql_error());
		
		if(isset($_POST["Login"])){
			
			$user=mysql_real_escape_string($_POST["UserId"]);
			$pass=md5($_POST["Password"]);
			if(strlen(trim($user))==0 )
			{
				echo "<script>show_error('Error : User Id should not be null');</script>";
				exit;
			}
			if(strlen(trim($pass))==0)
			{
				echo "<script>show_error('Error : Password should not be null');</script>";
				exit;
			}
			$q=mysql_query("SELECT Id,Password FROM `$table` where Id='".$user."';") or die(mysql_error());
			$res=mysql_fetch_array($q);
			if(empty($res)) echo "<script>show_error('Error : Invalid User Id ... Please try again ');</script>";
			else if($pass != $res["Password"]) echo "<script>show_error('Error : Invalid Password ... Please try again ');</script>";
			else{
				$_SESSION['UserId']=$user;
				header("location: ./?sub");
			}
		}
			 	
		echo "\n</body>\n</html>";
		mysql_close($con);
    }
}

login('Attendance Portal - Login');
?>
