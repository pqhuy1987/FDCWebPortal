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

<?php 
	if (isset($_POST["btnThem"])){
		if (($_POST["TenTL"] == null))
		{
			echo '<script language="javascript">';
			echo 'alert("Bạn chưa thêm Tên Thể Loại")';
			echo '</script>';	
		} else { 
			$TenTL = $_POST["TenTL"];		
			$TenTL_KhongDau = changeTitle($TenTL);
			$ThuTu = $_POST["ThuTu"];
				settype($ThuTu, "int");
			$AnHien = $_POST["AnHien"];	
				settype($AnHien, "int");
			$qr = "insert into theloai
			values(null, '$TenTL', '$TenTL_KhongDau', '$ThuTu', '$AnHien' )";
			mysqli_query($connect, $qr);	
			header("location: listTheLoai.php");
		}
}
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
    <td width="1196" id="hangTieuDe">TRANG QUẢN TRỊ</td>
  </tr>
  <tr>
    <td id="hang2"><?php require "menu.php"; ?></td>
  </tr>
  <tr>
    <td height="91"><form id="form1" name="form1" method="post" action="">
      <table width="1200" border="1">
        <tr>
          <td id="hang3" colspan="7">THÊM THỂ LOẠI</td>
        </tr>
        <tr>
          <td width="559">Tên TL</td>
          <td width="625"><label for="TenTL"></label>
            <input type="text" name="TenTL" id="TenTL" /></td>
        </tr>
        <tr>
          <td height="28">&nbsp;</td>
          <td><input type="submit" name="btnThem" id="btnThem" value="Thêm" /></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
</body>
</html>
