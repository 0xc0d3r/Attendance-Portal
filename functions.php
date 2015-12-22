<?php
@session_start();
ob_start();
date_default_timezone_set('Asia/Kolkata');

function check_login() {
    if(isset($_SESSION['UserId'])) {
        return true; 
    }
    else {
        //header("Location:login.php");
        return false;
    }
}

function check_day() {
	$da =  date('d-m-Y');
    $dates1=getdate(strtotime($da));
	$day=substr($dates1["weekday"],0,3);
	if($day == "Sun" or $day == "Sat") return true;
	else return false;
}

function display_error($msg)
{
	echo "<!DOCTYPE html>\n<html>\n";
	display_headers($title);
	echo "\n<body>";
	menu();
	echo '<div class="container" style="margin-top:-10px;"><div id="error" style="display:none;"></div></div>';
	echo "<script>show_error('".$msg."');</script>";
	echo "</body></html>";
}

function check_day1($da) {
	//$da =  date('d-m-Y');
    $dates1=getdate(strtotime($da));
	$day=substr($dates1["weekday"],0,3);
	if($day == "Sun" or $day == "Sat") return true;
	else return false;
}

function check_day2($da,$cls) {
	include 'config/db.php';
	$table = $cls."_Dates";
	$q = mysql_query("select Date from $table order by SNo");
	$res = mysql_fetch_array($q)['Date'];
	//echo $res;
	$dif = strtotime($da) - strtotime($res);
	//echo $dif;
	if($dif<0) return true;
	else false;
}

function check($str) {
	if(!check_login()) {
		return false;
		}
	else {
		include 'config/db.php';
		include 'config/settings.php';
		include 'config/globals.php';
		
		$dbname = $branchyear.'_Users';
		$table = $branchyear.'_Students';
		//if(!mysql_select_db($dbname)) die(mysql_error());
		
		$userid = $_SESSION['UserId'];
		$q = "select Position from $table where Id = '$userid'";
		$res = mysql_query($q) or die(mysql_error());
		$row = mysql_fetch_array($res);
		$position = $row['Position'];
		
		if($position == $str) return true;	
		else return false;
			
		}
	}




