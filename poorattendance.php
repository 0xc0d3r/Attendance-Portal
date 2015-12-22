<?php
session_start();
require "functions.php";
function poor($title) {
    if(!check_login() ) header('location:./login.php');
    else {
		include 'config/globals.php';	
		$p = $_SERVER['QUERY_STRING'];
		$reg = "/^".$globalbranch."[1-".$classno."]{1}$/";
		
		if(preg_match($reg,$p)) {
	
		include 'config/db.php';
		include 'config/settings.php';
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
			$dbname = $branchyear.'_Attendance';
			$table = $branch.$class.'_Attendance';
			//if(!mysql_select_db($dbname)) die(mysql_error());
			$da = date('d-m-Y');
			$date = date('d-m-Y');
			echo <<< a
			
			\n\t\t<div class="row">
				<div class='span12'>
					<div class="well well-large" style="background:#FFF;">
a;
			
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
//getting the poor attendance % students
		$dbname = $branchyear.'_Users';
		$table = $branchyear.'_Students';
		//if(!mysql_select_db($dbname)) die(mysql_error());
		$poor = array();
			$strength = count($users);
			for($j = 1; $j<=$strength;$j++) {
			$count = 1;				
				for($k = 0 ; $k< count($allowed_subjects) ;$k++) {
					$sub = $allowed_subjects[$k];
					$abs = $ar[$sub][$j]['Absents'];
					$pres = $ar[$sub][$j]['Presents'];
					$p_nod = $abs  + $pres;
					@$tmp = ($pres/$p_nod)*100;
					$pr = round($tmp,1);
					if($pr<50){
					$cou = $count++;
					$que_r="Select RNo from ".$table." where Id='".$users[$j]."';";
					$que_n="Select Name from ".$table." where Id='".$users[$j]."';";
					$poor[$sub][$users[$j]]=mysql_fetch_array(mysql_query($que_r))[0]."_".$pr."_".mysql_fetch_array(mysql_query($que_n))[0];
						}
			}	
		}
	
echo <<< a
			
				<div id="step1" class="span4">     
					<h5 class='text-info'>Poor Attendance Report  </h5>
					<h6> &emsp;&emsp;&emsp; - &emsp; Listing Data submitted from CR @ $branch&nbsp;$class </h6><br>
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
$pct=0;$pcs=array();
$mn = 1 ;
$html = '';
foreach($poor as $key => $value ) {
$sub2 = $sub_def[$key];
echo <<<table_head
		\n<table class="table table-hover table-bordered" style="padding:0px;">
			<thead>
				<tr> 
				<th style="text-align:center;" class='text-success'>Subject </th>
				<th style="padding-left:2%;" colspan=3 valign="top"><code>$sub2</code></th> </tr>\n<tr>
                <th  style="text-align:center;" class='span1' > RNo</th><th  style="text-align:center;"  class='span2'> Id </th> <th  style="text-align:center;"  > Name </th><th  style="text-align:center;" class='span1'> Percentage </th>
				</tr>
			</thead>
			<tbody>
table_head;
if($mn != 1) {$html .= '<table style="border-collapse:collapse;width:100%;margin-left:0%;font-size:14px;text-align:center;"  border=1>';}
$html .= '<thead>
				<tr> 
				<th style="text-align:center;" >Subject</th>
				<th style="padding-left:10px;text-align:left;" colspan=3 valign="top">'.$sub2.'</th> </tr>\n<tr>
                <th  style="text-align:center;width:15%;"  > RNo</th><th  style="text-align:center;width:20%;"  > Id </th> <th  style="text-align:center;"  > Name </th><th  style="text-align:center;width:15%;" > Percentage </th>
				</tr>
			</thead>
			<tbody>';
$pcs++;
foreach($value as $key1 => $value1) {
$det=explode("_",$value1);
$rn=$det[0];
$name = $det[2];
$per=$det[1];
$lnk = "./students.php?".$key1."/sub";
echo  '<tr onclick="document.location.href=\''.$lnk.'\';" style="cursor:pointer;"><td style="text-align:center;">'.$rn.'</td><td style="text-align:center;">'.$key1.'</td><td>'.$name.'</td><td style="text-align:center;" class="text-error">'.$per.'%</td></tr>';
$tr =   '<tr ><td style="text-align:center;">'.$rn.'</td><td style="text-align:center;">'.$key1.'</td><td style="text-align:left;padding-left:10px;">'.$name.'</td><td style="text-align:center;" ><font color=red>'.$per.'%<font></td></tr>';

$html .= $tr;
$pct++;
		}
		$html .= '</tbody>';
		if($mn != count($poor)) {$html .= '</table><br>';}
		echo "</tbody></table>";
		$mn++;
			}
		if($row['Position']=="BA"){
			echo <<< a
			<form action='print.php' method='post' name='abc'>
			<input type='hidden' name='Title1' value="$branch $class - Poor Attendance Report">
			<input type='hidden' name='Table1' value='$html'>
		<center><button type="submit" class="btn btn-primary"><i class='icon-download-alt'></i>&nbsp;&nbsp;Save as PDF</button></center>
			</form>
a;
			echo <<< b
			<form action='excel.php' method='post' name='abc'>
			<input type='hidden' name='Title1' value="$branch $class - Poor Attendance Report">
			<input type='hidden' name="sheet" value='$html'>
		<center><button type="submit" class="btn btn-primary"><i class='icon-download-alt'></i>&nbsp;&nbsp;Save as Excel Sheet</button></center>
			</form>
b;
}
		//echo $html;
		echo "</div>";
		display_footer();
		echo "\n</body>\n</html>";
		} else "Invalid syntax in url";
	}
}
poor("Poor Attendance");
?>
