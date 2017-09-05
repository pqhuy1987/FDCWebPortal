<?php
error_reporting(0);
require_once "./auth/config.php";
$connect_2 = mysqli_connect("$hostname","$username","$password");
if($connect_2)
{
	$dbcon = mysqli_select_db($connect_2, "$dbname");
}
$status=$_POST['status'];
$id=$_POST['id'];
if($status=="delete" && $id!="")
{
    $query=mysqli_query($connect_2,"delete from quiz where id='$id'");
}
else if($id!="")
{
 if($status=="release")    
    $query=mysqli_query($connect_2,"update quiz set status='susbend' where id='$id'");
 else
   $query=mysqli_query($connect_2,"update quiz set status='release' where id='$id'");
}
else
{
    echo "invalid data";
}
if($query)
{
    echo "success";
}
?>