 <?php
require "lib/dbCon.php";
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
<title>Lap Trinh PHP - KhoaPhamTraining</title>
<link rel="stylesheet" type="text/css" href="css/layout.css" />
</head>

<body>
<div id="wrap-vp">
	<div id="header-vp">
    	<div id="logo"><img src="images/logo2.png" width="1000" height="64" /></div>
    </div>
    
    <div>
    	<!--block/menu.php-->
        <?php require "blocks/menu.php"; ?>
    </div>
      <div id="midheader-vp">
    	<div id="left">
        	<ul class="list_arrow_breakumb">
            	<li class="start">
                <a href="javascript:;">CHÀO BẠN <?php echo $_SESSION['ldap_dn'];?></a>
           </ul>
           <ul class="list_arrow_breakumb">
           <li class="start">
                <a href="./admin/index.php" target="_blank">TRANG QUẢN TRỊ</a>
           </ul>
           <ul class="list_arrow_breakumb">
           <li class="start">
                <a href="#" onClick="MyWindow=window.open('../pqhuy1987_3/test/','MyWindow',width=1000,height=100); return false;">FILES / TÀI LIỆU</a>
           </ul>
            <form action = "" method = "post">
            
            <input style="width: 100px; height: 25px; padding: 5px; cursor: pointer; box-shadow: 6px 6px 5px; #999; font-weight: bold; background: #135194; color: #FFF; border-radius: 5px; border: 2px solid #EC2229; font-size: 100% " type = "submit" name="btnThoat" value="THOÁT"/>
            </form>
        </div>
        <div id="right">
			<!--blocks/thongtinchung.php-->
            <?php require "blocks/thongtinchung.php"; ?>
        </div>
    </div>
    <div class="clear"></div>

  	<div id="content-vp">
        <div id="content-main">
			
			<!--PAGES-->
            <?php
                switch ($p) {
                    case 'tintrongloai':        require 'pages/tintrongloai.php'; 
                        break;
                     case 'chitiettin':         require 'pages/chitiettin.php'; 
                        break;             
                     case 'timkiem':            require 'pages/timkiem.php'; 
                        break;   
                    default:                    require 'pages/trangchu.php'; 
                        break;
                }
            ?>
            
        </div>
        <div id="content-right">    
		<!--blocks/cot_phai.php-->
        <?php require "blocks/cot_phai.php"; ?>
        </div>

    <div class="clear"></div>
    	
    </div>
    
</div>

</body>
</html>
