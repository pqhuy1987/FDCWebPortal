<script>
$(document).ready(function() {
    $("#idTL").change(function(){
		var id	= $(this).val();
		$.get("../loaitin.php", {idTL:id}, function(data){
			$("#idLT").html(data);
		});
	});
});

</script>

<?php 
    if (isset($_GET["idTin"])){
      $idTin = $_GET["idTin"];
      settype($idTin, "int");
    } else {
      $idTin = 1;
    }
    CapNhatSoLanXemTin($connect, $idTin);
?>

<?php
    $ChiTietTin_NoiDungTin = ChonNoiDungTin($connect, $idTin);
    $row_ChiTietTin_NoiDungTin = mysqli_fetch_array($ChiTietTin_NoiDungTin);
?>

<h1 class="title"><?php echo $row_ChiTietTin_NoiDungTin['TieuDe'] ?></h1>
<div class="chitiet">
<!--noi dung-->
<?php echo $row_ChiTietTin_NoiDungTin['Content'] ?>
<?php
if ($row_ChiTietTin_NoiDungTin['urlFile'] != null) {
    $path = $row_ChiTietTin_NoiDungTin['urlFile'];
	$file = basename($path);         // $file is set to "index.php"
	
	
?>
<a href="<?php echo $row_ChiTietTin_NoiDungTin['urlFile']?>" target="_blank"><img src="images/attachment.png" width="15" height="15" />  <?php echo urldecode($file);?></a>
<?php 
} else {
	
}
?>
<!--//noi dung-->
</div>
<div class="clear"></div>
<a class="btn_quantam" id="vne-like-anchor-1000000-3023795" href="#" total-like="<?php echo $row_ChiTietTin_NoiDungTin['SoLanXem'] ?>"></a>
<div class="number_count"><span id="like-total-1000000-3023795"><?php echo $row_ChiTietTin_NoiDungTin['SoLanXem'] ?></span></div>
<!--face-->
<div class="left"><div class="fb-like fb_iframe_widget" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true" data-href="http://vnexpress.net/tin-tuc/the-gioi/ukraine-gianh-kiem-soat-nhieu-khu-vuc-gan-hien-truong-mh17-3023795.html" fb-xfbml-state="rendered" fb-iframe-plugin-query="app_id=&amp;href=http%3A%2F%2Fvnexpress.net%2Ftin-tuc%2Fthe-gioi%2Fukraine-gianh-kiem-soat-nhieu-khu-vuc-gan-hien-truong-mh17-3023795.html&amp;layout=button_count&amp;locale=en_US&amp;sdk=joey&amp;send=false&amp;show_faces=true&amp;width=450"></div></div>
<!--twister-->
<div class="left"></div>
<!--google-->
<div class="left"><div id="___plusone_0" style="text-indent: 0px; margin: 0px; padding: 0px; border-style: none; float: none; line-height: normal; font-size: 1px; vertical-align: baseline; display: inline-block; width: 90px; height: 20px; background: transparent;"></div></div>

<div class="clear"></div>






