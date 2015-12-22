<?php
session_start();
require('functions.php');

function feedback($title){
	if(!check_login()) header("location:login.php");
	else{
		include 'config/globals.php';
		include 'config/db.php';
		include 'config/settings.php';
		$dbname = $branchyear.'_Logs';
		$table = $branchyear.'_Feedback';
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
		echo "<body>\n";
		menu();
		echo <<< feedback
			<div class="container" style="margin-top:-15px;">
					<br>
					<div id="error"></div>
					<div class="row">
						<div class="span9">
							<div class="well well-large" style="background:#FFF;">
								<div id="stpe2_P1">
									<h5>Give Feedback </h5>
									<h6> &emsp;&emsp;&emsp; - &emsp; Fill out below details  </h6>
									<!--<h5>Period 1 : </h5>-->
									<form method="POST" action="" onSubmit="return give_feedback();" >
										<h6 > Feedback Type :</h6>
										<label class="radio inline">
										<input type="radio" id='complaint' value="Complaint" name="ftype" onclick="Preview(this.name,this.value);"> Complaint 
									</label>
									<label class="radio inline">
										<input type="radio" id='suggestion' value="Suggestion" name="ftype" onclick="Preview(this.name,this.value);"> Suggestion
									</label><br><br>
								<h6> Subject :</h6>
								<input type="text" class="span8" placeholder="Subject" id='subject' name='sub' onkeyup="Preview(this.name,this.value);"><br>
								<h6> Message :</h6>
								<textarea class="span8" id='feedback' name='fb' style="resize:vertical;height:90px;" onkeyup="Preview(this.name,this.value);" placeholder="Type your complaint/suggestion here"></textarea>
				<br>
			</div>
			<div id="stpe3">
				<a ><h5>Preview </h5></a>
				<!--<h6> &emsp;&emsp;&emsp; - &emsp; Confirm Your Notice </h6>-->
				<div class="row">
					<div class="span8">
						<table class="table  table-hover table-bordered" >
							<tbody>
								<tr> 
									<th class="span2"  > Feedback Type  </th>
									<td class='span6' id='ftype'> Complaint/Suggestion  </td>
								</tr>
							<tr> 
								<th class="span2"  > Suject </th>
								<td class="span6" id='sub'> Feedback subject  </td>  
							</tr>
							<tr> 
								<th class="span2" > Feedback  </th> 
								<td class="span6" id='fb'> Complaint/Suggestion  </td> 
							</tr>
						</tbody>
					</table>
				</div>
			</div><br>
			<input type="submit" class="btn btn-primary" value="Confirm & Send &rarr;" name="post" />
			</form>
		</div>
		<br>
	</div>
</div>
feedback;
			echo "<div class='span3'>"; 
			go_home();
			sidepanel();
			echo "</div></div>";   
			display_footer();
			echo "\n</body>\n</html>";
	}
}

feedback("Attendance Portal - Feedback");

if(isset($_POST['post'])){
	include 'config/db.php';
	include 'config/settings.php';	
	$dbname = $branchyear.'_Logs';
	$table = $branchyear.'_Feedback';
	$ftype = $_POST['ftype'];
	$Sentby=$_SESSION['UserId'];
	$sub = trim(htmlentities(addslashes($_POST['sub'])));
	//$feedback = trim(htmlentities(addslashes($_POST['fb'])));
	//$feedback = trim(htmlentities(addslashes(str_replace("\n","<br>",$_POST['fb']))));
	$feedback = trim(str_replace("\n","<br>",$_POST['fb']));
	if(strlen($sub)<6)
	{
		echo "<script>show_error('Subject Length Must Be Lessthan or equals to 6');</script>";
		exit;
	}
	if(strlen($feedback)<10)
	{
		echo "<script>show_error('Feedback Length Must Be Lessthan or equals to 10');</script>";
		exit;
	}
	$datetime = date('d/m/Y H:i:s');
	$ip=$_SERVER['REMOTE_ADDR'];
	//if(!mysql_select_db($dbname)) die(mysql_error());
	$query="INSERT INTO ".$table."(`Ftype`,`Subject`,`Feedback`,`Sentby`,`DateTime`,`IP`) VALUES('$ftype','$sub','$feedback','$Sentby','$datetime','$ip');";
	if (mysql_query($query))
		{echo "<script>show_success('Your Feedback posted successfully..Thank you');</script>";
		insert_log($_SESSION['UserId']." sent feedback");
		}
	else
		die(mysql_error());
}
?>
