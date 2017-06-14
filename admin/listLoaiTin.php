<?php 
	ob_start();
    session_start();
    
    if (isset($_SESSION["idUser"]) && ($_SESSION["idGroup"] == 1) )
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
</head>

<body>
<table width="auto" border="1">
  <tr>
    <td id="hangTieuDe">TRANG QUẢN TRỊ</td>
  </tr>
  <tr>
    <td id="hang2"><?php require "menu.php"; ?></td>
  </tr>
  <tr>
    <td><form id="form1" name="form1" method="post" action="">
      <table width="1200" border="1">
        <tr>
          <td colspan="7">DANH SÁCH LOẠI TIN</td>
          </tr>
        <tr>
          <td>ID LOẠI TIN</td>
          <td>TÊN</td>
          <td>TÊN KHÔNG DẤU</td>
          <td>THỨ TỰ</td>
          <td>ẨN HIỆN</td>
          <td>ID THỂ LOẠI</td>
          <td><a href="themLoaiTin.php">THÊM</a></td>
        </tr>
      <?php 
	  	  $DanhSachLoaiTin = DanhSachLoaiTin($connect);
		    while($row_DanhSachLoaiTin = mysqli_fetch_array($DanhSachLoaiTin))
        {
          ob_start();
	   ?>
        <tr>
          <td>{idLT}</td>
          <td>{Ten}</td>
          <td>{Ten_KhongDau}</td>
          <td>{ThuTu}</td>
          <td>{AnHien}</td>
          <td>{TenTL}</td>
          <td><a href="suaLoaiTin.php?idLT={idLT}">Sửa</a> - <a onclick="return confirm('Bạn có chắc muốn xóa?')" href="xoaLoaiTin.php?idLT={idLT}">Xóa</a></td>
        </tr>
      <?php 
        $s = ob_get_clean();
        $s = str_replace("{idLT}", $row_DanhSachLoaiTin["idLT"], $s);
        $s = str_replace("{Ten}", $row_DanhSachLoaiTin["Ten"], $s);
        $s = str_replace("{Ten_KhongDau}", $row_DanhSachLoaiTin["Ten_KhongDau"], $s);
        $s = str_replace("{ThuTu}", $row_DanhSachLoaiTin["ThuTu"], $s);
        $s = str_replace("{AnHien}", $row_DanhSachLoaiTin["AnHien"], $s);        
		$s = str_replace("{TenTL}", $row_DanhSachLoaiTin["TenTL"], $s);        
        echo $s;
		  }
	   ?>
      </table>
    </form></td>
  </tr>
</table>
</body>
</html>
