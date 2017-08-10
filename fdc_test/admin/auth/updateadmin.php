<?php

$un = $_POST['usern'];
$pw = $_POST['passw'];

$pw=md5($pw);

$connect = mysqli_connect($hostname, $username,$password);

if($connect)
{

 	$dbcon = mysqli_select_db($connect, $dbname);

	if($dbcon)
	{
	    	$result = mysqli_query($connect,"insert into hioxpm values( '$un', '$pw')");

	 	if (!$result)
		{
		    echo(" <div align='center' class='errortext'>
				 Unable to add / edit admin user. <br>.");
		    echo(" <div>");

		    //echo(mysql_error());
		}
		else
		{
		   include "message2.php";
		}
	}
	else
	{
		$vv =false;
	}
}
else
{
	$vv =false;
}

if($vv === false)
{
 echo	"<div class='form' style='margin:25px;border:1px solid #ddd;padding:10px;'>";
 echo "<form method=POST action=$PHP_SELF>";
 echo "<input type=hidden name=type value=changedb>";
 echo "<div class='errortext'>Unable to connect to the database.<br>
	Please check your database entries  </div><br><input type=submit value='dbentries' class='form_button' style='float:left;'><div style='clear:both;'></div>";
 echo "</form>";
echo(" </div>");

}

?>
