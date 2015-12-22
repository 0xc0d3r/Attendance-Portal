<?php
session_start();
ob_start();
require "functions.php";





function display_form() {

	echo <<< a
	<style>body {background-color: #f5f5f5;}</style>
	<div class="container">
	<div id="error" ></div>
	<div class="row " >
		<div class="span2"></div>
		<div id="login" class="span6 well well-large" style='background :white; border:1px silver solid;'>
			<form class="form-signin" action="forgot.php" method="post" onsubmit="return check_forgot();" style="border:0px;">
			<center><h3>Forgot Password</h3></center>
			<h5>User Id: </h5>
			<input type="text" class="input-block-level" placeholder="User Id" name='UserId' id='Uid' maxlength=7>
			<h5>Security Code : </h5>
			<input type="text" class="input-block-level" placeholder="Security Code" name="Code" id='ccode' maxlength=6>
			<h5>New Password : </h5>
			<input type="password" class="input-block-level" placeholder="Password" name='Pass1' id='pass1'>
			<h5>Confirm Password : </h5>
			<input type="password" class="input-block-level" placeholder="Password" name='Pass2' id='pass2'><br><br>
			<input class="btn  btn-primary " type="submit" name='forgot' value = 'Continue &nbsp;&rarr;' />
			<input class="btn btn-danger pull-right" onclick="window.location.href='login.php'" type='button' value='Login &nbsp;&darr;' />	
			</form>
		</div>
		<div class="span2"></div>
	</div>	
</div>
a;
}


function login($title) {
    if(check_login()) header('location:./?sub');
    else {
		
		include 'config/db.php';
		include 'config/settings.php';
		include 'config/globals.php';
		
		echo "<!DOCTYPE html>\n<html>\n";
		display_headers($title);
		echo "\n<body>";
		menu1("forgot.php","Forgot Password","unlock");
		display_form();
		//echo "<script>show_success('Contact your CR for Security Code');</script>";
		if(isset($_POST["forgot"])){
			
			$user=addslashes($_POST["UserId"]);
			$code=addslashes($_POST["Code"]);
			$pass1=addslashes($_POST["Pass1"]);
			$pass2=addslashes($_POST["Pass2"]);
			
			if(strlen(trim($user))==0)
			{
				echo "<script>show_error('Error : User id should not be null');</script>";
				exit;
			}
			if(strlen(trim($code))==0)
			{
				echo "<script>show_error('Error : Security code should not be null');</script>";
				exit;
			}
			if(strlen(trim($pass2))<7)
			{
				echo "<script>show_error('Error : Password Length Must Be Lessthan or equals to 7');</script>";
				exit;
			}
			if(strlen(trim($pass1))<7)
			{
				echo "<script>show_error('Error : Re-Password Length Must Be Lessthan or equals to 7');</script>";
				exit;
			}
			
			
			$dbname = $branchyear.'_Users';
			$table = $branchyear.'_Students';
			
			
			//if(!mysql_select_db($dbname)) {die(mysql_error());}
			
			$pass=md5($pass1);
			
			$q=mysql_query("SELECT Id,Password FROM $table where Id='".$user."';") or die(mysql_query());
			$res=mysql_fetch_array($q);
			if(empty($res)){
				echo "<script>show_error('Error : Invalid User Id ... Please try again ');</script>";
				exit;
				}
			else if ($pass1 != $pass2) {
				echo "<script>show_error('Error : Passwords does not matched ... Please try again ');</script>";
				exit;
				}
			else
			{
				$dbname = $branchyear.'_Logs';
				$table = $branchyear.'_Passwords';
				
				//if(!mysql_select_db($dbname)) {die(mysql_error());	}
				
				$q = "select `SNo`,`EndTime`, `Code`, `To`, `Status` from `$table` where `To` = '$user';";
				$res = mysql_query($q) or die(mysql_error());
				$n = mysql_num_rows($res);
				$end = "";$dif = 0;$code1="";$status = "";$sn=0;
				$StartTime =  date('d-m-Y H:i:s');
				
				while ($row = mysql_fetch_array($res)){
					$end = $row['EndTime'];
					$dif = strtotime($end) - strtotime($StartTime) ;
					$code1 = $row['Code'];
					$status = $row['Status'];
					$sn = $row['SNo'];
					};
				
			
				if(($dif <= 7200 && $dif > 0 ) && $n) {
					if($status == 'valid') {
						if($code1 == $code)  {
							
							$dbname = $branchyear.'_Users';
							$table = $branchyear.'_Students';
							//if(!mysql_select_db($dbname)) die(mysql_error());
								
							$q=mysql_query("update $table set Password = '$pass' where Id='".$user."';") or die(mysql_query());
								
							$dbname = $branchyear.'_Logs';
							$table = $branchyear.'_Passwords';
							
							//if(!mysql_select_db($dbname)) {die(mysql_error());}
							
							$q=mysql_query("update $table set Status = 'used' where `SNo` ='".$sn."';") or die(mysql_query());
							
							echo "<script>show_success('$user password updated click on login button');</script>";
							}
						else echo "<script>show_error('<b>Error </b> : Security code does not matched ... Please try again ');</script>";	
						}
					else echo "<script>show_error('<b>Error </b> : Security code already used ... Contact your CR ');</script>";
					}	
				else echo "<script>show_error('<b>Error </b> : Security code expired ... Contact your CR');</script>";
			}
		}	 	
		echo "\n</body>\n</html>";
		mysql_close($con);
    }   
}

login('Attendance Portal - Forgot Password');

?>
