<?php
error_reporting(0);
require_once "./auth/config.php";
$connect = mysqli_connect("$hostname","$username","$password");
if($connect)
{
	$dbcon = mysqli_select_db($connect, "$dbname");
}

$etime=$_POST['etime'];
$pnum=$_POST['pnum'];
if($etime=="" || $pnum=="")
{
	$msg="Invalid data..";
}
else
{
    $query=mysqli_query($connect,"update settings set pagenum='$pnum' ,examtime='$etime' where id='1'");
    if($query)
    {
	$msg="Updated Sucessfully...";
    }
}

    echo $msg;

?>