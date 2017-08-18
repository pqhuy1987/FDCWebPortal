<?php
error_reporting(0);
require_once "./auth/config.php";
$connect_2 = mysqli_connect("$hostname","$username","$password");
if($connect_2)
{
	$dbcon = mysqli_select_db($connect_2, "$dbname");
}

$etime=$_POST['etime'];
$pnum=$_POST['pnum'];
if($etime=="" || $pnum=="")
{
	$msg="Invalid data..";
}
else
{
    $query=mysqli_query($connect_2,"update settings set pagenum='$pnum' ,examtime='$etime' where id='1'");
    if($query)
    {
	$msg="Updated Sucessfully...";
    }
}

    echo $msg;

?>