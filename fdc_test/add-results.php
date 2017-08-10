<?php
$hm=$_POST['hm'];
$hm2=$_POST['hm2'];
$name=$_POST['name'];
$wans=$_POST['wans'];
$cans=$_POST['cans'];
$catid=$_POST['catid'];
$etime=$_POST['examtime'];
$cdate=date("Y-m-d");

require_once "$hm/admin/auth/config.php";
if(($hostname == "" || $dbname == "" || $username == "") )
{
		     
  echo "<div align='center' style='margin-top:20%;color:red;'><b>Installation process is not completed.kindly follow the read me file instruction.</b></div>";
}
else{
    $connect = mysqli_connect("$hostname","$username","$password");
if($connect)
{
	$dbcon = mysqli_select_db($connect, "$dbname");
}
    if($catid!="" && $name!="" && $wans!="" && $cans!="")
    {
        $query =  mysqli_query($connect,"INSERT into quizresults set name='$name' , cat_id='$catid' , correct_ans='$cans',wrong_ans='$wans',marks='$cans',datee='$cdate',examtime='$etime'");
       
    }
    
}





?>