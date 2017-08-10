<?php
error_reporting(0);
require_once "./auth/config.php";
$connect = mysqli_connect("$hostname","$username","$password");
if($connect)
{
	$dbcon = mysqli_select_db($connect, "$dbname");
}
$uidd  = $_SERVER['REQUEST_URI'];
    $host1 = $_SERVER['SERVER_NAME'];
    $uidd = "http://$host1$uidd";
   // echo $uidd;


$page = $_REQUEST['page'];

$start = ($page)*10;

$res2 = mysqli_query($connect,"SELECT * FROM quizresults order by id desc limit $start,10");
echo "<div id='maindiv'>";

//echo $start;

       $delcnt1=mysqli_num_rows($res2);
	     $tcount=$delcnt1;
	     echo "<input type='hidden' value='$tcount' id='tcount'>";
                    
		echo '<div class="admin_table"><table border="0" cellspacing="0" cellpadding="0" >
        <tr>
          
          <th>Name</th>
          <th>Category</th>
          <th>Correct Answers</th>
	  <th>Wrong Answers</th>
	  <th>Marks</th>
	  <th>Taken Time</th>
	  <th>Date</th>
	 
        </tr>';
	$xx=0;
		$d=0;
		
		 while($line = mysqli_fetch_assoc($res2))
		 {
			$id = $line['id'];
			
			$name = $line['name'];
			$catid = $line['cat_id'];
			$res3 = mysqli_query($connect,"SELECT category FROM category where id='$catid'");
			$crow=mysqli_fetch_assoc($res3);
			$cat_name=$crow['category'];
			
			$cans = $line['correct_ans'];
			$wans = $line['wrong_ans'];
			$marks = $line['marks'];
			$examtime=$line['examtime'];
			
			$date = $line['datee'];
			
					echo "<tr id='row_$id'>";
			
			
			echo "<td>$name</td><td>$cat_name</td>
			<td>$cans</td><td>$wans</td><td>$marks</td><td>$examtime</td><td>$date</td>
			
			
			</tr>";
			$xx++;
			$d++;
		}
	       
		
		
		echo "</table></div>";
		
	?>

