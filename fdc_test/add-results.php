<?php
$hm=$_POST['hm'];
$hm2=$_POST['hm2'];
$name=$_POST['name'];

$chuyende_1=$_POST['chuyende_1'];
$wans=$_POST['wans'];
$cans=$_POST['cans'];

$chuyende_2=$_POST['chuyende_2'];
$wans_2=$_POST['wans_2'];
$cans_2=$_POST['cans_2'];

$catid=$_POST['catid'];
$etime=$_POST['examtime'];
$cdate=date("Y-m-d");
$email=$_POST['email'];

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
        $query =  mysqli_query($connect,"INSERT into quizresults set name='$name', cat_id='$catid', chuyende_1 = '$chuyende_1', correct_ans='$cans',wrong_ans='$wans', chuyende_2 = '$chuyende_2', correct_ans_2='$cans_2',wrong_ans_2='$wans_2', marks='$cans',datee='$cdate',examtime='$etime',email='$email' ");
       
    }
    
}

?>