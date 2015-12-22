<?php
session_start();
require("functions.php");
include("config/FusionCharts.php");

function homepage($title) {
    if(!check_login()) {
        header('location:login.php');
    }
    else {
	echo "<!DOCTYPE html>\n<html>\n	<SCRIPT LANGUAGE=\"Javascript\" SRC=\"assets/charts/FusionCharts.js\"></SCRIPT>";
        display_headers($title);
        echo "\n<body>";
        menu();
			 	echo <<< a
				<div class='container'>
					<div id='error'></div>
					<div class='row'>
					<div class='span9'>
						<div class="well well-large" style="background:#FFF">
						
a;


				splash();
	echo <<< a
	<div id="step1" class="span4">     
		
	</div>
	<div id="side1" class="span4" >
		<h6 class='text-right'><a href='?sub'><i class='icon-book'></i>&nbsp; Subjects</a> &emsp; <a href='?p'><i class='icon-qrcode'></i>&nbsp; Periods</a></h6>
	</div>
a;
/* Fetching Details */
include 'config/db.php';
include 'config/settings.php';
$dbname = $branchyear.'_Users';
$table = $branchyear.'_Students';
//if(!mysql_select_db($dbname)) die(mysql_error());
$userid = $_SESSION['UserId'];
$q = "select Position, Branch, Class ,RNo from $table where Id = '$userid'";
$res = mysql_query($q) or die(mysql_error());
$row = mysql_fetch_array($res);
$RNo=$row["RNo"];
$type = $row['Position'];
if($row['Position'] == "BA") {
	$branch = $globalbranch;
	$p1 = substr($_SERVER["QUERY_STRING"],0,$branchlen);
	if($p1 == $globalbranch){
		$p = explode("/",$_SERVER["QUERY_STRING"]);
		$class = substr($p[0],-1);}
	else {
		$class = 1;
		}	
	}
else {
	$branch = $row['Branch'];
	$class = $row['Class'];
	
}
$colors=array('F6BD0F','8BBA00','FF8E46','8E468E','588526','008ED6','9D080D','D64646','B3AA00','A186BE','AFD8F8');
shuffle($colors);
$colorz=array('F6BD0F,8BBA00','FF8E46,8E468E','8E468E,588526','008ED6,9D080D');
$reqcolorz=explode(",",$colorz[rand(0,3)]);
/* Deatils Fetched */
/* Start Checking wheter he is a student or any other */
if($type=="S")
{
	/* Starting Period Wise Attendance */
	if(strtolower($_SERVER["QUERY_STRING"])=="p")
	{
	//mysql_select_db($branchyear."_Dates") or die(mysql_error());
	$query=mysql_query("Select Date from ".$branch.$class."_Dates where P1_Con = 'ok' or P2_Con = 'ok' or P3_Con = 'ok' or P4_Con = 'ok';") or die(mysql_error());
	$nofd=mysql_num_rows($query);
	if($nofd != 0){
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
			@$st=((round($p["P".$i."_P"]/$nofd,1)*100)<=50)?"error":"success";
			@$tr.='<tr>  
				<td style="text-align:center;">'.$i.'</td>
				<td style="text-align:center;"> P'.$i.' </td> 
				<td style="text-align:center;"><b> '.$nofd.'</b> </td> 
				<td style="text-align:center;" class="text-success"><b> '.$p["P".$i."_P"].' </b></td>  
				<td style="text-align:center;" class="text-success"><b> '.round($p["P".$i."_P"]/$nofd,1).' </b></td>  
				<td style="text-align:center;" class="text-error"><b> '.$p["P".$i."_A"].' </b></td> 
				<td style="text-align:center;" class="text-error"><b> '.round($p["P".$i."_A"]/$nofd,1).' </b></td>  
				<td style="text-align:center;" class="text-'.$st.'"><b> <small>'.(round($p["P".$i."_P"]/$nofd,1)*100).' % </small></b></td>   
			</tr>';
			@$datasetp.="<set name='P".$i."' value='".(round($p["P".$i."_P"]/$nofd,1)*100)."' color='".$colors[$i]."'/>";
	}
	$strXML.=$datasetp."</graph>";
	echo '<br><h5 class="text-info">Chart Based Attendance Representaiton for Student - '.$userid.'</h5><br>';
	echo renderChart("assets/charts/FCF_Column3D.swf", "", $strXML, "FactorySum", 650, 380);
	echo <<<table_head
		<h5 class="text-info"> Period Wise Attendance Representation for Student - $userid</h5><br>
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
		<table class='table  table-hover table-bordered ' >
		<tr>
			<th	><center>Short Name</center></th><th> <center>Long Name</center></th>
			<th	><center>Short Name</center></th><th> <center>Long Name</center></th>
		</tr>
		<tr>
			<th><center>P/Day</center></th><td>&emsp;No. of Presents for Day</td>	
			<th><center>A/Day</center></th><td>&emsp;No. of Absents for Day</td>
		</tr>
		
		
</table>
		<br><div class='alert alert-info'><a class='close' data-dismiss='alert'>&times;</a><strong>CNYS </strong>: Classes Not Yet Started </div>
	<br>
		
tableend;
	}
	else echo "<br><br><h6 class='text-error text-center'>&emsp;No Submissions Found<br></h6>";
}/* End of Period Wise Attendance*/
	/* SUbjects Wise Attendance */
	if(strtolower($_SERVER["QUERY_STRING"])=="sub")
	{

		//mysql_select_db($branchyear."_Subjects") or die(mysql_error());
		$query=mysql_query("Select * from ".$branch.$class."_Subjects where RNo='$RNo';")  or die(mysql_error());
		$subjectwise=mysql_fetch_array($query) or die(mysql_error());
		$tr='';
		$strXML="<graph caption='Subject Wise Attendance Report' formatNumberScale='1' rotateValues='1' decimalPrecision='1' numberSuffix='%' xAxisName='Subjects' yAxisName='Performance'>";
		$datasetp='';
		$nc_cls = 0;
		$poor = array();
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
						{$remarks="Bad";$poor[$allowed_subjects[$i]]=$performance;}
					if(round($performance,1)<50)
						{$remarks="Go Out";$poor[$allowed_subjects[$i]]=$performance;}
				}
				$tr.='<tr> 
					<td style="text-align:center;">'.($i+1).'</td> 
					<td style="text-align:center;"> <b><small>'.$allowed_subjects[$i].'</small></b> </td> 
					<td style="text-align:center;"> <b>'.$tnoc.'</b> </td> 
					<td style="text-align:center;" class="text-success"><b> '.$subjectwise[$allowed_subjects[$i]."_P"].'</b> </td> 
					<td style="text-align:center;" class="text-error"><b> '.$subjectwise[$allowed_subjects[$i]."_A"].' </b></td>
					<td style="text-align:center;" class="text-'.$st.'"><b>'.$performance.'</b></td>
					<td style="text-align:center;" class="text-'.$st.'"><b><small>'.$remarks.'</small></b></td>
				</tr>';
				$datasetp.="<set name='".$allowed_subjects[$i]."' value='".round($performance,1)."' color='".$colors[$i]."'/>";
		}
		$strXML.=$datasetp."</graph>";
		if($nc_cls != count($allowed_subjects)) {
		echo '<br><h5 class="text-info">Chart Based Attendance Representaiton for Student - '.$userid.'</h5><br>';
		echo renderChart("assets/charts/FCF_Column3D.swf", "", $strXML, "FactorySum", 650, 380);
		echo <<<table_head
		<h5 class="text-info"> Subject Wise Attendance Representation for Student - $userid</h5><br>
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
		$st2 = "";
		//print_r($poor);
		foreach($poor as $key => $value){$st2 .= $key." ";}
		if(count($poor)!= 0) echo "<script type='text/javascript'>show_error('Your Attendance is Poor in $st2 ');</script>";
		}
		else echo "<br><br><h6 class='text-error text-center'>&emsp;No Submissions Found<br></h6>";
}/* End of SUbjects Wise Attendance*/
/* Checking for Wrong Keyword */
if(strtolower($_SERVER["QUERY_STRING"])!="sub" and strtolower($_SERVER["QUERY_STRING"])!="p")
{
	echo "<script type='text/javascript'>document.location.href='./?sub';</script>";
}
/* End of Checking for Wrong Keyword */	
}
/* End of Checking wheter he is a student or any other */

	/////////////////////*********************///////////////

