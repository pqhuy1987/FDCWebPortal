<?php 
	ob_start();
    session_start();
    
    if (isset($_SESSION['admin']))
    {
    	;
    } else {
    	header("location: ../index.php");
    }
    
    require "../lib/dbCon.php";
    require "../lib/quantri.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Trang Quản Trị</title>
<link rel="stylesheet" type="text/css" href="layout.css">

<script type="text/javascript" src="../jquery-slider-master/js/jquery-2.1.0.min.js"></script>
<script>
$(document).ready(function() {
    $("#idTL").change(function(){
		var id	= $(this).val();
		$.get("../loaitin.php", {idTL:id}, function(data){
			$("#idLT").html(data);
		});
	});
});

$(document).ready(function() {
    $("#idLT").change(function(){
		var id	= $(this).val();
		$.get("../chitiettin.php", {idLT:id}, function(data){
			$("#test").html(data);
		});
	});
});

</script>
</head>

<body>
<table width="auto" border="1">
  <tr>
    <td width="1198" id="hangTieuDe">TRANG QUẢN TRỊ</td>
  </tr>
  <tr>
    <td id="hang2"><?php require "menu.php"; ?></td>
  </tr>
  <tr>
    <td height="58"><table width="1200" border="1">
      <tr>
        <td id="hang3" colspan="4">DANH SÁCH TIN</td>
        </tr>
      <tr>
        <td width="246">ID LỊCH CÔNG TY</td>
        <td width="313">TIÊU ĐỀ </td>
        <td width="533">NỘI DUNG</td>

        <td width="80"><a href="themTin.php">Thêm</a></td>
      </tr>


        </table></td>
  </tr>
    </table>

</body>
</html>
