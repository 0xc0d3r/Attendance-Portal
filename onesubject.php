<?php
session_start();
require "functions.php";

function generate_attendance($title) {
    if(!check("BA") ) header('location:./login.php');
    else {
		
		include 'config/db.php';
		include 'config/settings.php';
		include 'config/globals.php';
		
		$p = $_SERVER['QUERY_STRING'];
		if(in_array($p,$allowed_subjects)) {
		
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
		\n\t\t<div class="row">
			<div class='span12'>
				<div class="well well-large" style="background:#FFF;">
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
		
		
		$sub = $p;
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
			
		
		$ar1[$branch.$class] = $ar;
	}
		
		//print_r($ar1);
		
		
		echo <<< a
		
			<div id="step1" class="span6">     
				<h5 class='text-info'>All Classes Attendance  Details for $p</h5>
				<h6> &emsp;&emsp;&emsp; - &emsp; Lising Data submitted from CRs @ $branch </h6><br>
			</div>
			<div id="side1" class="span5" >
				<h6 class='text-right'><a href='./?sub'><i class='icon-home'></i> Home&nbsp;</a> </h6>
a;
		echo <<< a
					<h6 class='text-right'>
a;
				for($cl = 0;$cl<count($allowed_subjects);$cl++)	
					{$sub = $allowed_subjects[$cl];echo "<a href='?$sub'>$sub</a>&emsp;";}
					echo <<< a
					</h6>
a;
		echo <<< a
			</div>
		
a;
		$tr = '';
		$html = '';
		$html.="<thead><tr><th> SNo </th><th> Class </th><th> Days </th><th> Presents </th><th> Pre/Day </th><th> Absents </th><th> Abs/Day</th><th> Performance </th></tr>";
		@$strength = count($users);
		for($j = 1; $j<=$classno;$j++) {
			$cls = $branch.$j;
			
			$tr .= '<tr><td style="text-align:center;"  >'.$j.' </td> <td  style="text-align:center;" >'.$cls.' </td>'; 
			$html.="<tr><td>".$j."</td><td>".$cls."</td>";
			$sub = $p;
			$abs = $ar1[$cls][$sub]['Absents'];
			$pres = $ar1[$cls][$sub]['Presents'];
			$p_nod = $abs  + $pres;
			@$tmp = ($pres/$p_nod)*100;
			$pr = round($tmp,1);
			$cl = ($pr>50)?"success":'error';
			$cl1 = ($pr>50)?"green":"darkred";
			@$perday = $pres/$ar1[$cls][$sub]['nod'];
			@$absday = $abs/$ar1[$cls][$sub]['nod'];
			$tr .=  '
					 <td style="text-align:center;">'.round($ar1[$cls][$sub]['nod']).'</td> 
					<td style="text-align:center;" class="text-success" > '.$pres.' </td> 		
					<td style="text-align:center;" class="text-success" > '.round($perday,1).' </td> 
					<td style="text-align:center;" class="text-error" > '.$abs.' </td> 		
					<td style="text-align:center;" class="text-error" > '.round($absday,1).' </td> 
					<td  style="text-align:center;" class="text-'.$cl.'"  > '.$pr.'</td>   																
					';
				
			$tr .= '</tr>';
			$html.="<td>".round($ar1[$cls][$sub]['nod'])."</td><td><font color=\"green\">".$pres."</font></td><td><font color=\"$cl1\">".round($perday,1)."</font></td><td><font color=\"darkred\">".$abs."</td><td>".round($absday,1)."</td><td><font color=\"$cl1\">".$pr."</font></td>";
			$html.="</tr>";
		}
		echo <<< a
		 
		 <table class="table  table-hover table-bordered "  style="padding:0px;">
					<thead>
						<tr> 
							<th style="text-align:center;" rowspan=2 valign="top"> SNo </th> 
							<th style="text-align:center;" rowspan=2 valign="top"> Class </th>
					</tr>
a;
			
			echo <<< a
					
					<tr> 
a;
			echo <<< a
							<th  style="text-align:center;"  > Days </th>
							<th  style="text-align:center;"  > Presents </th>
							<th  style="text-align:center;"  > Pre/Day </th> 
							<th  style="text-align:center;"  > Absents </th>
							<th  style="text-align:center;"  > Abs/Day </th>
							<th  style="text-align:center;"  > Performance </th>
a;
		
			echo <<< a
						</tr>
						
					</thead>
					<tbody>							
a;
	
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
			<input type='hidden' name='Title1' value="$branch _Period_Wise_Report">
			<input type='hidden' name="sheet" value='$html'>
		<center><button type="submit" class="btn btn-primary"><i class='icon-download-alt'></i>&nbsp;&nbsp;Save as Excel Sheet</button></center>
			</form>
b;
		echo "</div> </div> </div> ";
		display_footer();
		echo "\n</body>\n</html>";
		@mysql_close($con);	
		}
		else echo "Subject not Found";
	}
}
generate_attendance('Attendance Portal - Subjects Report');
?>

