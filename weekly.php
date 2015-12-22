<?php
session_start();
require("functions.php");
/* Fetching Details */

function homepage($title) {
    if(!check_login()) {
        header('location:login.php');
    }
else {
include 'config/db.php';
include 'config/settings.php';
$dbname = $branchyear.'_Users';
$table = $branchyear.'_Students';
//if(!mysql_select_db($dbname)) {die(mysql_error());}
$userid = $_SESSION['UserId'];
$q = "select Position, Branch, Class ,RNo from $table where Id = '$userid'";
$res = mysql_query($q) or die(mysql_error());
$row = mysql_fetch_array($res);
$RNo=$row["RNo"];
$type = $row['Position'];
$p = $_SERVER["QUERY_STRING"] ;
if($row['Position'] == "BA") {
	$branch = $globalbranch;
	$class = substr($p,-1);	}
else {
	
	$branch = $row['Branch'];
	$class = $row['Class'];
	$class1 = substr($p,-1);
	if($class1 != $class) {echo "<script type='text/javascript'>show_error('Error: Not authorised to access $branch$class1 details.');</script>";}
}
echo "<!DOCTYPE html>\n<html>\n";
display_headers($title);
echo "\n<body>";
menu();
$ndays = 5;
/* Deatils Fetched */
/* Starting Weekly Period Wise Attendance */
if($_SERVER["QUERY_STRING"]==$branch.$class)
{
	echo <<< a
	<div class='container'>	
	<div id='error' style='display:none'></div>					
a;

	$tr = '';
	$tr1 = '';
	$html = "";
	//$table='';
	$spread='';
	//mysql_select_db($branchyear."_Dates") or die(mysql_error());
	$nodq=mysql_fetch_array(mysql_query("Select count(Date) from ".$branch.$class."_Dates;")) or die(mysql_error());
	$nod=$nodq[0];
	///////////////////// ********* Change value to 6 ************ ///////////////////
	//echo $nod;
	if($nod<$ndays)
	{
		echo "<script type='text/javascript'>show_error('Weekly aren\'t prepared yet now ..');</script>";
	}
	else
	{
		$p=array();
		$stats=array("Total"=>0,"Presents"=>0,"Absents"=>0);
		//echo $nod/2;
		for($i=1;$i<=($nod/$ndays);$i++)
		{
			//mysql_select_db($branchyear."_Dates") or die(mysql_error());
			$p["Week".$i]=array("P1_P"=>0,"P1_A"=>0,"P2_P"=>0,"P2_A"=>0,"P3_P"=>0,"P3_A"=>0,"P4_P"=>0,"P4_A"=>0);
			$que=mysql_query("select Date from ".$branch.$class."_Dates LIMIT ".(($i-1)*$ndays).",$ndays;") or die(mysql_error());
			//echo 'select Date from '.$branch.$class.'_Dates LIMIT '.(($i-1)*2).',2;';
			$p["Weeks".$i]=array();
			$p["Weeks".$i]['Start'] = "";
			while($dates=mysql_fetch_array($que))
			{
				//echo $dates[0];
				if($p["Weeks".$i]['Start'] == "" ) $p["Weeks".$i]['Start'] = $dates[0];   
				$p["Weeks".$i]['End'] = $dates[0];
				//mysql_select_db($branchyear."_Attendance") or die(mysql_error());
				$count_q=mysql_query("select count(`RNo`) from ".$branch.$class."_Attendance;");
				$countclass=mysql_fetch_array($count_q);
				$classcount=$countclass[0];
				for($init=1;$init<=$classcount;$init++)
				{
					//mysql_select_db($branchyear."_Attendance") or die(mysql_error());
					$q=mysql_query("select `".$dates[0]."` from ".$branch.$class."_Attendance where RNo='".$init."';");
					while($res=mysql_fetch_array($q))
					{
						$values=explode(",",$res[0]);
						for($j=0;$j<count($values)-1;$j++)
						{
							if(substr($values[$j],-1)=="P"){
								$stats["Total"]+=1;$stats["Presents"]+=1;}
							if(substr($values[$j],-1)=="A"){
								$stats["Absents"]+=1;$stats["Total"]+=1;}
							$p["Week".$i][$values[$j]]+=1;
						}
					}
				}
				//print_r($p['Week'.$i]);
			}
		}
		for($lo=1;$lo<=count($p)/2;$lo++)
		{
			$tr .= '<tr ><td style="text-align:center;">'. $lo .' </td> 
                                <td style="text-align:center;"> '.$p["Weeks".$lo]['Start'].'  </td> 
                                <td style="text-align:center;"> '.$p["Weeks".$lo]['End'].'  </td> 
				<td style="text-align:center;"> '.$ndays.'  </td>';
			foreach($p["Week".$lo] as $key => $value)
			{
				
				$tr.='<td style="text-align:center;" ><font color=dark'.((substr($key,-1) == 'A')?'red':'green').'>'.$value.'</font> </td> ';
				$tr.='<td style="text-align:center;" ><font color=dark'.((substr($key,-1) == 'A')?'red':'green').'>'.round($value/$ndays,1).'</font></td> ';
			}
			$tr .= '</tr >';
		}
		
		$dd = date('d-m-Y');
		echo <<< a
		<div class="well well-large" style="background:#FFF;">	
		<div class="row">
                    <div id="step1" class="span4">     
                    <a ><h5>Weekly Attendance Report for $branch $class </h5></a>
                    <h6> &emsp;&emsp;&emsp; - &emsp; Lising Data submitted from CR @ $branch $class </h6><br>
                    
                    </div>
                    <div id="side1" class="span7" >
                    	<h6 class='text-right'><a href='./?sub'><i class='icon-home'></i> Home&nbsp;</a> </h6>
a;
			if($row['Position'] == "BA") {
				echo <<< a
					<h6 class='text-right'>
a;
				for($cl = 1;$cl<=$classno;$cl++)	
					{echo "<a href='./?$globalbranch$cl'>$globalbranch$cl</a>&emsp;";}
					echo <<< a
					</h6>
a;
				}
			echo <<< a
					</div>
                </div>
		 <table class="table  table-hover table-bordered "  style="padding:0px;">
                            <thead>
                                <tr> 
                                <th style="text-align:center;"  rowspan="2" valign="top"> SNo  </th> 
                                <th style="text-align:center;"  colspan="2" valign="top"> Date  </th>
				<th style="text-align:center;"  rowspan="2" valign="top"> WD  </th>  
                                <th  style="text-align:center;"  colspan="4"> P1 </th> <th  style="text-align:center;" colspan="4"> P2 </th>
                                <th  style="text-align:center;"  colspan="4"> P3 </th>  <th  style="text-align:center;"  colspan="4"> P4 </th>
                                </tr>
                                <tr> 
                                <th  style="text-align:center;" > Start </th> <th  style="text-align:center;"> End </th>
                                <th  style="text-align:center;" > P </th> <th  style="text-align:center;"> P/D </th> 
                                <th  style="text-align:center;" > A </th> <th  style="text-align:center;"> A/D </th> 		
				<th  style="text-align:center;" > P </th> <th  style="text-align:center;"> P/D </th> 
                                <th  style="text-align:center;" > A </th> <th  style="text-align:center;"> A/D </th>
                                <th  style="text-align:center;" > P </th> <th  style="text-align:center;"> P/D </th> 
                                <th  style="text-align:center;" > A </th> <th  style="text-align:center;"> A/D </th> 		
				<th  style="text-align:center;" > P </th> <th  style="text-align:center;"> P/D </th> 
                                <th  style="text-align:center;" > A </th> <th  style="text-align:center;"> A/D </th>
                                </tr>
                            </thead>
                            <tbody>
a;
	$html .= '<thead>
				<tr> 
					<th style="text-align:center;"  rowspan="2" valign="bottom"> SNo  </th> 
					<th style="text-align:center;"  colspan="2" valign="bottom"> Date  </th>
					<th style="text-align:center;"  rowspan="2" valign="bottom"> WD  </th>  
					<th  style="text-align:center;"  colspan="4"> P1 </th> <th  style="text-align:center;" colspan="4"> P2 </th>
					<th  style="text-align:center;"  colspan="4"> P3 </th>  <th  style="text-align:center;"  colspan="4"> P4 </th>
				</tr>
				<tr> 
					<th  style="text-align:center;" > Start </th> <th  style="text-align:center;"> End </th>
					<th  style="text-align:center;" > P </th> <th  style="text-align:center;"> P/D </th> 
					<th  style="text-align:center;" > A </th> <th  style="text-align:center;"> A/D </th> 		
					<th  style="text-align:center;" > P </th> <th  style="text-align:center;"> P/D </th> 
					<th  style="text-align:center;" > A </th> <th  style="text-align:center;"> A/D </th>
					<th  style="text-align:center;" > P </th> <th  style="text-align:center;"> P/D </th> 
					<th  style="text-align:center;" > A </th> <th  style="text-align:center;"> A/D </th> 		
					<th  style="text-align:center;" > P </th> <th  style="text-align:center;"> P/D </th> 
					<th  style="text-align:center;" > A </th> <th  style="text-align:center;"> A/D </th>
				</tr>
			</thead>
			<tbody>';
	$html .= $tr . "</tbody></table>";
	$html .= "
	<br>
	<table style=\"border-collapse:collapse;width:100%;margin-left:0%;font-size:12px;text-align:center;\" border=1 >
		<tr>
			<th>Short Name</th><th> Long Name</th>
			<th>Short Name</th><th> Long Name</th>
		</tr>
		<tr>
			<th>P</th><td>No. of Presents</td>	
			<th>A</th><td>No. of Absents</td>
		</tr>
		<tr>	
			<th>P/D</th><td>No. of Presents per Day</td>
			<th>A/D</th><td>No. of Absents per Day</td>
		</tr>
		<tr>
			<th>WD</th><td>No. of days in a Week</td>
		</tr>";
	echo $tr;
	echo <<< tableend
	</tbody>
</table>
<table class='table  table-hover table-bordered ' >
		<tr>
			<th>Short Name</th><th> Long Name</th>
			<th>Short Name</th><th> Long Name</th>
		</tr>
		<tr>
			<th>P</th><td>No. of Presents</td>	
			<th>A</th><td>No. of Absents</td>
		</tr>
		<tr>	
			<th>P/D</th><td>No. of Presents per Day</td>
			<th>A/D</th><td>No. of Absents per Day</td>
		</tr>
		<tr>
			<th>WD</th><td>No. of days in a Week</td>
		</tr>
</table>
tableend;
	if($row['Position']=="BA"){
			echo <<< a
			<form action='print.php' method='post' name='abc'>
			<input type='hidden' name='Title1' value="$branch $class - Weekly Report">
			<input type='hidden' name='Table1' value='$html'>
		<center><button type="submit" class="btn btn-primary"><i class='icon-download-alt'></i>&nbsp;&nbsp;Save as PDF</button></center>
			</form>
a;
			echo <<< b
			<form action='excel.php' method='post' name='abc'>
			<input type='hidden' name='Title1' value="$branch $class - Weekly Report">
			<input type='hidden' name="sheet" value='$html'>
		<center><button type="submit" class="btn btn-primary"><i class='icon-download-alt'></i>&nbsp;&nbsp;Save as Excel Sheet</button></center>
			</form>
b;
}
	echo <<< tableend
</div>
</div>               
tableend;

	}
}
/* End of Weekly Period Wise Attendance*/
 echo '</div></body></html>';

	}
}
homepage("Attendance Portal - Weekly Report");
?>
