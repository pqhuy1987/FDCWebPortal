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
	mainmenuid: "smoothmenu3", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

ddsmoothmenu.init({
	mainmenuid: "smoothmenu4", //Menu DIV id
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

<div id="smoothmenu3" class="ddsmoothmenu">
<ul>

<li><a href="http://<?php echo $_SESSION['ldap_dn'];?>:<?php echo $_SESSION['ldap_password'];?>@portal.fdcc.com.vn:8080/" target="_blank"> <img src="images/Menu1.jpg" width="250" height="60" /></a>
<li><a href="http://<?php echo $_SESSION['ldap_dn'];?>:<?php echo $_SESSION['ldap_password'];?>@project.fdcc.com.vn/" target="_blank"> <img src="images/Menu2.jpg" width="250" height="60" /></a>
<li><a href="http://hrm.fdcc.com.vn:8000/" target="_blank"> <img src="images/Menu3.jpg" width="250" height="60" /></a>
<li><a href="http://<?php echo $_SESSION['ldap_dn'];?>:<?php echo $_SESSION['ldap_password'];?>@forum.fdcc.com.vn/index.php/" target="_blank"> <img src="images/Menu4.jpg" width="250" height="60" /></a>
<li><a href="http://nas.fdcc.com.vn:5000/" target="_blank"> <img src="images/Menu5.jpg" width="250" height="60" /></a>
<li><a href="http://<?php echo $_SESSION['ldap_dn'];?>:<?php echo $_SESSION['ldap_password'];?>@mail.fdcc.com.vn/" target="_blank"> <img src="images/Menu6.jpg" width="250" height="60" /></a>
<li><a href="http://<?php echo $_SESSION['ldap_dn'];?>:<?php echo $_SESSION['ldap_password'];?>@edu.fdcc.com.vn/" target="_blank"> <img src="images/Menu7.jpg" width="250" height="60" /></a>
<li><a href="http://<?php echo $_SESSION['ldap_dn'];?>:<?php echo $_SESSION['ldap_password'];?>@cfe.fdcc.com.vn/" target="_blank"> <img src="images/Menu8.jpg" width="250" height="60" /></a>
<li><a href="http://<?php echo $_SESSION['ldap_dn'];?>:<?php echo $_SESSION['ldap_password'];?>@youtube.com/channel/UC2TriOxypZZJp7uZm6PbWQQ/" target="_blank"> <img src="images/Menu9.jpg" width="250" height="60" /></a>

</li>

</ul>
<br style="clear: left" />
</div>

