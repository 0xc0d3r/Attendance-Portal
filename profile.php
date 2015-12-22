<?php
session_start();
require("functions.php");

function display_contact(){
	echo <<< a
	<form action="?contact" method='post' onsubmit='return change_contact();'>
	<h5> Change Contact Info </h5>
	<h6> &emsp;&emsp;&emsp; - &emsp; Provide your Contact Info  </h6><br>
	<h5>Current Password : </h5>
	<input type="password" class="input-large" placeholder="Password" id="OPass" name='OPass'><br>
	<h5>Mobile No : </h5>
	<input type="text" class="input-large" placeholder="9000000000" id="MNo" name='MNo'>
	<br><br><button type="submit" class="btn btn-primary" name="Contact" >Change Contact No &rarr;</button><br>
	<br>
	</form>
a;

	}
	
function display_password() {
	echo <<< a
	<form action="?password" method='post' onsubmit='return change_password1();'>
	<h5> Change Password </h5>
	<h6> &emsp;&emsp;&emsp; - &emsp; Provide new password Details  </h6><br>
	<h5>Current Password : </h5>
	<input type="password" class="input-large" placeholder="Password" id="OPass" name='OPass'>
	<h5>New Password : </h5>
	<input type="password" class="input-large" placeholder="Password" id="NPass1" name='NPass1'><br>
	<h5>Confirm Password : </h5>
	<input type="password" class="input-large" placeholder="Password" id="NPass2" name='NPass2'>
	<br><br><button type="submit" class="btn btn-primary" name="Password">Change Password &rarr;</button><br><br>
	</form>
a;
}

function display_photo() {
	echo <<< a
	<form action="?photo" enctype="multipart/form-data" method='post' onsubmit='return change_photo();' >
	<h5>Change Profile Photo </h5>
	<h6> &emsp;&emsp;&emsp;- Provide a new image for your Profile</h6><br>
	<h5>Current Password : </h5>
	<input type="password" class="input-large" placeholder="Password" id="OPass" name='OPass' ><br>
	<h5>Choose File : </h5><input type="file" placeholder='Name' id="Photo" name='PhotoFile'><br><br>
	<button type="submit" class="btn btn-primary" name="Photo">Change Photo&rarr;</button><br><br>
	</form>
a;
}

