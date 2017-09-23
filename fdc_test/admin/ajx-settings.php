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

?>
<script type='text/javascript'>
var pp=1;
$(document).ready(function(){
 $('#m7').html("<span class='curr_mnu'>Xây Dựng Bộ Đề</span>")
 		 $("#Catid").change(function(){
		 var id	= $(this).val();
		 $.get("ajx-settings.php", {idTL:id}, function(data){
			$("#test1").html(data);
		 });
	 });
 });
</script>
			 <?php
				$category_temp_sub = mysqli_query($connect_2,"SELECT * FROM category_sub where id = $idTL order by id_sub desc");
				while ($row_category_temp_sub = mysqli_fetch_array($category_temp_sub))
				{
 			?>        
					<li><input type="checkbox" name="check_list[]" value="<?php echo $row_category_temp_sub["id_sub"]?>"/> <?php echo $row_category_temp_sub["name_sub"]?> <br /></li>
			<?php 
                }
            ?>                                                                               
<?php
}     
?>