/* Start Checking wheter he is a CR or any other */
if($type=="CR" or $type=="SA")
{
	$branch2 = $branch.$class;
	/* Starting Period Wise Attendance */
	if(strtolower($_SERVER["QUERY_STRING"])=="p")
	{
	////mysql_select_db($branchyear."_Dates") or die(mysql_error());
	$query=mysql_query("Select Date from ".$branch.$class."_Dates where P1_Con = 'ok' or P2_Con = 'ok' or P3_Con = 'ok' or P4_Con = 'ok';");
	$nofd=mysql_num_rows($query);
	if($nofd != 0) {
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
			@$st=((round($p["P".$i."_P"]/$nofd,1)*100)<=50)?"error":"success";
			@$tr.='<tr>  
				<td style="text-align:center;">'.$i.'</td>
				<td style="text-align:center;"> P'.$i.' </td> 
				<td style="text-align:center;"><b> '.$nofd.'</b> </td> 
				<td style="text-align:center;" class="text-success"><b> '.$p["P".$i."_P"].' </b></td>  
				<td style="text-align:center;" class="text-success"><b> '.round($p["P".$i."_P"]/$nofd,1).' </b></td>  
				<td style="text-align:center;" class="text-error"><b> '.$p["P".$i."_A"].' </b></td> 
				<td style="text-align:center;" class="text-error"><b> '.round($p["P".$i."_A"]/$nofd,1).' </b></td>  
				<td style="text-align:center;" class="text-'.$st.'"><b><small> '.(round($p["P".$i."_P"]/$nofd,1)*100).' % </small></b></td>   
			</tr>';
			@$datasetp.="<set name='P".$i."' value='".(round($p["P".$i."_P"]/$nofd,1)*100)."' color='".$colors[$i]."'/>";
	}
	$strXML.=$datasetp."</graph>";
	echo '<br><h5 class="text-info">Chart Based Attendance Representaiton for CR '.$branch2.' - '.$userid.'</h5><br>';
	echo renderChart("assets/charts/FCF_Column3D.swf", "", $strXML, "FactorySum", 650, 380);
	echo <<<table_head
		<h5 class="text-info"> Period Wise Attendance Representation for CR - $userid </h5><br>
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
		</table>
		<br>
		<table class='table  table-hover table-bordered ' >
		<tr>
			<th	><center>Short Name</center></th><th> <center>Long Name</center></th>
			<th	><center>Short Name</center></th><th> <center>Long Name</center></th>
		</tr>
		<tr>
			<th><center>P/Day</center></th><td>&emsp;No. of Presents for Day</td>	
			<th><center>A/Day</center></th><td>&emsp;No. of Absents for Day</td>
		</tr>
		
		
</table>
		<br><div class='alert alert-info'><a class='close' data-dismiss='alert'>&times;</a><strong>CNYS </strong>: Classes Not Yet Started </div>
	<br>
tableend;
	}
	else echo "<br><br><h6 class='text-error text-center'>&emsp;No Submissions Found<br></h6>";
}/* End of Period Wise Attendance*/
	/* SUbjects Wise Attendance */
	if(strtolower($_SERVER["QUERY_STRING"])=="sub")
	{
		$branch2 = $branch.$class;
		//mysql_select_db($branchyear."_Subjects") or die(mysql_error());
		$query=mysql_query("Select * from ".$branch.$class."_Subjects where RNo='$RNo';") or die(mysql_error());
		$subjectwise=mysql_fetch_array($query);
		$tr='';
		$strXML="<graph caption='Subject Wise Attendance Report' formatNumberScale='1' rotateValues='1' decimalPrecision='1' numberSuffix='%' xAxisName='Subjects' yAxisName='Performance'>";
		$datasetp="";
		$nc_cls= 0;
		$poor = array();
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
						{$remarks="Bad";$poor[$allowed_subjects[$i]]=$performance;}
					if(round($performance,1)<50)
						{$remarks="Go Out";$poor[$allowed_subjects[$i]]=$performance;}
				}
				$tr.='<tr> 
					<td style="text-align:center;">'.($i+1).'</td> 
					<td style="text-align:center;"> <b><small>'.$allowed_subjects[$i].'</small></b> </td> 
					<td style="text-align:center;"> <b>'.$tnoc.'</b> </td> 
					<td style="text-align:center;" class="text-success"><b> '.$subjectwise[$allowed_subjects[$i]."_P"].'</b> </td> 
					<td style="text-align:center;" class="text-error"><b> '.$subjectwise[$allowed_subjects[$i]."_A"].' </b></td>
					<td style="text-align:center;" class="text-'.$st.'"><b>'.$performance.'</b></td>
					<td style="text-align:center;" class="text-'.$st.'"><b><small>'.$remarks.'</small></b></td>
				</tr>';
				$datasetp.="<set name='".$allowed_subjects[$i]."' value='".round($performance,1)."' color='".$colors[$i]."'/>";
		}
		$strXML.=$datasetp."</graph>";
		if($nc_cls != count($allowed_subjects)) {
		echo '<br><h5 class="text-info">Chart Based Attendance Representaiton for CR '.$branch2.' - '.$userid.'</h5><br>';
		echo renderChart("assets/charts/FCF_Column3D.swf", "", $strXML, "FactorySum", 650, 380);
		echo <<<table_head
		<h5 class="text-info"> Subject Wise Attendance Representation for CR - $userid</h5><br>
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
	$st2 = "";
	//print_r($poor);
	foreach($poor as $key => $value){$st2 .= $key." ";}
	if(count($poor)!= 0) echo "<script type='text/javascript'>show_error('Your Attendance is Poor in $st2 ');</script>";
	} else echo "<br><br><h6 class='text-error text-center'>&emsp;No Submissions Found<br></h6>";
}/* End of SUbjects Wise Attendance*/






