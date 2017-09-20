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

$start = ($page)*10;

$res2 = mysqli_query($connect_2,"SELECT * FROM settings order by id desc limit $start,10");

echo "<div id='maindiv'>";

//echo $start;

       	$delcnt1=mysqli_num_rows($res2);
	     $tcount=$delcnt1;
	     echo "<input type='hidden' value='$tcount' id='tcount'>";
                    
		echo '<div class="admin_table"><table border="0" cellspacing="0" cellpadding="0" >
        <tr>
          
          <th>Tên Bộ Đề</th>
		  <th>Số Câu Hỏi</th>
		  <th>Thời Gian</th>
          <th>Sửa Đổi</th>
	  	  <th>Xóa</th>
	 
        </tr>';
		$xx=0;
		$d=0;
		
		 while($line = mysqli_fetch_assoc($res2))
		 {
			$id = $line['id'];
			
			$catname = $line['exam_name'];
			$num = $line['pagenum'];	
			$time = $line['examtime'];	
			
			echo "<tr id='row_$id'>";
			
			echo "  <td><input type='text' value='$catname' readonly='readonly' id='catname_$id' class='textbox'></td>
					<td><input type='text' value='$num' readonly='readonly' id='num_$id' class='textbox'></td>
					<td><input type='text' value='$time' readonly='readonly' id='time_$id' class='textbox'></td>
					
			<td><a href='javascript:changestatus(\"edit\",$id);'>Edit</a> </td>
			<td><a href='javascript:changestatus(\"delete\",$id);'>delete</a></td>
			</tr>";
			$xx++;
			$d++;
		}
	       
		
		
		echo "</table></div>";
		
	?>

