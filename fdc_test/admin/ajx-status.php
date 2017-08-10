<?php
error_reporting(0);
require_once "./auth/config.php";
$connect = mysqli_connect("$hostname","$username","$password");
if($connect)
{
	$dbcon = mysqli_select_db($connect, "$dbname");
}
$status=$_POST['status'];
$id=$_POST['id'];
if($status=="delete" && $id!="")
{
    $query=mysqli_query($connect,"delete from quiz where id='$id'");
}
else if($id!="")
{
 if($status=="release")    
    $query=mysqli_query($connect,"update quiz set status='susbend' where id='$id'");
 else
   $query=mysqli_query($connect,"update quiz set status='release' where id='$id'");
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