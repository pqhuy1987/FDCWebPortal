 <?php
require "lib/dbCon.php";
require "lib/dbConMSSQL.php";
require "lib/trangchu.php";

session_start();

if (!isset($_SESSION['ldap_dn']))
{
    header('Location: login/login.php');
    exit();
}

if (isset($_GET["p"]))
    $p = $_GET["p"];
else
    $p = "";
	
	if (isset($_POST['TimeSheet']))  
		$_POST['TimeSheet'] = $_POST['TimeSheet'];
	else 
		$_POST['TimeSheet'] = 'HO7682';
?>

<?php 
   if (isset($_POST["btnThoat"])){
        session_destroy();
        header('Location: login/login.php');
        //exit();
   }
   
   if (isset($_POST["Admin"])){
        header('Location: admin/index.php');
        //exit();
   }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FDC-Cổng Thông Tin Nội Bộ</title>
<link rel="stylesheet" type="text/css" href="css/layout.css" />
<link rel="shortcut icon" type="image/x-icon" href="images/logo1.png" />
</head>

<body>
<div id="wrap-vp">
    <div>
    	<!--block/menu.php-->
        <?php require "blocks/menu.php"; ?>
    </div>
    <div id="menu-2">
    	<!--block/menu.php-->
    </div>
    
    <div class="clear"></div>

  	<div id="content-vp">
        <div id="content-main">
        	<div id="content-main-1">	
            	<div id="left">	
					<?php require "blocks/listdoithicong.php"; ?>     
                </div> 
        	</div>
            <div id="content-main-2">
			<!--PAGES-->
					<?php require "blocks/thongtinbangchamcong.php"; ?>  
            </div>    
        </div>
        <div id="content-right-files">    
		<!--blocks/cot_phai.php-->     
        <div class="box-cat">
        </div>
        	 <div id="content-file">
        			<?php require "blocks/listbangluongcongnhan.php"; ?>  
             </div>
        </div>
        <div id="content-right-general">    
					<!--blocks/cot_phai.php-->
        			<?php require "blocks/bangdieukhien.php"; ?>  
        </div>

    <div class="clear"></div>  	
    </div>
    
</div>
</body>
</html>
