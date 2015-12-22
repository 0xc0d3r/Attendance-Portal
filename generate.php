<?php
session_start();
ob_start();
require "functions.php";

function generate_attendance($title) {
    if(!check('CR') ) header('location:./?sub');
    else {
		
		$qs1 = $_SERVER['QUERY_STRING'];
		$reg2 = '/^P[1-4]$/';
		$reg1="/^[0-9]{2}-[0-9]{2}-[0-9]{4}$/";
		$qs = explode('/',$qs1);
		$len = count($qs);
		
		if($len == 2 or ( $len == 3 && $qs[2] == "")){
			$ar = explode('-',$qs[0]);
			if(preg_match($reg1,$qs[0]) && preg_match($reg2,$qs[1])){
				if(checkdate($ar[1],$ar[0],$ar[2])) { 
					
					include 'config/db.php';
					include 'config/settings.php';
					include 'config/globals.php';
					
					$dbname = $branchyear.'_Users';
					$table = $branchyear.'_Students';
					//if(!mysql_select_db($dbname)) die(mysql_error());
					
					$userid = $_SESSION['UserId'];
					$q = "select Branch,Class from $table where Id = '$userid'";
					$res = mysql_query($q) or die(mysql_error());
					$row = mysql_fetch_array($res);
					$branch = $row['Branch'];
					$class = $row['Class'];
					
					$da = $qs[0];
					$date = $qs[0];
					$p = $qs[1];
					$dif = strtotime($da) - strtotime(date('d-m-Y'));
					
					
					
					if($dif > 0 ){
						display_error("Error : Not allowed to access future Attendance");
						}
					else if(check_day2($da,$branch.$class))
						display_error("Error : Not allowed to access Attendance of semester starting dates");
					else if(check_day1($da))
						echo noservice();
					else {
					
					
					
					
						
					echo "<!DOCTYPE html>\n<html>\n";
					display_headers($title);
					echo "\n<body>";
					menu();
					echo <<< a
					\n\t<div class="container" style="margin-top:-10px;"><br>
					
a;
					$dbname = $branchyear.'_Attendance';
					$table = $branch.$class.'_Attendance';
					//if(!mysql_select_db($dbname)) die(mysql_error());
					$class_total = mysql_num_rows(mysql_query("select `Id` from $table"));
					$sample = mt_rand(1,$class_total);
					
					
					
					$dbname = $branchyear.'_Dates';
					$table = $branch.$class.'_Dates';
					//if(!mysql_select_db($dbname)) die(mysql_error());
					
					$q = mysql_query("select Date from $table where Date = '$da'") or die(mysql_error()) ;
					if(mysql_num_rows($q) == 0){
						
						$q = mysql_query("insert into $table(Date) values('$da')") or die(mysql_error());
						
						$dbname = $branchyear.'_Cache';
						$table = $branch.$class.'_Cache';
						//if(!mysql_select_db($dbname)) die(mysql_error());
						
						for ($j=1;$j<=4;$j++) $q = mysql_query("alter table $table add `".$da."_P".$j."` varchar(2);") or die(mysql_error());
						insert_log($_SESSION['UserId']." added $date Cache columns to $table");
						
						$dbname = $branchyear.'_Attendance';
						$table = $branch.$class.'_Attendance';
						//if(!mysql_select_db($dbname)) die(mysql_error());
						$q = mysql_query("alter table $table add `".$da."` varchar(30) default '';") or die(mysql_error());
						insert_log($_SESSION['UserId'] ."added $date to Attendance columns to $table");
					}
						
					echo <<< a
					<div id="error" style="display:none;margin-top:10px;"></div>
					\n\t\t<div class="row">
						<div class='span9'>
							<div class="well well-large" style="background:#FFF;">
a;
					$dbname = $branchyear.'_Dates';
					$table = $branch.$class.'_Dates';
					//if(!mysql_select_db($dbname)) die(mysql_error());
					
					$q = mysql_query("select $p,`".$p."_Con` from $table where Date = '$da';") or die(mysql_error());
					$row = mysql_fetch_array($q);
					
					$a = $da.'_'.$p;
					
					if(isset($_POST['Generate'])  ) {
						if($row[$p] == 'ok') 
							echo "<script>show_error('$p Attendance has been already uploaded ');</script>";
						else {
						$key2 = addslashes($_POST['Skey']);
						$table = $branchyear.'_CRs';
						$q = "select `Id`,`Key` from $table where `Id` = '$userid'";
						$res = mysql_query($q) or die(mysql_error());
						$row = mysql_fetch_array($res);
						$key1 = $row['Key'];
						if($key1  != $key2) {
							echo "<script>show_error('<b>Error </b> : CR Security Key does not matched.  Please try again.. ');</script>";
							}
						else {
						
						$dbname = $branchyear.'_Cache';
						$table = $branch.$class.'_Cache';
						//if(!mysql_select_db($dbname))die(mysql_error());
							
						$less = addslashes($_POST['Less']);
						$rnos = addslashes($_POST['RNos']);
						$lastone = $rnos[strlen($rnos)-1];
						$rollno[$less]= $lastone != ',' ? explode(',',$rnos) : explode(',',$rnos,-1);
						
						if($less == "Absents"){
							for($i=1,$c=0;$i<=$class_total;$i++){
								if(!in_array($i,$rollno["Absents"])) $rollno["Presents"][$c++]=$i; 
							}
						}
						
						else{
							for($i=1,$c=0;$i<=$class_total;$i++){
								if(!in_array($i,$rollno["Presents"])) $rollno["Absents"][$c++]=$i;
							}
						}
							
						if(array_key_exists('Absents',$rollno))foreach ($rollno['Absents'] as $val ) { $insert=mysql_query("UPDATE ".$table." SET `$a` = 'A' WHERE RNo ='$val';") or die(mysql_error()); }
						if(array_key_exists('Presents',$rollno))foreach ($rollno['Presents'] as $val ) { $insert=mysql_query("UPDATE ".$table." SET `$a` = 'P' WHERE RNo ='$val';") or die(mysql_error()); }
						
						$dbname = $branchyear.'_Dates';
						$table = $branch.$class.'_Dates';
						//if(!mysql_select_db($dbname)) die(mysql_error());
						
						$in=mysql_query("UPDATE ".$table." SET `$p` = 'ok' WHERE Date ='$da';") or die(mysql_error());
						echo "<script>show_success('$p Attendance has been uploaded ');</script>";
							}
						}
					}
					
					$dbname = $branchyear.'_Dates';
					$table = $branch.$class.'_Dates';
					//if(!mysql_select_db($dbname))  die(mysql_error());
					
					$remaining = array() ; $j = 0;
					$remaining1 = array() ; $j1 = 0;
					$confired = array() ; $j2 = 0;
					$confired1 = array() ; $j3 = 0;
					
					for($i = 1;$i<=4;$i++) {
						$tmp = "P".$i; $tmp1 = "P".$i."_Con";
						
						$q = mysql_query("select ISNUll(`$tmp`) as `P$i`,ISNUll(`$tmp1`) as `P".$i."_C` from $table where Date = '$da' ") or die(mysql_error());
						$res = mysql_fetch_array($q);
						
						if($res["P".$i]) { $remaining[$j] = "P".$i; $j++;}
						else { $remaining1[$j1] = "P".$i; $j1++;}
						if($res["P".$i."_C"]) { $confired[$j2] = "P".$i; $j2++;}
						else { $confired1[$j3] = "P".$i; $j3++;}
						
					}
					
					$dates1=getdate(strtotime($da));
					$day=substr($dates1["weekday"],0,3);
					
					$dbname = $branchyear.'_TimeTable';
					$table = $branch.$class.'_TimeTable';
					//if(!mysql_select_db($dbname)) die(mysql_error());
					
					$ti=mysql_query("SELECT DayPeriod,$day from $table;") or die(mysql_error());
					
					$subjects=array();	
					while($da=mysql_fetch_array($ti)){$subjects[$da[0]]=$da[1];}	
					$sub = $subjects[$p];
					
					if(in_array($p,$remaining1)) {
						
						
							echo "<h5 style='text-align:center;'> Attendance Submission Details - $branch&nbsp;$class</h5><br>";
							//$p="P".$m;
							
							if(in_array($p,$confired1)){	
								$period = $p;
								
								$dbname = $branchyear.'_Attendance';
								$table = $branch.$class.'_Attendance';
								//if(!mysql_select_db($dbname)) die(mysql_error());
								
								$q = mysql_query("select RNo,Id,`$date` from $table;")  or die(mysql_error());
								
								$Rnos=array("Absents"=>array(),"Presents"=>array());
								$aindex=0;$pindex=0;
								$uid = array();
								while($res = mysql_fetch_array($q)){
									$uid[$res['RNo']]=$res['Id'];
									$z= explode(",",$res[$date]);
									for($m=0;$m<count($z);$m++) {
										$y = explode("_",$z[$m]);
										if($y[0]==$period) {
											if($y[1] == "A") {$Rnos['Absents'][$aindex] = $res[0];$aindex++;}
											else {$Rnos['Presents'][$pindex] = $res[0];$pindex++;}
											}
										}
									}
								}
								
							else {
								$da = $qs[0];
								$a = $da.'_'.$p;
								$dbname = $branchyear.'_Cache';
								$table = $branch.$class.'_Cache';
								//if(!mysql_select_db($dbname)) die(mysql_error());
								
								$q3=mysql_query("SELECT RNo, `".$a."` FROM $table") or die(mysql_error());
								
								$Rnos=array("Absents"=>array(),"Presents"=>array());
								$aindex=0;$pindex=0;
								
								while($individual=mysql_fetch_array($q3)){
									if($individual[$a]=="A"){$Rnos["Absents"][$aindex]=$individual["RNo"];$aindex++;}
									if($individual[$a]=="P"){$Rnos["Presents"][$pindex]=$individual["RNo"];$pindex++;}
									}
							}
						
							
							$pc = count($Rnos["Presents"]);$ac = count($Rnos["Absents"]);$tot=$pc+$ac;
							//print_r($Rnos);
							//print_r($uid);
						echo <<< tab
						
						<div class="row">
							<div class="span8">
							<table class="table  table-hover table-bordered" >
								<tbody>
									<tr> <td class="span2" style="text-align:center"> Date </td> <th class="text-warning span2" style="text-align:center"> $date</th> 
									<td class="span2" style="text-align:center"> Subject </td> <th class="text-success span2" style="text-align:center"> $sub</th> </tr>
								</tbody>
							</table>
							</div>
						</div>
							 <div class="row">
								<div class="span8">
								<table class="table  table-hover table-bordered" >
									<thead>
										<tr> <th class="span2"  style="text-align:center"> Period # </th> <th class="span3"> Presents  </th> <th class="span3"> Absents  </th> </tr>
									</thead>
									<tbody>
									<tr><td style="text-align:center;" >$p</td><td>
tab;
						for($i=0;$i<$pc;$i++){
							if($i%8==0 && $i != 0) echo "<br>";
							if($i==$pc-1) echo $Rnos["Presents"][$i];
							else echo $Rnos["Presents"][$i].",";				
						}	
											
						echo "</td><td>";
						
						for($i=0;$i<$ac;$i++){
							if($i%8==0 && $i != 0) echo "<br>";
							if($i==$ac-1) echo $Rnos["Absents"][$i];
							else echo $Rnos["Absents"][$i].",";				
						}
						
						echo <<< tab
								</td></tr>
								<tr>
									<td style="text-align:center;" >Total  (<b>$class_total</b>) </td>
									<td style="text-align:center;" class='text-success'> $pc</td>
									<td style="text-align:center;" class='text-error'>$ac</td>
									</tr>
								</tbody>
							</table>
							</div>
						</div>
									
tab;
						
					}
					else display_generate_form($p,$class_total,$sub,$branch.$class,$date);
						
					echo <<< a
							</div>
						</div>
						<div class='span3'>
a;
					go_home();
					echo '<ul class="nav nav-tabs nav-stacked">';

					for($i = 1; $i <=4 ; $i++) {
						$period = "P".$i;
						$da1 = $date."/".$period;
						echo "<li><a href=\"?$da1\">$period";
						if(!in_array($period,$remaining)){ echo "<i class='icon-ok pull-right text-success' style=\"padding-top:5px;\"></i>"; }
						else {echo "<i class='icon-remove pull-right text-error' style='padding-top:5px;'></i>";}
						echo '<i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>';
						}
					
					echo "</ul>";
					$table = $branch.$class."_Dates";
					$sn = mysql_fetch_array(mysql_query("select SNo from $table where Date = '$date'")) or die(mysql_error());
					$sn1 = (($sn['SNo']) < 5 )? 0:($sn['SNo']-5);
					echo '<ul class="nav nav-tabs nav-stacked">
						  <li class="dropdown" style="margin-top:2px;">
						  <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-chevron-right pull-left" style="padding-top:5px;"></i> 
						   <i class="icon-calendar"></i> Date - '.$date.' &nbsp;<b class="caret"></b></a>
								<ul class="dropdown-menu">';
					
					//echo $sn1;
					$q = mysql_query("select Date from $table  order by SNo limit $sn1,5") or die(mysql_errno());
					while($res = mysql_fetch_array($q))
						{$st1 = ($res['Date'] == $date ) ? "active":" ";
						echo "<li class='$st1'><a href='?".$res['Date']."/P1'>".$res['Date']."</a></li>";
						}
					echo 	'</ul>
						  </li>
						</ul>';
					echo "</div>";
					
					echo "</div> </div> ";
				
					display_footer();
					echo "\n</body>\n</html>";
					@mysql_close($con);	
					}
				}
				else {display_error("Error : Invalid date");}	
			}
			else {display_error("Error : Invalid input pattern");}
		}	
		else {display_error("Error : Invalid no. of input arguments ");}
	
	} 
	
}

