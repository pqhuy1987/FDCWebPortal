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
		if (($_POST["idLT"] == null) || ($_POST["idTL"] == null))
		{
			echo '<script language="javascript">';
			echo 'alert("Bạn chưa chọn Loại Tin và Thể Loại")';
			echo '</script>';	
		} else { 
			$TieuDe = $_POST["TieuDe"];
			$TieuDe_KhongDau = changeTitle($TieuDe);
			$TomTat = $_POST["TomTat"];	
			$urlHinh = $_POST["urlHinh"];
			$Ngay = date("Y-m-d");
			$idUser = $_SESSION["idUser"];
			$Content = $_POST["Content"];
			$idLT = $_POST["idLT"];
			$idTL = $_POST["idTL"];	
			$SoLanXem = 0;	
			$TinNoiBat = $_POST["TinNoiBat"];
			$AnHien = $_POST["AnHien"];
			$urlFile = $_POST["urlFile"];
			
			$qr = "
				insert into tin values (
				null,
				'$TieuDe',
				'$TieuDe_KhongDau',
				'$TomTat',
				'$urlHinh',
				'$Ngay',
				'$idUser',
				'$Content',
				'$idLT',
				'$idTL',
				'$SoLanXem',
				'$TinNoiBat',
				'$AnHien',
				'$urlFile'
				)
				";
			mysqli_query($connect, $qr);
			header("location: listTin.php");
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Trang Quản Trị</title>
<link rel="stylesheet" type="text/css" href="layout.css">
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckfinder/ckfinder.js"></script>

<script type="text/javascript">
function BrowseServer( startupPath, functionData ){
	var finder = new CKFinder();
	finder.basePath = 'ckfinder/'; //Đường path nơi đặt ckfinder
	finder.startupPath = startupPath; //Đường path hiện sẵn cho user chọn file
	finder.selectActionFunction = SetFileField; // hàm sẽ được gọi khi 1 file được chọn
	finder.selectActionData = functionData; //id của text field cần hiện địa chỉ hình
	//finder.selectThumbnailActionFunction = ShowThumbnails; //hàm sẽ được gọi khi 1 file thumnail được chọn	
	finder.popup(); // Bật cửa sổ CKFinder
} //BrowseServer


function SetFileField( fileUrl, data ){
	document.getElementById( data["selectActionData"] ).value = fileUrl;
}
function ShowThumbnails( fileUrl, data ){	
	var sFileName = this.getSelectedFile().name; // this = CKFinderAPI
	document.getElementById( 'thumbnails' ).innerHTML +=
	'<div class="thumb">' +
	'<img src="' + fileUrl + '" />' +
	'<div class="caption">' +
	'<a href="' + data["fileUrl"] + '" target="_blank">' + sFileName + '</a> (' + data["fileSize"] + 'KB)' +
	'</div>' +
	'</div>';
	document.getElementById( 'preview' ).style.display = "";
	return false; // nếu là true thì ckfinder sẽ tự đóng lại khi 1 file thumnail được chọn
}
</script>

</head>

<body>
<table width="1200" border="1">
  <tr>
    <td width="1323" id="hangTieuDe">TRANG QUẢN TRỊ</td>
  </tr>
  <tr>
    <td id="hang2"><?php require "menu.php"; ?></td>
  </tr>
  <tr>
    <td height="133"><form action="" method="post"><table width="1200" border="1">
      <tr>
        <td colspan="2">THÊM TIN</td>
        </tr>
      <tr>
        <td width="146">Tiêu Đề</td>
        <td width="1038"><label for="TieuDe"></label>          <input type="text" name="TieuDe" maxlength="50" id="TieuDe" />        </td>
      </tr>
      <tr>
        <td>Tóm Tắt</td>
        <td><label for="TomTat"></label>          <textarea name="TomTat" id="TomTat" cols="45" rows="5" maxlength="100"></textarea>        </td>
      </tr>
      <tr>
        <td>URL Hình</td>
        <td><label for="urlHinh"></label>          <input type="text" name="urlHinh" id="urlHinh" /><input onclick="BrowseServer('Images:/','urlHinh')" type="button" name="btnChonFile" id="btnChonFile" value="Chọn Hình" />          </td>
      </tr>
      <tr>
        <td>URL File</td>
        <td><label for="urlFile"></label>          <input type="text" name="urlFile" id="urlFile" /><input onclick="BrowseServer('Files:/','urlFile')" type="button" name="btnChonFile2" id="btnChonFile2" value="Chọn File" />          </td>
      </tr>
      <tr>
        <td height="23">Content</td>
        <td><label for="Content"></label>          <textarea name="Content" id="Content" cols="45" rows="5"></textarea>
		<script type="text/javascript">
var editor = CKEDITOR.replace( 'Content',{
	uiColor : '#9AB8F3',
	language:'vi',
	skin:'v2',
	filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?Type=Images',
	filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?Type=Flash',
	filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
	filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
			 	
	toolbar:[
	['Source','-','Save','NewPage','Preview','-','Templates'],
	['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print'],
	['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
	['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
	['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
	['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
	['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
	['Link','Unlink','Anchor'],
	['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
	['Styles','Format','Font','FontSize'],
	['TextColor','BGColor'],
	['Maximize', 'ShowBlocks','-','About']
	]
});		
</script>        </td>
      </tr>
      <tr>
        <td height="23">ID Thể Loại</td>
        <td><label for="idTL"></label> 
            <select name="idTL" id="idTL">
            <option  value="">--Chọn--</option>
        <?php 
			$theloai = DanhSachTheLoai($connect);
			while ($row_theloai = mysqli_fetch_array($theloai))
			{
		?>
            <option value="<?php echo $row_theloai["idTL"]?>"><?php echo $row_theloai["TenTL"]?></option>

        <?php 
			}
		?>
         </select></td>
      </tr>
      <tr>
        <td height="23">ID Loại Tin</td>
        <td><label for="idLT"></label> 
            <select name="idLT" id="idLT">
            <option  value="">--Chọn--</option>
        <?php 

			$loaitin = DanhSachLoaiTin($connect);
			while ($row_loaitin = mysqli_fetch_array($loaitin))
			{
		?>
            <option  value="<?php echo $row_loaitin["idLT"]?>"><?php echo $row_loaitin["Ten"]?></option>

        <?php 
			}
		?>
          </select>        </td>
      </tr>
      <tr>
        <td height="23">Tin Nổi Bật</td>
        <td><p>
          <label>
            <input type="radio" name="TinNoiBat" value="1" id="TinNoiBat_0" />
            Nổi bật</label>
          <br />
          <label>
            <input type="radio" name="TinNoiBat" value="0" id="TinNoiBat_1" />
            Thường</label>
          <br />
        </p>        </td>
      </tr>
      <tr>
        <td height="23">Ẩn Hiện</td>
        <td><p>
          <label>
            <input type="radio" name="AnHien" value="1" id="AnHien_0" />
            Hiện</label>
          <br />
          <label>
            <input type="radio" name="AnHien" value="0" id="AnHien_1" />
            Ẩn</label>
          <br />
        </p>        </td>
      </tr>
      <tr>
        <td height="23">&nbsp;</td>
        <td><input type="submit" name="btnThem" id="btnThem" value="Thêm" />        </td>
      </tr>
    </table></form></td>
  </tr>
</table>
</body>
</html>
