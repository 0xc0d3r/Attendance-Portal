<?php
session_start();
require('functions.php');
$userid = $_SESSION['UserId'];
function display_notice($title){
	$userid = $_SESSION['UserId'];
	if(!check_login()) header("location:login.php");	
	else{
		include 'config/globals.php';
		$pg = $_SERVER['QUERY_STRING'];
		$page='/^[\d]+$/';
		$todaydate=date('d/m/Y');
		if(preg_match($page,$pg)){
			include 'config/db.php';
			include 'config/settings.php';	
			$dbname = $branchyear.'_Logs';
			$table = $branchyear.'_Notifications';
			//if(!mysql_select_db($dbname)) die(mysql_error());
			echo "<!DOCTYPE html>\n<html>\n";
			display_headers($title);
			echo "<body>\n";
			menu();
			echo <<< display
				 <div class="container" style="margin-top:-15px;"><br>
					<div id='error'></div>
					 <div class="row">
						<div class="span12">
							<div class="well well-large" style="background:#FFF;">
								<div class="row">
									<div id="step1" class="span4">     
										<h5>Notifications</h5>
										<h6> &emsp;&emsp;&emsp; - &emsp; Listing all notifications </h6>
									</div>
									<div id="page1" class="span7">
										&emsp;<a class="pull-right"><h6>Page $pg</h6></a>&emsp;
										<a class="pull-right" href='./?sub'><h6><i class='icon-home'></i> Home&nbsp;| &nbsp;</h6></a>
									</div>
								</div>
display;
			//if(!mysql_select_db("".$branchyear."_Users")) die(mysql_error());
			$scheck=mysql_query("SELECT Branch,Class,Position FROM ".$branchyear."_Students WHERE Id='$userid';") or die(mysql_error());
			$sdet = mysql_fetch_array($scheck);
			$class = $sdet[0].$sdet[1];
			$type = $sdet['Position'];
			$toS = $class."@Students";
			$crcheck=mysql_query("SELECT Id FROM ".$branchyear."_CRs WHERE Id='$userid';") or die(mysql_error());
			//if(!mysql_select_db($dbname)) die(mysql_error());
			if(mysql_num_rows($crcheck) == 1){
				$toCR = $class."@CRs";
				$query = "SELECT * FROM ".$table." WHERE `To`='$toS' or `To`='$toCR' or `To` = 'all' or `To`= 'allcrs' ORDER BY SNo DESC;";
			}
			else if ($type == "BA" or $type == "SA") {$query = "SELECT * FROM ".$table."  ORDER BY SNo DESC;";}
			else $query="SELECT * From ".$table." WHERE `To`='$toS' or `To` = 'all' ORDER BY SNo DESC;";
			//echo $userid;
			$exe=mysql_query($query) or die(mysql_error());
			$page=$pg;
			$prev=$page-1;
			$next=$page+1;
			$per_page=10;
			$slimit=($page-1)*10;
			$total = mysql_num_rows($exe);
			//if($total == 0) echo "<script>show_error('No notifications found');</script>";
			$lastpage = ceil($total/$per_page);
			if(mysql_num_rows($crcheck) == 1){
				$query1 = "SELECT * FROM ".$table." WHERE `To`='$toS' or `To`='$toCR' or `To`='all' or `To`='allcrs' ORDER BY SNo DESC LIMIT $slimit,$per_page;";
				}
			else if ($type == "BA" or $type == "SA"){
				$query1 = "SELECT * FROM ".$table."  ORDER BY SNo DESC LIMIT $slimit,$per_page;";
				}
			else
				$query1 = "SELECT * FROM ".$table." WHERE `To`='$toS' or `To`='all' ORDER BY SNo DESC LIMIT $slimit,$per_page;";
			$exe1 = mysql_query($query1) or die(mysql_error());
			if($total > 0){
				echo <<< table
					<div id='$globalbranch' >
						<table class="table  table-hover table-bordered "  style="padding:0px;">
							<thead>
								<tr>
									<th style="text-align:center;" class="span1">Date</th>
									<th style="text-align:center;" class="span3">Subject</th>
									<th style="text-align:center;" class="span1">To</th> 
									<th style="text-align:center;" class="span2">Sender</th> 
								</tr>
							</thead>
							<tbody>
							
table;
				for($i=0;$i<mysql_num_rows($exe1);$i++){
					$record = mysql_fetch_array($exe1);
					$datetime=explode(' ',$record['DateTime']);
					$date=$datetime[0];
					if($type=="BA") {
						if ($record[1] == "all" ) {
							$to = "ALL Students";
							}
						else if($record[1]=="allcrs"){
							$to = $to = "ALL CRs";
							}
						else 
							$to = ucfirst($record[1]);
						}
					else {
						if ($record[1] == "all" ) {
							$to = "ALL Students";
							}
						else if($record[1]=="allcrs"){
							$to = $to = "ALL CRs";
							}
						else {$to=explode('@',$record[1])[1];}
					}
					$q1 = mysql_query("select `Name`,`Gender` from `".$branchyear."_Admins` where `Id` = '".$record[2]."'");
					$q11 = mysql_fetch_array($q1);
					
					$gen = $dict[$q11[1]."2"];
					$q2 = $gen.$q11[0];
					//$name = mysql_fetch_array($q2);
					//print_r($name);
					echo <<< feedback
						<tr data-toggle='modal' href="#Note$record[0]" style="cursor:pointer;" >
							<td style="text-align:center;">$date</td>  
							<td >$record[3]
feedback;
if($date==(string)$todaydate)
{
	echo "&emsp;<blink><span class='label label-important'>New</span></blink>";
}
echo <<<feedback
</td> 
							<td style='padding-left:15px;'> $to  </td>
							<td style='padding-left:15px;'> $q2 </td>
						 </tr>		
feedback;
				}
					echo <<< feedback
						</tbody>
						</table>
						</div>
feedback;
					if(mysql_num_rows($crcheck) == 1)
						$query2 = "SELECT * FROM ".$table." WHERE `To`='$toS' or `To`='$toCR' or `To` = 'all' ORDER BY SNo DESC LIMIT $slimit,$per_page;";
					else if ($type == "BA" or $type == "SA"){
						$query2 = "SELECT * FROM ".$table."  ORDER BY SNo DESC LIMIT $slimit,$per_page;";
						}
					else
						$query2 = "SELECT * FROM ".$table." WHERE `To`='$toS' or `To` = 'all' ORDER BY SNo DESC LIMIT $slimit,$per_page;";
					$exe2 = mysql_query($query1) or die(mysql_error());
					for($i=0;$i<mysql_num_rows($exe1);$i++){
							$record = mysql_fetch_array($exe2);
							$datetime=explode(' ',$record['DateTime']);
							$date=$datetime[0];
							//echo $todaydate;
							$to=explode('@',$record[1]);
							$q1 = mysql_query("select `Name`,`Gender` from `".$branchyear."_Admins` where `Id` = '".$record[2]."'");
							$q11 = mysql_fetch_array($q1);
							
							$gen = $dict[$q11[1]."2"];
							$q2 = $gen.$q11[0];
							if(preg_match("/&lt;br&gt;/",$record[4]))
								$record[4]=str_replace("&lt;br&gt;","<br>",$record[4]);
							echo <<< feedback
							<div id="Note$record[0]" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="useridlabel" aria-hidden="true">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h5>$record[3]</h5> 
								</div>
								<div class="modal-body">
									<p>$record[4]</p><br>
									<p>
feedback;
if($record[5]==NULL or $record[5]=="" or strlen(trim($record[5]))==0){echo "</p>";}
else{$uri=explode("/",$_SERVER["REQUEST_URI"]);$atname=explode("/",$record[5]);echo "<i class='icon-paper-clip icon-2x'></i><b>&emsp;<a href='http://".$_SERVER["SERVER_ADDR"]."/".$uri[1]."/".$record[5]."' target='_blank'>".$atname[2]."</a></b></p>";}
echo <<<min1
								</div>
								<div class="modal-footer">
									<h6 class="pull-left">Sent by<i> $q2 </i> @ $record[6] </h6>
								</div>
							</div>		
min1;
					}
					echo <<< page
						<div class="pagination pagination-centered">
							<ul>
page;
					
					if($page < ($total/10)+1) {
						if($page != 1)
							echo "<li><a href='?$prev'>&larr; Prev</a></li>";
						else {echo "<li class='disabled'><a>&larr; Prevt</a></li>";}
						
						if($lastpage<=10){
							for($i=1;$i<=$lastpage;$i++){
								if($page == $i ) echo "<li class='active'><a href='?$i'><b class='text-error'> $i</b></a></li>";	
									else echo "<li><a href='?$i'>$i</a></li>";					
							}
						}
						else{
								$init1 = ($page%10 == 0)?((floor($page/10)-1)*10+1):((floor($page/10)*10)+1) ;
								// total no of records total pages pages range 
								//echo $page/10; echo $lastpage/10;
								$end1 = (floor(($page-1)/10) == floor($lastpage/10))?$lastpage:((ceil($page/10))*10);
								for($i=$init1;$i<=$end1;$i++){
									if($page == $i ) echo "<li class='active'><a href='?$i'><b class='text-error'> $i</b></a></li>";	
									else echo "<li><a href='?$i'>$i</a></li>";			
								}
							}
					if($page != $lastpage)
						echo "<li><a href='?$next'>Next &rarr;</a></li>";
					else {echo "<li class='disabled'><a>Next &rarr;</a></li>";}
					}
					else echo "<script>show_error('No notifications found');</script>";
			echo <<< next
						</ul>
						</div>
					
next;
		
			}
			else echo "<center><p>No complaints/suggestions found.</p></center>";
				
			
			echo "\n</div>"; 
			display_footer();
			echo "</body>\n</html>";
		}
		else echo "<script type='text/javascript'>document.location.href='404.php';</script>";
	}
}
display_notice("Show Notifications");
?>
