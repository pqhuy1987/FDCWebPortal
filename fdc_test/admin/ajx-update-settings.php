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
$length=$_POST['length'];
$val = json_decode(stripslashes($_POST['jsonString']));
$catname=$_POST['catname'];

if($etime=="" || $pnum=="")
{
	$msg="Invalid data..";
}
else
{	
	$query=mysqli_query($connect_2,"INSERT into settings set pagenum='$pnum' ,examtime='$etime', exam_name='$catname'
	, chuyende_1=0, chuyende_2=0, chuyende_3=0, chuyende_4=0, chuyende_5=0
	, chuyende_6=0, chuyende_7=0, chuyende_8=0, chuyende_9=0, chuyende_10=0");
	
	$query_temp=mysqli_query($connect_2,"select * from settings
			order by id desc limit 1");
			
	$row_query_temp = mysqli_fetch_array($query_temp);
	$id_temp = $row_query_temp['id'];
	
	for($index = 1; $index <= 30; $index++)
	{
		if ($val[$index-1]!=0)
			$var_temp = $val[$index-1];
		else
			$var_temp = 0;
		
		$query=mysqli_query($connect_2,"update settings set chuyende_$index=$var_temp where id=$id_temp");
	}
	
    if($query)
    {
		$msg="Updated Sucessfully...";
    }
}

    echo $msg;

?>