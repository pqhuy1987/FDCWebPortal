<?php
error_reporting(0);
require_once "./auth/config.php";

$idTL = $_GET["idTL"];
settype($idTL, "int");

?>
<script type="text/javascript"> 
$(document).ready(function() {
	 $("#Catid").change(function(){
		 var id	= $(this).val();
		 console.log(id);
		 $.get("ajx-quiz-data.php", {idTL:id}, function(data){
			$("#maindiv").html(data);
		 });
	 });
});
</script>

<?php

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

$catid_2 = $idTL;

if ($catid_2 == NULL)
	$res2 = mysqli_query($connect_2,"SELECT * FROM quiz order by id desc limit $start,100");
else
	$res2 = mysqli_query($connect_2,"SELECT * FROM quiz where catid=$catid_2 order by id desc limit $start,100");
	
echo "<div id='maindiv'>";

//echo $start;

       	 $delcnt1=mysqli_num_rows($res2);
	     $tcount=$delcnt1;
	     echo "<input type='hidden' value='$tcount' id='tcount'>";
                    
		echo '<div class="admin_table"><table border="0" cellspacing="0" cellpadding="0" >
        <tr>
          	<th>Câu Hỏi		</th>';
?>
			<th> <select name="Catid" id="Catid"><option  value="">-- Chọn Chuyên Mục --
             <?php 
				$category_temp = mysqli_query($connect_2,"SELECT * FROM category order by id desc");;
				while ($row_category_temp = mysqli_fetch_array($category_temp))
				{
			 ?>
            		<option value="<?php echo $row_category_temp["id"]?>" <?php if ($catid_2 == $row_category_temp["id"]) echo "selected='selected'"; ?> ><?php echo $row_category_temp["category"]?></option>

        	 <?php 
				}
			 ?>
            </option></select></th>
<?php
        echo '<th>Đáp Án		</th>
          	<th>Câu 1		</th>
	  		<th>Câu 2		</th>
	  		<th>Trạng Thái	</th>
	  		<th>Xóa			</th>
	 		<th>Sửa Đổi</th>
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
			
			$catid =  $line['catid'];
			
			$res3 = mysqli_query($connect_2,"SELECT category FROM category order by id = $catid desc limit 0,1");
			$line2 = mysqli_fetch_assoc($res3);
			$category = $line2['category'];

			
			if($status=='susbend')
			{
			   $stle_bg="style='background-color:#C16161;color:#fff;text-shadow:none;'";
			}
		    else
			{
			    $stle_bg="";
			}
			echo "<tr id='row_$id'>";
			
			
			echo "<td>$qns</td><td>$category</td><td>Câu $ans</td>
			<td>$opt1</td><td>$opt2</td><td $stle_bg id='status_$id'><a href='javascript:changestatus(\"$status\",$id);' id='href_status_$id'> $status</a></td>
			
			<td> <a href='javascript:changestatus(\"delete\",$id);'>Xóa</a></td>
			<td><a href='./add-question.php?eid=$id'>Sửa Đổi</a></td>
			</tr>";
			$xx++;
			$d++;
		}
	       
		
		
		echo "</table></div>";
		
	?>

