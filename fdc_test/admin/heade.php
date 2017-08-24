<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width">

<!-- disable iPhone inital scale -->
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>PHP Quiz System</title>
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
<?php
error_reporting(0);
require_once "auth/config.php";

$connect_2 = mysqli_connect($hostname, $username,$password);
if($connect_2)
{
	$dbcon = mysqli_select_db($connect_2, $dbname);
}
$hr_admin =mysqli_query($connect_2,"select username from hioxpm");
 if($hrline=@mysqli_fetch_array($hr_admin))
   {
     $uname=$hrline['username'];
   }	
?>

<body>
   <div class="top">

  <!-- top_con begins -->
  <div class="top_con">
    <ul class="top_con_ul_pos1">
    <li><span class="admin_name"><?php echo $uname;?></span></li>
    </ul>
    
    
    <ul class="top_con_ul_pos2">
      <li><a href="./change-password.php">Change Password</a></li>
         <li><a href="./logout.php">Sign out</a></li>
    </ul>
    
    
  </div>
  <!-- top_con ends -->
  
</div>
<!-- top ends -->

<!-- content begins -->
<div class="content clearfix">
  <div class="content_left">
    <div class="logo"><img src="images/logo.png" width="190" height="150" alt="Logo"></div>
    <div class="menu">
    <ul>
    <li id='m1'><a href="index.php">Edit Questions</a></li>
    <li id='m2'><a href="add-question.php">Add Questions</a></li>
    <li id='m3'><a href="add-category.php">Add Category</a></li>
    <li id='m4'><a href="edit-category.php">Edit Category</a></li>
    <li id='m5'><a href="settings.php">Settings</a></li>
    <li id='m6'><a href="code.php">Get Code</a></li>
	  <li id='m7'><a href="quiz-results.php">Quiz User Results</a></li>
   
    </ul>
    </div>
  </div>
  <div class="content_right">
	  
	  
	  
	  
	  
