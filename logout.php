<?php
session_start();

function logout(){
	if(isset($_SESSION['UserId']))
		unset($_SESSION['UserId']);		
	header("location: login.php");
	}

logout();
?>
