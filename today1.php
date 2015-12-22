<?php
session_start();
ob_start();
require "functions.php";

function generate_attendance($title) {
    if(!check_login() ) header('location:./login.php');
    else {
		
		include('config/globals.php');

		$qs1 = $_SERVER['QUERY_STRING'];
		
		$reg1="/^[0-9]{2}-[0-9]{2}-[0-9]{4}$/";
		$reg2 = "/^".$globalbranch."[1-".$classno."]{1}$/";
		
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
					
					$p = $qs[1];
					
					$userid = $_SESSION['UserId'];
					$q = "select Branch,Class,Position from $table where Id = '$userid'";
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
						display_error("Error : Not allowed to access  $class1 details");
						die();
						}
					}
					
					$da = $qs[0];
					$date = $qs[0];
				
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
						<div id="error" style="display:none;margin-top:10px;"></div>
						
a;
						$table='';
						//$spread='';
						
						
						$dbname = $branchyear.'_Attendance';
						$table = $branch.$class.'_Attendance';
						//if(!mysql_select_db($dbname)) die(mysql_error());
						$class_total = mysql_num_rows(mysql_query("select `Id` from $table"));
						$sample = mt_rand(1,$class_total);
						
						
							
						echo <<< a
						
						\n\t\t
								<div class="well well-large" style="background:#FFF;">
a;
						
					
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
						while($da1=mysql_fetch_array($ti)){$subjects[$da1[0]]=$da1[1];}	
						//print_r($subjects);
						//$sub = $subjects[$p];
						
							
						//echo "<h5 style='text-align:center;'> Attendance Submission Details - $branch&nbsp;$class - $date</h5><br>";
						echo <<< a
						
							<div id="step1" class="span5">     
								<h5 class='text-info'>Daily  Attendance Submission Details for $date </h5>
								<h6> &emsp;&emsp;&emsp; - &emsp; Listing Data submitted from CR @ $branch&nbsp;$class </h6><br>
							</div>
							<div id="side1" class="span6" >
								<h6 class='text-right'><a href='./?sub'><i class='icon-home'></i> Home&nbsp;</a> </h6>
