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
	if (($_POST["Ten"] == null) || ($_POST["idTL"] == null))
	{
		echo '<script language="javascript">';
		echo 'alert("Bạn chưa thêm Tên hoặc Thể Loại")';
		echo '</script>';	
	} else { 
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
    <td width="1033" id="hangTieuDe">TRANG QUẢN TRỊ</td>
  </tr>
  <tr>
    <td id="hang2"><?php require "menu.php"; ?></td>
  </tr>
  <tr>
    <td><form action="" method="post" name="form1"><table width="1200" border="1">
      <tr>
        <td id="hang3" width = "1200px" colspan="7" >THÊM LOẠI TIN</td>
        </tr>
      <tr>
        <td width="508">TÊN</td>
        <td width="509"><label for="Ten"></label>
          <input type="text" name="Ten" id="Ten" /></td>
      </tr>

        <label  for="ThuTu"></label>
          <input type="hidden" type="text" name="ThuTu" id="ThuTu" />

      <tr>
          <label>
            <input type="hidden" type="radio" name="AnHien" value="1" id="AnHien_0" />
            </label>
         
          <label>
            <input  type="hidden" type="radio" name="AnHien" value="0" id="AnHien_1" />
           </label>            
      </tr>
      <tr>
        <td>ID THỂ LOẠI</td>
        <td><label for="idTL"></label>
          <select name="idTL" id="idTL">
          	<option  value="">--Chọn--</option>
          	<?php 
				$theloai = DanhSachTheLoai($connect);
				while($row_theloai = mysqli_fetch_array($theloai)){
			?>
          	<option value="<?php echo $row_theloai["idTL"]?>"><?php echo $row_theloai["TenTL"]?></option>
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
