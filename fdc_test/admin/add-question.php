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
 $('#m2').html("<span class='curr_mnu'>Thêm Câu Hỏi</span>")
 
 $("#cat").change(function(){
		 var id	= $(this).val();
		 $.get("ajx-chuyen-de.php", {idTL:id}, function(data){
			$("#test1").html(data);
		 });
	 });

 });
function submit_quiz()
{
	$ques=$('#ques').val();
	$catid=$('#cat').val();
	$id_sub=$('#cat_sub').val();
	$opt1=$('#opt1').val();
	$opt2=$('#opt2').val();
	$opt3=$('#opt3').val();
	$opt4=$('#opt4').val();
	$ans=$('#ans').val();
	$imptid=$('#imptid').val();
	$dokho=$('#dokho').val();
	
	console.log($id_sub);
	
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
                    data:{ques:$ques,catid:$catid,opt1:$opt1,opt2:$opt2,opt3:$opt3,opt4:$opt4,ans:$ans,imptid:$imptid,dokho:$dokho,id_sub:$id_sub},
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
	$edit_res 	= 	mysqli_query($connect_2,"SELECT * FROM quiz where id='$eid'");
	$row		=	mysqli_fetch_assoc($edit_res);
	$ques		=	trim($row['question']);
	$opt1		=	trim($row['opt1']);
	$opt2		=	trim($row['opt2']);
	$opt3		=	trim($row['opt3']);
	$opt4		=	trim($row['opt4']);
	$answer		=	trim($row['answer']);
	$catidd		=	$row['catid'];
	$dokho		=	$row['dokho'];
	$id_sub		=	$row['id_sub'];
	
	$edit_cat_name = mysqli_query($connect_2,"SELECT * FROM category where id='$catidd'");
	$cat_row=mysqli_fetch_assoc($edit_cat_name);
	$edit_cat_name=$cat_row['category'];
}
$res = mysqli_query($connect_2,"SELECT * FROM category where status='release' order by id");
if($eid!="")
{ 
	$res2 = mysqli_query($connect_2,"SELECT * FROM category_sub where id='$catidd' order by id_sub");
} else {
	$res2 = mysqli_query($connect_2,"SELECT * FROM category_sub where id='$catidd' order by id_sub");
}
   
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
			 echo "<div class='form_con'> <div class='form_element lable'>Chọn Chuyên Mục : </div><div class='form_element'><select style='height: 35px;' name='cat' id='cat' class='selectbox'>
			";
?>
			 <option  value=""> -- Chọn Chuyên Mục -- </option>
<?php 
			 while($line = mysqli_fetch_assoc($res))
		     {
				 $catid=$line['id'];
				 $catname=$line['category'];
?>
				<option value='<?php echo $catid ?>' <?php if ($catidd == $catid ) echo "selected='selected'" ?> ><?php echo $catname ?> </option>
<?php 	
			 }
?>			 
			</select></div></div>
<?php
			 echo "<div id='test1' class='form_con'> <div class='form_element lable'>Chọn Chuyên Đề : </div><div class='form_element'><select style='height: 35px;' name='cat_sub' id='cat_sub' class='selectbox'>";
?>
			 <option  value=""> -- Chọn Chuyên Đề -- </option>
<?php 
			 
			 while($line = mysqli_fetch_assoc($res2))
		     {
				 $catid_sub=$line['id_sub'];
				 $catname_sub=$line['name_sub'];
?>
				<option value='<?php echo $catid_sub ?>' <?php if ($id_sub == $catid_sub ) echo "selected='selected'" ?> ><?php echo $catname_sub ?> </option>
<?php 	
			 }
?>			 
			</select></div></div>
            
            <div class='form_con'> <div class='form_element lable'>Lựa chọn 1 : </div><div class='form_element'><input type=textarea name=opt1 id='opt1' value='<?php echo $opt1 ?>'  class='textbox'></div></div>
            <div class='form_con'> <div class='form_element lable'>Lựa chọn 2 : </div><div class='form_element'><input type=textarea name=opt2 id='opt2' value='<?php echo $opt2 ?>' class='textbox'></div></div>
            <div class='form_con'> <div class='form_element lable'>Lựa chọn 3 : </div><div class='form_element'><input type=textarea name=opt3 id='opt3' value='<?php echo $opt3 ?>'  class='textbox'></div></div>
            <div class='form_con'> <div class='form_element lable'>Lựa chọn 4 : </div><div class='form_element'><input type=textarea name=opt4 id='opt4' value='<?php echo $opt4 ?>'  class='textbox'></div></div>
            
            <div class='form_con'> <div class='form_element lable'>Đáp án đúng : </div><div class='form_element'><select style='height: 35px;' name='ans' id='ans' class='selectbox'>
<?php	
			if($answer!="")
			  	echo "<optgroup value='$answer' label='Lựa chọn $answer'>Lựa chọn $answer</strong></option>";
?>
				<option value='1' <?php if($answer == 1) echo "selected='selected'"?>>Lựa chọn 1</option> 
                <option value='2' <?php if($answer == 2) echo "selected='selected'"?>>Lựa chọn 2</option>
                <option value='3' <?php if($answer == 3) echo "selected='selected'"?>>Lựa chọn 3</option>
                <option value='4' <?php if($answer == 4) echo "selected='selected'"?>>Lựa chọn 4</option></select></div></div>
                
<div class='form_con'> <div class='form_element lable'>Mức Độ Khó : </div><div class='form_element'><select style='height: 35px;' name='dokho' id='dokho' class='selectbox'>
<?php	
			if($dokho!=""){
?>
			  	<optgroup value='<?php echo $dokho ?>' label='Mức Độ <?php if($dokho == 1)  echo "Trung Bình"; else if($dokho == 2) echo "Khá"; else if($dokho == 3) echo "Khó"; else if($dokho == 4) echo "Rất Khó"; else echo "Trung Bình"  ?>'>Mức Độ $dokho</strong></option>
                <option value='1' <?php if($dokho == 1) echo "selected='selected'"?>>Mức Độ Trung Bình</option> 
                <option value='2' <?php if($dokho == 2) echo "selected='selected'"?>>Mức Độ Khá́</option>
                <option value='3' <?php if($dokho == 3) echo "selected='selected'"?>>Mức Độ Khó</option>
                <option value='4' <?php if($dokho == 4) echo "selected='selected'"?>>Mức Độ Rất Khó</option></select></div></div>
<?php 
			} else {
?>
				
				<option value='1' <?php if($dokho == 1) echo "selected='selected'"?>>Mức Độ Trung Bình</option> 
                <option value='2' <?php if($dokho == 2) echo "selected='selected'"?>>Mức Độ Khá́</option>
                <option value='3' <?php if($dokho == 3) echo "selected='selected'"?>>Mức Độ Khó</option>
                <option value='4' <?php if($dokho == 4) echo "selected='selected'"?>>Mức Độ Rất Khó</option></select></div></div>

<?php
			}
			echo " <span style='float:left;'>";
			if($eid=="")
              	echo "<input name=submit type='button' value=submit class='form_button' onclick='CKupdate();submit_quiz()'><input type='hidden' value='add' id='imptid'>";
			else
			  	echo "<input name=submit type='button' value=Update class='form_button' onclick='CKupdate();submit_quiz()'><input type='hidden' value='$eid' id='imptid'>";                  
				echo "</span></form></div>";   
}
?>


