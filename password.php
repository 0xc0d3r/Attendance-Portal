<?php
session_start();
require("functions.php");

function changecr($title) {
	
if(!check('CR')) header('location:login.php'); 
else {
	
	include('config/globals.php');
	
	$p = $_SERVER['QUERY_STRING'];
	$reg = "/^".$globalbranch."[1-".$classno."]{1}$/";
	
	if(preg_match($reg,$p)) {
		
		include 'config/db.php';
		include 'config/settings.php';	
		
		$dbname = $branchyear.'_Users';
		$table = $branchyear.'_Students';
		//if(!mysql_select_db($dbname)) die(mysql_error());
		
		$userid = $_SESSION['UserId'];
		$q = "select Branch,Class from $table where Id = '$userid'";
		$res = mysql_query($q) or die(mysql_error());
		$row = mysql_fetch_array($res);
		$branch = $row['Branch'];
		$class1 = $row['Class'];
		$class = substr($p,-1);
		
		if($class != $class1) echo "Your not from $branch $class";
	
		else {
				
			echo "<!DOCTYPE html>\n<html>\n";
			display_headers($title);
			echo "\n<body>";
			menu();
			
			$array=array_merge(range(0,9));
			shuffle($array);
			$crkey="";
			for($i=0;$i<6;$i++) $crkey.=$array[$i];
		
			echo <<< a
					<div class='container'>
						<div id="error" style="display:none;"></div>
						<div class='row'>
							<div class='span9'>
								<div class="well well-large" style="background:#FFF;height:450px;">
a;

			if(isset($_POST["Generate"])){
				
				$id = addslashes($_POST['IdNo']);
				$key = addslashes($_POST['Key']);
				$Skey = addslashes($_POST['Skey']);
				
				$dbname = $branchyear.'_Users';
				$table = $branchyear.'_Students';		
				//if(!mysql_select_db($dbname)) die(mysql_error());
				
				$userid1 = $_SESSION['UserId'];
				$userid = $id;
				
				$q = "select Name,Branch,Class,Gender from $table where Id = '$userid'";
				$res = mysql_query($q) or die(mysql_error());
				$row = mysql_fetch_array($res);
				$name = ucwords(strtolower($row['Name']));
				$branch = $row['Branch'];
				$class2 = $row['Class'];
				
				$dbname = $branchyear.'_Users';
				$table = $branchyear.'_CRs';		
				//if(!mysql_select_db($dbname)) die(mysql_error());
				
				$q = "select Id,`Key` from $table where Id = '$userid1'";
				$res = mysql_query($q) or die(mysql_error());
				$row = mysql_fetch_array($res);
				$key1 = $row['Key'];
				
				if($key1  != $Skey) {
					echo "<script>show_error('<b>Error </b> : CR Security Key does not matched.  Please try again.. ');</script>";
					}
				else {
					
					if(($class2 == $class) ) {
						
						$dbname = $branchyear.'_Logs';
						$table = $branchyear.'_Passwords';		
						//if(!mysql_select_db($dbname)) die(mysql_error());
						
						$q = "select `EndTime`, `Code` from `$table` where `To` = '$userid';";
						$res = mysql_query($q) or die(mysql_error());
						$n = mysql_num_rows($res);
						
						$StartTime =  date('d-m-Y H:i:s');
						$end = "";$dif = 0;$code="";
						
						while ($row = mysql_fetch_array($res)){
							$end = $row['EndTime'];
							$dif = strtotime($end)-strtotime($StartTime);
							$code = $row['Code'];};
						
						if(($dif <= 7200 && $dif > 0 ) && $n) echo "<script>show_error('<b>Error </b> : <b>$userid</b> is already assigned <b class=\'text-success\'>$code</b> till <b class=\'text-success\'>$end</b> ');</script>";	
						else {
							
							$EndTime = date('d-m-Y H:i:s', mktime(date('H')+2 ));
							$ip = $_SERVER['REMOTE_ADDR'];
			
							$q1 = mysql_query("insert into $table ( `To`, `Code`, `CreatedBy`, `StartTime`,`EndTime`, `Status`,`IP` ) values ( '$id', '$key' , '$userid1', '$StartTime', '$EndTime', 'valid','$ip');") or die(mysql_error());
							insert_log($_SESSION['UserId']."created security key for $id ");
							echo "<script>show_success('To change password of $id  use the security pin <u class=\'text-error\'>$key</u> valid up to <u class=\'text-error\'>$EndTime</u>  ');</script>";
							}
						}
					else echo "<script>show_error('<b>Error </b> : <b>$userid</b> is not from the <b>$branch $class </b>  Please try again.. ');</script>";
			
				}
			}
			
			echo <<< a
						<div id="step1">    
							<h4>Security Codes @ $branch $class </h4>
							<h6> &emsp;&emsp;&emsp;&emsp; Provide  requesting Student  Id </h6>
						   
							<form action="?$p" method="POST" onsubmit="return check_id();"  id="password">
							<br>
							<h5>Student ID No : </h5>
							<input type="text" class="input-large" placeholder="N090001"  id="Idno" name="IdNo" maxlength="7" /><br>
							<h5>Your Security Key : </h5>
							<input type="text" class="input-large" placeholder="Security Key"  id="Skey" name="Skey" maxlength="9" /><br>
							<!--<h5>Security Key : </h5>-->
							<input type="hidden" class="input-large" readonly=readonly name="Key" value="$crkey" >
							<br><input type="submit" class="btn btn-primary" name="Generate" value = "Continue &rarr;" />
							</form>	
							
						</div>
					</div>
				</div>
				<div class='span3'>
a;
			go_home();
			sidepanel();
			echo <<< a
			</div>
			</div>
			
			</div>
			</div>
			
a;
			
			echo "</div></div>";   
			display_footer();
			echo "\n</body>\n</html>";
			}
		}

	else echo "<script type='text/javascript'>document.location.href='404.php';</script>";
    }
}

changecr("Attendance Portal - Generate Password ");

?>


