<?php
session_start();
require("functions.php");

function changecr($title) {
	
if(!check('BA') and !check('SA')) header('location:login.php');
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
		$q = "select Branch from $table where Id = '$userid'";
		$res = mysql_query($q) or die(mysql_error());
		$row = mysql_fetch_array($res);
		$branch = $row['Branch'];
		$class = substr($p,-1);
		
		echo "<!DOCTYPE html>\n<html>\n";
		display_headers($title);
		echo "\n<body>";
		menu();
		
		$array=array_merge(range(0,9),range('a','z'));
		shuffle($array);
		$crkey="";
		for($i=0;$i<9;$i++) $crkey.=$array[$i];
		
		echo <<< a
				<div class='container'>
					<div id="error" style="display:none;"></div>
					<div class='row'>
					<div class='span9'>
						<div class="well well-large" style="background:#FFF;height:450px;">
a;
		
		if(isset($_POST["Idno"]))
		{
			$id = addslashes($_POST['Idno']);
			$gender = addslashes($_POST['Gender']);
			$key = addslashes($_POST['Key']);
			
			if(strlen(trim($id))==0)
			{
				echo "<script>show_error('Error : Id should not be null');</script>";
				exit;
			}
			if(strlen(trim($gender))==0)
			{
				echo "<script>show_error('Error : CR Gender should not be null');</script>";
				exit;
			}
			if(strlen(trim($key))==0)
			{
				echo "<script>show_error('Error : Key should not be null');</script>";
				exit;
			}
			
			include 'config/db.php';
			include 'config/settings.php';	
			
			$dbname = $branchyear.'_Users';
			$table = $branchyear.'_Students';		
			//if(!mysql_select_db($dbname)) {die(mysql_error());}
			
			$userid = $id;
			$q = "select Name,Branch,Class,Gender from $table where Id = '$userid'";
			$res = mysql_query($q) or die(mysql_error());
			$row = mysql_fetch_array($res);
			$name = ucwords(strtolower($row['Name']));
			$branch = $row['Branch'];
			$class1 = $row['Class'];
			$gender1 = $row['Gender'];
			$branch = $globalbranch;
			$d = $dict[$gender.'1'];
			if(($class1 == $class) && ($gender1 == $gender) ) {
				
				$table = $branchyear.'_CRs';
				$old_id = mysql_fetch_array(mysql_query("Select Id from $table where Class = '$class'  and Gender = '$gender';"))['Id'];
				$q = mysql_query("delete from $table where Class = '$class'  and Gender = '$gender';") or die(mysql_error());
				$q1 = mysql_query("insert into $table ( `Id`, `Name`, `Gender`, `Branch`,`Class`, `Key`) values ( '$id', '$name' , '$gender', '$branch', '$class', '$key');") or die(mysql_error());
				insert_log("Changing $branch $class $d CR to $id");
				$dbname = $branchyear.'_Logs';
				$table = $branchyear.'_Notifications';		
				//if(!mysql_select_db($dbname)) {die(mysql_error());}
				$datetime = date('d/m/Y H:m:s');
				$ip=$_SERVER['REMOTE_ADDR'];
				$to1 = $branch.$class."@students";
				$query=mysql_query("INSERT INTO ".$table."(`To`,`From`,`Subject`,`Message`,`DateTime`,`IP`) VALUES('$to1','".$_SESSION['UserId']."','Changing the $d CR of $branch $class','Dear Students,<br>Please Notice that, $branch $class $d CR has been changed to <br> $name, $id.','$datetime','$ip');") or die(mysql_error());
				$table = $dbname = $branchyear.'_Students';
				$query=mysql_query("update $table set Position = 'CR' where Id = '$id'") or die(mysql_error());
				$query1=mysql_query("update $table set Position = 'S' where Id = '$old_id'") or die(mysql_error());
				echo "<script>show_success('$branch $class $d CR has been updated with $name and security key <u class=\'text-error\'>$key</u> ');</script>";
				
				}
			else echo "<script>show_error('<b>Error </b> : <b>$id</b> is not from the <b>$branch $class $d</b>  Please try again.. ');</script>";
		}
		
		echo <<< a
			<div id="step1">    
			<h4>Change CR of $branch $class </h4>
			<h6> &emsp;&emsp;&emsp;&emsp; Provide Details of New CR  </h6><br>
			<form action="?$p" method="POST" onsubmit="return viewcr('$branch',$class);"  id="changecr">
			<h5>Gender : </h5>  
			<label class="radio inline"><input type="radio"  value="M" name="Gender" id="Male" /> Male </label>
			<label class="radio inline"><input type="radio"  value="F" name="Gender" id="Female" /> Female </label> 
			<br><br>
			<h5>New CR ID No : </h5>
			<input type="text" class="input-large" placeholder="N090001"  id="Idno" name="IdNo" maxlength="7" /><br>
			<!--<h5>Security Key : </h5>-->
			<input type="hidden" class="input-large" placeholder="Password" readonly=readonly name="Key" value="$crkey" ><br>
			<input type="submit" class="btn btn-primary" name="change" value = "Continue &rarr;" />
			</form>	
			<form action="?$p" method='post' id='sub2'>
			<div id="confirm">
				<div id="cr" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="useridlabel" aria-hidden="true">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 id="useridlabel">Caution</h4>
				</div>
				<div class="modal-body" id='mbody'></div>
				<div class="modal-footer">
				<button class="btn btn-danger"  aria-hidden="true" type="submit" onclick="a();">Confirm & Replace </button> 
				<button class="btn btn-primary"  aria-hidden="true"  data-dismiss='modal' > Cancel </button>
				</div>
			</div>
				<input type="hidden"  placeholder="Password" readonly=readonly name="Gender" value="" id='gender1'>
				<input type="hidden"  placeholder="Password" readonly=readonly name="Idno" value="" id='idno1'>
				<input type="hidden" class="input-large" placeholder="Password" readonly=readonly name="Key" value="$crkey" >
			</form>
			</div>
			</div>		
a;
			echo <<< b
				
				</div>	
				</div>
				<div class='span3'>
b;
			go_home();
			cr_classes($classno,$globalbranch);
			
			echo "</div></div></div>";   
			display_footer();
			echo "\n</body>\n</html>";
		}
	else echo "<script type='text/javascript'>document.location.href='404.php';</script>";
	
    }
}

changecr("Attendance Portal - Change CR ");

?>