function display_headers($title){
    echo <<< head
<head>
	<title>$title</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" media="screen">
	<link rel="stylesheet" type="text/css" href="assets/css/fontawesome/css/font-awesome.min.css" media="all" /> 
	<link rel="stylesheet" type="text/css" href="assets/css/application.css" media="screen">

	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/validate.js"></script>
</head>
head;
    
    include 'config/db.php';
	include 'config/globals.php';
	$dbname = $branchyear.'_Logs';
    $table = $branchyear.'_Pageviews';
    //if(!mysql_select_db($dbname)) die(mysql_error());
    $visitor = check_login() ? $_SESSION['UserId']:"Guest";
    $url = $_SERVER['REQUEST_URI'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $datime = date("h:i:s A, d-m-Y");
    mysql_query("insert into `$table`(`Path`,`Visitor`,`DateTime`,`IP`) values ('$url','$visitor','$datime','$ip');") or die(mysql_error());    
}

function insert_log($action){
	include 'config/db.php';
	include 'config/globals.php';
	$dbname = $branchyear.'_Logs';
    $table = $branchyear.'_Logs';
    //if(!mysql_select_db($dbname)) die(mysql_error());
    $visitor = check_login()?$_SESSION['UserId']:'Guest';
    $url = $_SERVER['REQUEST_URI'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $datime = date("h:i:s A, d-m-Y");
    mysql_query("insert into `$table`(`Id`,`Location`, `Action`, `DateTime`,`IP`) values ('$visitor','$url','$action','$datime','$ip');") or die(mysql_error());
}


function display_footer(){
    echo <<< head
		<div style='position:relative;'>
        <div class="container" >
            <div id="footer" class="tabbable tabs-below">
                <ul class="nav nav-tabs">
                    <li ><h6>&copy; 2013&emsp;<a href="http://10.11.2.99/" >Dept. of CSE </a>, &emsp;<a href="http://www.rgukt.in/"  >IIIT Nuzvid </a> </h6></li>
                    <li class="pull-right">
                    <h6><a href="./?sub"><i class="icon-home"></i> Home </a> &emsp;<a href="developers.php" ><i class="icon-bookmark"></i> Contact Us</a>
                    &emsp;<a href="./feedback.php" ><i class="icon-magic"></i> Feedback</a> 
                    </h6></li>
                </ul>
            </div>
        </div>
        </div>
head;
    //@mysql_close($con);
}


function menu1($link1, $name1,$icon){
	echo <<< menu
	<!-- Fixed navbar -->
	<div class="navbar navbar-fixed-top navbar-inverse" style='margin-top:-2px;'>
	  <div class="navbar-inner">
		<div class="container">
			<div class="nav-collapse collapse">
				<ul class="nav">
					<li class='active'><a class="brand " href="./?sub" ><i class='icon-cloud'></i> Attendance Portal </a></li>
				</ul>
				<ul class="nav pull-right">
					<li class='active' style='margin-top:2px;'><a href="$link1" ><i class="icon-$icon"></i>&nbsp; $name1 &nbsp; </a></li>
				</ul>
			</div>
		</div>
	  </div>
	</div>
	<!-- end of fixed Nav bar--> 
menu;
}

function menu(){
    
    include 'config/db.php';
    include 'config/settings.php';
    include 'config/globals.php';
    $dbname = $branchyear.'_Users';
    $table = $branchyear.'_Students';
    
    
    //if(!mysql_select_db($dbname)) { die(mysql_error()); }
    $userid = $_SESSION['UserId'];
    $q = "select RNo,Name,Gender,Branch,Class,Picture,PhoneNo,Position from $table where Id = '$userid'";
    $res = mysql_query($q) or die(mysql_error());
    $row = mysql_fetch_array($res);
    $username = $dict[$row['Gender']."2"]." ".ucwords(strtolower($row['Name']));
    $rno = $row['RNo'];
    $branch = $row['Branch'];
    $class = ($row['Position'] != "BA" )?$row['Class']:1;
    $img = $row['Picture'];
    $contactno = ($row['PhoneNo'] != 0 )?$row['PhoneNo']:"N/A";
    $ad = ($row['Position'] == "BA" )?"$branch":"$branch $class ";
    $position = $dict[$row['Position']]." @ $ad";
    $cr = ($row['Position'] != "BA" )?$branch.$class:"all";
	
echo <<< head
    <!-- Fixed navbar -->
    <div class="navbar navbar-fixed-top navbar-inverse" id='men1' style='margin-top:-2px;'>
      <div class="navbar-inner">
      	<div class="container">
          	<div class="nav-collapse collapse">
           	<ul class="nav">
           	<li class='active'><a class="brand" href='./?sub'><i class='icon-cloud'></i> Attendance Portal</a></li></ul>
            <ul class="nav">
              <li class="dropdown" style='margin-top:2px;'><a href="#" class="dropdown-toggle" data-toggle="dropdown">People &nbsp;<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="./browsestudents.php?$branch$class/1">Students</a></li>
                      <li><a href="./browsecrs.php?$cr">All CRs</a></li>
                      <!--<li><a href="#">Faculty</a></li>-->
                    </ul>
              </li>
            </ul>
head;
	if($row['Position'] == "BA") {
		echo <<< head
		<ul class="nav">
              <li class="dropdown" style='margin-top:2px;'><a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin &nbsp;<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="./displayfeedback.php?1">Feedback</a></li>
                    </ul>
              </li>
            </ul>
head;
		}
	if($row['Position'] == "BA") {
		echo <<< head
		<ul class="nav">
              <li class="dropdown" style='margin-top:2px;'><a href="#" class="dropdown-toggle" data-toggle="dropdown">Classes &nbsp;<b class="caret"></b></a>
                    <ul class="dropdown-menu">
head;
         for($i=1;$i<=$classno;$i++) echo '<li><a href="./?'.$globalbranch.$i.'/sub">'.$globalbranch.$i.'</a></li>';
        echo <<< head
                    </ul>
              </li>
            </ul>
head;
		}
	echo <<< head
            
           	<ul class="nav pull-right">
              <li class="dropdown" style='margin-top:2px;'><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user "></i>&nbsp; $userid &nbsp; <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="#profile" data-toggle="modal"><i class="icon-edit"></i>&nbsp; Profile</a></li>
                      <li><a href="logout.php"><i class="icon-off"></i>&nbsp; Logout</a></li>
                    </ul>
              </li>
            </ul>
            
          	</div>
        </div>
      </div>
    </div>
    <!-- end of fixed Nav bar-->
    <!-- profile -->
    <div id="profile" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="useridlabel" aria-hidden="true">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 id="useridlabel">$username</h4>
        </div>
        <div class="modal-body">
            <div class="row">
            	<div class="span2">
                    <img src="$img" class="pull-right img-polaroid" style="height:140px; width:130px;">
                </div>
                <div class="span4">
                	<table class="table table-hover table-striped table-bordered">
                    <tbody>
                    <tr><td class="span2">Id </td> <td>$userid 
head;
			if($row['Position'] != "BA") 
                    echo "[$rno]";
        echo <<< head
					</td> </tr>
                    <tr><td>Class </td> <td>$branch
head;
			if($row['Position'] != "BA") 
                    echo "$class";
        echo <<< head
        </td> </tr> 
                    <tr><td>Position </td> <td>$position</td> </tr>  
                    <tr><td>Contact No :</td> <td>$contactno</td> </tr> 
                    </tbody>
                    </table>
                </div>
                
            </div>
        </div>
        <div class="modal-footer">
        <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
    </div>
    <!--end of profile -->    
head;

}





function splash() {
	include 'config/globals.php';
	echo <<<abcd
    <div class="row">
			<div class="span2">
				<img src="assets/img/1.jpeg" class="pull-right" style="height:150px; width:130px;">
			</div>
			
			<div class="span6">
				<h4>Welcome to Attendance Portal for $globalbranch $globalyear</h4>
					<h6>&emsp;&emsp;&emsp; - &emsp; Browse all details about students attendances.</h6>
					<h6>&emsp;&emsp;&emsp; - &emsp; Check your Notifications and Requests regularly </h6> 
					<h6>&emsp;&emsp;&emsp; - &emsp; All Statistics are generated from each class CR (s) submissions.</h6> 
					<h6>&emsp;&emsp;&emsp; - &emsp; For any Complaints or Suggestions contanct your respective CR (s).</h6>
			</div>
			
    </div>
		<br>
abcd;
}

function go_home(){
	echo '<ul class="nav nav-tabs nav-stacked">';
	echo '<li><a href="./?sub">Back to Home <i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>';
	echo "</ul><!-- site admin -->";
}

function sidepanel() {
	
	include 'config/db.php';
    include 'config/settings.php';
    include 'config/globals.php';
       
    $dbname = $branchyear.'_Users';
    $table = $branchyear.'_Students';
    //if(!mysql_select_db($dbname)) die(mysql_error());
    
    $userid = $_SESSION['UserId'];
    $q = "select Position, Branch, Class from $table where Id = '$userid'";
    $res = mysql_query($q) or die(mysql_error());
    $row = mysql_fetch_array($res);
	$type = $row['Position'];
	//echo $type;
	$class = ($type!="BA")?$row['Class']:1;
	$branch = $row['Branch'];
	$branch1 = $branch."1";
	
	$branch2 = $branch.$class;
	
	$dbname = $branchyear.'_Logs';
    $table = $branchyear.'_Notifications';
    //if(!mysql_select_db($dbname)) die(mysql_error());
    $date = date('d/m/Y');
    $to = $branch2."@";
    $To = $to."Students";
    if($type == 'S') {
    	$query = mysql_query("SELECT COUNT(`SNo`) FROM ".$table." WHERE DateTime like '$date%' and (`To`='$To' or `To`='all');") or die(mysql_error());
    	$nc = mysql_fetch_array($query);
    	$new_notifications = $nc[0];
    }
    if($type == 'CR') {
    	$TO = $to."CRs";
    	$query = mysql_query("SELECT COUNT(`SNo`) FROM ".$table." WHERE DateTime like '$date%' and (`To`='$TO' or `To`='$To' or `To`='all' or `To`='allcrs');") or die(mysql_error());
    	$nc = mysql_fetch_array($query);
    	$new_notifications = $nc[0];
    }//x/im?wsc=hg&source=wax&u=http://www.rgukt.in&ei=80H3Uc2gCKifiAf6iYB4&ct=im_without_mcd
		if($type == 'BA' or $type == 'SA') {
    	$TO = $to."CRs";
    	$query = mysql_query("SELECT COUNT(`SNo`) FROM ".$table." WHERE DateTime like '$date%';") or die(mysql_error());
    	$nc = mysql_fetch_array($query);
    	$new_notifications = $nc[0];
    }
	
	$notifications='';
	if($new_notifications > 0)
		$notifications .= '<span class="label label-important"> '.$new_notifications .'</span> ';
	
	
	$new_feedback = 1;
	
	$feedback = '<span class="label label-important"> '.$new_feedback  .'</span> ';

$date = $date = date('d-m-Y');

if($type == "BA" || $type == "SA") {
	$sub = $allowed_subjects[0];
	echo <<< abc
	<!-- Branch admin -->
    <ul class="nav nav nav-tabs nav-stacked">
    <li><a href='branchpoor.php'>Branch Poor Attendance&nbsp;<i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
    <li><a href='poorattendance.php?$branch1'>Class Poor Attendance &nbsp;<i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
    <li><a href="subjectpoor.php?$sub">Subject Poor Attendance<i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
    </ul>
    <ul class="nav nav nav-tabs nav-stacked">
    <li><a href='./displaynotice.php?1'>Notifications &nbsp;$notifications <i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
    <li><a href="./sendnotice.php?all">Send Notice <i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
    <li><a href='search.php?q=&p=1'>Search People <i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
    </ul>
    <ul class="nav nav-tabs nav-stacked">
    <li><a href='./upload.php?$branch1'>Confirm Uploads &nbsp; <i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
    <li><a href='./profile.php?password'>Change Profile <i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
    <li><a href="./changecr.php?$branch1">Change CR <i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
    <li><a href="./key.php">CRs Security Keys <i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
    </ul>
    <!-- end of Branch admin -->
abc;

}

if($type == "CR") {
	
	echo <<< abc
	<!-- Class CR -->
    <ul class="nav nav-tabs nav-stacked">
    <li><a href='poorattendance.php?$branch2'>Poor Attendance &nbsp;<i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
    <li><a href='./displaynotice.php?1'>Notifications &nbsp; $notifications
    <i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
    <li><a href='search.php?q=&p=1'>Search People <i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
    </ul>
    <ul class="nav nav-tabs nav-stacked">
    <li><a href='./profile.php?password'>Change Profile <i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
    <li><a href="generate.php?$date/P1">Generate Attendance &nbsp; <i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a></li>
    <li><a href='password.php?$branch$class'>Generate Password <i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
    </ul>
		<!-- End of CR -->
abc;
}

if($type == "S"){
	echo <<< abc
		<!-- Students -->
		
    <ul class="nav nav nav-tabs nav-stacked">
    <li><a href='poorattendance.php?$branch2'>Poor Attendance &nbsp;<i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
    <li><a href='./displaynotice.php?1' >Notifications &nbsp;$notifications 
    <i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
    <li><a href='search.php?q=&p=1'>Search People <i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
    <li><a href='./profile.php?password'>Change Profile <i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
	<li><a href='today1.php?$date/$branch2'>Todays Attendance <i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
	<li><a href='tt.php?$branch2'>Class Timetable <i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
    </ul>
		<!-- End of Student -->
abc;
	}
	
	if($type=="CR" or $type=="SA" or $type=="BA")
{
	
	echo '
    <ul class="nav nav nav-tabs nav-stacked">
    <li><a href="today1.php?'.$date."/".$branch2.'">Todays Attendance <i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
    <li><a href="./?'.$branch.$class.'/p">Class Period Wise<i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
    <li><a href="./?'.$branch.$class.'/sub">Class Subject Wise<i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
    <li><a href="tt.php?'.$branch2.'">Class Timetable <i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
    </ul>
     <ul class="nav nav nav-tabs nav-stacked">
    <li><a href="./subjects.php?'.$branch.$class.'">Subjects Report<i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
    <li><a href="./periods.php?'.$branch.$class.'">Periods Report<i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
    <li><a href="./weekly.php?'.$branch.$class.'">Weekly Report<i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
    
    </ul>';
}

if($type=="SA" or $type=="BA")
{
	$sub = $allowed_subjects[0];
	echo '
    <ul class="nav nav nav-tabs nav-stacked">
    <li><a href="branch.php">Branch Period Wise<i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
    <li><a href="branchsubjects.php">Branch Subject Wise<i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
    <li><a href="onesubject.php?'.$sub.'">One Subject<i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>
    </ul>';
}
	
}
 


function cr_classes($classno,$branch) {	
	echo "<ul class='nav nav-tabs nav-stacked'>";
	for($i = 1; $i <=$classno ; $i++) 
	echo <<< a
	<li><a href="?$branch$i">$branch$i<i class="icon-chevron-right pull-left" style="padding-top:5px;"></i></a> </li>\n
a;
	echo "</ul>";
}



function notfound($title){
	$abc = (strlen($_SERVER['HTTP_REFERER']))?$_SERVER['HTTP_REFERER'] : "You have manually entered here..";
	echo <<< a
	<div class="container">
		<div class='row'>
			<div class='span6'>
				<img src="assets/img/404.jpg">
			</div>
			<div class="span4">
				<br><br><br>
				<h3> Oops ..!</h3> 
				<h6 class='text-error'> $title</h6> 
				<u>$abc</u> <br><br>
				Back to  <a href="./?sub">Attendance Portal</a>
			</div>
		</div>
	</div>
a;
	
}

function noservice(){
	include_once "functions.php";
	$p = $_SERVER['REQUEST_URI'];
	echo "<!DOCTYPE html>\n<html>\n";
	display_headers(" Error : No Sunday and Saturday Service ...  ");
	echo "\n<body>";
	echo <<< a
	<div class="container">
		<div class='row'>
			<div class='span6'>
				<img src="assets/img/404.jpg">
			</div>
			<div class="span6">
				<br><br><br>
				<h3> Ohh No ..!</h3> 
				<h6 class='text-error'>Service not avaliable Saturday and Sunday</h6> 
				<u> $p </u> <br><br>
				Back to  <a href="./?sub">Attendance Portal</a>
			</div>
		</div>
	</div>
a;
	echo "\n</body>\n</html>";
	
}


?>
