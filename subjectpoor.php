<?php
session_start();
require "functions.php";
function poor($title) {
    if(!check("BA") ) header('location:./login.php');
    else {
		include 'config/globals.php';	
		include 'config/db.php';
		include 'config/settings.php';
		
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
		$dbname = $branchyear.'_Users';
		$table = $branchyear.'_Students';
		////if(!mysql_select_db($dbname)) die(mysql_error());
		
		$userid = $_SESSION['UserId'];
		$q = "select Position, Branch,Class from $table where Id = '$userid'";
		$res = mysql_query($q) or die(mysql_error());
		$row = mysql_fetch_array($res);
		$branch = $globalbranch;
		echo <<< a
		
		\n\t\t<div class="row">
			<div class='span12'>
				<div class="well well-large" style="background:#FFF;">
a;

		echo <<< a
		
			<div id="step1" class="span4">     
				<h5 class='text-info'>Poor Attendance Report - $branch </h5>
				<h6> &emsp;&emsp;&emsp; - &emsp; Listing Data submitted from CRs @ $branch  </h6><br>
			</div>
			<div id="side1" class="span7" >
				<h6 class='text-right'><a href='./?sub'><i class='icon-home'></i> Home&nbsp;</a> </h6>
a;
		echo <<< a
					<h6 class='text-right'>
a;
				for($cl = 0;$cl<=count($allowed_subjects);$cl++)	
					{$sub = $allowed_subjects[$cl];echo "<a href='?$sub'>$sub</a>&emsp;";}
					echo <<< a
					</h6>
a;
		echo <<< a
			</div>
		
a;

	$poor = array();
		for($cl = 1;$cl<=$classno;$cl++) {
			
		$class = $cl;
		$dbname = $branchyear.'_Attendance';
		$table = $branch.$class.'_Attendance';
		//if(!mysql_select_db($dbname)) die(mysql_error());
		$da = date('d-m-Y');
		$date = date('d-m-Y');
		
		$brcls= $branch.$class;
		$ar = array();
		$users = array();
//intializing the count of A,P's to 0
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
//counting the total A's & P's 
		
		$sub = $p ;
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
		
//getting the poor attendance % students
	$dbname = $branchyear.'_Users';
	$table = $branchyear.'_Students';
	//if(!mysql_select_db($dbname)) die(mysql_error());
	
	$strength = count($users);
	for($j = 1; $j<=$strength;$j++) {
	$count = 1;				
		
	$sub = $p;
	$abs = $ar[$sub][$j]['Absents'];
	$pres = $ar[$sub][$j]['Presents'];
	$p_nod = $abs  + $pres;
	@$tmp = ($pres/$p_nod)*100;
	$pr = round($tmp,1);
	if($pr<50){
	$cou = $count++;
	$que_r="Select RNo from ".$table." where Id='".$users[$j]."';";
	$que_n="Select Name from ".$table." where Id='".$users[$j]."';";
	$poor[$brcls][$users[$j]]=mysql_fetch_array(mysql_query($que_r))[0]."_".$pr."_".mysql_fetch_array(mysql_query($que_n))[0];
		}
			
	}

}
$pct=0;$pcs=array();
$mn = 1 ;
$html = '';
///print_r($poor);

$sub2 = $sub_def[$p];
echo <<<table_head
	\n<table class="table table-hover table-bordered" style="padding:0px;">
		<thead>
			<tr> 
			<th style="text-align:center;" >Subject</th>
			<th style="padding-left:10px;text-align:left;" colspan=4 valign="top">$sub2</th> </tr>\n<tr>
			<th  style="text-align:center;width:10%;"  > Class </th> <th  style="text-align:center;width:15%;"  > Id </th><th  style="text-align:center;width:10%;"  > RNo</th> <th  style="text-align:center;"  > Name </th><th  style="text-align:center;width:10%;" > Percentage </th>
			</tr>
		</thead>
		<tbody>
table_head;

$html .= '<thead>
			<tr> 
			<th style="text-align:center;" >Subject</th>
			<th style="padding-left:10px;text-align:left;" colspan=4 valign="top"><code>'.$sub2.'</code></th> </tr>\n<tr>
			<th  style="text-align:center;width:10%;"  > Class </th><th  style="text-align:center;width:15%;"  > Id </th> <th  style="text-align:center;width:10%;"  > RNo</th><th  style="text-align:center;"  > Name </th><th  style="text-align:center;width:10%;" > Percentage </th>
			</tr>
		</thead>
		<tbody>';
$pcs++;
//print_r($poor);
foreach($poor as $key => $val) {
	$brcls = $key;
	//$val2 = $poor[$brcls];
	//print_r($val2);
	foreach($val as $key1 => $value1) {
	$det=explode("_",$value1);
	$rn=$det[0];
	$name = $det[2];
	$per=$det[1];
	$lnk = "./students.php?".$key1."/sub";
	echo  '<tr onclick="document.location.href=\''.$lnk.'\';" style="cursor:pointer;"><td style="text-align:center;">'.$brcls.'</td><td style="text-align:center;">'.$key1.'</td><td style="text-align:center;" class = "span1">'.$rn.'</td><td class = "span3">'.$name.'</td><td style="text-align:center;" class="text-error">'.$per.'%</td></tr>';
	$tr = '<tr ><td style="text-align:center;">'.$brcls.'</td><td style="text-align:center;">'.$key1.'</td><td style="text-align:center;" class = "span1">'.$rn.'</td><td class = "span3" style="text-align:left;">'.$name.'</td><td style="text-align:center;" ><font color=darkred>'.$per.'%</font></td></tr>';
	$html .= $tr;
	$pct++;
		}
}
	$html .= '</tbody>';
	//if($mn != count($poor)) {$html .= '</table><br>';}
	echo "</tbody></table>";
		
		
	if($row['Position']=="BA"){
		echo <<< a
		<form action='print.php' method='post' name='abc'>
		<input type='hidden' name='Title1' value="$branch - $p - Poor Attendance Report">
		<input type='hidden' name='Table1' value='$html'>
	<center><button type="submit" class="btn btn-primary"><i class='icon-download-alt'></i>&nbsp;&nbsp;Save as PDF</button></center>
		</form>
a;
		echo <<< b
		<form action='excel.php' method='post' name='abc'>
		<input type='hidden' name='Title1' value="$branch - $p - Poor Attendance Report">
		<input type='hidden' name="sheet" value='$html'>
	<center><button type="submit" class="btn btn-primary"><i class='icon-download-alt'></i>&nbsp;&nbsp;Save as Excel Sheet</button></center>
		</form>
b;
}
	//echo $html;
	echo "</div>";
	display_footer();
	echo "\n</body>\n</html>";
		
		}
	else echo "invalid subject";
	}
}
poor("Poor Attendance");
?>
