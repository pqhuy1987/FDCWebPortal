
<!DOCTYPE html>
<html>
<head>
<title>Event Calendar</title>
<link type="text/css" rel="stylesheet" href="jscript/style.css"/>
<link type="text/css" rel="stylesheet" href="jscript/bootstrap/css/bootstrap.min.css"/>
<script src="jscript/jquery.min.js"></script>
</head>
<body>
<?php include_once('functions.php'); ?>
<?php
if (isset($_GET["group_general"])){
	$group_general = $_GET["group_general"];     
	settype($group_general, "int");
	$group_small = $_GET["group_small"];
	settype($group_small, "int");
} else {
	$group_general = 0;
}
?>
<div id="calendar_div" class="container">
<h1 align="center"> Lịch <?php
 	if ($group_small == NULL) {
	 	 if ($group_general == 0) {echo "Công Ty";} else {echo "Ban Lãnh Đạo";}
	} else {
		 if (($group_general == 0)&&($group_small == 1)) {echo "Du Lịch";} 
		 else if (($group_general == 0)&&($group_small == 2)) {echo "Nghĩ Lễ";} 
		 else if (($group_general == 0)&&($group_small == 2)) {echo "Sự Kiện";} 
		 else if (($group_general == 1)&&($group_small == 1)) {echo "Ông Ngô Thanh Phong";} 
		 else if (($group_general == 1)&&($group_small == 2)) {echo "Ông Nguyễn Quang Thụy";} 
		 else if (($group_general == 1)&&($group_small == 3)) {echo "Ông Nguyễn Ngọc Lân";} 
	}	
?>   
</h1>
    
    
	<?php echo getCalender(); ?>
</div>
</body>
</html>
