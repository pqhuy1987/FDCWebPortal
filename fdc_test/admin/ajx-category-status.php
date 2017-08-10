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
$catname=$_POST['catname'];
$catstatus=$_POST['catstatus'];
if($id=="")
{
	$msg="Invalid data..";
}
else if($status=="delete")
{
    $query=mysqli_query($connect,"delete from category where id='$id'");
    if($query)
    {
	$msg="Deleted Sucessfully...";
    }
}
else if($status=="update")
{
    $query=mysqli_query($connect,"update category set category='$catname', status='$catstatus' where id='$id'");
    
     if($query)
    {
	$msg="Updated Sucessfully...";
    }
 
}
else
{
   $msg= "invalid data";
}

    echo $msg;

?>