<?php
require_once "auth/config.php";

$connect_2 = mysqli_connect($hostname, $username,$password);
if($connect_2)
{
	$dbcon = mysqli_select_db($connect_2, $dbname);
}
$idd=$_POST['id'];
$tabnam=$_POST['tabnam'];

if($tabnam=='filter'){
   $delname = $idd;   
   $result = mysqli_query($connect_2,"delete from filter where word='$delname'");
   
     if($result)
       echo "<div align='center'><font color=Green><b>$delname Deleted</b></font></div>";
 }
 else if($tabnam=='ip'){
   $delname = $idd;   
   $result = mysqli_query($connect_2,"delete from filter where ip='$delname'");
   
     if($result)
       echo "<div align='center'><font color=Green><b>$delname Deleted</b></font></div>";
 }
 else
 {
       $result = mysqli_query($connect_2,"delete from $tabnam where id='$idd'");
     if($result)
       echo "<div align='center'><font color=Green><b>$delname Deleted</b></font></div>";
    
 }
 ?>