function display_generate_form($p,$max,$sub,$cl,$da) {
	$cls = substr($cl,-1);
	$da1 = $da."/".$p;
	echo <<< a
	<form action="?$da1" method="post" onsubmit="return check_range($max);" >
	<div id="Period">
		<h5 class='text-info'>Submit Attendance for $sub ($p) @ $cl  </h5>
		<h6> &emsp;&emsp;&emsp; - &emsp; List out all Roll Nos less in Number below  </h6><br>
		<h5>Your Security Key : </h5>
		<input type="text" class="input-large" placeholder="Security Key"  id="Skey" name="Skey" maxlength="9" /><br>
		<h5>All Students are : </h5>
		<label class="radio inline">
			<input type="radio" id="All_Abs" name="all" onchange="fill_rnos('Abs',$cls);"> Absents 
		</label>
		<label class="radio inline">
			<input type="radio"  id="All_Pre" name="all"  onchange="fill_rnos('Pre',$cls);"> Presents 
		</label>
		<br><br>
		<div id="absn">
		
		<h6>or </h6>
		<h5>Less Ones : </h5>
		
		<label class="radio inline">
			<input type="radio"  value="Absents" name="Less" id="Less_Abs"> Absents 
		</label>
		<label class="radio inline">
			<input type="radio"  value="Presents" name="Less" id="Less_Pre"> Presents 
		</label>
		<br><br>
		</div>
		<textarea class="span8" style="resize: vertical; height: 90px;" placeholder="List Roll Numbers here ..." name="RNos" id="RNos"></textarea>
		
		<br><br><input type="submit" class="btn btn-primary" name="Generate" value="Generate &darr;"  />
	</div>
	<br>
	</form>
a;
}	

generate_attendance('Attendance Portal - Generate Attendance');
?>
