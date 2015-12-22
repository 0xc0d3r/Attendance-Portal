<?php
session_start();
require('functions.php');

function display_feedback($title){
	if(!check('SA') and !check('BA') ) header("location:./?sub");
	else{
		include 'config/globals.php';
		$pg = $_SERVER['QUERY_STRING'];
		$page='/^[\d]+$/';
		if(preg_match($page,$pg)){
			include 'config/db.php';
			include 'config/settings.php';	
			$dbname = $branchyear.'_Logs';
			$table = $branchyear.'_Feedback';
			//if(!mysql_select_db($dbname)) die(mysql_error());
			echo "<!DOCTYPE html>\n<html>\n";
			display_headers($title);
			echo "<body>\n";
			menu();
			echo <<< display
				 <br><div class="container" style="margin-top:-15px;">
					 <div class="row">
						<div class="span9">
							<div class="well well-large" style="background:#FFF;">
								<div class="row">
									<div id="step1" class="span4">     
										<h5>Feedback</h5>
										<h6> &emsp;&emsp;&emsp; - &emsp; Listing all complaints and suggestions </h6>
									</div>
									<div id="page1" class="span4">
										<a class="pull-right"><h6>Page $pg</h6></a>
									</div>
								</div>
display;
			//if(!mysql_select_db($dbname)) die(mysql_error());
			$query="SELECT * From ".$table." ORDER BY SNo DESC;";
			$exe=mysql_query($query) or die(mysql_error());
			$page=$pg;
			$prev=$page-1;
			$next=$page+1;
			$per_page=10;
			$slimit=($page-1)*10;
			$total = mysql_num_rows($exe);
			$lastpage = ceil($total/$per_page);
			$query1 = "SELECT * FROM ".$table." ORDER BY SNo DESC LIMIT $slimit,$per_page;";
			$exe1 = mysql_query($query1) or die(mysql_error());
			if($total > 0){
				echo <<< table
					<div id='$globalbranch' >
						<table class="table  table-hover table-bordered "  style="padding:0px;">
							<thead>
								<tr>
									<th style="text-align:center;" class="span1">Date</th>
									<th style="text-align:center;" class="span4">Subject</th>
									<th style="text-align:center;" class="span1">Sender</th> 
								</tr>
							</thead>
							<tbody>
							
table;
				for($i=0;$i<mysql_num_rows($exe1);$i++){
					$record = mysql_fetch_array($exe1);
					$datetime=explode(' ',$record['DateTime']);
					$date=$datetime[0];
					echo <<< feedback
			<tr data-toggle='modal' href="#Note$record[0]" style="cursor:pointer;" >
				<td style="text-align:center;">$date</td>  
				<td >$record[2]</td> 
				<td style="text-align:center;"> $record[4]  </td>
			 </tr>	
					
feedback;
				}
				echo <<< feedback
				</tbody>
				</table>
				</div>
				
feedback;
		$query2 = "SELECT * FROM ".$table." ORDER BY SNo DESC LIMIT $slimit,$per_page;";
		$exe2 = mysql_query($query2) or die(mysql_error());
		for($i=0;$i<mysql_num_rows($exe1);$i++){
				$record = mysql_fetch_array($exe2);
				$datetime=explode(' ',$record['DateTime']);
				$date=$datetime[0];
				if(preg_match("/&lt;br&gt;/",$record[3]))
					$record[3]=str_replace("&lt;br&gt;","<br>",$record[3]);
				echo <<< feedback
				<div id="Note$record[0]" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="useridlabel" aria-hidden="true">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h5>$record[2]</h5> 
					</div>
					<div class="modal-body">
						<p>$record[3]</p>
					</div>
					<div class="modal-footer">
						<h6 class="pull-left">$record[1] sent by<i> $record[4] </i> @ $record[5] </h6>
					</div>
				</div>		
feedback;
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
			echo "</div></div><div class='span3'>"; 
				go_home();
				sidepanel();
				echo "</div></div>";
				display_footer();
				echo "\n</body>\n</html>";
		}
		else echo "<script type='text/javascript'>document.location.href='404.php';</script>";
	}
}

display_feedback("Admin - Feedback");
?>
