<?php 

include 'globals.php';


// length 
$branchlen = strlen($globalbranch);
// dictionary for users definations 
$dict = array();
$dict['S'] = 'Student';
$dict['CR'] = 'CR';
$dict['BA'] = 'Admin';
$dict['SA'] = 'Site Admin';
$dict['F'] = "Female";
$dict['M'] = "Male";

$dict['M1'] = "Boys";
$dict['F1'] = "Girls";

$dict['M2'] = "Mr.";
$dict['F2'] = "Ms.";

//SUbjects Definition

$subjects_list=array("AOA","COA","COAL","PPL","PPLL","TOC","B","SH","EX");
$allowed_subjects=array("AOA","COA","COAL","PPL","PPLL","TOC");
$sub_def = array(
	"AOA"=>"Analysis of Algorithms",
	"COA" => "Computer Organisation and Architecture",
	"COAL" => "Computer Organisation and Architecture Lab",
	"PPL" => "Principles of Programming Languages",
	"PPLL" => "Principles of Programming Languages Lab",
	"TOC" => "Theory of Computation",
	"B" => "Breadth Cource",
	"SH" => "Study Hour",
	"Ex" => "Exam"
	 );

$exp = array(
		"CSE1"=>[],
		"CSE2"=>[],
		"CSE3"=>[],
		"CSE4"=>[],
		"CSE5"=>[],
		"CSE6"=>[]
		);

?>
