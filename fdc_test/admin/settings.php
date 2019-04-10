<?php
error_reporting(0);
include "authheader.php";
if($block != true)
{
require_once "./auth/config.php";
$connect_2 = mysqli_connect("$hostname","$username","$password");
if($connect_2)
{
	$dbcon = mysqli_select_db($connect_2, "$dbname");
}
include "heade.php";
$eid=$_GET['eid'];

if($eid!="")
{
	$edit_res 		= 	mysqli_query($connect_2,"SELECT * FROM quiz where id='$eid'");
	$row			=	mysqli_fetch_assoc($edit_res);
	$exam_name		=	trim($row['exam_name']);
	$pagenum		=	trim($row['pagenum']);
	$examtime		=	trim($row['examtime']);
	
	$edit_cat_name = mysqli_query($connect_2,"SELECT * FROM category where id='$catidd'");
	$cat_row=mysqli_fetch_assoc($edit_cat_name);
	$edit_cat_name=$cat_row['category'];
}

?>
<script type='text/javascript'>
var pp=1;
var val = [];
$(document).ready(function(){
 $('#m7').html("<span class='curr_mnu'>Xây Dựng Bộ Đề</span>")
 		 $("#Catid").change(function(){
			 var id	= $(this).val();
			 $.get("ajx-settings.php", {idTL:id}, function(data){
				$("#test1").html(data);
			 });
	 	 });
		 
		$('#submit').click(function(){
			
			$(':checkbox:checked').each(function(i){
          		val[i] = $(this).val();
        	});

        	$("input[type=text]").each(function(i){
          		val_text[i] = $(this).val();
          		console.log($val_text[i]);
        	});
			
			$pnum=$('#num').val();
			$etime=$('#etime').val();
			$catname=$('#catname').val();
			$filter=$('#filter').val();
			$length=val.length;
			
			console.log($filter);
			var jsonString = JSON.stringify(val);
		
			$.ajax({//Make the Ajax Request
					type: "POST",
					url: "./ajx-update-settings.php",
					data:{pnum:$pnum, etime:$etime, length:$length, jsonString:jsonString, catname:$catname, filter:$filter},
					success: function(data){

					$('#msg').html("<font color='green'>"+data+"</font>");
			 
					setTimeout(function(){
				 		window.location.href="./settings.php";	
							  },1000);
						}
					});			 
		 });
	
 });
</script>
<?php
			
			echo '<div class="form"><div id="error_msg" class="errortext"></div><div id="msg"></div>';
			echo "<div class='form_con'> <div class='form_element lable'>Bộ Đề Kiểm Tra: </div><div class='form_element'><input type=text name=catname id='catname' value=''  class='textbox'></div></div>";
?>
			<th> <div class='form_con'> <div class='form_element lable'> Tên Chuyên Mục : </div><div class='form_element'><select name='Catid' id='Catid' class='selectbox'>
             <?php 
				$category_temp = mysqli_query($connect_2,"SELECT * FROM category order by id desc");
				while ($row_category_temp = mysqli_fetch_array($category_temp))
				{
			 ?>
            		<option value="<?php echo $row_category_temp["id"]?>"><?php echo $row_category_temp["category"]?></option>
        	 <?php 
				}
			 ?>
            </select></th>
 			<div id='test1'>
			 <?php
			 	$category_temp = mysqli_query($connect_2,"SELECT * FROM category order by id desc");
				$row_category_temp = mysqli_fetch_array($category_temp);
			 	$tem_id = $row_category_temp["id"];           
				$category_temp_sub = mysqli_query($connect_2,"SELECT * FROM category_sub where id = $tem_id  order by id_sub desc");
				while ($row_category_temp_sub = mysqli_fetch_array($category_temp_sub))
				{
					$row_quiz_with_temp_sub = mysqli_query($connect_2,"SELECT * FROM quiz where id_sub = $row_category_temp_sub[id_sub] order by id desc");
					$rowcount=mysqli_num_rows($row_quiz_with_temp_sub);
 			?>        
					<li><input type="checkbox" name="check_list[]" id="" value="<?php echo $row_category_temp_sub["id_sub"]?>"/> <?php echo $row_category_temp_sub["name_sub"]; echo " (".$rowcount." câu)" ?>  <input type=text size="3" disabled> <br /></li>
			<?php 
                }
            ?> 
            </div>           
<?php
			
			$res = mysqli_query($connect_2,"SELECT * FROM settings where id='1'");
			
			if($res)
			{
				$row=mysqli_fetch_assoc($res);
				$pnum=$row['pagenum'];
				$examtime =$row['examtime'];
				$examtimearr=explode(":","$examtime");
				$examtime_val=$examtimearr[0].":".$examtimearr[1];
			}
			
			echo "<div class='form_con'> <div class='form_element lable'> Số câu hỏi hiển trị trên một trang : </div><div class='form_element'><select name='num' id='num' class='selectbox'>";
			
			echo "<option value=''>-- Chọn Số Câu Hỏi --</option>";
			
			for($i=20;$i<=200;$i=$i+20)
			{
				echo "<option value='$i'>$i</option>";
			}
				echo "<option value='-1'>Tự chọn</option>";
			echo "</select></div>  <div class='clear'></div><br><div class='form_element lable'> Chọn thời gian kiểm tra : </div><div class='form_element'><select name='etime' id='etime' class='selectbox'>";
			echo "<option value=''>-- Chọn Thời Gian Làm Bài --</option>";

		 	echo '
    			<option value="00:30:00">00:30</option>
     			<option value="00:45:00">00:45</option>
    			<option value="01:00:00">01:00</option>
    			<option value="01:15:00">01:15</option>
    			<option value="01:45:00">01:45</option>
    			<option value="02:00:00">02:00</option>
    			<option value="02:15:00">02:15</option>
    			<option value="02:30:00">02:30</option>
     			<option value="02:45:00">02:45</option>
     			<option value="03:00:00">03:00</option>
      			<option value="03:30:00">03:30</option>
      			<option value="04:00:00">04:00</option>
        	';
       		echo "</select></div> ";
			echo "</select></div>  <div class='clear'></div><div class='form_element lable'> Chọn phương pháp lọc bộ đề : </div><div class='form_element'><select name='filter' id='filter' class='selectbox'>";
			echo "<option value=''>-- Chọn Cách Lọc Bộ Đề --</option>";
?>
    			<option value="1">Lọc Theo Câu Hỏi Cũ Nhất</option>
     			<option value="2">Lọc Theo Câu Hỏi Mới Nhất</option>
    			<option value="<?php echo(rand (3,10)) ?>">Lọc Theo Câu Hỏi Ngẫu Nhiên</option>
<?php

			
       		echo "</select></div> <div class='clear'></div><br> <span style='float:left;'>";
			
            echo "<input name=submit id=submit type='button' value=submit class='form_button' onclick='submit_settings()'>";
			       
			echo "</span></form></div>";
}     
	?>


