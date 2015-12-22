<?php 
include("functions.php");
echo "<html>\n";
echo '<head>
<title>Test - page</title>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="assets/css/fontawesome/css/font-awesome.min.css" media="all" /> 
<link rel="stylesheet" type="text/css" href="assets/css/application.css" media="screen">

<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/validate.js"></script>

<link href="assets/css/bootstrap-editable.css" rel="stylesheet" />
<script src="assets/js/bootstrap-editable.min.js"></script>
<script>$("#username").editable();</script>
';

echo "</head>";
echo "\n<body>";
echo '<a href="#" id="username" data-type="text" data-pk="1" data-url="./update.php" data-original-title="Enter username">superuser</a>';
echo "</body>";
echo "</html>";
?>
