<?php
error_reporting(0);
require_once "./auth/config.php";
$connect = mysqli_connect("$hostname","$username","$password");
if($connect)
{
	$dbcon = mysqli_select_db($connect, "$dbname");
}
$catname=trim($_POST['catname']);
$catstatus=trim($_POST['catstatus']);

if($catname!="" && $catstatus!="")
{
  $chkduplicate=  mysqli_query($connect,"select id from category where category like '$catname' ");
  $dup_count= mysqli_num_rows($chkduplicate);
  if($dup_count==0)
  {
    $query =  mysqli_query($connect,"INSERT into category set category='$catname',status='$catstatus'");
      if($query)
    {
       echo "<font color='green'>Your category name added sucessfully..</font>";    
    }
    else
     {
         echo "<font color='red'>Your category name not added</font>";        
     }
  }
 else
  {
	echo "<font color='red'>Catagory name is already added</font>";        
  }
 
}
else
 {
    echo "<font color='red'>Invalid category name </font>";  
 }


?>