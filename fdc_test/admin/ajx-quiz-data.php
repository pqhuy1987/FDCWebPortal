<?php
error_reporting(0);
require_once "./auth/config.php";



$dokho = $_GET["dokho"];
settype($dokho, "int");
$idTL = $_GET["idTL"];
settype($idTL, "int");
$id_sub = $_GET["id_sub"];
settype($id_sub, "int");
?>
<script type="text/javascript"> 
$(document).ready(function() {

	 $("#Catid").change(function(){
		 var id		= $(this).val();
		 var dokho	= $("#dokho").val();
		 var id_sub	= $("#Catid_sub").val();
		 $.get("ajx-quiz-data.php", {idTL:id, dokho:dokho, id_sub:id_sub}, function(data){
				$("#maindiv").html(data);
		 });
	 });
	 
	 $("#Catid_sub").change(function(){
		 var id_sub	= $(this).val();
		 var id		= $("#Catid").val();
		 var dokho	= $("#dokho").val();
		 $.get("ajx-quiz-data.php", {idTL:id, dokho:dokho, id_sub:id_sub}, function(data){
				$("#maindiv").html(data);
		 });
	 });	 
	 
	 
	 $("#dokho").change(function(){
		 var dokho	= $(this).val();
		 var id		= $("#Catid").val();
		 var id_sub	= $("#Catid_sub").val();
		 console.log(id);
		 $.get("ajx-quiz-data.php", {idTL:id, dokho:dokho, id_sub:id_sub}, function(data){
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
$catid_sub_2 = $id_sub;
$dokho_2 = $dokho;

if (($catid_2 == NULL)&&($dokho_2 == NULL))
{
	$res2 = mysqli_query($connect_2,"SELECT * FROM quiz order by id desc limit $start,10000");
} else if (($catid_2 != NULL)&&($dokho_2 == NULL))
{
	if ($catid_sub_2 == NULL)
		$res2 = mysqli_query($connect_2,"SELECT * FROM quiz where catid=$catid_2 order by id desc limit $start,10000");
	else
		$res2 = mysqli_query($connect_2,"SELECT * FROM quiz where catid=$catid_2 AND id_sub=$catid_sub_2 order by id desc limit $start,10000");
} else if (($catid_2 == NULL)&&($dokho_2 != NULL))
{
	$res2 = mysqli_query($connect_2,"SELECT * FROM quiz where dokho=$dokho_2 order by id desc limit $start,10000");
}
else{
	if ($catid_sub_2 == NULL)
		$res2 = mysqli_query($connect_2,"SELECT * FROM quiz where catid=$catid_2 AND dokho=$dokho_2 order by id desc limit $start,10000");
	else 
		$res2 = mysqli_query($connect_2,"SELECT * FROM quiz where catid=$catid_2 AND dokho=$dokho_2 AND id_sub=$catid_sub_2 order by id desc limit $start,10000");
}
	
echo "<div id='maindiv'>";

//echo $start;

       	 $delcnt1=mysqli_num_rows($res2);
	     $tcount=$delcnt1;
	     echo "<input type='hidden' value='$tcount' id='tcount'>";
                    
		echo '<div class="admin_table"><table border="0" cellspacing="0" cellpadding="0"`	 >
        <tr>
			<th id="ques2" >Số Thứ Tự</th>
          	<th id="ques" >Câu Hỏi		</th>';
?>
			<th> <select name="Catid" id="Catid"><option  value="">-- Chọn Chuyên Mục --
             <?php 
				$category_temp = mysqli_query($connect_2,"SELECT * FROM category order by id desc");
				while ($row_category_temp = mysqli_fetch_array($category_temp))
				{
			 ?>
            		<option value="<?php echo $row_category_temp["id"]?>" <?php if ($catid_2 == $row_category_temp["id"]) echo "selected='selected'"; ?> ><?php echo $row_category_temp["category"]?></option>
        	 <?php 
				}
			 ?>
            </option></select></th>
            
			<th> <select name="Catid_sub" id="Catid_sub"><option  value="">-- Chọn Chuyên Đề --
             <?php
			 	$res3 = mysqli_query($connect_2,"SELECT * FROM category_sub where id='$catid_2' order by id_sub"); 
				while ($row_res3 = mysqli_fetch_array($res3))
				{
			 ?>
            		<option value="<?php echo $row_res3["id_sub"]?>" <?php if ($catid_sub_2 == $row_res3["id_sub"]) echo "selected='selected'"; ?> ><?php echo $row_res3["name_sub"]?></option>
        	 <?php 
				}
			 ?>
            </option></select></th>
            
			<th> <select name="dokho" id="dokho"><option  value="">-- Chọn Độ Khó --
             <?php 
				$dokho = mysqli_query($connect_2,"SELECT DISTINCT dokho FROM quiz order by dokho desc");
				while ($row_dokho = mysqli_fetch_array($dokho))
				{
			 ?>
            		<option value="<?php echo $row_dokho["dokho"]?>" <?php if ($row_dokho["dokho"] == $dokho_2) echo "selected='selected'"; ?> ><?php if ($row_dokho["dokho"] == 1) echo "Trung Bình"; else if ($row_dokho["dokho"] == 2) echo "Khá Khó"; else if ($row_dokho["dokho"] == 3) echo "Khó"; else if ($row_dokho["dokho"] == 4) echo "Rất Khó"; else echo "Trung Bình"  ?></option>

        	 <?php 
				}
			 ?>
            </option></select></th>
<?php
      echo '
	  		<th>Đáp Án		</th>
          	<th>Câu 1		</th>
	  		<th>Câu 2		</th>
			<th>Câu 3		</th>
	  		<th>Câu 4		</th>
	  		<th>Trạng Thái	</th>
			<th>Ngày Tạo	</th>
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
			$opt3 = $line['opt3'];
			$opt4 = $line['opt4'];
			
			
			$date = $line['datee'];
			$status = $line['status'];
			$datee = $line['datee'];
			
			$catid =  $line['catid'];
			$dokho =  $line['dokho'];
			$id_sub =  $line['id_sub'];
			
			$res3 = mysqli_query($connect_2,"SELECT category FROM category order by id = $catid desc limit 0,1");
			$res4 = mysqli_query($connect_2,"SELECT name_sub FROM category_sub order by id_sub = $id_sub desc limit 0,1");
			
			$line2 = mysqli_fetch_assoc($res3);
			$line3 = mysqli_fetch_assoc($res4);
			
			$category = $line2['category'];
			$category_sub = $line3['name_sub'];

			
			if($status=='susbend')
			{
			   $stle_bg="style='background-color:#C16161;color:#fff;text-shadow:none;'";
			}
		    else
			{
			    $stle_bg="";
			}
			echo "<tr id='row_$id'>";
?>
			
			<td id='ques2' ><?php echo "Câu số: $id"?></td><td id='ques' ><?php echo $qns?></td><td><?php echo $category?></td><td><?php echo $category_sub?></td><td><?php if ($dokho == 1) echo "Trung Bình"; else if ($dokho == 2) echo "Khá Khó"; else if ($dokho == 3) echo "Khó"; else if ($dokho == 4) echo "Rất Khó"; else echo "Trung Bình"  ?></td>
<?php		
			echo "<td>Câu $ans</td>
			<td>$opt1</td><td>$opt2</td><td>$opt3</td><td>$opt4</td><td $stle_bg id='status_$id'><a href='javascript:changestatus(\"$status\",$id);' id='href_status_$id'> $status</a></td><td>$datee</td>
			
			<td> <a href='javascript:changestatus(\"delete\",$id);'>Xóa</a></td>
			<td><a href='./add-question.php?eid=$id'>Sửa Đổi</a></td>
			</tr>";
			$xx++;
			$d++;
		}
	       
		
		
		echo "</table></div>";
		
	?>

