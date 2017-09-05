<?php
@session_start();
error_reporting(0);
$ss = $_SESSION['HRS'];
$type = $_POST['type'];

if ($ss != "passed")
{
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width">

<!-- disable iPhone inital scale -->
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>Admin Login Syaystem</title>
<link href="./css/style.css" rel="stylesheet" type="text/css">

<!-- media queries css -->
<link href="./css/media-queries.css" rel="stylesheet" type="text/css">

<!-- html5.js for IE less than 9 -->
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- css3-mediaqueries.js for IE less than 9 -->
<!--[if lt IE 9]-->
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>

<script type="text/javascript" src="./jquery.js"></script>

</head>

    <div class="top">

  <!-- top_con begins -->
  <div class="top_con">
    <ul class="top_con_ul_pos1">
    <li><span class="admin_name">Admin Login</span></li>
    </ul>
    
    
    <ul class="top_con_ul_pos2">
 
    </ul>
    
    
  </div>
  <!-- top_con ends -->
  
</div>
    <div class="content clearfix">
  <div class="content_left">
    <div class="logo"><img src="images/logo.png" width="190" height="150" alt="Logo"></div>
    <div class="menu">
    
    </div>
  </div>
  <div class="content_right">
<?php

	$type = $_POST['type'];
	require_once "auth/config.php";

	if($hostname == "" || $dbname == "" || $username == "")
	{
	 echo "<div align=center class=rad>Invalid Data, Please give proper values in configuration file</div>";
	}

	if($type=="auth")
	{
		include "checkauth.php";
	}
	else{
	 include "authlogin.php";
	 $block = true;
	}

	
}else
{
	$block = false;
}
?>
</div>
  

</body>
</html>
