<link rel="stylesheet" type="text/css" href="../menu_2/ddsmoothmenu.css" />
<link rel="stylesheet" type="text/css" href="../menu_2/ddsmoothmenu-v.css" />

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
<li><a href="#">LỊCH CÔNG TY</a>
  <ul>
  		<li><a href="../cms/calendar/index.php?group_general=0&group_small=1" target="_blank">LỊCH DU LỊCH</a></li>
        <li><a href="../cms/calendar/index.php?group_general=0&group_small=2" target="_blank">LỊCH NGHĨ LỄ</a></li>
        <li><a href="../cms/calendar/index.php?group_general=0&group_small=3" target="_blank">LỊCH SỰ KIỆN</a></li>
  </ul>
</li>
<li><a href="#">LỊCH LÀM VIỆC BAN LÃNH ĐẠO</a>
  <ul>

  		<li><a href="../cms/calendar/index.php?group_general=1&group_small=1" target="_blank">TGĐ NGÔ THANH PHONG</a></li>
        <li><a href="../cms/calendar/index.php?group_general=1&group_small=2" target="_blank">PHÓ TGĐ NGUYỄN QUANG THỤY</a></li>
        <li><a href="../cms/calendar/index.php?group_general=1&group_small=3" target="_blank">PHÓ TGĐ NGUYỄN NGỌC LÂN</a></li>

  </ul>
</li>

</ul>
<br style="clear: left" />
</div>

<div class="box-cat">
	<div class="cat">
    	<div class="main-cat">
        	<a>LỊCH LÀM VIỆC MỚI NHẤT</a>
        </div>
    </div>
</div>
<div class="clear"></div>
<?php 
	$eventListHTML = '';
	$result = $db->query("SELECT title, date FROM events order by id desc
			limit 0,30");
	if($result->num_rows > 0)
	{ 
		while($row = $result->fetch_assoc())
		{ 
				$eventListHTML .= '<div style="padding:0 0 0 25px;" class="col2">
       						 <h3 class="tlq">
							 	<a>';
				$eventListHTML .= $row['title'];
				$eventListHTML .= ' [ Vào ngày: '.$row['date'].' ] ';
				$eventListHTML .= '</a></h>
   				 </div>';
		}
	}
	echo $eventListHTML;
?>           


