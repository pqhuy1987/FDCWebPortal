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
$catname=$_POST['catname'];
$catstatus=$_POST['catstatus'];
if($id=="")
{
	$msg="Invalid data..";
}
else if($status=="delete")
{
    $query=mysqli_query($connect_2,"delete from category where id='$id'");
    if($query)
    {
		$msg="Deleted Sucessfully...";
    }
}
else if($status=="update")
{
    $query=mysqli_query($connect_2,"update category set category='$catname', status='$catstatus' where id='$id'");
    
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