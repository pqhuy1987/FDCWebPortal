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
if(isset($_POST["btnThem"])){
	$Ten = $_POST["Ten"];
	$Ten_KhongDau  = changeTitle($Ten);	
	$ThuTu  = $_POST["ThuTu"];
		settype($ThuTu, "int");
	$AnHien  = $_POST["AnHien"];
		settype($AnHien, "int");
	$idTL  = $_POST["idTL"];
		settype($idTL, "int");
	$qr = "
		insert into loaitin values (
		null,
		'$Ten',
		'$Ten_KhongDau',
		'$ThuTu',
		'$AnHien',
		'$idTL'
	)
	";
	mysqli_query($connect, $qr);
	header ("location: listLoaiTin.php");
}
?>


<?php 
	$idLT = $_GET["idLT"]; settype($idLT, "int");
	$row_ChiTietLoaiTin = ChiTietLoaiTin($connect, $idLT);
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
    <td width="1033" id="hangTieuDe">TRANG QUẢN TRỊ</td>
  </tr>
  <tr>
    <td id="hang2"><?php require "menu.php"; ?></td>
  </tr>
  <tr>
    <td><form action="" method="post" name="form1"><table width="1200" border="1">
      <tr>
        <td colspan="2">THÊM LOẠI TIN</td>
        </tr>
      <tr>
        <td width="508">TÊN</td>
        <td width="509"><label for="Ten"></label>
          <input type="text" value="<?php echo $row_ChiTietLoaiTin["Ten"] ?>" name="Ten" id="Ten" /></td>
      </tr>
      <tr>
        <td>THỨ TỰ</td>
        <td><label for="ThuTu"></label>
          <input type="text" value="<?php echo $row_ChiTietLoaiTin["ThuTu"] ?>" name="ThuTu" id="ThuTu" /></td>
      </tr>
      <tr>
        <td>ẨN HIỆN</td>
        <td><p>
          <label>
            <input <?php if($row_ChiTietLoaiTin["AnHien"]==1) echo "checked='checked'" ?> type="radio" name="AnHien" value="1" id="AnHien_0" />
            Hiện</label>
          <br />
          <label>
            <input <?php if($row_ChiTietLoaiTin["AnHien"]==0) echo "checked='checked'" ?> type="radio" name="AnHien" value="0" id="AnHien_1" />
            Ẩn</label>
          <br />
        </p>        </td>
      </tr>
      <tr>
        <td>ID THỂ LOẠI</td>
        <td><label for="idTL"></label>
          <select name="idTL" id="idTL">
          	<?php 
				$theloai = DanhSachTheLoai($connect);
				while($row_theloai = mysqli_fetch_array($theloai)){
			?>
          	<option <?php if ($row_theloai["idTL"] == $row_ChiTietLoaiTin["idTL"]) echo "selected='selected'"  ?> value="<?php echo $row_theloai["idTL"]?>"><?php echo $row_theloai["TenTL"]?></option>
            <?php 
				}
			?>
          </select></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="btnThem" id="btnThem" value="Thêm" /></td>
      </tr>
    </table></form></td>
  </tr>
</table>
</body>
</html>
