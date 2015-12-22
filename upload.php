<?php
session_start();
require("functions.php");


function homepage($title) {
    if(!check("BA") || !check('BA')) 
        header('location:login.php');
    else {
		
		include "config/globals.php";
		include 'config/db.php';
		include 'config/settings.php';
		
		$qs=$_SERVER["QUERY_STRING"];
		$reg1="/^".$globalbranch."[1-".$classno."]$/";
		$reg2="/^P[1-4]$/";
		$reg3="/^[0-9]{2}-[0-9]{2}-[0-9]{4}$/";
		$reg4="/^all$/";
		
		$p = explode('/',$qs);
		$len = count($p);
		
		echo "<!DOCTYPE html>\n<html id='con2'>\n";
			display_headers($title);
			echo "\n<body>";
			menu();
			echo <<< a
			<div class='container' id='con1'>
				<div id="error"></div>
				<div class='row'>
				<div class='span9'>
					<div class="well well-large" style="background:#FFF;">
a;
	
		if($len == 3 or ( $len == 4 && $p[3] == "")){
			if(preg_match($reg1,$p[0]) && (preg_match($reg2,$p[1]) or preg_match($reg4,$p[1])  )&& preg_match($reg3,$p[2])  ) {
				$ar = explode('-',$p[2]);
				if(checkdate($ar[1],$ar[0],$ar[2])) {
					$lockfile=str_replace("/","_",$qs);
					if(file_exists("assets/tmp/".$lockfile))
					{
						echo "<script>show_error('Request in Progress');</script>";
					}
					else
					{
					exec("> assets/tmp/".$lockfile);
					$dbname = $branchyear.'_Dates';
					$table = $p[0].'_Dates';		
					//if(!mysql_select_db($dbname)) {die(mysql_error());}
					$date_sub = $p[2];
					$n = mysql_num_rows(mysql_query("select * from $table where Date = '$date_sub';"));
					if($n == 0) {
						echo "<script>show_error('$date_sub not found ');</script>";
						}
					else {
						
						$pcount = 1;
						$remaining = array();$j=0;
						$uploaded = array();$j1=0;
						$confirmed = array();$j2=0;
						
						if($p[1] == "all") {
							for($i = 1;$i<=4;$i++) {
								$tmp = "P".$i."_Con"; $tmp1 = "P".$i;
								$q = mysql_query("select `$tmp`,`$tmp1` from $table where Date = '$date_sub'; ") or die(mysql_error());
								$res = mysql_fetch_array($q);
								if($res[$tmp1] == 'ok' && $res[$tmp] == null ) {$remaining[$j] = "P".$i; $j++;} 
								}
							}
							
						else $remaining[$j] = $p[1];
							
						for($r = 1; $r<=count($remaining); $r++) {
							$tmp = "P".$r."_Con"; $tmp1 = "P".$r;
							$q = mysql_query("select `$tmp`,`$tmp1` from $table where Date = '$date_sub'; ") or die(mysql_error());
							$res = mysql_fetch_array($q);
							if($res[$tmp] == 'ok') { $uploaded[$j1]=$tmp1; $j1++;}
							if($res[$tmp1] == 'ok') { $confirmed[$j2]=$tmp1; $j2++;}
							}
						
						
						//print_r($remaining);
						if(count($uploaded) != 4) {
							
							$cou = 0;
							$str2 = "";
							
							for($r = 0; $r<count($remaining); $r++) {
								
								$period1 = $remaining[$r];
								$tmp = $period1."_Con"; 
								$tmp1 = $period1;
								$q = mysql_query("select $tmp, $tmp1 from  $table where Date = '$date_sub';") or die(mysql_error());
								$res = mysql_fetch_array($q);
								
								if($res[$tmp] == 'ok') {
									echo "<script>show_error('$period1 already confirmed ');</script>";
									}
								else if($res[$tmp1] != 'ok'){
									$str2 .= $period1." ";
									echo "<script>show_error('$str2 &nbsp;attendance not uploaded');</script>";
									}
								else {
									
									$dbname = $branchyear.'_Cache';
									$table = $p[0].'_Cache';
									//if(!mysql_select_db($dbname)) die(mysql_error());
									
									$class_total = mysql_num_rows(mysql_query("select `Id` from $table")) or die(mysql_error());
									
									$dbname = $branchyear.'_Attendance';
									$table = $p[0].'_Attendance';
									//if(!mysql_select_db($dbname)) die(mysql_error());
										
										
									$f = mysql_query("show columns from `$table` like '$date_sub';") or die(mysql_error());
									$val = (mysql_num_rows($f))?True:False;
									
									if(!$val) mysql_query("alter table `$table` add (`$date_sub` varchar(30) default '');") or die(mysql_error());
									insert_log($_SESSION['UserId']." added $date_sub to $table");
									
									$dbname = $branchyear.'_Attendance';
									$table = $p[0].'_Attendance';
									//if(!mysql_select_db($dbname)) die(mysql_error());		
									$q = mysql_query("select isnull (`$date_sub`) as Date from $table;") or die(mysql_error());
									$res = mysql_fetch_array($q);
									
									$strs = array(); $strs1 = array();
									
									if(!$res['Date']) {
										
										$dbname = $branchyear.'_Cache';
										$table = $p[0].'_Cache';
										//if(!mysql_select_db($dbname)) die(mysql_error());
											
										for($k=1;$k<=$class_total;$k++){
											$a12=mysql_query("Select `".$date_sub."_".$remaining[$r]."`  from `$table` where RNo='$k';") or die(mysql_error());
											$b12=mysql_fetch_array($a12);
											$strs[$k]=$remaining[$r]."_".$b12[0].",";
											}
										
										$dbname = $branchyear.'_Attendance';
										$table = $p[0].'_Attendance';
										//if(!mysql_select_db($dbname)) die(mysql_error());
											
										for($k=1;$k<=$class_total;$k++){
											$a12=mysql_query("Select `".$date_sub."`from `$table` where RNo='$k';") or die(mysql_error());
											$b12=mysql_fetch_array($a12);
											if($b12[$date_sub] == null) $strs1[$k] = $strs[$k];
											else $strs1[$k] = $b12[$date_sub].$strs[$k];
											}
										}
										
									$dbname = $branchyear.'_Attendance';
									$table = $p[0].'_Attendance';
									//if(!mysql_select_db($dbname)) die(mysql_error());
										
									for($k=1;$k<=$class_total;$k++){
										if(in_array($k,$exp[$p[0]])) continue;
										$a12=mysql_query("update $table set `".$date_sub."` = '".$strs1[$k]."' where RNo = '".$k."';") or die(mysql_error());}
										
									$dbname = $branchyear.'_TimeTable';
									$table = $p[0].'_TimeTable';
									//if(!mysql_select_db($dbname)) die(mysql_error());
										
										
									$dates1=getdate(strtotime($date_sub));
									//$date=$dates[$r];
									$day=substr($dates1["weekday"],0,3);
									
									$per = ($p[1] == 'all')? $remaining[$r]:$p[1];
									
									$ti=mysql_query("SELECT DayPeriod,$day from $table where DayPeriod = '".$per."';") or die(mysql_error());
									
									$subjects=array();	
									while($da=mysql_fetch_array($ti)){
										$subjects[$da[0]]=$da[1];}
									
									$dbname = $branchyear.'_Subjects';
									$table = $p[0].'_Subjects';
									//if(!mysql_select_db($dbname)) die(mysql_error());
										
									for($k=1;$k<=$class_total;$k++){
										if(in_array($k,$exp[$p[0]])) continue;
										$st = strtoupper(substr($strs[$k],-2,-1));
										$sub = $subjects[$per];
										$q = mysql_query("select `".$sub."_".$st."` from $table where RNo = '$k';") or die(mysql_error());
										$res = mysql_fetch_array($q);
										$subcount = $res[0]+1;
										$a12=mysql_query("update $table set `".$sub."_".$st."` = '".$subcount."' where RNo = '".$k."';") or die(mysql_error());
									}
									
									$dbname = $branchyear.'_Cache';
									$table = $p[0].'_Cache';
									//if(!mysql_select_db($dbname)) die(mysql_error());
									
									$q = mysql_query("alter table `$table` drop `".$date_sub."_".$per."`;");
									
									$dbname = $branchyear.'_Dates';
									$table = $p[0].'_Dates';
									//if(!mysql_select_db($dbname)) die(mysql_error());
										
									$q = mysql_query("update $table set `$tmp` = 'ok' where Date = '$date_sub';") or die(mysql_error());
									$cou++;
								}
							}
							
							if($cou == count($remaining) && $cou != 0) {
								$abz = count($remaining);
								$st = "";
								for($s=0;$s<$abz;$s++){
									if($s == $abz-1) $st .= $remaining[$s];
									else $st .= $remaining[$s].", ";
									}
								insert_log($_SESSION['UserId']." uploaded $st Attendance");
								echo "<script>show_success('$st attendance updated ');</script>";
								}
							else {
								if(in_array($p[1],$confirmed)) echo "<script>show_error('".$p[1]." already updated');</script>";
								if(in_array($p[1],$uploaded)) echo "<script>show_error('".$p[1]." attendance already confirmed');</script>";
								if($p[1] == 'all') echo "<script>show_error('".$p[1]." uploaded fields are already confirmed');</script>";
								}
						}
						else {
							$abz = count($confirmed);
							$st = "";
							for($s=0;$s<$abz;$s++){
								if($s == $abz-1) $st .= $confirmed[$s];
								else $st .= $confirmed[$s].", ";
								}
							 echo "<script>show_error('$st &nbsp;attendance not yet uploaded');</script>";
						}
					}
					unlink("assets/tmp/".$lockfile);	
				}
				}
				else {echo "<script>show_error('Invalid Date Sent');</script>";}
				}
			else {echo "<script>show_error('Invalid Input Sent');</script>";}
			}
		if ( preg_match($reg1,$p[0]) ){
			
			

			echo '<h4>Confirm Uploads </h4> <h5> &emsp;&emsp;&emsp; - &emsp; Below records need to be confirmed. </h5>';
			
			$qs=$p[0];
			$dbname = $branchyear.'_Dates';
			$table = $qs.'_Dates';
			//if(!mysql_select_db($dbname)) die(mysql_error());
				
			
			$new=mysql_query("SELECT `Date` FROM `$table` WHERE P1_Con IS NULL OR P2_Con IS NULL OR P3_Con IS NULL OR P4_Con IS NULL") or die(mysql_error());
			if(mysql_num_rows($new) == 0) {
				echo "<span class='text-error'><b>No records found</b></span>";
				}
			else {
				
			$dates = array(); $i = 0;
			while($res = mysql_fetch_row($new)) { $dates[$i] = $res[0]; $i++; }
		
			for($l=0;$l<count($dates);$l++){
			
				$dates1=getdate(strtotime($dates[$l]));
				$date=$dates[$l];
				$day=substr($dates1["weekday"],0,3);
				
				
				$dbname = $branchyear.'_TimeTable';
				$table = $qs.'_TimeTable';
				//if(!mysql_select_db($dbname))  die(mysql_error());
					
				$ti=mysql_query("SELECT DayPeriod,$day from $table;") or die(mysql_error());
				
				$subjects=array();	
				while($da=mysql_fetch_array($ti)){
					$subjects[$da[0]]=$da[1];}
			
				$p=array("P1_A"=>0,"P1_P"=>0,"P2_A"=>0,"P2_P"=>0,"P3_A"=>0,"P3_P"=>0,"P4_A"=>0,"P4_P"=>0);
				
				$dbname = $branchyear.'_Dates';
				$table = $qs.'_Dates';
				//if(!mysql_select_db($dbname)) die(mysql_error());
					
				$remaining = array() ; $j = 0;
				$remaining1 = array() ; $j1 = 0;
				$confirmed = array() ; $j2 = 0;
				$confirmed1 = array() ; $j3 = 0;
				
				for($i = 1;$i<=4;$i++) {
					
					$tmp = "P".$i; $tmp1 = "P".$i."_Con";
				
					$q = mysql_query("select ISNUll(`$tmp`) as `P$i`,ISNUll(`$tmp1`) as `P".$i."_C` from $table where Date = '$date' ") or die(mysql_error());
					$res = mysql_fetch_array($q);
					
					if($res["P".$i]) {$remaining[$j] = "P".$i; $j++;}
					else {$remaining1[$j1] = "P".$i; $j1++;}
					if($res["P".$i."_C"]) {$confirmed[$j2] = "P".$i; $j2++;}
					else {$confirmed1[$j3] = "P".$i; $j3++;}
					
				}
				
				$dbname = $branchyear.'_Cache';
				$table = $qs.'_Cache';
				//if(!mysql_select_db($dbname)) die(mysql_error());
				
				//print_r($confirmed);
				$a = $date."_";
				$q=mysql_query("SELECT * FROM $table") or die(mysql_error());
				while($q1=mysql_fetch_array($q)){
					for($i=0;$i<count($confirmed);$i++){
						$tmp2 = $a.$confirmed[$i];
						//print_r($q1);
						if($q1[$tmp2]=="A") $p[$confirmed[$i]."_A"]++;
						if($q1[$tmp2]=="P") $p[$confirmed[$i]."_P"]++;
						}

					}
//print_r($p);echo "<br>";

			
				if(count($confirmed1) != 0 ) {
					
					$dbname = $branchyear.'_Attendance';
					$table = $qs.'_Attendance';
					//if(!mysql_select_db($dbname))die(mysql_error());
					
					$q=mysql_query("SELECT `$date` FROM $table;") or die(mysql_error());
					
					while($res = mysql_fetch_array($q)){
						$z= explode(",",$res[$date],-1);
						for($m=0;$m<count($z);$m++) {$p[$z[$m]]+=1;}	

						}
				}
//print_r($p);
				
				$a = $date."_P";
				$li1 = "?$qs/all/$date";
				
				echo <<<main
				<div id="Date$a">
					<ul class="nav nav-pills span8">
						<li><h5><i class="icon-calendar"></i> $date &nbsp;@&nbsp;$qs</h5> </li>
main;
				echo <<< main
				<li class="pull-right"><h6><span class="text-success"><i class="icon-ok-circle"></i> <a href="$li1" class="text-success">Confirm All</a></span> &emsp;</h6></li>
main;
				echo <<< main
				</ul>
				<div class="row">
					<div class="span8">
					<table class="table  table-hover table-bordered"  style="padding:0px;">
						<thead>
							<tr>  <th style="text-align:center;"> Subject </th>  <th style="text-align:center;" class="span1"> Period  </th> 
							<th class="span1" style="text-align:center;"> Absents </th> <th class="span1" style="text-align:center;"> Presents </th> 
							 <th class="span4" style="text-align:center;"> Options</th> </tr>
						</thead>
						<tbody>
main;
				for($j=1;$j<=4;$j++){
					
					if(!in_array("P".$j, $remaining)){
					
					echo '<tr><td style="text-align:center;">'.$subjects["P".$j].'</td><td style="text-align:center;">'."P".$j.'</td> 
							<td style="text-align:center;" class="text-error">'.$p["P".$j."_A"].'</td> <td style="text-align:center;" class="text-success"> '.$p["P".$j."_P"].' </td> 
							<td style="text-align:center;">';
					
					if(in_array("P".$j, $confirmed1)) { echo ' <span class="text-success" >Confirmed</span>';}
					else {
						$li = "?$qs/P$j/$date";
						$li1 = "./today1.php?$date/$qs";
						echo ' <span class="text-success" ><i class="icon-ok-circle"></i> <a href="'.$li.'" class="text-success">Confirm </a></span> &emsp;	';
						echo ' <span class="text-error" ><i class="icon-edit"></i> <a href="'.$li1.'" class="text-error">Edit </a></span>';
						}
					echo ' &emsp; <span class="text-info"><i class="icon-globe"></i> <a href="#'.$a.$j.'" class="text-info"  data-toggle="modal">Browse</a> </span></td> </tr>';
					}
				}
						 
				echo <<<main
						</tbody>
					</table>
					</div>
				</div>
				</div>
				<br>
				
main;
				for($j=1;$j<=4;$j++){
					if(!in_array("P".$j, $remaining)){
									
						echo <<<confirm
						\n<div id="$a$j" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="useridlabel" aria-hidden="true">
							<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 id="useridlabel">$qs @ P$j Attendance Details</h4>
							</div>
						<div class="modal-body">
							<div class="row">
								<div class="span6">
									<table class="table  table-hover table-bordered" >
										<tbody>
										<tr> <td class="span2" style="text-align:center"> Date </td> <th class="text-warning span2" style="text-align:center"> $date</th> 
										<td class="span2" style="text-align:center"> Subject </td> <th class="text-success span2" style="text-align:center"> {$subjects["P".$j]}&nbsp;</th> </tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="row">
								<div class="span6">
								<table class="table  table-hover table-bordered" >
								<thead>
									<tr> <th class="span2"  style="text-align:center"> Period # </th> <th class="span3"> Presents  </th> <th class="span3"> Absents  </th> </tr>
								</thead>
								<tbody>
									<tr><td style="text-align:center;" >P$j</td>
confirm;
						$dbname = $branchyear.'_Dates';
						$table = $qs.'_Dates';
						//if(!mysql_select_db($dbname)) die(mysql_error());
							
						$q = mysql_query("select ISNULL(`P".$j."_Con`) as `P$j` from $table where Date = '$date'; ") or die(mysql_error());
						$row = mysql_fetch_array($q);
						
						if(!$row["P".$j]) {
							
							$period = "P".$j;
							
							$dbname = $branchyear.'_Attendance';
							$table = $qs.'_Attendance';
							//if(!mysql_select_db($dbname)) die(mysql_error());
							
							$q = mysql_query("select RNo,`$date` from $table;")  or die(mysql_error());
							
							$Rnos=array("Absents"=>array(),"Presents"=>array());
							$aindex=0;$pindex=0;
							
							while($res = mysql_fetch_array($q)){
								$z= explode(",",$res[$date]);
								for($m=0;$m<count($z);$m++) {
									$y = explode("_",$z[$m]);
									if($y[0]==$period) {
										if($y[1] == "A") { $Rnos['Absents'][$aindex] = $res[0]; $aindex++;}
										else { $Rnos['Presents'][$pindex] = $res[0]; $pindex++; }
										}
									}
								}
							}
						else {
						
							$dbname = $branchyear.'_Cache';
							$table = $qs.'_Cache';
							//if(!mysql_select_db($dbname)) die(mysql_error());
									
							$q3=mysql_query("SELECT RNo, `".$a.$j."` FROM $table") or die(mysql_error());
							
							$Rnos=array("Absents"=>array(),"Presents"=>array());
							$aindex=0;$pindex=0;
							
							while($individual=mysql_fetch_array($q3)){
								if($individual[$a.$j]=="A"){ $Rnos["Absents"][$aindex]=$individual["RNo"];$aindex++;}
								if($individual[$a.$j]=="P"){$Rnos["Presents"][$pindex]=$individual["RNo"];$pindex++;}
							}
						}
						
						$pc = count($Rnos["Presents"]);$ac = count($Rnos["Absents"]);$tot=$pc+$ac;
						
						echo "<td>";
						
						for($i=0;$i<$pc;$i++){
							if($i%8==0 && $i != 0) echo "<br>";
							if($i==$pc-1) echo $Rnos["Presents"][$i];
							else echo $Rnos["Presents"][$i].",";				
						}
						
						echo "</td><td>";
						
						for($i=0;$i<$ac;$i++){
							if($i%8==0 && $i!=0) echo "<br>";
							if($i==$ac-1) echo $Rnos["Absents"][$i];
							else echo $Rnos["Absents"][$i].",";				
						}
						
						echo <<<confirm1
							</td></tr>
								<tr>
									<td style="text-align:center;" >Total (<b>$tot</b>)</td>
									<td style="text-align:center;" class='text-success'> $pc</td>
									<td style="text-align:center;" class='text-error'>$ac</td>
									</tr>
								</tbody>
							</table>
							</div>
						</div>
						</div>
						<div class="modal-footer">
						<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Close</button>
						</div>
					</div>
confirm1;
	
						}	
					} 
				}
			}
			
			echo "</div></div>";
			echo "<div class='span3'>";
			go_home();
			
			echo "<ul class='nav nav-tabs nav-stacked'>";
			for($i = 1; $i <=$classno ; $i++){ 
				$branch= $globalbranch;
				$cls = $branch.$i;
				$table = $cls.'_Dates';
					
				$remaining = array() ; $j = 0;
				$q = mysql_query("select * from $table ; ") or die(mysql_error());
				while($res = mysql_fetch_array($q)) {
						if($res["P1_Con"] != 'ok' or $res["P2_Con"] != 'ok' or $res["P3_Con"] != 'ok' or $res["P4_Con"] != 'ok'  ){
							$remaining[$j++]=$res['Date'];}
					}
							
				$str1 = (count($remaining) != 0 )?"<i class='icon-remove pull-right text-error' style='padding-top:5px;'></i>":"<i class='icon-ok pull-right text-success' style='padding-top:5px;'></i>";
				//echo $str1;
				echo <<< a
				<li><a href="?$branch$i">$branch$i<i class="icon-chevron-right pull-left" style="padding-top:5px;"></i> $str1 </a> </li>\n
a;
			}
			
			echo "</ul>";
			
			
			
			echo "</div></div></div>";   
			display_footer();
			echo "\n</body>\n</html>";
			}
				
		else{ 
			echo "<script type='text/javascript'>document.location.href='404.php';</script>";
			}
		
	}
}

homepage('Attendance Portal - Confirm Attendance Deatils ')
?>
