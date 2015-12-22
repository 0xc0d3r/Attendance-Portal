<?php
session_start();
require "functions.php";

function generate_attendance($title) {
    if(!check("BA") ) header('location:./login.php');
    else {
		
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
		
		
		$branch = $globalbranch;
		
		
			
		echo <<< a
		<div id="error" style="display:none;margin-top:10px;"></div>
		\n\t\t
a;
		$ar1 = array();
		
		for($cln=1;$cln<=$classno;$cln++) {
		
		$class = $cln;
		
		$ar = array();
		
		$dbname = $branchyear.'_Subjects';
		$table = $branch.$class.'_Subjects';
		//if(!mysql_select_db($dbname)) die(mysql_error());
		$q = mysql_query("select RNo,Id from $table") or die(mysql_error());
		$strength = mysql_num_rows($q);
		
		for($j=0;$j<count($allowed_subjects);$j++) {
			$sub = $allowed_subjects[$j];
			$dbname = $branchyear.'_Subjects';
			$table = $branch.$class.'_Subjects';
			//if(!mysql_select_db($dbname)) die(mysql_error());
			$qa = mysql_query("select RNo, `".$sub."_A` from $table") or die(mysql_error()) ;
			$qp = mysql_query("select RNo, `".$sub."_P` from $table") or die(mysql_error()) ;
			while($res = mysql_fetch_array($qa)) {
				@$ar[$sub]["Absents"]+=$res[$sub."_A"];				
				}
			while($res = mysql_fetch_array($qp)) {
				@$ar[$sub]["Presents"]+=$res[$sub."_P"];				
				}
			$ar[$sub]['nod'] = ($ar[$sub]["Absents"] + $ar[$sub]["Presents"])/$strength;	
			}
		$ar1[$branch.$class] = $ar;
	}
		
		//print_r($ar1);
		
		
		echo <<< a
		<div class="well well-large" style="background:#FFF;">
			<div id="step1" class="span6">     
				<h5 class='text-info'>All Classes & All Subjects Attendance  Details </h5>
				<h6> &emsp;&emsp;&emsp; - &emsp; Lising Data submitted from CRs @ $branch </h6><br>
			</div>
			<div id="side1" class="span5" >
				<h6 class='text-right'><a href='./?sub'><i class='icon-home'></i> Home&nbsp;</a> </h6>
a;

		echo <<< a
			</div>
		
a;
		$tr = '';
		$html_tr="";
		$html="";
		//$strength = count($users);
		for($j = 1; $j<=$classno;$j++) {
			$cls = $branch.$j;
			
			$tr .= '<tr><td style="text-align:center;"  >'.$j.' </td> <td  style="text-align:center;" >'.$cls.' </td>';
			$html_tr.="<tr><td>".$j."</td><td>".$cls."</td>";
			for($k = 0 ; $k< count($allowed_subjects) ;$k++) {
				$sub = $allowed_subjects[$k];
				$abs = $ar1[$cls][$sub]['Absents'];
				$pres = $ar1[$cls][$sub]['Presents'];
				$p_nod = $abs  + $pres;
				@$tmp = ($pres/$p_nod)*100;
				$pr = round($tmp,1);
				$cl = ($pr>50)?"success":'error';
				$htcol=($pr>50)?"green":"darkred";
				@$perday = $pres/$ar1[$cls][$sub]['nod'];
				$tr .=  '
						 <td style="text-align:center;">'.round($ar1[$cls][$sub]['nod']).'</td> 
						<td style="text-align:center;" class="text-success" > '.$pres.' </td> 		
						<td style="text-align:center;" class="text-error" > '.round($perday,1).' </td> 
						<td  style="text-align:center;" class="text-'.$cl.'"  > '.$pr.'</td>   																
						';
				$html_tr.="<td>".round($ar1[$cls][$sub]['nod'])."</td><td><font color=\"green\">".$pres."</font></td><td><font color=\"darkred\">".round($perday,1)."</font></td><td><font color=".$htcol.">".$pr."</font></td>";
				}
			$tr .= '</tr>';
			$html_tr.="</tr>";
		}
		echo <<< a
		 
		 <table class="table  table-hover table-bordered "  style="padding:0px;">
					<thead>
						<tr> 
							<th style="text-align:center;" rowspan=2 valign="top"> SNo </th> 
							<th style="text-align:center;" rowspan=2 valign="top"> Class </th>
a;
			$html.="<thead><tr><th rowspan=2>SNo</th><th rowspan=2>Class</th>";
			for($i=0;$i<count($allowed_subjects);$i++) {
			$sub = $allowed_subjects[$i];
			echo '<th  style="text-align:center;" colspan=4>'.$sub.'</th>';
			$html.="<th colspan=4>".$sub."</th>";
			} 
			echo <<< a
					</tr>
					<tr> 
a;
			$html.="</tr><tr>";
			for($i=0;$i<count($allowed_subjects);$i++) {
			echo <<< a
							<th  style="text-align:center;"> D </th>
							<th  style="text-align:center;"> P </th>
							<th  style="text-align:center;"> PD </th> 
							<th  style="text-align:center;"> Pr </th>
a;
			$html.="<th>D</th><th>P</th><th>PD</th><th>Pr</th>";
		}
			echo <<< a
						</tr>
						
					</thead>
					<tbody>							
a;
		$html.="</tr></thead>";$html.=$html_tr;
		echo $tr;
		$html .="</tbody></table><br><table style=\"border-collapse:collapse;width:100%;margin-left:0%;font-size:12px;\" border=1 >";
		$html .= "<tr>
			<th	><center>Short Name</center></th><th> <center>Long Name</center></th>
			<th	><center>Short Name</center></th><th> <center>Long Name</center></th>
		</tr>
		<tr>
			<th><center>P</center></th><td>&emsp;No. of Presents</td>	
			<th><center>PD</center></th><td>&emsp;No. of Presents for Day</td>
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
			<th><center>PD</center></th><td>&emsp;No. of Presents for Day</td>
		</tr>
		<tr>	
			<th><center>D</center></th><td>&emsp;No. of Day</td>
			<th><center>Pr</center></th><td>&emsp;Performance in %</td>
		</tr>
		
</table>
a;
			echo <<< a
			<form action='print.php' method='post' name='abc'>
			<input type='hidden' name='Title1' value="$branch Subject Wise Report">
			<input type='hidden' name='Table1' value='$html'>
		<center><button type="submit" class="btn btn-primary"><i class='icon-download-alt'></i>&nbsp;&nbsp;Save as PDF</button></center>
			</form>
a;
			echo <<< b
			<form action='excel.php' method='post' name='abc'>
			<input type='hidden' name='Title1' value="{$branch}_Subject_Wise_Report">
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
generate_attendance('Attendance Portal - Subjects Report');
?>

