<?php
session_start();
require "functions.php";

function generate_attendance($title) {
    if(!check('BA') ) header('location:./?sub');
    else {
		
		include 'config/db.php';
		include 'config/settings.php';
		include 'config/globals.php';
		
		echo "<!DOCTYPE html>\n<html>\n";
		display_headers($title);
		echo "\n<body>";
		menu();
		$branch = $globalbranch;
		echo <<< a
		\n\t<div class="container" style="margin-top:-10px;"><br>
		<div class="well well-large" style="background:#FFF;">
		<div id='error'></div>
a;
		/*echo <<< a
		\n\t\t<div class="row">
			<div class='span12'>
				<div class="well well-large" style="background:#FFF;">
a;*/
	
		echo <<< a
		
			<div id="step1" class="span5">     
				<h5 class='text-info'>Daily  Attendance Submission Details </h5>
				<h6> &emsp;&emsp;&emsp; - &emsp; Lising Data submitted from All CRs @ $branch  </h6><br>
			</div>
			<div id="side1" class="span6" >
				<h6 class='text-right'><a href='./?sub'><i class='icon-home'></i> Home&nbsp;</a> </h6>
			</div>
		
a;
		
		$userid = $_SESSION['UserId'];
		$ar1=array();
		$datez = array();$dtcon=0;
		$html="";
		for($cln=1;$cln<=$classno;$cln++){
		
		
		$class = $cln;
		$branch = $globalbranch;
		
		
		$dbname = $branchyear.'_Attendance';
		$table = $branch.$class.'_Attendance';
		//if(!mysql_select_db($dbname)) die(mysql_error());
		$class_total = mysql_num_rows(mysql_query("select `Id` from $table"));
		$sample = mt_rand(1,$class_total);
		
		//$da = date('d-m-Y');
		//$date = date('d-m-Y');
		
		$ar = array();
		
		for($j=1;$j<=4;$j++) {
			$prd = "P".$j;
			$prd1 = $prd."_Con"; 
			
			$dates = array(); $coun = 0;
			
			//mysql_select_db($branchyear."_Dates") or die(mysql_error());
			$q=mysql_query("Select Date from ".$branch.$class."_Dates where `$prd1` ='ok' ;") or die(mysql_error());
			
		
			$nodq = mysql_num_rows($q);
			$ar[$prd]['nod'] = $nodq;
			
			while($dad = mysql_fetch_array($q)) { 
				$dates[$coun++] = $dad[0]; 
				if(!in_array($dad[0],$datez)) {$datez[$dtcon++] = $dad[0];}
				}
			//var_dump($da);
			
			
			
			foreach($dates as $key => $da){
				
				$ar[$prd][$da]["Presents"] = 0;
				$ar[$prd][$da]["Absents"] = 0;
				
				$dbname = $branchyear.'_Attendance';
				$table = $branch.$class.'_Attendance';
				//if(!mysql_select_db($dbname)) die(mysql_error());
				$q = mysql_query("select RNo, `$da` from $table") or die(mysql_error()) ;
				while($res = mysql_fetch_array($q)) {
					$exp = explode(",",$res[$da]);
					
					for($z=0;$z<count($exp);$z++) {
						if(substr($exp[$z],0,2) == $prd) {
							if(substr($exp[$z],-1) == "A") $ar[$prd][$da]["Absents"]+=1;	
							else $ar[$prd][$da]["Presents"]+=1;				
							}	
						}
					}
				//echo $da."\n";
				}	
				
			}
		
		$ar1[$branch.$class]=$ar;
		
		
	}
	//print_r($datez);
	//print_r($ar1);
	
		$tr = '';
		$html_tr="";
		for($j = 0; $j<count($datez);$j++) {
			$date = $datez[$j];
			$pr_tot = 0 ;
			$tr .= '<tr><td style="text-align:center;"  >'.($j+1).' </td> <td  style="text-align:center;" >'.$datez[$j].' </td> '; 
			$html_tr.="<tr><td>".($j+1)."</td><td>".$datez[$j]."</td>";
			for($l=1;$l<=$classno;$l++){
				$cls = $globalbranch.$l;
				
				for($k = 1 ; $k<= 4;$k++) {
					$prd = "P".$k;
					@$pres = $ar1[$cls][$prd][$date]['Presents'];
					$tr .=  '<td style="text-align:center;" class="text-success" > '.$pres.' </td>';
					$html_tr.="<td><font color=\"green\">".$pres."</font></td>";
					}
			}
			
		}
		echo <<< a
		 
		 <table class="table  table-hover table-bordered "  style="padding:0px;">
					<thead>
						<tr> 
							<th style="text-align:center;" rowspan=2 valign="top"> SNo </th> 
							<th style="text-align:center;" rowspan=2 valign="top"> Date  </th> 
a;
		$html.="<thead><tr><th rowspan=2>SNo</th><th rowspan=2>Date</th>";
		for($i=1;$i<=$classno;$i++) {
				echo <<< a
							<th  style="text-align:center;" colspan=4> $branch$i </th>
a;
				$html.="<th colspan=4>".$branch.$i."</th>";
						}					
				echo <<< a
							
						</tr>
						<tr>
a;
				$html.="</tr><tr>";
		for($i=0;$i<$classno;$i++) {
				echo <<< a
							<th  style="text-align:center;"  > P1 </th> <th  style="text-align:center;" > P2 </th>
							<th  style="text-align:center;"  > P3 </th> <th  style="text-align:center;" > P4 </th>
a;
				$html.="<th>P1</th><th>P2</th><th>P3</th><th>P4</th>";
						}
							
		echo <<< a
						</tr>
						
					</thead>
					<tbody>							
a;
		$html.="</tr></thead>";$html.=$html_tr;
		echo $tr;
		echo "</tbody></table>";
		echo <<< a
			<form action='print.php' method='post' name='abc'>
			<input type='hidden' name='Title1' value="$branch Period Wise Report">
			<input type='hidden' name='Table1' value='$html'>
		<center><button type="submit" class="btn btn-primary"><i class='icon-download-alt'></i>&nbsp;&nbsp;Save as PDF</button></center>
			</form>
a;
		echo <<< b
			<form action='excel.php' method='post' name='abc'>
			<input type='hidden' name='Title1' value="$branch Period Wise Report">
			<input type='hidden' name="sheet" value='$html'>
		<center><button type="submit" class="btn btn-primary"><i class='icon-download-alt'></i>&nbsp;&nbsp;Save as Excel Sheet</button></center>
			</form>
b;
		//echo "</div> </div> </div> ";
		echo "</div>"; 
		display_footer();
		echo "\n</body>\n</html>";
		@mysql_close($con);	
	}
}

	

generate_attendance('Attendance Portal - Period Report');
?>

