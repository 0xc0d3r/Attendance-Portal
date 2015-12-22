<?php
session_start();
require('functions.php');
function classes($classno,$branch) {	
	echo "<ul class='nav nav-tabs nav-stacked'>";
	for($i = 1; $i <=$classno ; $i++) {
		echo <<< a
		<li><a href="?$branch$i/1/">$branch$i<i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>\n
a;
	}
	echo "</ul>";
}

function browse_students($title){
	
	if(!check_login()){
		header('location:login.php');
	}
	else{
		include 'config/globals.php';
		$cls_page=$_SERVER['QUERY_STRING'];
		$cp=explode('/',$cls_page);
		$len=count($cp);
		if($len == 2 or ($len == 3 and $cp[2]==null)){
			$class='/^'.$globalbranch.'[1-'.$classno.']{1}$/';
			$page='/^[1-9]{1}$/';
			if(preg_match($class,$cp[0]) and preg_match($page,$cp[1])){
				include 'config/db.php';
				include 'config/settings.php';	
				$dbname = $branchyear.'_Users';
				$table = $branchyear.'_Students';
				//if(!mysql_select_db($dbname)){die(mysql_error());}
				echo "<!DOCTYPE html>\n<html>\n";
				display_headers($title);
				echo "\n<body>";
				menu();
				echo <<< browse
					<div class="container" style="margin-top:-15px;height:450px;"><br>
						<div class="row">
							<div class="span9">
								<div class="well well-large" style="background:#FFF;">
									<div class="row">
										<div id="step1" class="span4">     
											<h5>Students @ $cp[0] </h5>
											<h6> &emsp;&emsp;&emsp; - &emsp; Listing all students in $cp[0] </h6>
										</div>
										<div id="page1" class="span4">
											<a class="pull-right"><h6>Page $cp[1]  </h6></a>
										</div>
									</div>
									<div id=$cp[0] >
										<table class="table  table-hover table-bordered "  style="padding:0px;">
											<thead>
												<tr>
													<th style="text-align:center;" class="span1">RNo</th> 
													<th style="text-align:center;" class="span1">ID #</th>
													<th style="text-align:center;" class="span3">Name</th> 
													<th style="text-align:center;" class="span1">Gender</th>
												</tr>
											</thead>
											<tbody>
browse;
				$page=$cp[1];
				$prev=$page-1;
				$next=$page+1;
				$per_page=10;
				$slimit=($page-1)*10;
				$branch=substr($cp[0],0,strlen($cp[0])-1);
				$class=substr($cp[0],-1);
				$query1=mysql_query("SELECT Id From ".$table." WHERE Branch = '$branch' and Class = '$class';");
				$strength=mysql_num_rows($query1);
				$query="SELECT Id,Name,Gender,RNo From ".$table." WHERE Branch='$branch' and Class='$class' LIMIT $slimit,$per_page;";
				$exe=mysql_query($query) or die(mysql_error());
				$lastpage=ceil($strength/$per_page);
				for($i=0;$i<mysql_num_rows($exe);$i++){
					$det=mysql_fetch_array($exe);
					$lnk = "./students.php?".$det[0]."/sub";
					$nm = ucwords(strtolower($det[1]));
					echo <<< student
					<tr onclick="document.location.href='$lnk';" style='cursor:pointer;'>  
						<td style="text-align:center;">$det[3]</td> 
						<td style="text-align:center;">$det[0]</td> 
						<td>$nm</td>
						<td style="text-align:center;" >$det[2]</td>   
					</tr>
student;
				}
				echo <<< next
				</tbody>
				</table>			
				</div>
				<div class="pagination pagination-centered">
				<ul>
next;
				if($page == 1 and $strength > 0){
					echo "<li class='disabled'><a>&larr;Prev</a></li>";
					for($i=1;$i<=$lastpage;$i++){
						echo "<li><a href='?$cp[0]/$i/'>$i</a></li>";			
					}
					echo "<li><a href='?$cp[0]/$next/'>Next&rarr;</a></li>";
				}
				elseif($page > 1 and $page < $lastpage){
					echo "<li><a href='?$cp[0]/$prev/'>&larr;Prev</a></li>";
					for($i=1;$i<=$lastpage;$i++){
						echo "<li><a href='?$cp[0]/$i/'>$i</a></li>";
					}
					echo "<li><a href='?$cp[0]/$next/'>Next&rarr;</a></li>";			
				}
				elseif($page == $lastpage){
					echo "<li><a href='?$cp[0]/$prev/'>&larr;Prev</a></li>";
					for($i=1;$i<=$lastpage;$i++){
						echo "<li><a href='?$cp[0]/$i/'>$i</a></li>";
					}
					echo "<li class='disabled'><a>Next&rarr;</a></li>";
				}
				else echo "No records found.";
				echo <<< next
						</ul>
						</div>
						</div>
						</div>
						<div class="span3">
next;
				go_home();
				classes($classno,$globalbranch);
				
				echo "</div></div>";
				display_footer();
				echo "\n</div></body>\n</html>";
			}
			else echo "Error :  Invalid syntax in URL.<br>";	
		}
		else echo "Error :  Invalid syntax in URL.<br>";
	}
}
browse_students("Browse Students");
?>
