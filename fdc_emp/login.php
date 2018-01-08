 <?php
require "lib/dbCon.php";
require "lib/dbConMSSQL.php";
require "lib/trangchu.php";

$error = null;

session_start();

function mssql_escape($str)
{
    if(get_magic_quotes_gpc())
    {
        $str= stripslashes($str);
    }
    return str_replace("'", "''", $str);
}

?>

<?php 
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mssql_escape($_POST['username']);
      $mypassword = mssql_escape($_POST['password']); 
      
	  $tsql = "SELECT UserID FROM [HRISWORKERSPCC].[dbo].[SYS_List_User] where UserID = '$myusername' and Password='$mypassword'";
	  
	  $getResults= sqlsrv_query($conn_mssql, $tsql, array(), array( "Scrollable" => 'static' ));
	  $rownum = sqlsrv_num_rows($getResults);
		
      if($rownum == 1) 
	  {
         $_SESSION['user_ketoan'] = $myusername;
         header("location: index.php");
      }else
	  {
         $error = "Bạn đã đăng nhập sai, vui lòng liên hệ phòng kế toán để xin cấp ID và Password";
      }
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
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>
    
</div>
</body>
</html>
