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
			$class_total = mysql_num_rows(mysql_query("select `Id` from $table"));
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
			$html="";
			//$spread="";
			for($j=1;$j<=4;$j++) {
				$prd = "P".$j;
				$dbname = $branchyear.'_Attendance';
				$table = $branch.$class.'_Attendance';
				//if(!mysql_select_db($dbname)) die(mysql_error());
				$q = mysql_query("select RNo,Id from $table") or die(mysql_error());
				while($res = mysql_fetch_array($q)) {
					if($j == 1) {$users[$res['RNo']] = $res['Id'];}
					$ar[$prd][$res['RNo']]['Absents'] = 0;
					$ar[$prd][$res['RNo']]['Presents'] = 0;
					}
				}
			
			for($j=1;$j<=4;$j++) {
				$prd = "P".$j;
				$prd1 = $prd."_Con"; 
				
				$dates = array(); $coun = 0;
				
				//mysql_select_db($branchyear."_Dates") or die(mysql_error());
				$q=mysql_query("Select Date from ".$branch.$class."_Dates where `$prd1` ='ok' ;") or die(mysql_error());
				
			
				$nodq = mysql_num_rows($q);
				$ar[$prd]['nod'] = $nodq;
				while($dad = mysql_fetch_array($q)) { $dates[$coun++] = $dad[0]; }
				
				
				foreach($dates as $key => $da){
					$dbname = $branchyear.'_Attendance';
					$table = $branch.$class.'_Attendance';
					//if(!mysql_select_db($dbname)) die(mysql_error());
					$q = mysql_query("select RNo, `$da` from $table") or die(mysql_error()) ;
					while($res = mysql_fetch_array($q)) {
						$exp = explode(",",$res[$da]);
						
						for($z=0;$z<count($exp);$z++) {
							if(substr($exp[$z],0,2) == $prd) {
								if(substr($exp[$z],-1) == "A") $ar[$prd][$res['RNo']]["Absents"]+=1;	
								else $ar[$prd][$res['RNo']]["Presents"]+=1;				
								}	
							}
						}
				}	
			}
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
			$html_tr="";
			//$spread_tr="";
			$strength = count($users);
			for($j = 1; $j<=$strength;$j++)
			{
				$pr_tot = 0 ;
				$tr .= '<tr><td style="text-align:center;">'.$j.' </td> <td  style="text-align:center;" >'.$users[$j].' </td> '; 
				$html_tr.="<tr><td>".$j." </td> <td>".$users[$j]."</td> ";
				//$spread_tr.="$j \t {$users[$j]} \t";
				for($k = 1 ; $k<= 4;$k++) {
					$prd = "P".$k;
					
					$abs = $ar[$prd][$j]['Absents'];
					$pres = $ar[$prd][$j]['Presents'];
					$p_nod = $ar[$prd]['nod'];
					@$tmp = ($pres/$p_nod)*100;
					$pr = round($tmp,1);
					$cl = ($pr>50)?"success":'error';
					$htcol = ($pr>50)?"green":"darkred";
					$pr_tot += $pr;
					
					$tr .=  '<td style="text-align:center;"  > '.$p_nod.' </td><td style="text-align:center;" class="text-success" > '.$pres.' </td> <td  style="text-align:center;" class="text-error"> '.$abs.' </td><td  style="text-align:center;" class="text-'.$cl.'"  > '.$pr.'</td>';
					$html_tr.="<td> ".$p_nod." </td><td><font color=\"green\">".$pres."</font></td><td> <font color=\"darkred\">".$abs."</font></td><td> <font color=\"$htcol\">".$pr."</font></td>";
					//$spread_tr.="$p_nod \t $pres \t $abs \t $pr \t";
					}
				$tmp1 = round(($pr_tot/4),1);
				$cl1 = ($tmp1>50)?"success":'error';
				$htcol = ($tmp1>50)?"green":"darkred";
				$tr .= '<td style="text-align:center;" class="text-'.$cl1.'" >'.$tmp1.'</td></tr>';
				$html_tr.="<td><font color=\"$htcol\">".$tmp1."</font></td></tr>";
				//$spread_tr.="$tmp1\n";
			}
			echo <<< a
			 
			 <table class="table  table-hover table-bordered "  style="padding:0px;">
						<thead>
							<tr> 
								<th style="text-align:center;" rowspan=2 valign="top"> RNo  </th> 
								<th style="text-align:center;" rowspan=2 valign="top"> Id  </th> 
								<th  style="text-align:center;" colspan=4> P1 </th> <th  style="text-align:center;" colspan=4> P2 </th>
								<th  style="text-align:center;" colspan=4 > P3 </th>  <th  style="text-align:center;" colspan=4 > P4 </th> 
								<th  style="text-align:center;" rowspan=2 > Total </th>
								
							</tr>
							<tr> 
								<th  style="text-align:center;"  > D </th>
								<th  style="text-align:center;"  > P </th> <th  style="text-align:center;" > A </th>
								<th  style="text-align:center;"  > Pr </th>
								<th  style="text-align:center;"  > D </th>  
								<th  style="text-align:center;"  > P </th> <th  style="text-align:center;" > A </th>
								<th  style="text-align:center;"  > Pr </th> 
								<th  style="text-align:center;"  > D </th> 
								<th  style="text-align:center;"  > P </th> <th  style="text-align:center;" > A </th>
								<th  style="text-align:center;"  > Pr </th>
								<th  style="text-align:center;"  > D </th>  
								<th  style="text-align:center;"  > P </th> <th  style="text-align:center;" > A </th>
								<th  style="text-align:center;"  > Pr </th>  																
							</tr>
							
						</thead>
						<tbody>							
