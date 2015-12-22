<?php
session_start();
ob_start();
require "functions.php";

function generate_attendance($title) {
    if(!check_login() ) header('location:./login.php');
    else {
		if(!check_day() ) {
			
		include('config/globals.php');

		$p = $_SERVER['QUERY_STRING'];
		$reg = "/^".$globalbranch."[1-".$classno."]{1}$/";
		
		if(preg_match($reg,$p)) {
			
			include 'config/db.php';
			include 'config/settings.php';
			include 'config/globals.php';
			
			echo "<!DOCTYPE html>\n<html>\n";
			display_headers($title);
			echo "\n<body>";
			menu();
			echo <<< a
			\n\t<div class="container" style="margin-top:-10px;"><br>
			<div id="error" style="display:none;margin-top:10px;"></div>
			
a;
			$table='';
			//$spread='';
			
			$dbname = $branchyear.'_Users';
			$table = $branchyear.'_Students';
			//if(!mysql_select_db($dbname)) die(mysql_error());
			
			$userid = $_SESSION['UserId'];
			$q = "select Branch,Class,Position from $table where Id = '$userid'";
			$res = mysql_query($q) or die(mysql_error());
			$row = mysql_fetch_array($res);
			if($row['Position'] == "BA") {
				$branch = $globalbranch;
				$class = substr($p,-1);	}
			else {
				$branch = $row['Branch'];
				$class = $row['Class'];
				$class1 = substr($p,-1);
				if($class1 != $class) {
				//echo 'i am in';
				echo "<script type='text/javascript'>show_error('Error: Not authorised to access $branch$class1 details.');</script>";}
			}
			
			
				
			
			
				
			echo <<< a
			
			\n\t\t<div class="row">
				<div class='span12'>
					<div class="well well-large" style="background:#FFF;">
a;
			
		
			
			
			
			
			
			
			
			echo <<< a
			
				<div id="step1" class="span4">     
					<h5 class='text-info'>Time Table Details for Class $branch&nbsp;$class </h5>
					<h6> &emsp;&emsp;&emsp; - &emsp; Listing Data present in our database </h6><br>
				</div>
				<div id="side1" class="span7" >
					<h6 class='text-right'><a href='./?sub'><i class='icon-home'></i> Home&nbsp;</a> </h6>
a;
			if($row['Position'] == "BA") {
				echo <<< a
					<h6 class='text-right'>
a;
				for($cl = 1;$cl<=$classno;$cl++)	
					{echo "<a href='?$globalbranch$cl'>$globalbranch$cl</a>&emsp;";}
					echo <<< a
					</h6>
a;
				}
			echo <<< a
				</div>
			
a;
			
			
			$html = "";
			echo 
			 
			 '<table class="table  table-hover table-bordered "  style="padding:0px;">
						<thead>
							<tr> 
								<th style="text-align:center;"  > Period/Day  </th> 
								<th style="text-align:center;"  > Monday  </th> 
								<th style="text-align:center;"  > Tuesday  </th> 
								<th style="text-align:center;"  > Wednesday  </th> 
								<th style="text-align:center;"  > Thursday  </th> 
								<th style="text-align:center;"  > Friday  </th> 
								<th style="text-align:center;"  > Saturday  </th> 
							</tr>
						</thead>
						<tbody>';
			//$spread.=" \t \t P1  \t P2 \t  P3 \t P4 \t \t \t\nRno\tID\t".$subjects['P1']."\t".$subjects['P2']."\t".$subjects['P3']."\t".$subjects['P4']."\tPresents\tAbsents\n";
			$html .= "<thead><tr> 
								
								<th > Period/Day </th> 
								<th > Monday </th>
								<th > Tuesday </th>  
								<th > Wednesday </th>
								<th > Thursday </th>
								<th > Friday </th>  
								<th > Saturday </th> 
							</tr>
							</thead><tbody>";
			
			$dbname = $branchyear.'_TimeTable';
			$table = $branch.$class.'_TimeTable';
			//if(!mysql_select_db($dbname)) die(mysql_error());
			
			$ti=mysql_query("SELECT * from $table;") or die(mysql_error());
			while($res = mysql_fetch_array($ti)){
				echo "<tr>";
				$html .="<tr>";
				
				for($ct=0;$ct<7;$ct++){
					if($ct == 0 ){
						echo "<th><center>".$res[$ct]."</center></th>";
						$html .= "<th><center>".$res[$ct]."</center></th>";
						}
					else {
						echo "<td><center>".$res[$ct]."</center></td>";
						$html .= "<td><center>".$res[$ct]."</center></td>";
						}
					}
				$html .="</tr>";
				echo "</tr>";
				}
			$html .="</tbody></table><br><br><table style=\"border-collapse:collapse;width:100%;margin-left:0%;font-size:12px;\" border=1 ><tr>
			<th width=25% ><center>Short Name</center></th><th> Long Name</th></tr>";
			echo "</tbody></table>";
			echo <<< a
			<br>
			<table class='table  table-hover table-bordered' >
		<tr>
			<th width=25% ><center>Short Name</center></th><th> Long Name</th>
		</tr>
		
a;
		foreach($sub_def as $key => $val){
		echo "<tr><th><center>$key</center></th><td>$val</td></tr>";
		$html.="<tr><th><center>$key</center></th><td>&emsp;$val</td></tr>";}
		echo <<< a
		</table>	
a;

			
			if($row['Position']=="BA"){
			echo <<< a
			<form action='print.php' method='post' name='abc'>
			<input type='hidden' name='Title1' value="$branch $class - Time Table Report">
			<input type='hidden' name='Table1' value='$html'>
		<center><button type="submit" class="btn btn-primary"><i class='icon-download-alt'></i>&nbsp;&nbsp;Save as PDF</button></center>
			</form>
a;
			echo <<< b
			<form action='excel.php' method='post' name='abc'>
			<input type='hidden' name='Title1' value="$branch $class - Time Table Report">
			<input type='hidden' name="sheet" value='$html'>
		<center><button type="submit" class="btn btn-primary"><i class='icon-download-alt'></i>&nbsp;&nbsp;Save as Excel Sheet</button></center>
			</form>
b;
}
			echo <<< a
					</div>
				</div>
				
a;
		
			echo "</div> </div> ";
		
			display_footer();
			echo "\n</body>\n</html>";
			@mysql_close($con);	
		}else echo "<script type='text/javascript'>document.location.href='404.php';</script>";
	}
		else noservice();
	} 
	
}

	

generate_attendance('Attendance - Class - Time Table');
?>

