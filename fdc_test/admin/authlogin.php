
<?php
$file = "auth/config.php"; 
if(!is_readable($file) or !is_writeable($file))
{
    echo " <span class=\"errortext\">Incorrect file permissions for config.php! <br>
		Must be in read,write mode during installaton</span>";
}
?>


<h4> Enter Admin Login Details</h4>
<div class="form">
 <form name=setf method=POST action='<?php echo $PHP_SELF;?>'>

	<div class='form_con'> <div class='form_element lable'>User NAME </div><div class='form_element'><input class='textbox' name="usern"  type=text value='<?php echo "$un";?>' ></div></div>
	<div class='form_con'> <div class='form_element lable'>Password </div><div class='form_element'><input class='textbox' name="passw"  type=password value='<?php echo "$pw";?>' ></div></div>
	<input name="type" type=hidden value="auth">
	<input type=submit value="Enter" class='form_button' style='float:left;'>
	
 </form>
