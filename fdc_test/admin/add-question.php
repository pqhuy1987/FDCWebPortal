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
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type='text/javascript'>

function CKupdate(){
    for ( instance in CKEDITOR.instances )
        CKEDITOR.instances[instance].updateElement();
}

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
	
$edit_res = mysqli_query($connect_2,"SELECT * FROM quiz where id='$eid'");
$row=mysqli_fetch_assoc($edit_res);
$ques=trim($row['question']);
$opt1=trim($row['opt1']);
$opt2=trim($row['opt2']);
$opt3=trim($row['opt3']);
$opt4=trim($row['opt4']);
$answer=trim($row['answer']);
$catidd=$row['catid'];
$edit_cat_name = mysqli_query($connect_2,"SELECT * FROM category where id='$catidd'");
$cat_row=mysqli_fetch_assoc($edit_cat_name);
$edit_cat_name=$cat_row['category'];
}
$res = mysqli_query($connect_2,"SELECT * FROM category where status='release' order by id  ");
   
				echo '<div class="form"><div id="error_msg" class="errortext"></div><div id="msg"></div>';
			
         		echo "<form name=de method='post' action=''>";
				echo "<div class='form_con'> <div class='form_element lable'>Câu hỏi : </div><div class='form_element'><textarea name=question  id='ques' value='' class='textbox' />$ques</textarea></div></div>";
?>
<script>
var editor = CKEDITOR.replace( 'ques',{
	language:'vi',
			 	
	toolbar:[
	['Source','-','Save','NewPage','Preview','-','Templates'],
	['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print'],
	['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
	['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
	['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
	['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
	['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
	['Link','Unlink','Anchor'],
	['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
	['Styles','Format','Font','FontSize'],
	['TextColor','BGColor'],
	['Maximize', 'ShowBlocks','-','About']
	]
});
</script>
<?php
			 echo "<div class='form_con'> <div class='form_element lable'>Chọn chuyên mục : </div><div class='form_element'><select style='height: 35px;' name='cat' id='cat' class='selectbox'>";
			 
			 while($line = mysqli_fetch_assoc($res))
		     {
				 $catid=$line['id'];
				 $catname=$line['category'];
				 if($edit_cat_name!="")
				 echo "<option value='$catidd'>$edit_cat_name</option>";
			     echo "<option value='$catid'>$catname</option>";
			 }
			 
			echo "</select></div></div><div class='form_con'> <div class='form_element lable'>Lựa chọn 1 : </div><div class='form_element'><input type=textarea name=opt1 id='opt1' value='$opt1'  class='textbox'></div></div>";
            echo "<div class='form_con'> <div class='form_element lable'>Lựa chọn 2 : </div><div class='form_element'><input type=textarea name=opt2 id='opt2' value='$opt2'  class='textbox'></div></div>";
            echo "<div class='form_con'> <div class='form_element lable'>Lựa chọn 3 : </div><div class='form_element'><input type=textarea name=opt3 id='opt3' value='$opt3'  class='textbox'></div></div>";
            echo "<div class='form_con'> <div class='form_element lable'>Lựa chọn 4 : </div><div class='form_element'><input type=textarea name=opt4 id='opt4' value='$opt4'  class='textbox'></div></div>";
			echo "<div class='form_con'> <div class='form_element lable'>Đáp án đúng : </div><div class='form_element'><select style='height: 35px;' name='ans' id='ans' class='selectbox'>";
			
			if($answer!="")
			  	echo "<optgroup value='$answer' label='Lựa chọn $answer'>Lựa chọn $answer</strong></option>";
				echo "<option value='$answer'>Lựa chọn $answer</option> <option value='1'>Lựa chọn 1</option><option value='2'>Lựa chọn 2</option><option value='3'>Lựa chọn 3</option><option value='4'>Lựa chọn 4</option></select></div></div>";
			echo " <span style='float:left;'>";
			if($eid=="")
              echo "<input name=submit type='button' value=submit class='form_button' onclick='submit_quiz()'><input type='hidden' value='add' id='imptid'>";
			else
			  echo "<input name=submit type='button' value=Update class='form_button' onclick='CKupdate();submit_quiz()'><input type='hidden' value='$eid' id='imptid'>";                  
			echo "</span></form></div>";   
}
?>


