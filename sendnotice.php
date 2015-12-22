<?php
session_start();
require("functions.php");

function classes($classno,$branch) {
	go_home();
	echo "<ul class='nav nav-tabs nav-stacked'>";
	echo '<li><a href="?all">All Students<i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a></li>';
	echo '<li><a href="?allcrs">All CRs<i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a></li>';
	for($i = 1; $i <=$classno ; $i++) 
	echo <<< a
	<li><a href="?$branch$i">$branch$i<i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>\n
a;
	echo "</ul>";
}

function send_notice($title){
	if(!check('BA') || !check('BA')) header('location:./?sub');
	else {
		include 'config/globals.php';
		$to = $_SERVER['QUERY_STRING'];
		$reg = "/^all|allcrs|".$globalbranch."[1-".$classno."]{1}$/";
		if(preg_match($reg,$to)){
			
			include 'config/db.php';
			include 'config/settings.php';
				
			$dbname = $branchyear.'_Logs';
			$table = $branchyear.'_Notifications';
			//if(!mysql_select_db($dbname)) die(mysql_error());
			
			echo "<!DOCTYPE html>\n<html>\n";
			display_headers($title);
			echo <<< js
				<script type='text/javascript'>
					function Preview(id,val){
						document.getElementById(id).innerHTML=val;
					}
				</script>
js;
			echo "\n<body>";
			menu();
			echo <<< a
				<div class="container" style="margin-top:-15px;">
					<br>
					<div id="error"></div>
					<div class="row">
						<div class="span9">
							<div class="well well-large" style="background:#FFF;">
								<div id="stpe2_P1">
									<h5>Send Notice @ $to :</h5>
									<h6> &emsp;&emsp;&emsp; - &emsp; Fill out below details  </h6>
									<!--<h5>Period 1 : </h5>-->
									<form enctype="multipart/form-data" method="POST" action="" onSubmit="return send_notice();">
a;
			if($to != "all" and $to != "allcrs"){
					echo <<< to
						<h6 > To :</h6>
						<label class="radio inline">
						<input type="radio" id='CRs' value="CRs" name="to" onclick="Preview(this.name,this.value);"> CRs 
					</label>
					<label class="radio inline">
						<input type="radio" id='Students' value="Students" name="to" onclick="Preview(this.name,this.value);"> Students
					</label><br><br>
to;
			}
			
			else echo "<br>";
			
			echo <<< a
				<h6> Subject :</h6>
				<input type="text" class="span8" placeholder="Subject" id='subject' name='sub' onkeyup="Preview(this.name,this.value);"><br>
				<h6> Message :</h6>
				<textarea class="span8" id='message' name='mes' style="resize:vertical;height:90px;" onkeyup="Preview(this.name,this.value);" placeholder="Type your message here"></textarea>
				<br>
				<h6> Attachment (Max : 100 MB):</h6>
				<input type="file" class="span8" placeholder="Attach a File Here" name='attachment'><br>				
			</div>
			<div id="stpe3">
				<a><h5>Preview : </h5></a><br>
				<!--<h6> &emsp;&emsp;&emsp; - &emsp; Confirm Your Notice </h6>-->
				<div class="row">
					<div class="span8">
						<table class="table  table-hover table-bordered" >
							<tbody>
								<tr> <th class="span2"  > To  </th>
a;
		if($to == "all") echo "<td class='span6' id='to'> ALL </td>  </tr>";
		else if($to=="allcrs") echo "<td class='span6' id='to'> ALL CR's</td>  </tr>";
		else echo "<td class='span6' id='to'> To address  </td>  </tr>";
		
		echo <<< a
							<tr> <th class="span2"  > Suject </th> <td class="span6" id='sub'> Notification subject  </td>  </tr>
							<tr> <th class="span2" > Message  </th> <td class="span6" id='mes'> Messasge  </td>  </tr>
						</tbody>
					</table>
				</div>
			</div><br>
			<input type="submit" class="btn btn-primary" value="Confirm & Send &rarr;" name="send" />
			</form>
		</div>
		<br>
	</div>
</div>
<div class="span3">
a;
			classes($classno,$globalbranch);
			echo "</div></div></div>";   
			display_footer();
			echo "\n</body>\n</html>";
		}
		else echo "<script type='text/javascript'>document.location.href='404.php';</script>";
		
	}
}

