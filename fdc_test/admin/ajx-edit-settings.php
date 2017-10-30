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

$res2 = mysqli_query($connect_2,"SELECT * FROM settings order by id desc limit $start,100");

echo "<div id='maindiv'>";

//echo $start;

       	$delcnt1=mysqli_num_rows($res2);
	     $tcount=$delcnt1;
	     echo "<input type='hidden' value='$tcount' id='tcount'>";
                    
		echo '<div class="admin_table"><table border="0" cellspacing="0" cellpadding="0" >
        <tr>
          
          <th>Tên Bộ Đề</th>
		  <th>Cách Lộc Bộ Đề</th>
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
			$filter = $line['filter'];	
			
			echo "<tr id='row_$id'>";
			
			echo "  <td><input type='text' value='$catname' readonly='readonly' id='catname_$id' class='textbox'></td>";
			if ($filter == 1){
					echo "<td><input type='text' value='Lọc bộ đề cũ nhất' readonly='readonly' id='num_$id' class='textbox'></td>";
			} else if ($filter == 2) {
					echo "<td><input type='text' value='Lọc bộ đề mới nhất' readonly='readonly' id='num_$id' class='textbox'></td>";
			} else {
					echo "<td><input type='text' value='Lọc bộ đề ngẫu nhiên' readonly='readonly' id='num_$id' class='textbox'></td>";
			}
			echo "
					<td><input type='text' value='$num' readonly='readonly' id='num_$id' class='textbox'></td>
					<td><input type='text' value='$time' readonly='readonly' id='time_$id' class='textbox'></td>
					
			<td><a href='./settings.php?eid=$id'>Sửa Đổi</a></td>
			<td><a href='javascript:changestatus(\"delete\",$id);'>delete</a></td>
			
			</tr>";
			$xx++;
			$d++;
		}
	       
		
		
		echo "</table></div>";
		
	?>

