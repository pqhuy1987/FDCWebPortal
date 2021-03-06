<link rel="stylesheet" type="text/css" href="ddsmoothmenu.css" />
<link rel="stylesheet" type="text/css" href="ddsmoothmenu-v.css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<script type="text/javascript" src="ddsmoothmenu.js">

/***********************************************
* Smooth Navigational Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* Please keep this notice intact
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>

<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "smoothmenu1", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

ddsmoothmenu.init({
	mainmenuid: "smoothmenu2", //Menu DIV id
	orientation: 'v', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu-v', //class added to menu's outer DIV
	method: 'toggle', // set to 'hover' (default) or 'toggle'
	arrowswap: true, // enable rollover effect on menu arrow images?
	//customtheme: ["#804000", "#482400"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

</script>

<!-- Markup for mobile menu toggler. Hidden by default, only shown when in mobile menu mode -->
<a class="animateddrawer" id="ddsmoothmenu-mobiletoggle" href="#">
<span></span>
</a>

<div id="smoothmenu1" class="ddsmoothmenu">
<ul>
<li><a href="./">Trang Chủ</a></li>
<?php 
	$danhsachtheloai = DanhSachTheLoai($connect);
	while ($row_danhsachtheloai = mysqli_fetch_array($danhsachtheloai)) {
		$idTL = $row_danhsachtheloai['idTL'];
?>
<li><a href="index.php?p=theloai&idTL=<?php echo $row_danhsachtheloai['idTL'] ?>"><?php echo $row_danhsachtheloai['TenTL']?></a>
  <ul>
  	<?php 
		$danhsachtheloaitin = LocTenLoaiTin_Theo_DanhSachTheLoai($connect, $idTL);
		while ($row_danhsachtheloaitin = mysqli_fetch_array($danhsachtheloaitin)) {
	?>
  		<li><a href="index.php?p=tintrongloai&idLT=<?php echo $row_danhsachtheloaitin['idLT'] ?>"><?php echo $row_danhsachtheloaitin['Ten']?></a></li>
  	<?php 
		}
	?>

  </ul>
</li>
<?php 
	}
?>
<li><a href="./">Đánh Giá Năng Lực Giám Sát</a>
  <ul>
  		<li><a href="./fdc_test/" target="_blank">Làm trắc nghiệm</a></li>
  		<li><a href="./fdc_test/admin" target="_blank">Quản trị nội dung trắc nghiệm</a></li>
  </ul>
</li>
<li><a href="./">Quản lý Nhân Công</a>
  <ul>
  		<li><a href="./fdc_emp/" target="_blank">Tính lương công nhân</a></li>
  </ul>
</li>
<li><a href="./">Chào bạn: <?php echo $_SESSION['nameuser'];?></a>
  <ul>
  		<li><a href="./admin/index.php" target="_blank">Trang Quản Trị</a></li>
  		<li><a href="#" onClick="MyWindow=window.open('../cms/upload/Document/','MyWindow',width=1000,height=100); return false;">File/Tài Liệu Ban Hành</a></li>
  		<li><form id="btnThoat" action = "" method = "post"><a href="#" onClick="document.getElementById('btnThoat').submit();"> <input type="hidden" name="btnThoat"> Thoát </input></a></form></li>
  </ul>
</li>
</ul>
<br style="clear: left" />
</div>

