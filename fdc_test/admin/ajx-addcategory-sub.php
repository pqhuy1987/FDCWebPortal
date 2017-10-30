<?php
error_reporting(0);
require_once "./auth/config.php";
$connect_2 = mysqli_connect("$hostname","$username","$password");
if($connect_2)
{
	$dbcon = mysqli_select_db($connect_2, "$dbname");
}
$catname=trim($_POST['catname']);
$Catid=trim($_POST['Catid']);

if($catname!="")
{
  $chkduplicate		=  mysqli_query($connect_2,"select id_sub from category_sub where name_sub like '$catname' ");
  $category 		=  mysqli_query($connect_2,"SELECT * FROM category where id='$Catid'");
  $row_category	= mysqli_fetch_array($category);
  $category_sub = $row_category['category'];
  $dup_count= mysqli_num_rows($chkduplicate);
  if($dup_count==0)
  {
    $query =  mysqli_query($connect_2,"INSERT into category_sub set name_sub='$catname',id='$Catid', category='$category_sub'");
      if($query)
    {
       echo "<font color='green'>Your category name added sucessfully..</font>";    
    }
    else
     {
         echo "<font color='red'>Your category name not added</font>";        
     }
  }
 else
  {
	echo "<font color='red'>Catagory name is already added</font>";        
  }
 
}
else
 {
    echo "<font color='red'>Invalid category name </font>";  
 }


?>