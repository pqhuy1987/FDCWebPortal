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
$name_sub=$_POST['catname'];
$id2=$_POST['catstatus'];
$otherValue=$_POST['otherValue'];

if($id=="")
{
	$msg="Invalid data..";
}
else if($status=="delete")
{
    $query=mysqli_query($connect_2,"delete from category_sub where id_sub='$id'");
    if($query)
    {
		$msg="Deleted Sucessfully...";
    }
}
else if($status=="update")
{
    $query=mysqli_query($connect_2,"update category_sub set category='$otherValue', name_sub='$name_sub', id='$id2' where id_sub='$id'");
    
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