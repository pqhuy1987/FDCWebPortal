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

$chuyende_3=$_POST['chuyende_3'];
$wans_3=$_POST['wans_3'];
$cans_3=$_POST['cans_3'];

$chuyende_4=$_POST['chuyende_4'];
$wans_4=$_POST['wans_4'];
$cans_4=$_POST['cans_4'];

$chuyende_5=$_POST['chuyende_5'];
$wans_5=$_POST['wans_5'];
$cans_5=$_POST['cans_5'];

$chuyende_6=$_POST['chuyende_6'];
$wans_6=$_POST['wans_6'];
$cans_6=$_POST['cans_6'];

$chuyende_7=$_POST['chuyende_7'];
$wans_7=$_POST['wans_7'];
$cans_7=$_POST['cans_7'];

$chuyende_8=$_POST['chuyende_8'];
$wans_8=$_POST['wans_8'];
$cans_8=$_POST['cans_8'];

$chuyende_9=$_POST['chuyende_9'];
$wans_9=$_POST['wans_9'];
$cans_9=$_POST['cans_9'];

$chuyende_10=$_POST['chuyende_10'];
$wans_10=$_POST['wans_10'];
$cans_10=$_POST['cans_10'];

$chuyende_11=$_POST['chuyende_11'];
$wans_11=$_POST['wans_11'];
$cans_11=$_POST['cans_11'];

$chuyende_12=$_POST['chuyende_12'];
$wans_12=$_POST['wans_12'];
$cans_12=$_POST['cans_12'];

$chuyende_13=$_POST['chuyende_13'];
$wans_13=$_POST['wans_13'];
$cans_13=$_POST['cans_13'];

$chuyende_14=$_POST['chuyende_14'];
$wans_14=$_POST['wans_14'];
$cans_14=$_POST['cans_14'];

$chuyende_15=$_POST['chuyende_15'];
$wans_15=$_POST['wans_15'];
$cans_15=$_POST['cans_15'];

$chuyende_16=$_POST['chuyende_16'];
$wans_16=$_POST['wans_16'];
$cans_16=$_POST['cans_16'];

$chuyende_17=$_POST['chuyende_17'];
$wans_17=$_POST['wans_17'];
$cans_17=$_POST['cans_17'];

$chuyende_18=$_POST['chuyende_18'];
$wans_18=$_POST['wans_18'];
$cans_18=$_POST['cans_18'];

$chuyende_19=$_POST['chuyende_19'];
$wans_19=$_POST['wans_19'];
$cans_19=$_POST['cans_19'];

$chuyende_20=$_POST['chuyende_20'];
$wans_20=$_POST['wans_20'];
$cans_20=$_POST['cans_20'];

$chuyende_21=$_POST['chuyende_21'];
$wans_21=$_POST['wans_21'];
$cans_21=$_POST['cans_21'];

$chuyende_22=$_POST['chuyende_22'];
$wans_22=$_POST['wans_22'];
$cans_22=$_POST['cans_22'];

$chuyende_23=$_POST['chuyende_23'];
$wans_23=$_POST['wans_23'];
$cans_23=$_POST['cans_23'];

$chuyende_24=$_POST['chuyende_24'];
$wans_24=$_POST['wans_24'];
$cans_24=$_POST['cans_24'];

$chuyende_25=$_POST['chuyende_25'];
$wans_25=$_POST['wans_25'];
$cans_25=$_POST['cans_25'];

$chuyende_26=$_POST['chuyende_26'];
$wans_26=$_POST['wans_26'];
$cans_26=$_POST['cans_26'];

$chuyende_27=$_POST['chuyende_27'];
$wans_27=$_POST['wans_27'];
$cans_27=$_POST['cans_27'];

$chuyende_28=$_POST['chuyende_28'];
$wans_28=$_POST['wans_28'];
$cans_28=$_POST['cans_28'];

$chuyende_29=$_POST['chuyende_29'];
$wans_29=$_POST['wans_29'];
$cans_29=$_POST['cans_29'];

$chuyende_30=$_POST['chuyende_30'];
$wans_30=$_POST['wans_30'];
$cans_30=$_POST['cans_30'];

