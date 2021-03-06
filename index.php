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
   
   if ($_SESSION['mail'] == 'interview@FDCC.COM.VN') {
		$interview = 1;
   } else {
		$interview = 0;
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
	<div id="header-vp">
    </div>
    <div>
    	<!--block/menu.php-->
        <?php require "blocks/menu.php"; ?>
    </div>
    <div id="menu-2">
    	<!--block/menu.php-->
        <?php 
		if ($interview == 1)
			; 
		else 
			require "blocks/menu2.php"; 
		?>
    </div>
    <div id="midheader-vp">
    	<div id="left">
            <?php require "blocks/thongtinchung.php"; ?>
			<!--blocks/thongtinchung.php-->
        </div>
        <div id="right">
        </div>
   
    </div>
    
    <div class="clear"></div>

  	<div id="content-vp">
        <div id="content-main">
        	<div id="content-main-1">	
            	<div id="left">	
					<?php require "blocks/tin_moi_nhat.php"; ?>     
                </div>
                <div id="right">	
                	<div class="box-cat">
                        <div class="cat">
                            <div class="main-cat">
                                <a href="#">Gallery Hình Ảnh Công Ty</a>
                            </div>
                            
                            <div class="child-cat">
                                <a href="#" onClick="MyWindow=window.open('test/filemanager2.php','MyWindow'); return false;">(Phóng To)</a>
                            </div>  
                           
                            <div class="clear"></div>
                         </div>
                    </div>
                    <div id="content-file">
						<?php require "test/filemanager.php"; ?> 
                    </div>
                </div>  

        	</div>
            <div id="content-main-2">
			<!--PAGES-->
				<?php
                    switch ($p) {
                        case 'tintrongloai':        require 'pages/tintrongloai.php'; 
                            break;
                         case 'chitiettin':         require 'pages/chitiettin.php'; 
                            break;             
                         case 'timkiem':            require 'pages/timkiem.php'; 
                            break;
                         case 'theloai':            require 'pages/theloai.php'; 
                            break;    
                        default:                    require 'pages/trangchu.php'; 
                            
                            break;
                    }
                ?>
             </div>
            
        </div>
        <div id="content-right-files">    
		<!--blocks/cot_phai.php-->
        <?php
			$agent = '';
			$browser = '';
			if(isset($_SERVER['HTTP_USER_AGENT'])){
				 $agent = $_SERVER['HTTP_USER_AGENT'];
			}
			
			if(strlen(strstr($agent,'coc_coc_browser')) > 0 ){
				$browser = 'coc_coc_browser';
			} else if (strlen(strstr($agent,'Chrome')) > 0 ) {
				$browser = 'Chrome';
			} else if (strlen(strstr($agent,'Firefox')) > 0 ) {
				$browser = 'Firefox';
			}
			
			if($browser=='Firefox'){
				//echo 'Firefox';
			} else if($browser=='Chrome'){
				//echo 'Chrome';
			} else if($browser=='coc_coc_browser'){
				//echo 'coc_coc_browser';
			} else if($browser=='Safari'){
				//echo 'Safari';
			}
		?>       
        <div class="box-cat">
			<div class="cat">
    			<div class="main-cat">
                    <a href="https://chrome.google.com/webstore/detail/office-editing-for-docs-s/gbkeegbaiigmenfmjfclcdgdpimamgkj?hl=en" target="_blank"><img src="images/Logo_Extension.jpg" width="40" height="15" /> Add-On Đọc File Word, Excel, PPT Online</a>
                 </div>
        		<div class="child-cat">
					<a href="#" onClick="MyWindow=window.open('../cms/images/guide/','MyWindow',width=1000,height=100); return false;">(Hướng Dẫn)</a>
        		</div>   
        	</div>
        </div>
        	 <div id="content-file">
        		<?php require "filebrowser.php"; ?>
             </div>
        </div>
        <div id="content-right-general">    
		<!--blocks/cot_phai.php-->
        <?php require "Event_4/wdCalendar/sample.php"; ?>
        </div>

    <div class="clear"></div>  	
    </div>
    
    <div id="ft-bot">
    </div>
    
</div>
</body>
</html>
