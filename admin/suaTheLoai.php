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

<?php
$idTL = $_GET["idTL"]; settype($idTL, "int");
$row_suatheloai = ChiTietTheLoai($connect, $idTL);
?>

<?php
if (isset($_POST["btnSua"])){
		$TenTL = $_POST["TenTL"];		
		$TenTL_KhongDau = changeTitle($TenTL);
		$ThuTu = $_POST["ThuTu"];
			settype($ThuTu, "int");
		$AnHien = $_POST["AnHien"];	
			settype($AnHien, "int");
		$qr = "
			update theloai set
			TenTL = '$TenTL',
			TenTL_KhongDau = '$TenTL_KhongDau',
			ThuTu  = '$ThuTu',
			AnHien = '$AnHien'
			where idTL='$idTL'			
		 ";
		mysqli_query($connect, $qr);	
		header("location: listTheLoai.php");
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
    <td id="hangTieuDe">TRANG QUẢN TRỊ</td>
  </tr>
  <tr>
    <td id="hang2"><?php require "menu.php"; ?></td>
  </tr>
  <tr>
    <td height="140"><form action="" method="post" name="form2"><table width="1200" border="1">
      <tr>
        <td height="24" colspan="2">SỬA THỂ LOẠI</td>
        </tr>
      <tr>
        <td width="492">Tên TL</td>
        <td width="492"><label for="TenTL"></label>          <input type="text" value="<?php echo $row_suatheloai["TenTL"] ?>" name="TenTL" id="TenTL" />        </td>
      </tr>
      <tr>
        <td>Thứ Tự</td>
        <td><label for="ThuTu"></label>          <input type="text" value="<?php echo $row_suatheloai["ThuTu"] ?>" name="ThuTu" id="ThuTu" />        </td>
      </tr>
      <tr>
        <td>Ẩn Hiện</td>
        <td><p>
          <label>
            <input <?php if($row_suatheloai["AnHien"]==1) echo "checked='checked'" ?> type="radio" name="AnHien" value="1" id="AnHien_0" />
            Hiện</label>
          <br />
          <label>
            <input <?php if($row_suatheloai["AnHien"]==0) echo "checked='checked'" ?> type="radio" name="AnHien" value="0" id="AnHien_1" />
            Ẩn</label>
          <br />
        </p>        </td>
      </tr>
      <tr>
        <td height="28">&nbsp;</td>
        <td><input type="submit" name="btnSua" id="btnSua" value="Sửa" />        </td>
      </tr>
    </table></form></td>
  </tr>
</table>
</body>
</html>