$catid=$_POST['catid'];
$workplace  	= $_POST['catid_2'];
$title			= $_POST['catid_3'];
$contact		= $_POST['catid_4'];
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
        $query =  mysqli_query($connect,"INSERT into quizresults set name='$name', cat_id='$catid', workplace='$workplace',title='$title', contact='$contact',
		chuyende_1 = '$chuyende_1', correct_ans='$cans',wrong_ans='$wans', 
		chuyende_2 = '$chuyende_2', correct_ans_2='$cans_2',wrong_ans_2='$wans_2', 
		chuyende_3 = '$chuyende_3', correct_ans_3='$cans_3',wrong_ans_3='$wans_3', 
		chuyende_4 = '$chuyende_4', correct_ans_4='$cans_4',wrong_ans_4='$wans_4', 
		chuyende_5 = '$chuyende_5', correct_ans_5='$cans_5',wrong_ans_5='$wans_5', 
		chuyende_6 = '$chuyende_6', correct_ans_6='$cans_6',wrong_ans_6='$wans_6', 
		chuyende_7 = '$chuyende_7', correct_ans_7='$cans_7',wrong_ans_7='$wans_7', 
		chuyende_8 = '$chuyende_8', correct_ans_8='$cans_8',wrong_ans_8='$wans_8', 
		chuyende_9 = '$chuyende_9', correct_ans_9='$cans_9',wrong_ans_9='$wans_9', 
		chuyende_10 = '$chuyende_10', correct_ans_10='$cans_10',wrong_ans_10='$wans_10', 
		chuyende_11 = '$chuyende_11', correct_ans_11='$cans_11',wrong_ans_11='$wans_11', 
		chuyende_12 = '$chuyende_12', correct_ans_12='$cans_12',wrong_ans_12='$wans_12', 
		chuyende_13 = '$chuyende_13', correct_ans_13='$cans_13',wrong_ans_13='$wans_13', 
		chuyende_14 = '$chuyende_14', correct_ans_14='$cans_14',wrong_ans_14='$wans_14', 
		chuyende_15 = '$chuyende_15', correct_ans_15='$cans_15',wrong_ans_15='$wans_15', 
		chuyende_16 = '$chuyende_16', correct_ans_16='$cans_16',wrong_ans_16='$wans_16', 
		chuyende_17 = '$chuyende_17', correct_ans_17='$cans_17',wrong_ans_17='$wans_17', 
		chuyende_18 = '$chuyende_18', correct_ans_18='$cans_18',wrong_ans_18='$wans_18', 
		chuyende_19 = '$chuyende_19', correct_ans_19='$cans_19',wrong_ans_19='$wans_19', 
		chuyende_20 = '$chuyende_20', correct_ans_20='$cans_20',wrong_ans_20='$wans_20', 
		chuyende_21 = '$chuyende_21', correct_ans_21='$cans_21',wrong_ans_21='$wans_21', 
		chuyende_22 = '$chuyende_22', correct_ans_22='$cans_22',wrong_ans_22='$wans_22', 
		chuyende_23 = '$chuyende_23', correct_ans_23='$cans_23',wrong_ans_23='$wans_23', 
		chuyende_24 = '$chuyende_24', correct_ans_24='$cans_24',wrong_ans_24='$wans_24', 
		chuyende_25 = '$chuyende_25', correct_ans_25='$cans_25',wrong_ans_25='$wans_25', 
		chuyende_26 = '$chuyende_26', correct_ans_26='$cans_26',wrong_ans_26='$wans_26', 
		chuyende_27 = '$chuyende_27', correct_ans_27='$cans_27',wrong_ans_27='$wans_27', 
		chuyende_28 = '$chuyende_28', correct_ans_28='$cans_28',wrong_ans_28='$wans_28', 
		chuyende_29 = '$chuyende_29', correct_ans_29='$cans_29',wrong_ans_29='$wans_29', 
		chuyende_30 = '$chuyende_30', correct_ans_30='$cans_30',wrong_ans_30='$wans_30', 

		marks='$cans',datee='$cdate',examtime='$etime',email='$email' ");
       
    }
    
}

?>