a;
						if($row['Position'] == "BA") {
							echo <<< a
								<h6 class='text-right'>
a;
							for($cl = 1;$cl<=$classno;$cl++)	
								{echo "<a href='?$date/$globalbranch$cl'>$globalbranch$cl</a>&emsp;";}
								echo <<< a
								</h6>
								
a;
							}
							
					
						$dbname = $branchyear.'_Dates';
						$table = $branch.$class.'_Dates';
						//if(!mysql_select_db($dbname)) die(mysql_error());
						
						$q = mysql_query("select Date from $table where Date = '$da'") or die(mysql_error()) ;
						
						
						
						if(count($remaining1) != 0  && mysql_num_rows($q) != 0) {
							
						$table = $branch.$class."_Dates";
						$q = mysql_query("select SNo from $table where Date = '$date'") or die(mysql_error());
						if(mysql_num_rows($q) == 0) {
							echo "<script>show_error('Attendance has been not yet uploaded ');</script>";
							
						}
						
						$sn = mysql_fetch_array($q) or die(mysql_error());
						$sn1 = (($sn['SNo']) < 5 )? 0:($sn['SNo']-5);
						
						echo '<ul class="nav nav-pills pull-right">
							  <li class="dropdown" style="margin-top:2px;">
							  <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
							   <i class="icon-calendar"></i> Date - '.$date.' &nbsp;<b class="caret"></b></a>
									<ul class="dropdown-menu">';
						
						//echo $sn1;
						$q = mysql_query("select Date from $table  order by SNo limit $sn1,5") or die(mysql_errno());
						while($res = mysql_fetch_array($q))
							{$st1 = ($res['Date'] == $date ) ? "active":" ";
							echo "<li class='$st1'><a href='?".$res['Date']."/".$branch.$class."'>".$res['Date']."</a></li>";
							}
						echo 	'</ul>
							  </li>
							</ul>';
							echo <<< a
								</div>
								
							
a;
							
						$html = "";
						echo 
						 
						 '<table class="table  table-hover table-bordered "  style="padding:0px;">
									<thead>
										<tr> 
											<th style="text-align:center;"  rowspan="2" valign="top"> RNo  </th> 
											<th style="text-align:center;"  rowspan="2" valign="top"> Id  </th> 
											<th  style="text-align:center;"  > P1 </th> <th  style="text-align:center;" > P2 </th>
											<th  style="text-align:center;"  > P3 </th>  <th  style="text-align:center;"  > P4 </th> 
											<th  style="text-align:center;" rowspan=2> Presents </th> <th rowspan=2 style="text-align:center;"  > Absents </th>
										</tr>
										<tr> 
											<th  style="text-align:center;"  > '.$subjects['P1'].' </th> <th  style="text-align:center;" > '.$subjects['P2'].' </th>
											<th  style="text-align:center;"  > '.$subjects['P3'].' </th>  <th  style="text-align:center;"  > '.$subjects['P4'].' </th> 
											
										</tr>
										
									</thead>
									<tbody>';
						//$spread.=" \t \t P1  \t P2 \t  P3 \t P4 \t \t \t\nRno\tID\t".$subjects['P1']."\t".$subjects['P2']."\t".$subjects['P3']."\t".$subjects['P4']."\tPresents\tAbsents\n";
						$html .= "<thead><tr> 
											<th rowspan=\"2\" width=8%> RNo  </th> 
											<th rowspan=\"2\" width=17%> ID  </th> 
											<th  > P1 </th> <th > P2 </th>
											<th  > P3 </th>  <th  > P4 </th> 
											<th rowspan=2 width=14%> Presents </th> <th rowspan=2  width=14%> Absents </th>
										</tr>
										<tr> 
											<th  > {$subjects['P1']}</th> <th >{$subjects['P2']}</th>
											<th  > {$subjects['P3']} </th>  <th  > {$subjects['P4']} </th> 
										</tr></thead>";
						$Rnos=array();$uid = array();
						$dbname = $branchyear.'_Attendance';
						$table = $branch.$class.'_Attendance';
						//if(!mysql_select_db($dbname)) die(mysql_error());
						$q = mysql_query("select Id, RNo from $table;") or die(mysql_error());
						while($res = mysql_fetch_array($q)) $uid[$res['RNo']]=$res['Id'];
						for($s=0;$s<count($remaining1);$s++) {
							$p1=$remaining1[$s];
							if(in_array($p1,$confired1)){	
								$period = $p1;
								$dbname = $branchyear.'_Attendance';
								$table = $branch.$class.'_Attendance';
								//if(!mysql_select_db($dbname)) die(mysql_error());
								
								$q = mysql_query("select RNo,Id,`$date` from $table;")  or die(mysql_error());
								
								$aindex=0;$pindex=0;
								
								while($res = mysql_fetch_array($q)){
									//$uid[$res['RNo']]=$res['Id'];
									$z= explode(",",$res[$date]);
									for($m=0;$m<count($z);$m++) {
										$y = explode("_",$z[$m]);
										if($y[0]==$period) {
											if($y[1] == "A") {$Rnos[$p1]['Absents'][$aindex] = $res[0];$aindex++;}
											else {$Rnos[$p1]['Presents'][$pindex] = $res[0];$pindex++;}
											}
										}
									}
								}
								
							else {
								//$da = date('d-m-Y');
								$a = $da.'_'.$p1;
								$dbname = $branchyear.'_Cache';
								$table = $branch.$class.'_Cache';
								//if(!mysql_select_db($dbname)) die(mysql_error());
								
								$q3=mysql_query("SELECT RNo, `".$a."` FROM $table") or die(mysql_error());
								$aindex=0;$pindex=0;
								
								while($individual=mysql_fetch_array($q3)){
									if($individual[$a]=="A"){$Rnos[$p1]["Absents"][$aindex]=$individual["RNo"];$aindex++;}
									if($individual[$a]=="P"){$Rnos[$p1]["Presents"][$pindex]=$individual["RNo"];$pindex++;}
									}
							}
						
						}
						$tot = array('A' => 0, 'P' => 0);
						//print_r($uid);
						for($w=1;$w<=$class_total;$w++){
							$tr2 =  
								 '<tr >  
									<td style="text-align:center;">'.$w.'  </td>
									<td style="text-align:center;"> '.$uid[$w].'  </td>';
							echo $tr2;
							//$spread.="$w \t {$uid[$w]} \t";
							$html .= $tr2;

							$pc=0;$ac=0;
							for($l=1;$l<=4;$l++){
								$pl= "P".$l;
								if(in_array($pl,$remaining1)) {
									$edit_error = ""; $edit_success = "";
									if(check('BA') or check('CR')) {
										//echo $pl; print_r($confired1);
										if(!in_array($pl,$confired1)) {
											//echo "i am in";
											//echo $pl;print_r($confired1);echo "<br>";
											$fun = "";
											if(array_key_exists("Absents",$Rnos[$pl]) && in_array($w,$Rnos[$pl]['Absents'])){
												$fun = "update_rno('$date','$pl','$w','P','$class');";
												}
											else {
												$fun = "update_rno('$date','$pl','$w','A','$class');";
												}
											$edit_error = '|  <i class="icon-edit text-success" onclick="'.$fun.'" style="cursor:pointer;"></i>';
											$edit_success = '|  <i class="icon-edit text-error" onclick="'.$fun.'" style="cursor:pointer;"></i>';
										}
									}
									else {$edit_error = ""; $edit_success = "";}
									if(array_key_exists("Absents",$Rnos[$pl]) && in_array($w,$Rnos[$pl]['Absents'])) {echo '<td style="text-align:center;" ><b class="text-error"> <i class="icon-remove"></i>  </b> '.$edit_error.' </td>';$ac++;$html.="<td><font color=\"darkred\">&#x2716;</font></td>";}
									else {echo '<td style="text-align:center;" ><b class="text-success"> <i class="icon-ok"></i> </b> '.$edit_success.'</td>';$pc++;$html.="<td><font color=\"green\">&#x2714;</font></td>";}	
									}
								else {echo '<td></td>'; $html .= '<td></td>';//$spread.=" \t";
			}
									
								}
							$tot['A']+=$ac;$tot['P']+=$pc;
							echo <<< a
									<td style="text-align:center;" class="text-success"><b> $pc </b> </td> 
									<td style="text-align:center;" class="text-error"><b> $ac </b></td>  
								</tr>
								
a;
						$html .= "<td><font color=\"green\"><b>$pc</b></font></td><td><font color=\"darkred\"><b>$ac</b></font></td></tr>";
						//$spread.="$pc \t $ac \n";
						}
						
						echo "<tr><td colspan=6 style='text-align:center;'><b>Total</b></td><td style='text-align:center;' class='text-success'><b>".$tot['P']."</b></td><td style='text-align:center;' class='text-error'><b>".$tot['A']."</b></td></tr>";
						$html .= "<tr><th colspan=6 style=\"text-align:center;\"> <b>Total</b> </th><td><b><font color=\"green\">".$tot['P']."</font></b></td><td><b><font color=\"darkred\">".$tot['A']."</font></b></td></tr>";
						//$spread.="\t \tTotal\t \t \t \t{$tot['P']} \t {$tot['A']}";
						
						echo "</tbody></table>";
							
						
						if($row['Position']=="BA"){
						echo <<< a
						<form action='print.php' method='post' name='abc'>
						<input type='hidden' name='Title1' value="$branch $class - Daily Report">
						<input type='hidden' name='Table1' value='$html'>
					<center><button type="submit" class="btn btn-primary"><i class='icon-download-alt'></i>&nbsp;&nbsp;Save as PDF</button></center>
						</form>
a;
						echo <<< b
						<form action='excel.php' method='post' name='abc'>
						<input type='hidden' name='Title1' value="$branch $class - Daily Report">
						<input type='hidden' name="sheet" value='$html'>
					<center><button type="submit" class="btn btn-primary"><i class='icon-download-alt'></i>&nbsp;&nbsp;Save as Excel Sheet</button></center>
						</form>
b;
			}
						echo <<< a
								</div>
							</div>
							
a;
					}
						else echo "</div><br><h6><span class='text-error'><br><br><br>No Submissions found till now ...</span></h6><br>";
						
						echo "</div></div>";
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

	

generate_attendance('Attendance Portal - Daily Attendance ');
?>

