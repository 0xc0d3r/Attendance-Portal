<?php
include "functions.php"; 
if(!check('BA')) echo "Your are not authorised to print the contents";
else  {
if(isset($_POST['Title1']) && isset($_POST['Table1'])) {
$title = $_POST['Title1'];
$table1 = $_POST['Table1'];
$date = date('d-M-Y');
if(preg_match("/Win/",$_SERVER['HTTP_USER_AGENT'])) {
	
	$table1 = str_replace("&#10004;","P",$table1);
	$table1 = str_replace("&#10006;","A",$table1);
	}
$html = '<style>
@page {
	margin-top: 0.5cm;
	margin-bottom: 2.0cm;
	margin-left: 2.3cm;
	margin-right: 1.7cm;
	margin-header: 8mm;
	margin-footer: 8mm;
	footer: html_myHTMLFooter;
	background-color:#ffffff;
	font-family: \'norasi\';
}
</style>
<body>
<table style="margin-top:0%;font-family: \'norasi\';border-bottom:0.2mm solid #000000;padding-bottom:2px;"><tr colspan=3><td style="text-align:left;font-size:20px;font-weight:bold;">Attendance Portal</td></tr><tr><td style="font-size:12px;"><i>'.$title.'</i></td><td width="80%"></td><td style="text-align:right;"><i>'.$date.'</i></td></tr></table><br>
<htmlpagefooter name="myHTMLFooter">
<table width="100%" style="border-top: 0.1mm solid #000000; vertical-align: top; font-size: 9pt; color: #000055;font-family: \'norasi\';"><tr>
<td width="25%" align="left"><b>&copy; Dept Of CSE 2013</b></td>
<td width="25%" align="right"><b>Page {PAGENO}</b></td>
</tr></table>
</htmlpagefooter>
<div style="font-family: \'norasi\';">
<table style="border-collapse:collapse;font-family: \'norasi\';width:100%;margin-left:0%;font-size:14px;text-align:center;" border=1>'.$table1.'</table>
</div>
</body>';
include("assets/mpdf/mpdf.php");
//echo htmlentities($table1);
$mpdf=new mPDF('','A4','','',15,15,20,20,5,5); 
$mpdf->SetDisplayMode('fullpage');
$mpdf->useSubstitutions = true;
$mpdf->WriteHTML($html);
$mpdf->Output($title."_".$date.".pdf","D");
	}
else {
	echo "No input specified";
}
}
?>