function changeprofile($title) {
	
if(!check_login()) {
	header('location:login.php');
}
else {
	
	include('config/globals.php');
	
	$p = $_SERVER['QUERY_STRING'];
	$arr = array("password","contact","photo");
	if(in_array($p,$arr)) {
		
		include 'config/db.php';
		include 'config/settings.php';	
		
		$dbname = $branchyear.'_Users';
		$table = $branchyear.'_Students';
		//if(!mysql_select_db($dbname)) die(mysql_error());
		
		$userid = $_SESSION['UserId'];
		$q = "select Password, PhoneNo, Branch from $table where Id = '$userid'";
		$res = mysql_query($q) or die(mysql_error());
		$row = mysql_fetch_array($res);
		$branch = $row['Branch'];
		$pass = $row['Password'];
		$phoneno = $row['PhoneNo'];
		$class = substr($p,-1);
		
		$ex = array("png","jpg","jpeg","gif","bmp");
		
		echo "<!DOCTYPE html>\n<html>\n";
		display_headers($title);
		echo "\n<body>";
		menu();
		
		echo <<< a
				<div class='container'>
					<div id="error" style="display:none;"></div>
					<div class='row'>
					<div class='span9'>
						<div class="well well-large" style="background:#FFF;height:450px;">
a;

		if($p == 'password') display_password();	
		if(isset($_POST['Password'])){
			
			$pass1 = md5($_POST['OPass']);
			$newpass1 = md5($_POST['NPass1']);
			$newpass2 = md5($_POST['NPass2']);
			
			if(strlen(trim($pass1))<7 )
			{
				echo "<script>show_error('Error : Password should not be null');</script>";
				exit;
			}
			if(strlen(trim($newpass1))<7)
			{
				echo "<script>show_error('Error : New Password should not be null');</script>";
				exit;
			}
			if(strlen(trim($newpass2))<7)
			{
				echo "<script>show_error('Error : Re- New Password should not be null');</script>";
				exit;
			}
			
			
			if($pass1 != $pass) echo "<script>show_error('Error : Your Current Password does not matched ... Please try again....');</script>";
			else {
				if($newpass1 != $newpass2) echo "<script>show_error('Error : New Password both does not matched ... Please try again....');</script>";
				else {
					$q = mysql_query("update $table set Password = '$newpass1' where Id = '$userid';") or die(mysql_error());
					insert_log("$userid changed his Password ");
					echo "<script>show_success('Password has been updated');</script>";
					
				}
			}		
		}	
			
		if($p == 'contact') display_contact();	
		if(isset($_POST['Contact'])){
			
			$pass1 = md5($_POST['OPass']);
			$contact1 = $_POST['MNo'];
			
			if(strlen(trim($pass1))<7 )
			{
				echo "<script>show_error('Error : Password should not be null');</script>";
				exit;
			}
			if(strlen(trim($contact1))==0)
			{
				echo "<script>show_error('Error : Contact No should not be null');</script>";
				exit;
			}
			
			
			if($pass1 != $pass) echo "<script>show_error('Error : Your Current Password does not matched ... Please try again....');</script>";
			else {
				if(strlen($contact1) != 10) echo "<script>show_error('Error : New Contact No. to short... Please try again....');</script>";
				else {
					$q = mysql_query("update $table set PhoneNo = '$contact1' where Id = '$userid';") or die(mysql_error());
					insert_log("$userid changed his Contact No");
					echo "<script>show_success('Contact No has been updated');</script>";
					
				}	
			}
		}
			
		if($p == 'photo')display_photo();	
		if(isset($_POST['Photo'])){
			
			$pass1 = md5($_POST['OPass']);
			if(strlen(trim($pass1))<7 )
			{
				echo "<script>show_error('Error : Password should not be null');</script>";
				exit;
			}
			
			if($pass1 != $pass) echo "<script>show_error('Error : Your Current Password does not matched ... Please try again....');</script>";
			else {
				
				if(isset($_FILES['PhotoFile'])) {
					$fname=$_FILES['PhotoFile']["name"];
					$fsize=$_FILES['PhotoFile']["size"];
					$fext=strtolower(end(explode(".",$fname)));
					if($fsize>102400) echo "<script>show_error('Error : Input file is larger than 100KB ... Please try again....');</script>";
					else {
						if(!in_array($fext,$ex)) echo "<script>show_error('Error : Input file is not a image file ... Please try again....');</script>";
						else {
							$fname_new = "assets/img/users/".$userid.".png";
							if(!move_uploaded_file($_FILES["PhotoFile"]["tmp_name"],$fname_new)) echo "<script>show_error('Error : In moving the input file ... Please try again....');</script>";
							else {
								exec("chmod 777 $fname_new");
								$q = mysql_query("update $table set Picture = '$fname_new' where Id = '$userid';") or die(mysql_error());
								insert_log("$userid changed his profile photo");
								echo "<script>show_success('Profile Photo Updated ');</script>";
								
							}
						}	
					}	
				}
				else echo "<script>show_error('Error : No input file ... Please try again....');</script>";
			}
		}

		echo <<< b
		</div>	
		</div>
		<div class='span3'>
b;
		go_home();
		echo <<< b
		<ul class="nav nav nav-tabs nav-stacked">
		
		<li><a href='?password'>Change Password <i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
		<li><a href='?contact'>Change Contact No<i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
		<li><a href='?photo'>Change Photo <i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
		
		</ul>
b;
		echo "</div></div></div>";   
		display_footer();
		echo "\n</body>\n</html>";
		}
		
	else echo "<script type='text/javascript'>document.location.href='404.php';</script>";
    }
}

changeprofile("Attendance Portal - Change Profile ");

?>
