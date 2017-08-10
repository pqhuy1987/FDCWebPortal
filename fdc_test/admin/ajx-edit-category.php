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

$res2 = mysqli_query($connect,"SELECT * FROM category order by id desc limit $start,10");

echo "<div id='maindiv'>";

//echo $start;

       $delcnt1=mysqli_num_rows($res2);
	     $tcount=$delcnt1;
	     echo "<input type='hidden' value='$tcount' id='tcount'>";
                    
		echo '<div class="admin_table"><table border="0" cellspacing="0" cellpadding="0" >
        <tr>
          
          <th>Category</th>
          <th>Status</th>
          <th>Edit</th>
	  <th>Delete</th>
	   <th>Update</th>
	 
        </tr>';
	$xx=0;
		$d=0;
		
		 while($line = mysqli_fetch_assoc($res2))
		 {
			$id = $line['id'];
			
			$catname = $line['category'];
			$catstatus = $line['status'];
			
	
			echo "<tr id='row_$id'>";
			
			
			echo "<td><input type='text' value='$catname' readonly='readonly' id='catname_$id' class='textbox'></td><td><select name='catstatus' id='catstatus_$id' class='selectbox' disabled='disabled'><option value='$catstatus'>$catstatus</option><option value='release'>release</option><option value='susbend'>susbend</option></select></td>
					
			<td><a href='javascript:changestatus(\"edit\",$id);'>Edit</a> </td>
			<td><a href='javascript:changestatus(\"delete\",$id);'>delete</a></td>
			<td><input type='button' onclick='changestatus(\"update\",$id)' value='Update' class='form_button' style='float:none;text-align:center;'></td>
			</tr>";
			$xx++;
			$d++;
		}
	       
		
		
		echo "</table></div>";
		
	?>

