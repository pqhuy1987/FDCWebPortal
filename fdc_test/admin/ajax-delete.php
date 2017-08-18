<?php
error_reporting(0);
include "config.php";
$host="localhost";
$uname="root";
$pwd="";
$dbname="hscripts";

$connect_2 = mysqli_connect($host, $uname,$pwd) or die ("Could not connect");

mysqli_select_db($connect_2, $dbname);
$action=$_POST['idd']; 
if(isset($_POST['idd']))
  {
   $id = $_POST['idd'];
   $id = mysql_escape_String($id);
   $delquery=mysqli_query($connect_2,"delete from survey where id=$id") or die(mysql_error());
   $qry = mysqli_query($connect_2,"delete from rating where id=$id") or die(mysql_error());
   echo "Record deleted";
  }