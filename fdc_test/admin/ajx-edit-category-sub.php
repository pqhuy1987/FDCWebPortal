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
	
	$res2 = mysqli_query($connect_2,"SELECT * FROM category_sub order by id_sub desc limit $start,10");
	
	echo "<div id='maindiv'>";

	//echo $start;

       	$delcnt1=mysqli_num_rows($res2);
	    $tcount=$delcnt1;
	    echo "<input type='hidden' value='$tcount' id='tcount'>";
                    
		echo '<div class="admin_table"><table border="0" cellspacing="0" cellpadding="0" >
        <tr>
          
          <th>Chuyên Đề</th>
          <th>Chuyên Mục</th>
          <th>Sửa Đổi</th>
	  	  <th>Xóa</th>
	   	  <th>Cập Nhật</th>
	 
        </tr>';
		$xx=0;
		$d=0;
		
		 while($line = mysqli_fetch_assoc($res2))
		 {
			$id = $line['id_sub'];
			
			$catname = $line['name_sub'];
			$catstatus = $line['category'];
	
			echo "<tr id='row_$id'>";
			
			echo "<td><input type='text' value='$catname' readonly='readonly' id='catname_$id' class='textbox'></td>";
?>
			<td>
            	<select name='catstatus' id='catstatus_<?php echo $id ?>' class='selectbox' disabled='disabled'>
                <optgroup value='$catstatus' label='<?php echo $catstatus?>' ><?php echo $catstatus?></strong></option>   
             	<?php 
				$category_temp = mysqli_query($connect_2,"SELECT * FROM category order by id desc");
				while ($row_category_temp = mysqli_fetch_array($category_temp))
				{
			 	?>
            		<option value="<?php echo $row_category_temp["id"]?>" data-value="<?php echo $row_category_temp["category"]?>" <?php if($catstatus == $row_category_temp["category"]) echo "selected='selected'"?> ><?php echo $row_category_temp["category"]?></option>

        	 	<?php 
				}
			 	?>
            	</option></select>
            
            </td>
<?php		
			echo "
			<td><a href='javascript:changestatus(\"edit\",$id);'>Edit</a> </td>
			<td><a href='javascript:changestatus(\"delete\",$id);'>delete</a></td>
			<td><input type='button' onclick='changestatus(\"update\",$id)' value='Update' class='form_button' style='float:none;text-align:center;'></td>
			</tr>";
			$xx++;
			$d++;
		}
	       
		
		
		echo "</table></div>";
		
	?>

