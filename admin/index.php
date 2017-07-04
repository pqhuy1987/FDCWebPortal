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

			<?php
            $sotin1trang = 50;
        
            if (isset($_GET["trang"]))
            {
                $trang = $_GET["trang"];
                settype($trang, "int");
            }else {
                $trang = 1;
            }
        
            $from = ($trang - 1)*$sotin1trang;
    
            $ChonTin_Theo_PhanTrang = ChonTin_Theo_PhanTrang($connect, $from, $sotin1trang);
            
            while ($row_ChonTin_Theo_PhanTrang = mysqli_fetch_array($ChonTin_Theo_PhanTrang))
            {
            ?>
          <tr>
            <td>idLich::<?php echo $row_ChonTin_Theo_PhanTrang["idTin"]?></td>
            <td><a href="suaTin.php?idTin=<?php echo $row_ChonTin_Theo_PhanTrang["idTin"]?>"><?php echo $row_ChonTin_Theo_PhanTrang["TieuDe"]?></a><br />
              <?php echo $row_ChonTin_Theo_PhanTrang["TomTat"]?></td>
            <td>&nbsp;</td>
            <td><a href="suaTin.php?idTin=<?php echo $row_ChonTin_Theo_PhanTrang["idTin"]?>">Sửa</a> - <a onclick="return confirm('Bạn có chắc muốn xóa?')" href="xoaTin.php?idTin=<?php echo $row_ChonTin_Theo_PhanTrang["idTin"]?>">Xóa</a></td>
          </tr>
          <?php 
            }
          ?>
        </table></td>
  </tr>
    </table>
	<style>
        #phantrang {text-align: center; margin:15px auto; overflow:auto}
        #phantrang a {background-color: #000; color:#ff0; padding:5px; margin-right: 3px;}
        #phantrang a:hover{background-color:#09f}
    </style>
    <div id="phantrang">
		<?php 
            $Tongsotin = ChonTin_TatCa($connect);
            $row_Tongsotin = mysqli_num_rows($Tongsotin);
            $tongsotrang =  ceil($row_Tongsotin/$sotin1trang);
            for ($i = 1; $i <=$tongsotrang; $i++)
			{
        ?>
        
        	<a <?php if($i==$trang) echo "style='background-color:red' "; ?> href="listTin.php?p=&trang=<?php echo $i?>"><?php echo $i ?></a>
        
        <?php 
            }
        ?>
    </div>
</body>
</html>
