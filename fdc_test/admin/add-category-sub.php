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
?>
<script type='text/javascript'>
var pp=1;
$(document).ready(function(){
 $('#m4').html("<span class='curr_mnu'>Thêm Chuyên Đề</span>")
 
 });
function submit_category()
{
	$catname=$('#catname').val();
	$Catid=$('#Catid').val();
	
	console.log($catname);
	console.log($Catid);

	if ($catname=="") {
		$('#error_msg').html("Category name is empty..")
	}
	
	else
	{
		     $.ajax({//Make the Ajax Request
                    type: "POST",
                    url: "./ajx-addcategory-sub.php",
                    data:{catname:$catname,Catid:$Catid},
                    success: function(data){
			
                    $('#error_msg').html(""); 
                 	$('#msg').html(data);
		 
		 setTimeout(function(){
			
			 window.location.href="./add-category-sub.php";	
			
                          },1000);
                    }
                });
	}
}
</script>
<?php
			echo '<div class="form"><div id="error_msg" class="errortext"></div><div id="msg"></div>';
			
         	echo "<form name=de method='post' action=''>";
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
<?php            
			echo "<div class='form_con'> <div class='form_element lable'>Tên Chuyên Đề</div><div class='form_element'><input type=text name=catname id='catname' value=''  class='textbox'></div></div>";
			 
			echo " <span style='float:left;'>";
			
            echo "<input name=submit type='button' value=submit class='form_button' onclick='submit_category()'>";
			
                        
			echo "</span></form></div>";
    
}
	?>


