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
    <td><table min-width = "1200px"; width="auto" border="1">
      <tr>
        <td id="hang3"; width = "1200px"; colspan="6">DANH SÁCH THỂ LOẠI</td>
        </tr>
      <tr>
        <td width="auto">ID THỂ LOẠI</td>
        <td width="auto">TÊN THỂ LOẠI</td>
        <td width="auto">TÊN TL KHÔNG DẤU</td>
        <td width="auto">THỨ TỰ</td>
        <td width="auto">ẨN/HIỆN</td>
        <td width="auto"><a href="themTheLoai.php">THÊM</a></td>
      </tr>
      <?php 
	  	  $listtheloai = DanhSachTheLoai($connect);
		    while($row_DanhSachTheLoai = mysqli_fetch_array($listtheloai))
        {
          ob_start();
	   ?>
      <tr>
        <td>{idTL}</td>
        <td>{TenTL}</td>
        <td>{TenTL_KhongDau}</td>
        <td>{ThuTu}</td>
        <td>{AnHien}</td>
        <td><a href="suaTheLoai.php?idTL={idTL}">Sửa</a>-<a onclick="return confirm('Bạn có chắc muốn xóa?')" href="xoaTheLoai.php?idTL={idTL}">Xóa</a></td>
      </tr>
      <?php 
        $s = ob_get_clean();
        $s = str_replace("{idTL}", $row_DanhSachTheLoai["idTL"], $s);
        $s = str_replace("{TenTL}", $row_DanhSachTheLoai["TenTL"], $s);
        $s = str_replace("{TenTL_KhongDau}", $row_DanhSachTheLoai["TenTL_KhongDau"], $s);
        $s = str_replace("{ThuTu}", $row_DanhSachTheLoai["ThuTu"], $s);
        $s = str_replace("{AnHien}", $row_DanhSachTheLoai["AnHien"], $s);        
        echo $s;
		  }
	   ?>
  </tr>
</table>
</body>
</html>
