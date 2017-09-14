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

$idTL = $_GET["idTL"];
settype($idTL, "int");

$res2 = mysqli_query($connect_2,"SELECT * FROM category_sub where id='$idTL' order by id_sub");

?>

<?php
			 echo "<div class='form_element lable'>Chọn Chuyên Đề : </div><div class='form_element'><select style='height: 35px;' name='cat_sub' id='cat_sub' class='selectbox'>";

			 
			 while($line = mysqli_fetch_assoc($res2))
		     {
				 $catid_sub=$line['id_sub'];
				 $catname_sub=$line['name_sub'];
?>
				<option value='<?php echo $catid_sub ?>' <?php if ($catidd == $catid_sub ) echo "selected='selected'" ?> ><?php echo $catname_sub ?> </option>
<?php 	
			 }
?>			 
			</select></div>	            
<?php
}
?>


