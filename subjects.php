<?php
session_start();
require "functions.php";

function generate_attendance($title) {
    if(!check_login() ) header('location:./login.php');
    else {
		
			
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
			<div id='error'></div>
a;
			
			$dbname = $branchyear.'_Users';
			$table = $branchyear.'_Students';
			//if(!mysql_select_db($dbname)) die(mysql_error());
			
			$userid = $_SESSION['UserId'];
			$q = "select Position, Branch,Class from $table where Id = '$userid'";
			$res = mysql_query($q) or die(mysql_error());
			$row = mysql_fetch_array($res);
			if($row['Position'] == "BA") {
				$branch = $globalbranch;
				$class = substr($p,-1);	}
			else {
				$branch = $row['Branch'];
				$class = $row['Class'];
				$class1 = substr($p,-1);
				if($class1 != $class) {echo "<script type='text/javascript'>show_error('Error: Not authorised to access $branch$class1 details.');</script>";}
			}
				
			$dbname = $branchyear.'_Attendance';
			$table = $branch.$class.'_Attendance';
			//if(!mysql_select_db($dbname)) die(mysql_error());
			$class_total = mysql_num_rows(mysql_query("select `Id` from $table")) or die(mysql_error());
			$sample = mt_rand(1,$class_total);
			
			$da = date('d-m-Y');
			$date = date('d-m-Y');
			
				
			echo <<< a
			<div id="error" style="display:none;margin-top:10px;"></div>
			\n\t\t<div class="row">
				<div class='span12'>
					<div class="well well-large" style="background:#FFF;">
a;
			
			$ar = array();
			$users = array();
			
			for($j=0;$j<count($allowed_subjects);$j++) {
				$sub = $allowed_subjects[$j];
				$dbname = $branchyear.'_Subjects';
				$table = $branch.$class.'_Subjects';
				//if(!mysql_select_db($dbname)) die(mysql_error());
				$q = mysql_query("select RNo,Id from $table") or die(mysql_error());
				while($res = mysql_fetch_array($q)) {
					if($j == 1) {$users[$res['RNo']] = $res['Id'];}
					$ar[$sub][$res['RNo']]['Absents'] = 0;
					$ar[$sub][$res['RNo']]['Presents'] = 0;
					}
				}
			
			for($j=0;$j<count($allowed_subjects);$j++) {
				$sub = $allowed_subjects[$j];
				$dbname = $branchyear.'_Subjects';
				$table = $branch.$class.'_Subjects';
				//if(!mysql_select_db($dbname)) die(mysql_error());
				$qa = mysql_query("select RNo, `".$sub."_A` from $table") or die(mysql_error()) ;
				$qp = mysql_query("select RNo, `".$sub."_P` from $table") or die(mysql_error()) ;
				while($res = mysql_fetch_array($qa)) {
					$ar[$sub][$res['RNo']]["Absents"]+=$res[$sub."_A"];				
					}
				while($res = mysql_fetch_array($qp)) {
					$ar[$sub][$res['RNo']]["Presents"]+=$res[$sub."_P"];				
					}	
			}
			
			//print_r($ar);
			
			
			echo <<< a
			
				<div id="step1" class="span4">     
					<a ><h5>Today's Attendance Submission Details </h5></a>
					<h6> &emsp;&emsp;&emsp; - &emsp; Lising Data submitted from CR @ $branch&nbsp;$class </h6><br>
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
			$tr = '';
		
			$strength = count($users);
			for($j = 1; $j<=$strength;$j++) {
				
				$tr .= '<tr><td style="text-align:center;"  >'.$j.' </td> <td  style="text-align:center;" >'.$users[$j].' </td> '; 
				for($k = 0 ; $k< count($allowed_subjects) ;$k++) {
					$sub = $allowed_subjects[$k];
					$abs = $ar[$sub][$j]['Absents'];
					$pres = $ar[$sub][$j]['Presents'];
					$p_nod = $abs  + $pres;
					@$tmp = ($pres/$p_nod)*100;
					$pr = round($tmp,1);
					$cl = ($pr>50)?"green":'red';
					
					$tr .=  '
							<td style="text-align:center;"  ><font color=darkgreen> '.$pres.' </font></td> 		
							<td style="text-align:center;" > <font color=darkred >'.$abs.'</font> </td> 
							<td  style="text-align:center;"  > <font color=dark'.$cl.'>'.$pr.'</font></td>   																
							';
					}
				$tr .= '</tr>';
			}
			$html = "";
			echo <<< a
			 
			 <table class="table  table-hover table-bordered "  style="padding:0px;">
a;
			$html .= '<thead>
							<tr> 
								<th style="text-align:center;" rowspan=2 valign="top"> RNo  </th> 
								<th style="text-align:center;" rowspan=2 valign="top"> Id  </th>';
			echo $html;
					
				for($i=0;$i<count($allowed_subjects);$i++) {
				$sub = $allowed_subjects[$i];
				echo '<th  style="text-align:center;" colspan=3>'.$sub.'</th>';
				$html .= '<th  style="text-align:center;" colspan=3>'.$sub.'</th>';;
				} 
				$html .= "</tr><tr>";
				echo <<< a
						</tr>
						<tr> 
a;
				for($i=0;$i<count($allowed_subjects);$i++) {
				$tmp1 = '<th  style="text-align:center;"  > P </th>
								<th  style="text-align:center;"  > A </th> 
								<th  style="text-align:center;"  > Pr </th>';
				echo $tmp1; $html .= $tmp1;
			}
				echo <<< a
							</tr>
							
						</thead>
						<tbody>							
a;
			$html .= "</tr></thead><tbody>";
			echo $tr;
			$html .=$tr;
			$html .="</tbody></table><br><table style=\"border-collapse:collapse;width:100%;margin-left:0%;font-size:12px;\" border=1 >";
			$html .= "<tr>
			<th	><center>Short Name</center></th><th> <center>Long Name</center></th>
			<th	><center>Short Name</center></th><th> <center>Long Name</center></th>
		</tr>
		<tr>
			<th><center>P</center></th><td>&emsp;No. of Presents</td>	
			<th><center>A</center></th><td>&emsp;No. of Absents</td>
		</tr>
		<tr>	
			<th><center>Pr</center></th><td>&emsp;Performance in %</td>
			
		</tr>";
			echo "</tbody></table>";
			echo <<< a
			<br>
			<table class='table  table-hover table-bordered ' >
		<tr>
			<th	><center>Short Name</center></th><th> <center>Long Name</center></th>
			<th	><center>Short Name</center></th><th> <center>Long Name</center></th>
		</tr>
		<tr>
			<th><center>P</center></th><td>&emsp;No. of Presents</td>	
			<th><center>A</center></th><td>&emsp;No. of Absents</td>
		</tr>
		<tr>	
			
			<th><center>Pr</center></th><td>&emsp;Performance in %</td>
			<td colspan=2>&nbsp;</td>
		</tr>
		
</table>
a;
			if($row['Position']=="BA"){
			echo <<< a
			<form action='print.php' method='post' name='abc'>
			<input type='hidden' name='Title1' value="$branch $class - Subjectwise Attendance Report">
			<input type='hidden' name='Table1' value='$html'>
		<center><button type="submit" class="btn btn-primary"><i class='icon-download-alt'></i>&nbsp;&nbsp;Save as PDF</button></center>
			</form>
a;
			echo <<< b
			<form action='excel.php' method='post' name='abc'>
			<input type='hidden' name='Title1' value="$branch $class - Subjectwise Attendance Report">
			<input type='hidden' name="sheet" value='$html'>
		<center><button type="submit" class="btn btn-primary"><i class='icon-download-alt'></i>&nbsp;&nbsp;Save as Excel Sheet</button></center>
			</form>
b;
			}
			echo "</div> </div> </div> ";
			display_footer();
			echo "\n</body>\n</html>";
			@mysql_close($con);	
		}else echo "<script type='text/javascript'>document.location.href='404.php';</script>";
	
	} 
	
}

	

generate_attendance('Attendance Portal - Subjects Report');
?>

