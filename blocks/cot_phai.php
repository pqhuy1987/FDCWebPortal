<link rel="stylesheet" type="text/css" href="../menu_2/ddsmoothmenu.css" />
<link rel="stylesheet" type="text/css" href="../menu_2/ddsmoothmenu-v.css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<script type="text/javascript" src="../menu_2/ddsmoothmenu.js">

/***********************************************
* Smooth Navigational Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* Please keep this notice intact
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>

<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "smoothmenu1a", //menu DIV id
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

<div id="smoothmenu1a" class="ddsmoothmenu">
<ul>
<li><a href="../cms/calendar/index.php?group=1" target="_blank">LỊCH CÔNG TY</a>
  <ul>
  		<li><a href="index.php?p=tintrongloai&idLT=<?php echo $row_danhsachtheloaitin['idLT'] ?>">LỊCH DU LỊCH</a></li>
        <li><a href="index.php?p=tintrongloai&idLT=<?php echo $row_danhsachtheloaitin['idLT'] ?>">LỊCH NGHĨ LỄ</a></li>
  </ul>
</li>
<li><a href="#">LỊCH LÀM VIỆC BAN LÃNH ĐẠO</a>
  <ul>

  		<li><a href="index.php?p=tintrongloai&idLT=<?php echo $row_danhsachtheloaitin['idLT'] ?>">TGĐ NGÔ THANH PHONG</a></li>
        <li><a href="index.php?p=tintrongloai&idLT=<?php echo $row_danhsachtheloaitin['idLT'] ?>">PHÓ TGĐ NGUYỄN QUANG THỤY</a></li>
        <li><a href="index.php?p=tintrongloai&idLT=<?php echo $row_danhsachtheloaitin['idLT'] ?>">PHÓ TGĐ NGUYỄN NGỌC LÂN</a></li>

  </ul>
</li>

</ul>
<br style="clear: left" />
</div>


