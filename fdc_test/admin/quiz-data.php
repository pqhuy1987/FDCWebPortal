<?php
error_reporting(0);
require_once "./auth/config.php";
$connect_2 = mysqli_connect("$hostname","$username","$password");
if($connect_2)
{
	$dbcon = mysqli_select_db($connect_2, "$dbname");
}
	$uidd  = $_SERVER['REQUEST_URI'];
    $host1 = $_SERVER['SERVER_NAME'];
    $uidd = "http://$host1$uidd";
   // echo $uidd;
   
$page = $_REQUEST['page'];

$start = ($page)*100;

$res2 = mysqli_query($connect_2,"SELECT * FROM quiz order by id desc limit $start,100");
echo "<div id='maindiv'>";

//echo $start;

       	 $delcnt1=mysqli_num_rows($res2);
	     $tcount=$delcnt1;
	     echo "<input type='hidden' value='$tcount' id='tcount'>";
                    
		echo '<div class="admin_table"><table border="0" cellspacing="0" cellpadding="0" >
        <tr>
          
          	<th>Questions</th>
          	<th>Answer</th>
          	<th>Option1</th>
	  		<th>Option2</th>
	  		<th>Status</th>
	  		<th>Delete</th>
	 		<th>Edit</th>
	 
        </tr>';
	$xx=0;
		$d=0;
		
		 while($line = mysqli_fetch_assoc($res2))
		 {
			$id = $line['id'];
			
			$qns = $line['question'];
			$ans = $line['answer'];
			$opt1 = $line['opt1'];
			$opt2 = $line['opt2'];
			
			
			$date = $line['datee'];
			$status = $line['status'];
			if($status=='susbend')
			 {
			   $stle_bg="style='background-color:#C16161;color:#fff;text-shadow:none;'";
			 }
		         else
			  {
			    $stle_bg="";
			  }
			echo "<tr id='row_$id'>";
			
			
			echo "<td>$qns</td><td>Opt $ans</td>
			<td>$opt1</td><td>$opt2</td><td $stle_bg id='status_$id'><a href='javascript:changestatus(\"$status\",$id);' id='href_status_$id'> $status</a></td>
			
			<td> <a href='javascript:changestatus(\"delete\",$id);'>delete</a></td>
			<td><a href='./add-question.php?eid=$id'>Edit</a></td>
			</tr>";
			$xx++;
			$d++;
		}
	       
		
		
		echo "</table></div>";
		
	?>

