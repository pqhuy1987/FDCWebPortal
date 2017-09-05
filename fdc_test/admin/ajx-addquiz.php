<?php
error_reporting(0);
require_once "./auth/config.php";
$connect_2 = mysqli_connect("$hostname","$username","$password");
if($connect_2)
{
	$dbcon = mysqli_select_db($connect_2, "$dbname");
}
$ques=trim($_POST['ques']);
$catid=trim($_POST['catid']);
$opt1=trim($_POST['opt1']);
$opt2=trim($_POST['opt2']);
$opt3=trim($_POST['opt3']);
$opt4=trim($_POST['opt4']);
$ans=trim($_POST['ans']);
$imptid=trim($_POST['imptid']);
$dokho=trim($_POST['dokho']);
if($imptid=="add")
{
$dat=date('Y-m-d');
if($ques!="" && $opt1!="" && $opt2!="" && $ans!="" && $catid!="")
{
    $query =  mysqli_query($connect_2,"INSERT into quiz set catid='$catid' , question='$ques',opt1='$opt1',opt2='$opt2',opt3='$opt3',opt4='$opt4',answer='$ans',datee='$dat',status='release',dokho='$dokho'");
   // echo "INSERT into quiz set catid='$catid' , question='$ques',opt1='$opt1',opt2='$opt2',opt3='$opt3',opt4='$opt4',ans='$ans',date='$dat'";
    if($query)
    {
       echo "<font color='green'>Your question added sucessfully..</font>";    
    }
    else
     {
         echo "<font color='red'>Your question not added</font>";        
     }
}
else
 {
    echo "<font color='red'>Invalid question and options </font>";  
 }
}
else
{

	$dat=date('Y-m-d');
    if($imptid!="")
    {
        $query =  mysqli_query($connect_2,"update quiz set catid='$catid' , question='$ques',opt1='$opt1',opt2='$opt2',opt3='$opt3',opt4='$opt4',answer='$ans',datee='$dat',dokho='$dokho' where id='$imptid'");
	if($query)
	    echo "<font color='green'>Your question updated sucessfully..</font>";
	else
	    echo "<font color='red'>Updation Failed..</font>";
    }
}
?>