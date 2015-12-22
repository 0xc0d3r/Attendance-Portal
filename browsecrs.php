<?php
session_start();
require("functions.php");

function changecr($title) {
	
/* checks the user login and  
 * redirecting user to login page */
 
if(!check_login()) header('location:login.php');
else {
	
	include('config/globals.php');
	
	/* taking the query string by using the regular expression */
	$p = $_SERVER['QUERY_STRING']; 
	$reg = "/^".$globalbranch."[1-".$classno."]{1}$/";
	$reg1 = "/^all$/";
	if(preg_match($reg,$p) or preg_match($reg1,$p) ) {
		/* including the necessary configuration php files */
		include 'config/db.php';
		include 'config/settings.php';	
		/* defining the table names  */
		$dbname = $branchyear.'_Users';
		$table = $branchyear.'_CRs';
		$table1 = $branchyear.'_Students';
		
		//if(!mysql_select_db($dbname)) die(mysql_error());
			
		//$branch = $row['Branch']; its not required
		$class = substr($p,-1);
		/* Getting the users details from joining the two tables */
		if($p == 'all') $q = "select $table.Name as Name, $table.Gender as Gender, $table.Id as Id,PhoneNo, `$table1`.`Class` as `Class` from $table,$table1 where `$table`.`Id` = `$table1`.`Id` order by `$table1`.`Class` Desc;";
		else $q = "select $table.Name as Name, $table.Gender as Gender, $table.Id as Id,PhoneNo from $table,$table1 where `$table`.`Id` = `$table1`.`Id` and `$table`.`Class` = '$class';";
		$res = mysql_query($q) or die(mysql_error());
		
		echo "<!DOCTYPE html>\n<html>\n";
		/* including the header java scripts and css files  */
		display_headers($title);
		echo "\n<body>";
		/* displayin the header menu */
		menu();
		$br = ($p == 'all')?$globalbranch :$p;
		$cls1 =  ($p == 'all')? '<th style="text-align:center;" class="span1"> Class </th>' : "" ;
		echo <<< a
		<div class='container'>
			<div id="error" style="display:none;"></div>
			<div class='row'>
			<div class='span9'>
				<div class="well well-large" style="background:#FFF;">
				<h5 class='text-info'>CRs @ $br  </h5>
				<h6> &emsp;&emsp;&emsp; - &emsp; Listing all CRs in $br  </h6><br>
				<table class="table  table-hover table-bordered "  style="padding:0px;">
				<thead>
					<tr> <th class="span1" style="text-align:center;" > Id </th><th style="text-align:center;" class="span3"> Name   </th> $cls1
					<th style="text-align:center;" class="span1"> Gender  </th>  <th class="span1" style="text-align:center;"> Contact No </th> </tr>
				</thead>
				<tbody>
a;
		while($row = mysql_fetch_array($res)) {
			$gender=$row['Gender'];
			$d = $dict[$gender.'1'];
			$id=$row['Id'];
			$contact=$row['PhoneNo'];
			$cls =  ($p == 'all')? '<td style="text-align:center;">'.$globalbranch." ".$row['Class'].'</td>' : "" ;
			$name = ucwords(strtolower($row['Name']));
			echo <<< a
					
			<tr >  
			<td style="text-align:center;" > $id </td> 
			<td > $name </td>
			$cls
			<td style="text-align:center;"> $d  </td> 
			<td style="text-align:center;" class="text-success"><b> $contact </b> </td>  
			</tr>
a;
		}
		
		echo <<< a
				</tbody>
			   </table>
			</div>	
			</div>
			<div class='span3'>
a;
		go_home();
		echo '<ul class="nav nav nav-tabs nav-stacked"> <li><a href=\'?all\'>All CRs &nbsp; <i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li></ul>';
		cr_classes($classno,$globalbranch);
		
		echo "</div></div></div>";   
		display_footer();
		echo "\n</body>\n</html>";
		}
	else echo "<script type='text/javascript'>document.location.href='404.php';</script>";	
    }
}

changecr("Attendance Portal - Browse CRs ");

?>
