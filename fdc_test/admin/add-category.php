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
 $('#m3').html("<span class='curr_mnu'>Add Category</span>")
 
 });
function submit_category()
{
	$catname=$('#catname').val();
	$catstatus=$('#catstatus').val();


	if ($catname=="") {
		$('#error_msg').html("Category name is empty..")
	}
	
	else
	{
		     $.ajax({//Make the Ajax Request
                    type: "POST",
                    url: "./ajx-addcategory.php",
                    data:{catname:$catname,catstatus:$catstatus},
                    success: function(data){
			
                       $('#error_msg').html(""); 
                 $('#msg').html(data);
		 
		 setTimeout(function(){
			
			 window.location.href="./add-category.php";	
			
                          },1000);
                    }
                });
	}
}
</script>
<?php

   
			echo '<div class="form"><div id="error_msg" class="errortext"></div><div id="msg"></div>';
			
         		echo "<form name=de method='post' action=''>";
			echo "<div class='form_con'> <div class='form_element lable'>Category Name</div><div class='form_element'><input type=text name=catname id='catname' value=''  class='textbox'></div></div>";
			
			echo "<div class='form_con'> <div class='form_element lable'> Status : </div><div class='form_element'><select name='catstatus' id='catstatus' class='selectbox'><option value='release'>release</option><option value='susbend'>susbend</option></select></div>";
			 
			

			echo " <span style='float:left;'>";
			
                          echo "<input name=submit type='button' value=submit class='form_button' onclick='submit_category()'>";
			
                        
			echo "</span></form></div>";
    
}
	?>


