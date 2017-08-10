<?php
error_reporting(0);
include "authheader.php";
if($block != true)
{
require_once "./auth/config.php";
$connect = mysqli_connect("$hostname","$username","$password");
if($connect)
{
	$dbcon = mysqli_select_db($connect, "$dbname");
}
include "heade.php";
?>
<script type='text/javascript'>
var pp=1;
$(document).ready(function(){
 $('#m2').html("<span class='curr_mnu'>Add Question</span>")
 
 });
function submit_quiz()
{
	$ques=$('#ques').val();
	$catid=$('#cat').val();
	$opt1=$('#opt1').val();
	$opt2=$('#opt2').val();
	$opt3=$('#opt3').val();
	$opt4=$('#opt4').val();
	$ans=$('#ans').val();
	$imptid=$('#imptid').val();
	
	if ($ques=="") {
		$('#error_msg').html("Enter your question..")
	}
	else if ($opt1=="" || $opt2=="") {
		$('#error_msg').html("Enter atleast two options ..")
	}
	else if ($ans=="") {
		$('#error_msg').html("Enter your answer.. ")
	}
	else
	{
		     $.ajax({//Make the Ajax Request
                    type: "POST",
                    url: "./ajx-addquiz.php",
                    data:{ques:$ques,catid:$catid,opt1:$opt1,opt2:$opt2,opt3:$opt3,opt4:$opt4,ans:$ans,imptid:$imptid},
                    success: function(data){
			
                       $('#error_msg').html(""); 
                 $('#msg').html(data);
		 
		 setTimeout(function(){
			if ($imptid=="add") {
			 window.location.href="./add-question.php";	
			}
			else
			{
     	            window.location.reload();
			}
                          },1000);
                    }
                });
	}
}
</script>
<?php
$sub = $_POST['submit'];
$dat = date('y-m-d');
$eid=$_GET['eid'];
if($eid!="")
{
	
$edit_res = mysqli_query($connect,"SELECT * FROM quiz where id='$eid'");
$row=mysqli_fetch_assoc($edit_res);
$ques=trim($row['question']);
$opt1=trim($row['opt1']);
$opt2=trim($row['opt2']);
$opt3=trim($row['opt3']);
$opt4=trim($row['opt4']);
$answer=trim($row['answer']);
$catidd=$row['catid'];
$edit_cat_name = mysqli_query($connect,"SELECT * FROM category where id='$catidd'");
$cat_row=mysqli_fetch_assoc($edit_cat_name);
$edit_cat_name=$cat_row['category'];
}
$res = mysqli_query($connect,"SELECT * FROM category where status='release' order by id  ");
   
			echo '<div class="form"><div id="error_msg" class="errortext"></div><div id="msg"></div>';
			
         		echo "<form name=de method='post' action=''>";
			echo "<div class='form_con'> <div class='form_element lable'>Question</div><div class='form_element'><textarea name=question  id='ques' value='' class='textbox' />$ques</textarea></div></div>";
			
			echo "<div class='form_con'> <div class='form_element lable'>Select Category : </div><div class='form_element'><select name='cat' id='cat' class='selectbox'>";
			 while($line = mysqli_fetch_assoc($res))
		           {
				 $catid=$line['id'];
				 $catname=$line['category'];
				 if($edit_cat_name!="")
				   echo "<option value='$catidd'>$edit_cat_name</option>";
			        echo "<option value='$catid'>$catname</option>";
			       
			   }
			echo "</select></div></div><div class='form_con'> <div class='form_element lable'>Option1</div><div class='form_element'><input type=text name=opt1 id='opt1' value='$opt1'  class='textbox'></div></div>";
                        echo "<div class='form_con'> <div class='form_element lable'>Option2</div><div class='form_element'><input type=text name=opt2 id='opt2' value='$opt2'  class='textbox'></div></div>";
                        echo "<div class='form_con'> <div class='form_element lable'>Option3</div><div class='form_element'><input type=text name=opt3 id='opt3' value='$opt3'  class='textbox'></div></div>";
                        echo "<div class='form_con'> <div class='form_element lable'>Option4</div><div class='form_element'><input type=text name=opt4 id='opt4' value='$opt4'  class='textbox'></div></div>";
			echo "<div class='form_con'> <div class='form_element lable'>Answer : </div><div class='form_element'><select name='ans' id='ans' class='selectbox'>";
			
			if($answer!="")
			  echo "<option value='$answer'>Option $answer</option>";
			echo "<option value='1'>Option 1</option><option value='2'>Option 2</option><option value='3'>Option 3</option><option value='4'>Option 4</option></select></div></div>";
                        

			echo " <span style='float:left;'>";
			if($eid=="")
                          echo "<input name=submit type='button' value=submit class='form_button' onclick='submit_quiz()'><input type='hidden' value='add' id='imptid'>";
			else
			  echo "<input name=submit type='button' value=Update class='form_button' onclick='submit_quiz()'><input type='hidden' value='$eid' id='imptid'>"; 
                        
			echo "</span></form></div>";
    
}
	?>