a;
			$html .= "<thead>
							<tr>
								<th rowspan=2> RNo  </th> 
								<th rowspan=2 > Id  </th> 
								<th colspan=4> P1 </th> <th colspan=4> P2 </th>
								<th colspan=4 > P3 </th>  <th colspan=4 > P4 </th> 
								<th rowspan=2 > Total </th>
								
							</tr>
							<tr> 
								<th> D </th>
								<th> P </th> <th> A </th>
								<th> Pr </th>
								<th> D </th>  
								<th> P </th> <th> A </th>
								<th> Pr </th> 
								<th> D </th> 
								<th> P </th> <th> A </th>
								<th> Pr </th>
								<th> D </th>  
								<th> P </th> <th> A </th>
								<th> Pr </th>  																
							</tr>
							
						</thead>";
			//$spread.="\t \t P1 \t \t \t \t P2 \t \t \t \t P3 \t \t \t \t P4 \t \t \t \t\nRno\tID\tD\tP\tA\tPer\tD\tP\tA\tPer\tD\tP\tA\tPer\tD\tP\tA\tPer\tTotal\n";
			//$spread.=//$spread_tr;
			echo $tr;
			$html.=$html_tr;
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
			<th><center>D</center></th><td>&emsp;No. of Day</td>
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
			<th><center>D</center></th><td>&emsp;No. of Day</td>
			<th><center>Pr</center></th><td>&emsp;Performance in %</td>
		</tr>
		
</table>
a;
			if($row['Position']=="BA"){
			echo <<< a
			<form action='print.php' method='post' name='abc'>
			<input type='hidden' name='Title1' value="$branch $class - Daily Report">
			<input type='hidden' name='Table1' value='$html'>
		<center><button type="submit" class="btn btn-primary"><i class='icon-download-alt'></i>&nbsp;&nbsp;Save as PDF</button></center>
			</form>
a;
			echo <<< b
			<form action='excel.php' method='post' name='abc'>
			<input type='hidden' name='Title1' value="$branch $class - Daily Report">
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

	

generate_attendance('Attendance Portal - Period Report');
?>

