<?php
session_start();
require("functions.php");
include("config/FusionCharts.php");

function homepage($title) {
	
    if(!check_login()) header('location:login.php');
    else {
		
	echo "<!DOCTYPE html>\n<html>\n	<SCRIPT LANGUAGE=\"Javascript\" SRC=\"assets/charts/FusionCharts.js\"></SCRIPT>";
	display_headers($title);
	echo "\n<body>";
	menu();
	echo <<< a
	<div class='container'>
		<div id='error'></div>
		<div class='row'>
a;
	echo '<div class="span9"><div class="well well-large" style="background:#FFF;">';
	
	/* Pattern Matching */
	$reg1="/^N[0-9]{6}$/";
	$reg2="/^p|(sub)$/";
	$qs=$_SERVER["QUERY_STRING"];
	$va=explode("/",$qs);
	$qs1=$va[0];$qs2=$va[1];

if(preg_match($reg1,$qs1) and preg_match($reg2,$qs2)){

	/* Fetching Details */
	include 'config/db.php';
	include 'config/settings.php';

	$dbname = $branchyear.'_Users';
	$table = $branchyear.'_Students';
	//if(!mysql_select_db($dbname)) die(mysql_error());

	$userid = $_SERVER["QUERY_STRING"];
	$resultant=explode("/",$userid);
	$id=$resultant[0];    
   
    $mode=$resultant[1];
	$q = "select Name,Gender,Position, Branch, Class ,RNo from $table where Id = '$id'";
	$res = mysql_query($q) or die(mysql_error());
	if(mysql_num_rows($res)==0) echo "<script>document.location.href='404.php';</script>";
	
	$row = mysql_fetch_array($res);
	$username = ucwords(strtolower($row['Name']));
	$gender = $row['Gender'];
	$RNo=$row["RNo"];
	$type = $row['Position'];
	$class = $row['Class'];
	$branch = $row['Branch'];
	$colors=array('F6BD0F','8BBA00','FF8E46','8E468E','588526','008ED6','9D080D','D64646','B3AA00','A186BE','AFD8F8');
	shuffle($colors);
	/* Deatils Fetched */
	
		echo <<< a
		<div id="step1" class="span6">     
		<a ><h5>Student Attendance Report for $id </h5></a>
		<h6> &emsp;&emsp;&emsp; - &emsp; Lising Attendance details submitted from CR @ $branch $class</h6><br>
		</div>
		<table class="table table-hover table-bordered">
		<tbody>
		<tr><th>Name </th> <td>$username</td> <th>Gender </th> <td>$gender</td> </tr>
		<tr><th>RNo </th> <td>$RNo</td>  <th>Class </th> <td>$branch $class </td></tr>
		</tbody>
		</table>
	<div id="step1" class="span4">     
		<h5>Chart Based Representaiton </h5>
	</div>
	<div id="side1" class="span4" >
		<h6 class='text-right'><a href='?$id/sub' ><i class='icon-book'></i>&nbsp; Subjects</a> &emsp; <a href='?$id/p'><i class='icon-qrcode'></i>&nbsp; Periods</a></h6>
	</div>
a;
	
	
	
if(strtolower($mode)=="p"){
		//mysql_select_db($branchyear."_Dates") or die(mysql_error());
	$query=mysql_query("Select Date from ".$branch.$class."_Dates where P1_Con = 'ok' or P2_Con = 'ok' or P3_Con = 'ok' or P4_Con = 'ok' ;") or die(mysql_error());
	$nofd=mysql_num_rows($query);
	if($nofd != 0 ){
	$p=array("P1_A"=>0,"P1_P"=>0,"P2_A"=>0,"P2_P"=>0,"P3_A"=>0,"P3_P"=>0,"P4_A"=>0,"P4_P"=>0);
	$stats=array("Total"=>0,"Presents"=>0,"Absents"=>0);
	$strXML="<graph caption='Period Wise Attendance Report' formatNumberScale='1' rotateValues='1' decimalPrecision='1' numberSuffix='%' xAxisName='Periods' yAxisName='Performance'>";
	$datasetp='';
	while($dates=mysql_fetch_array($query))
	{
		//mysql_select_db($branchyear."_Attendance") or die(mysql_error());
		$q=mysql_query("select `".$dates[0]."` from ".$branch.$class."_Attendance where RNo='".$RNo."';");
		while($res=mysql_fetch_array($q))
		{
			$values=explode(",",$res[0]);
			for($i=0;$i<count($values)-1;$i++)
			{
				if(substr($values[$i],-1)=="P"){
					$stats["Presents"]+=1;$stats["Total"]+=1;}
				if(substr($values[$i],-1)=="A"){
					$stats["Absents"]+=1;$stats["Total"]+=1;}
				$p[$values[$i]]+=1;
			}
		}
	}
	$tr='';
	for($i=1;$i<=4;$i++)
	{
			$st=((round($p["P".$i."_P"]/$nofd,1)*100)<=50)?"error":"success";
			$tr.='<tr>  
				<td style="text-align:center;">'.$i.'</td>
				<td style="text-align:center;"> P'.$i.' </td> 
				<td style="text-align:center;"><b> '.$nofd.'</b> </td> 
				<td style="text-align:center;" class="text-success"><b> '.$p["P".$i."_P"].' </b></td>  
				<td style="text-align:center;" class="text-success"><b> '.round($p["P".$i."_P"]/$nofd,1).' </b></td>  
				<td style="text-align:center;" class="text-error"><b> '.$p["P".$i."_A"].' </b></td> 
				<td style="text-align:center;" class="text-error"><b> '.round($p["P".$i."_A"]/$nofd,1).' </b></td>  
				<td style="text-align:center;" class="text-'.$st.'"><b> '.(round($p["P".$i."_P"]/$nofd,1)*100).' % </b></td>   
			</tr>';
			$datasetp.="<set name='P".$i."' value='".(round($p["P".$i."_P"]/$nofd,1)*100)."' color='".$colors[$i]."'/>";
	}
	$strXML.=$datasetp."</graph>";
	echo renderChart("assets/charts/FCF_Column3D.swf", "", $strXML, "FactorySum", 650, 380);
	echo <<<table_head
		<h5> Period Wise Attendance Representation </h5><br>
		<table class="table  table-hover table-bordered "  style="padding:0px;">
			<thead>
				<tr> 
				<th style="text-align:center;" valign="top"> SNo  </th> 
                                <th style="text-align:center;"   valign="top"> Period </th> 
                                <th  style="text-align:center;"  > Days </th> <th  style="text-align:center;" > Presents </th>
                                <th  style="text-align:center;"  > P/Day </th>  <th  style="text-align:center;"  > Absents </th> 
                                <th  style="text-align:center;" > A/Day </th><th  style="text-align:center;" > Performance </th> 
				</tr>
			</thead>
			<tbody>
table_head;
	echo $tr;
echo <<<tableend
			</tbody>
		</table>
		<br><div class='alert alert-info'><a class='close' data-dismiss='alert'>&times;</a><strong>CNYS </strong>: Classes Not Yet Started </div>
	<br>
tableend;
	} else echo "<br><br><h6 class='text-error text-center'>&emsp;No Submissions Found<br></h6>";
}
	
	/* End of Period Wise Attendance*/
	/* SUbjects Wise Attendance */
	
	if(strtolower($mode)=="sub"){
		//mysql_select_db($branchyear."_Subjects") or die(mysql_error());
		$query=mysql_query("Select * from ".$branch.$class."_Subjects where RNo='$RNo';")  or die(mysql_error());
		$subjectwise=mysql_fetch_array($query) or die(mysql_error());
		$tr='';
		$strXML="<graph caption='Subject Wise Attendance Report' formatNumberScale='1' rotateValues='1' decimalPrecision='1' numberSuffix='%' xAxisName='Subjects' yAxisName='Performance'>";
		$datasetp='';
		$nc_cls = 0;
		for($i=0;$i<count($allowed_subjects);$i++)
		{
				$tnoc=($subjectwise[$allowed_subjects[$i]."_P"])+($subjectwise[$allowed_subjects[$i]."_A"]);
				if($tnoc==0){
					$nc_cls++;
					$performance="N/A  ";
					$st="error";
					$remarks="CNYS";}
				else{
					$performance=(($subjectwise[$allowed_subjects[$i]."_P"])/$tnoc)*100;
					$performance=round($performance,1)." %";
					$st=($performance<=50)?"error":"success";
					if(round($performance,1)>=95)
						$remarks="Excellent";
					if(round($performance,1)>=90 && round($performance,1)<95)
						$remarks="Very Good";
					if(round($performance,1)>=80 && round($performance,1)<90)
						$remarks="Good";
					if(round($performance,1)>=70 && round($performance,1)<80)
						$remarks="Normal";
					if(round($performance,1)>=60 && round($performance,1)<70)
						$remarks="Average";
					if(round($performance,1)>=50 && round($performance,1)<60)
						$remarks="Bad";
					if(round($performance,1)<50)
						$remarks="Go Out";
				}
				$tr.='<tr> 
					<td style="text-align:center;">'.($i+1).'</td> 
					<td style="text-align:center;"> <b>'.$allowed_subjects[$i].'</b> </td> 
					<td style="text-align:center;"> <b>'.$tnoc.'</b> </td> 
					<td style="text-align:center;" class="text-success"><b> '.$subjectwise[$allowed_subjects[$i]."_P"].'</b> </td> 
					<td style="text-align:center;" class="text-error"><b> '.$subjectwise[$allowed_subjects[$i]."_A"].' </b></td>
					<td style="text-align:center;" class="text-'.$st.'"><b>'.$performance.'</b></td>
					<td style="text-align:center;" class="text-'.$st.'"><b>'.$remarks.'</b></td>
				</tr>';
				$datasetp.="<set name='".$allowed_subjects[$i]."' value='".round($performance,1)."' color='".$colors[$i]."'/>";
		}
		$strXML.=$datasetp."</graph>";
		if($nc_cls != count($allowed_subjects)) {
		echo renderChart("assets/charts/FCF_Column3D.swf", "", $strXML, "FactorySum", 650, 380);
		echo <<<table_head
		<h5> Subject Wise Attendance Representation </h5><br>
		<table class="table  table-hover table-bordered "  style="padding:0px;">
			<thead>
				<tr> 
				<th style="text-align:center;"  rowspan="2" valign="top"> SNo  </th> 
                                <th style="text-align:center;"   valign="top"> Subject  </th> 
                                <th  style="text-align:center;"  > Classes </th> <th  style="text-align:center;" > Presents </th>
                                <th  style="text-align:center;"  > Absents </th>  <th  style="text-align:center;"  > Performance </th> 
                                <th  style="text-align:center;" > Remarks </th> 
				</tr>
			</thead>
			<tbody>
table_head;
		echo $tr;
		echo <<<tableend
			</tbody>
		</table>
		<br><div class='alert alert-info'><a class='close' data-dismiss='alert'>&times;</a><strong>CNYS </strong>: Classes Not Yet Started </div>
	<br>
tableend;
	}
	else echo "<br><br><h6 class='text-error text-center'>&emsp;No Submissions Found<br></h6>";
}
	
	/* Subject WIse */
	
}
	else echo "<script type='text/javascript'>show_error('Error: Invalid Syntax given..');</script>";
	
	echo <<< b
	</div>
	</div>
	<div class='span3'>
b;
	go_home();
	sidepanel();
	echo "</div></div></div>";   
	display_footer();
	echo "\n</body>\n</html>";
	}
}

homepage("Attendance Portal - Home");
?>
