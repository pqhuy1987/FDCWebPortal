<?php include_once('functions.php'); ?>
<?php
if (isset($_GET["group_general"])){
	$group_general = $_GET["group_general"];
	settype($group_general, "int");
} else {
 	$group_general = 0;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Event Calendar</title>
<link type="text/css" rel="stylesheet" href="jscript/style.css"/>
<link type="text/css" rel="stylesheet" href="jscript/bootstrap/css/bootstrap.min.css"/>
<script src="jscript/jquery.min.js"></script>
</head>
<body>
<div id="calendar_div" class="container">
<h1 align="center"> LỊCH CÔNG TY </h1>
	<?php echo getCalender(); ?>
</div>
</body>
</html>
