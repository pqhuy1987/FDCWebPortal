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
        <td colspan="5">DANH SÁCH TIN</td>
        </tr>
      <tr>
        <td width="148">ID TIN</td>
        <td width="551">TIÊU ĐỀ VÀ TÓM TẮT</td>
        <td width="219">
        <form id="form1" name="form1" method="post" action="">
          <label for="idTL">THỂ LOẠI</label>
          <select name="idTL" id="idTL">
          <option  value="" selected="selected">-Chọn-</option>
			<?php 
                $theloai = DanhSachTheLoai($connect);
                while ($row_theloai = mysqli_fetch_array($theloai))
                {
            ?>
                <option value="<?php echo $row_theloai["idTL"]?>"><?php echo $row_theloai["TenTL"]?></option>
    
            <?php 
                }
            ?>
          </select>
          <label for="idLT"><br />
            LOẠI TIN</label>
          <select name="idLT" id="idLT">
          <option  value="">-Chọn-</option>
			<?php 
                $loaitin = DanhSachLoaiTin($connect);
                while ($row_loaitin = mysqli_fetch_array($loaitin))
                {
            ?>
                <option  value="<?php echo $row_loaitin["idLT"]?>"><?php echo $row_loaitin["Ten"]?></option>
    
            <?php 
                }
            ?>
          </select>
        </form></td>

        <td width="121">GHI CHÚ</td>
        <td width="127"><a href="themTin.php">Thêm</a></td>
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
            <td>idTin:<?php echo $row_ChonTin_Theo_PhanTrang["idTin"]?></td>
            <td><a href="suaTin.php?idTin=<?php echo $row_ChonTin_Theo_PhanTrang["idTin"]?>"><?php echo $row_ChonTin_Theo_PhanTrang["TieuDe"]?></a><br />          <img src="../upload/tintuc/<?php echo $row_ChonTin_Theo_PhanTrang["urlHinh"]?>" width="150" /><?php echo $row_ChonTin_Theo_PhanTrang["TomTat"]?></td>
            <td><?php echo $row_ChonTin_Theo_PhanTrang["TenTL"]?>-<?php echo $row_ChonTin_Theo_PhanTrang["Ten"]?></td>
            <td>Số Lần Xem:<?php echo $row_ChonTin_Theo_PhanTrang["SoLanXem"]?>-<br />
              <?php echo $row_ChonTin_Theo_PhanTrang["TinNoiBat"]?> - <?php echo $row_ChonTin_Theo_PhanTrang["AnHien"]?><br /></td>
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