/* Checking for Wrong Keyword */
if(strtolower($_SERVER["QUERY_STRING"])!="sub" and strtolower($_SERVER["QUERY_STRING"])!="p" and strtolower($_SERVER["QUERY_STRING"])!=strtolower($branch.$class."/p") and strtolower($_SERVER["QUERY_STRING"])!=strtolower($branch.$class."/sub") )
{
	echo "<script type='text/javascript'>document.location.href='./?sub';</script>";
}
/* End of Checking for Wrong Keyword */	
}
/* End of Checking wheter he is a CR or any other */

            ////////////////////////////////****************////////////////

if($type == "BA" or $type == "CR") {
	/* Start of Class Period Wise Attendance */
if(strtolower($_SERVER["QUERY_STRING"])==strtolower($branch.$class."/p"))
{
	$branch2 = $branch.$class;
	//mysql_select_db($branchyear."_Dates") or die(mysql_error());
	$query=mysql_query("Select Date from ".$branch.$class."_Dates where P1_Con = 'ok' or P2_Con = 'ok' or P3_Con = 'ok' or P4_Con = 'ok';");
	$nofd=mysql_num_rows($query);
	if($nofd != 0) {
	$p=array("P1_A"=>0,"P1_P"=>0,"P2_A"=>0,"P2_P"=>0,"P3_A"=>0,"P3_P"=>0,"P4_A"=>0,"P4_P"=>0);
	$stats=array("Total"=>0,"Presents"=>0,"Absents"=>0);
	$strXML="<graph caption='Period Wise Attendance Report of $branch $class' formatNumberScale='1' rotateValues='1' decimalPrecision='1' numberSuffix='%' xAxisName='Periods' yAxisName='Performance'>";
	$datasetp='';
	while($dates=mysql_fetch_array($query))
	{
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
	}
	$tr='';
	for($i=1;$i<=4;$i++)
	{
			@$st=((round($p["P".$i."_P"]/$nofd,1)*100)<=50)?"error":"success";
			@$tr.='<tr>  
				<td style="text-align:center;">'.$i.'</td>
				<td style="text-align:center;"> P'.$i.' </td> 
				<td style="text-align:center;"><b> '.$nofd.'</b> </td> 
				<td style="text-align:center;" class="text-success"><b> '.$p["P".$i."_P"].' </b></td>  
				<td style="text-align:center;" class="text-success"><b> '.round($p["P".$i."_P"]/$nofd,1).' </b></td>  
				<td style="text-align:center;" class="text-error"><b> '.$p["P".$i."_A"].' </b></td> 
				<td style="text-align:center;" class="text-error"><b> '.round($p["P".$i."_A"]/$nofd,1).' </b></td>  
				<td style="text-align:center;" class="text-'.$st.'"><b> <small>'.round((($p["P".$i."_P"]/$nofd)/$classcount)*100,1).' %</small> </b></td>
			</tr>';
			@$datasetp.="<set name='P".$i."' value='".round((($p["P".$i."_P"]/$nofd)/$classcount)*100,1)."' color='".$colors[$i]."'/>";
	}
	$strXML.=$datasetp."</graph>";
	echo '<br><h5 class="text-info">Chart Based Periods Attendance Representaiton for Class '.$branch2.'</h5><br>';
	echo renderChart("assets/charts/FCF_Column3D.swf", "", $strXML, "FactorySum", 650, 380);
	echo <<<table_header
	
	<table class="table  table-hover table-bordered "  style="padding:0px;">
	    <thead>
		<tr> 
		<th style="text-align:center;"   valign="top"> SNo  </th> 
		<th style="text-align:center;"   valign="top"> Periods  </th> 
		<th  style="text-align:center;"  > Classes </th> 
		<th  style="text-align:center;" > Presents </th>
		<th  style="text-align:center;" > P/C </th>
		<th  style="text-align:center;"  > Absents </th>  
		<th  style="text-align:center;" > A/C </th>
		<th  style="text-align:center;"  > Performance </th> 
		</tr>
	    </thead>
	    <tbody>
table_header;
	echo $tr;
echo <<<tableend
			</tbody>
		</table>
		<br>
		<table class='table  table-hover table-bordered ' >
		<tr>
			<th	><center>Short Name</center></th><th> <center>Long Name</center></th>
			<th	><center>Short Name</center></th><th> <center>Long Name</center></th>
		</tr>
		<tr>
			<th><center>P/C</center></th><td>&emsp;No. of Presents for Class</td>	
			<th><center>A/C</center></th><td>&emsp;No. of Absents for Class</td>
		</tr>
		
		
</table>
		<br><div class='alert alert-info'><a class='close' data-dismiss='alert'>&times;</a><strong>CNYS </strong>: Classes Not Yet Started </div>
	<br>
tableend;
} else echo "<br><br><h6 class='text-error text-center'>&emsp;No Submissions Found<br></h6>";
}
/* End of Class Period Wise Attendance */

/* Start of Class Subject Wise Attendance */
if(strtolower($_SERVER["QUERY_STRING"])==strtolower($branch.$class."/sub"))
{
	$branch2 = $branch.$class;
	$tr='';
	$strXML="<graph caption='Subject Wise Attendance Report' formatNumberScale='1' rotateValues='1' decimalPrecision='1' numberSuffix='%' xAxisName='Subjects' yAxisName='Performance'>";
	$datasetp="";
	$nc_cls=0;
	for($i=0;$i<count($allowed_subjects);$i++)
	{
		//mysql_select_db($branchyear."_Subjects") or die(mysql_error());
		$queryp=mysql_query("Select sum(`".$allowed_subjects[$i]."_P`) as ".$allowed_subjects[$i]."_P from ".$branch.$class."_Subjects;");
		$querya=mysql_query("Select sum(`".$allowed_subjects[$i]."_A`) as ".$allowed_subjects[$i]."_A from ".$branch.$class."_Subjects;");
		$resultp1=mysql_fetch_array($queryp);
		$resulta1=mysql_fetch_array($querya);
		$resultp=$resultp1[0];
		$resulta=$resulta1[0];
		//mysql_select_db($branch."09_Subjects");
		$tn=mysql_fetch_array(mysql_query("select `".$allowed_subjects[$i]."_P`,`".$allowed_subjects[$i]."_A` from ".$branch.$class."_Subjects;")) or die(mysql_error());
		$tnoc=$tn[0]+$tn[1];
		if($tnoc==0){
			$nc_cls++;
			$performance=0;
			$performance1="N/A  ";
			$st="error";
			$remarks="CNYS";}
		else{
			$performance=$resultp/($resultp+$resulta)*100;
			$performance1=round($performance,1)." %";
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
		<td style="text-align:center;"> <small>'.($i+1).'</small> </td> 
		<td style="text-align:center;"> <small>'.$allowed_subjects[$i].'</small> </td> 
		<td style="text-align:center;"><b> <small>'.$tnoc.'</small></b> </td> 
		<td style="text-align:center; class="text-success""><b><small> '.$resultp.' </small></b></td>  
		<td style="text-align:center;" class="text-success"><b> <small>'.(($resultp!=0)?round(($resultp)/($tnoc),1):0).'</small> </b></td>  
		<td style="text-align:center;" class="text-error"><b> <small>'.$resulta.' </small></b></td>  
		<td style="text-align:center;" class="text-error"><b><small> '.(($resulta!=0)?round(($resulta)/($tnoc),1):0).'</small> </b></td> 
		<td style="text-align:center;" class="text-'.$st.'"><b> <small>'.$performance1.'</small> </b></td>  
		<td style="text-align:center;" class="text-'.$st.'"><b> <small>'.$remarks.'</small> </b></td>  
		</tr>';
		$datasetp.="<set name='".$allowed_subjects[$i]."' value='".$performance."' color='".$colors[$i]."'/>";
	}
	$strXML.=$datasetp."</graph>";
	if($nc_cls != count($allowed_subjects)){
	echo '<br><h5 class="text-info">Chart Based  Subjects Attendance Representaiton for Class '.$branch2.'</h5><br>';
	echo renderChart("assets/charts/FCF_Column3D.swf", "", $strXML, "FactorySum", 650, 380);
	echo <<<table_header
	<table class="table  table-hover table-bordered "  style="padding:0px;">
	<thead>
	<tr> 
	<th style="text-align:center;"   valign="top"> SNo  </th> 
	<th style="text-align:center;"   valign="top"> Subject  </th> 
	<th  style="text-align:center;"  > Classes </th> 
	<th  style="text-align:center;" > Presents </th>
	<th  style="text-align:center;" > P/C </th>
	<th  style="text-align:center;"  > Absents </th>  
	<th  style="text-align:center;" > A/C </th>
	<th  style="text-align:center;"  > Performance </th> 
	<th  style="text-align:center;" > Remarks </th> 
	</tr>
	</thead>
	<tbody>
table_header;
	echo $tr;
	echo <<<tableend
			</tbody>
		</table>
		<table class='table  table-hover table-bordered ' >
		<tr>
			<th	><center>Short Name</center></th><th> <center>Long Name</center></th>
			<th	><center>Short Name</center></th><th> <center>Long Name</center></th>
		</tr>
		<tr>
			<th><center>P/C</center></th><td>&emsp;No. of Presents for Class</td>	
			<th><center>A/C</center></th><td>&emsp;No. of Absents for Class</td>
		</tr>
		
		
</table>
		
		<br><div class='alert alert-info'><a class='close' data-dismiss='alert'>&times;</a><strong>CNYS </strong>: Classes Not Yet Started </div>
	<br>
tableend;
	} else  echo "<br><br><h6 class='text-error text-center'>&emsp;No Submissions Found<br></h6>";
}

/* End of Class Subject Wise Attendance */
}

/* Start Checking wheter he is a Branch Admin or any other */
if($type=="BA")
{
	/* Starting Period Wise Attendance */
	if($_SERVER["QUERY_STRING"]=="p")
	{
		$p=array();
		$nofday=array();
		$stats=array("Total"=>0,"Presents"=>0,"Absents"=>0);
		$strXML="<graph caption='Class Wise Attendance Report' formatNumberScale='1' rotateValues='1' decimalPrecision='0' numberSuffix='%' xAxisName='Classes' yAxisName='Performance'>";
		$class_period=array();
		$noofperiods=array();
		$cn = 0;
		for($cln=1;$cln<$classno+1;$cln++)
		{
			//mysql_select_db($branchyear."_Dates") or die(mysql_error());
			$query=mysql_query("Select Date from ".$branch.$cln."_Dates where P1_Con = 'ok' or P2_Con = 'ok' or P3_Con = 'ok' or P4_Con = 'ok';") or die("Here");
			$nofday[$branch.$cln]=mysql_num_rows($query);
			if($nofday[$branch.$cln] == 0) $cn++;
			$class_period[$branch.$cln]=array("P1_A"=>0,"P1_P"=>0,"P2_A"=>0,"P2_P"=>0,"P3_A"=>0,"P3_P"=>0,"P4_A"=>0,"P4_P"=>0);
			$p[$branch.$cln]=array("A"=>0,"P"=>0);
			$noofperiods[$branch.$cln]=0;
			while($dates=mysql_fetch_array($query))
			{
				//mysql_select_db($branchyear."_Attendance") or die(mysql_error());
				$q=mysql_query("select `".$dates[0]."` from ".$branch.$cln."_Attendance;");
				$cou=0;
				while($res=mysql_fetch_array($q))
				{
					$values=explode(",",$res[0]);
					if($cou==0){
						$noofperiods[$branch.$cln]=$noofperiods[$branch.$cln]+(count($values)-1);}
					$cou++;
					for($i=0;$i<count($values)-1;$i++)
					{
						if(substr($values[$i],-1)=="P"){
							$stats["Presents"]+=1;$stats["Total"]+=1;$p[$branch.$cln]["P"]+=1;$class_period[$branch.$cln][$values[$i]]++;}
						if(substr($values[$i],-1)=="A"){
							$stats["Absents"]+=1;$stats["Total"]+=1;$p[$branch.$cln]["A"]+=1;$class_period[$branch.$cln][$values[$i]]++;}
					}
				}
			}
		}
		$tr='';
		$datasetp = '';
		for($i=1;$i<=$classno;$i++)
		{
				@$ab_per=(round(($p[$branch.$i]["A"]/$noofperiods[$branch.$i]),1)<=0)?'NA':round(($p[$branch.$i]["A"]/$noofperiods[$branch.$i]),1);
				@$ab_day=(round(($p[$branch.$i]["A"]/$nofday[$branch.$i]),1)<=0)?'NA':round(($p[$branch.$i]["A"]/$nofday[$branch.$i]),1);
				@$pre_per=(round(($p[$branch.$i]["P"]/$noofperiods[$branch.$i]),1)<=0)?'NA':round(($p[$branch.$i]["P"]/$noofperiods[$branch.$i]),1);
				@$pre_day=(round(($p[$branch.$i]["P"]/$nofday[$branch.$i]),1)<=0)?'NA':round(($p[$branch.$i]["P"]/$nofday[$branch.$i]),1);
				@$perform=round((($p[$branch.$i]["P"]/($p[$branch.$i]["P"]+$p[$branch.$i]["A"]))*100),1);
				if($nofday[$branch.$i]==0 || $noofperiods[$branch.$i]==0){
				$st="error";
				$remarks="CNYS";}
				else{
				$st=((($p[$branch.$i]["P"]/($p[$branch.$i]["P"]+$p[$branch.$i]["A"]))*100)<=50)?'error':'success';
				if((int)$perform>=95)
					$remarks="Excellent";
				if((int)$perform>=90 && (int)$perform<95)
					$remarks="VGood";
				if((int)$perform>=80 && (int)$perform<90)
					$remarks="Good";
				if((int)$perform>=70 && (int)$perform<80)
					$remarks="Normal";
				if((int)$perform>=60 && (int)$perform<70)
					$remarks="Average";
				if((int)$perform>=50 && (int)$perform<60)
					$remarks="Bad";
				if((int)$perform<50)
					$remarks="Go Out";
				}
				$tr.='<tr>  
					<td style="text-align:center;">'.$i.'</td> 
					<td style="text-align:center;"><small>'.$branch." ".$i.'</small></td>
					<td style="text-align:center;"><small>'.$nofday[$branch.$i].'</small></td>
					<td style="text-align:center;"><small>'.$noofperiods[$branch.$i].'</small></td>
					<td style="text-align:center;">4</td>
					<td style="text-align:center;" class="text-error"><b> <small>'.$p[$branch.$i]["A"].'</small></b> </td> 
					<td style="text-align:center;" class="text-error"><b> <small>'.$ab_per.'</small> </b></td> 
					<td style="text-align:center;" class="text-error"><b> <small>'.$ab_day.'</small> </b></td> 
					<td style="text-align:center;" class="text-success"><b><small> '.$p[$branch.$i]["P"].'</small></b> </td> 
					<td style="text-align:center;" class="text-success"><b> <small>'.$pre_per.' </small></b></td> 
					<td style="text-align:center;" class="text-success"><b> <small>'.$pre_day.' </small></b></td> 
					<td style="text-align:center;" class="text-'.$st.'"><b> <small>'.round($perform,0).'%</small></b></td> 
					<td style="text-align:center;" class="text-'.$st.'"><b> <small>'.$remarks.' </small></b></td> 
				</tr>';
				$datasetp.="<set name='".$branch.$i."' value='".round($perform,0)."' color='".$colors[$i]."'/>";
		}
		$strXML.=$datasetp."</graph>";
		if($cn != $classno) {
		echo '<br><h5 class="text-info">Graph based Period Attendance representation for '.$globalbranch.'</h5>';
		echo renderChart("assets/charts/FCF_Column3D.swf", "", $strXML, "FactorySum", 650, 380);
		echo <<<tabhead
		<h5 class="text-info">Table based data representation </h5><br>
	    <table class="table  table-hover table-bordered "  style="padding:0px;">
	    <thead>
		<tr> 
		<th style="text-align:center;"   valign="top"> SNo  </th> 
		<th style="text-align:center;"   valign="top"> Class  </th> 
		<th style="text-align:center;"   valign="top"> Days  </th>
		<th style="text-align:center;"   valign="top"> Periods  </th> 
		<th style="text-align:center;"   valign="top"> P/Day  </th>   
		<th  style="text-align:center;" > A </th>
		<th  style="text-align:center;" > A/P </th>
		<th  style="text-align:center;" > A/D </th>
		<th  style="text-align:center;" > P </th>
		<th  style="text-align:center;" > P/P </th>
		<th  style="text-align:center;" > P/D </th>
		<th  style="text-align:center;"  > % </th> 
		<th  style="text-align:center;" > Remarks </th> 
		</tr>
		
	    </thead>
	    <tbody>
tabhead;
		echo $tr;
	echo <<<tableend
				</tbody>
			</table>
			<br>
			<table class='table  table-hover table-bordered ' >
		<tr>
			<th	><center>Short Name</center></th><th> <center>Long Name</center></th>
			<th	><center>Short Name</center></th><th> <center>Long Name</center></th>
		</tr>
		<tr>
			<th><center>P</center></th><td>&emsp;No. of Presents</td>	
			<th><center>P/D</center></th><td>&emsp;No. of Presents for Day</td>
		</tr>
		<tr>	
			<th><center>A</center></th><td>&emsp;No. of Absents</td>
			<th><center>A/D</center></th><td>&emsp;No of Absents for Day</td>
		</tr>
		<tr>	
			<th><center>P/P</center></th><td>&emsp;No. of Absents for Periods</td>
			<th><center>A/P</center></th><td>&emsp;No of Absents for Periods</td>
		</tr>
		<tr>	
			<th><center>P/Day</center></th><td>&emsp;No. of Periods for Day</td>
			<th><center>%</center></th><td>&emsp;Performace in %</td>
		</tr>
		
</table>
			<br><div class='alert alert-info'><a class='close' data-dismiss='alert'>&times;</a><strong>CNYS </strong>: Classes Not Yet Started </div>
	<br>
tableend;
	}
	else echo "<br><br><h6 class='text-error text-center'>&emsp;No Submissions Found<br></h6>";
}
/* End of Period Wise Attendance*/
/* Start of Subject Wise Attendance */
if($_SERVER["QUERY_STRING"]=="sub")
{
		$tr='';
	$strXML="<graph caption='Subject Wise Attendance Report' formatNumberScale='1' rotateValues='1' decimalPrecision='1' numberSuffix='%' xAxisName='Subjects' yAxisName='Performance'>";
	$datasetp="";
	$sub_per=array();$cnt = 0;
	for($j=1;$j<=$classno;$j++){
	$sub_per[$branch.$j]=array();
	for($i=0;$i<count($allowed_subjects);$i++)
	{
		//mysql_select_db($branchyear."_Subjects") or die(mysql_error());
		$queryp=mysql_query("Select sum(`".$allowed_subjects[$i]."_P`) as ".$allowed_subjects[$i]."_P from ".$branch.$j."_Subjects;");//die
		$querya=mysql_query("Select sum(`".$allowed_subjects[$i]."_A`) as ".$allowed_subjects[$i]."_A from ".$branch.$j."_Subjects;");//die
		@$resultp1=mysql_fetch_array($queryp);//die
		@$resulta1=mysql_fetch_array($querya);//die
		$resultp=$resultp1[0];
		$resulta=$resulta1[0];
		if($resultp+$resulta == 0 ) $cnt++;
		@$sub_per[$branch.$j][$allowed_subjects[$i]]=($resultp/($resultp+$resulta))*100;
	}
}
	if($cnt != $classno*count($allowed_subjects)){
	for($k=1;$k<=$classno;$k++)
	{
		$tr.='<tr>  
		<td style="text-align:center;"> '.($k).' </td> 
		<td style="text-align:center;"><small> '.$branch.$k.'</small> </td>';
		$sub_count = 0;
		for($l=0;$l<count($allowed_subjects);$l++){
		if(round($sub_per[$branch.$k][$allowed_subjects[$l]],1) == 0) $sub_count++;
		@$tr.='<td style="text-align:center;"><b> '.round($sub_per[$branch.$k][$allowed_subjects[$l]],1).'</b> </td>'; 
		}
		@$tr.='<td style="text-align:center; class="text-success""><b> '.round(array_sum($sub_per[$branch.$k])/abs(count($allowed_subjects)-$sub_count),1).' </b></td> ';
		@$performance = round(array_sum($sub_per[$branch.$k])/abs(count($allowed_subjects)-$sub_count),1);
		
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
		//echo $sub_count;
		@$tr.='<td style="text-align:center;" class="text-'.$st.'"><b><small> '.$remarks.' </small></b></td>  
		</tr>';
		
		@$datasetp.="<set name='".$branch.$k."' value='".array_sum($sub_per[$branch.$k])/abs(count($allowed_subjects)-$sub_count)."' color='".$colors[$k]."'/>";
	}
	$strXML.=$datasetp."</graph>";
	$branch2 = $branch.$class;
	echo '<br><h5 class="text-info">Graph based Subjects Attendance representation for '.$globalbranch.' </h5>';
	echo renderChart("assets/charts/FCF_Column3D.swf", "", $strXML, "FactorySum", 650, 380);
	echo <<<table_header
	<h5 class="text-info">Table based data representation </h5><br>
	<table class="table  table-hover table-bordered "  style="padding:0px;">
	<thead>
	<tr> 
	<th style="text-align:center;"   valign="top"> SNo  </th> 
	<th style="text-align:center;"   valign="top"> Class  </th> 
table_header;
	for($i=0;$i<count($allowed_subjects);$i++)
	{
		echo '<th style="text-align:center;"   valign="top">'.$allowed_subjects[$i].'</th>';
	}
	echo <<<table_1
	<th  style="text-align:center;"  > % </th> 
	<th  style="text-align:center;" > Remarks </th> 
	</tr>
	</thead>
	<tbody>
table_1;
	echo $tr;
	echo <<<tableend
			</tbody>
		</table>
		<br>
tableend;
	}
	else echo "<br><br><h6 class='text-error text-center'>&emsp;No Submissions Found<br></h6>";
}
/* End of Subject Wise Attendance */
if(strtolower($_SERVER["QUERY_STRING"])=="")
{
	echo "<script type='text/javascript'>document.location.href='./?sub';</script>";
}
}
/* End of Checking wheter he is Branch Admin or any other */

echo <<< b
	

	</div>
	</div>
	<div class='span3'>
b;
	sidepanel();
/* Creating a Sidepanel for CR */


/* END Creating a Sidepanel for CR */
	echo "</div></div></div>";   
        display_footer();
        echo "\n</body>\n</html>";
	}
}
homepage("Attendance Portal - Home");
?>