send_notice("Send notice section");

if(isset($_POST['send'])){
	include 'config/db.php';
	include 'config/settings.php';	
	
	$dbname = $branchyear.'_Logs';
	$table = $branchyear.'_Notifications';
	
	$To=$_SERVER['QUERY_STRING'];
	
	if($To != "all" and $To != "allcrs"){
		$to = $_POST['to'];
		$TO = $To."@".$to;
	}
	else $TO = $To;
	
	$from=$_SESSION['UserId'];
	$sub = trim(htmlentities(addslashes($_POST['sub'])));
	$mes = trim(htmlentities(addslashes(str_replace("\n","<br>",$_POST['mes']))));
	$datetime = date('d/m/Y H:i:s');
	$ip=$_SERVER['REMOTE_ADDR'];
	if(strlen($sub)<6)
	{
		echo "<script>show_error('Subject Length Must Be Lessthan or equals to 6');</script>";
		exit;
	}
	if(strlen($mes)<10)
	{
		echo "<script>show_error('Message Length Must Be Lessthan or equals to 10');</script>";
		exit;
	}
	//if(!mysql_select_db($dbname)) die(mysql_error());
	if($_FILES["attachment"]["name"]=="" or $_FILES["attachment"]["name"]==null or strlen($_FILES["attachment"]["name"])==0)
	{
	echo "Yes ! jAFFAGA IKKADE CHCHAV..";
	$query='INSERT INTO '.$table.'(`To`,`From`,`Subject`,`Message`,`DateTime`,`IP`) VALUES("'.$TO.'","'.$from.'","'.$sub.'","'.$mes.'","'.$datetime.'","'.$ip.'");';
	}
	else
	{
		$ex=array("php","js","sh","aspx");
		$fsize=$_FILES["attachment"]["size"];
		$fname=$_FILES["attachment"]["name"];
		$fext=strtolower(end(explode(".",$fname)));
		if($fsize>10240000) echo "<script>show_error('Error : Input file is larger than 100 MB ... Please try again....');</script>";
					else {
						if(in_array($fext,$ex)) echo "<script>show_error('Error : Selected File Contains some Suspicious Code ... ');</script>";
						else {
							$fname_new = "assets/notify_uploads/".$fname;
							if(!move_uploaded_file($_FILES["attachment"]["tmp_name"],$fname_new)) echo "<script>show_error('Error : In moving the input file ... Please try again....');</script>";
							else {
								exec("chmod 777 $fname_new");
								insert_log("$userid Attached ".$fname." in a Notification.");
							}
						}	
					}
		$query='INSERT INTO '.$table.'(`To`,`From`,`Subject`,`Message`,`Attachment`,`DateTime`,`IP`) VALUES("'.$TO.'","'.$from.'","'.$sub.'","'.$mes.'","'.$fname_new.'","'.$datetime.'","'.$ip.'");';
	}
	if (mysql_query($query)){
	if($_FILES["attachment"]["name"]!="" and $_FILES["attachment"]["name"]!=null and strlen($_FILES["attachment"]["name"])!=0)
	{
		echo "<script>show_success('Notification sent successfully with an Attachment.');</script>";
		insert_log($_SESSION['UserId']." added Notification ");
	}
	else
	{
		echo "<script>show_success('Notification sent successfully..');</script>";
		insert_log($_SESSION['UserId']." added Notification ");
	}
		}
	else die(mysql_error());
}
?>
