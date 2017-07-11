<?php
   $domain = 'FDC.LOCAL';
   $admin_group = 'CN=FDC HCNS,CN=Users,DC=FDC,DC=LOCAL';
   
   if (isset($_POST["btnSubmit"]))
   {
		$ldap_dn = $_POST["username"];
		$ldap_password = $_POST["password"];
		
		$ldap_con = ldap_connect("SRBDC-02.FDC.LOCAL", 389) or die('Could not connect to LDAP server.');
		
		if (!ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3)) 
		{
			fatal_error("Failed to set LDAP Protocol version to 3, TLS not supported.");
		}
		
	
		if(@ldap_bind($ldap_con, $ldap_dn.'@'.$domain, $ldap_password))
		{
			session_start();
        	$_SESSION['ldap_dn'] = $ldap_dn;
			
			$samaccountname = $ldap_dn;
			$filter = "(samaccountname=$samaccountname)";
			$dn = "OU=FDC Department,DC=FDC,DC=LOCAL";
			$attributes = array("memberof","cn");

			$res = ldap_search($ldap_con, $dn, $filter, $attributes);
			$first = ldap_get_entries($ldap_con, $res);
			
			for ($i=0; $i < $first[0]["memberof"]["count"]; $i++)
    		{
				if ($first[0]["memberof"][$i]==$admin_group)
				{
					$_SESSION['admin'] = $samaccountname;
				}
    		}
			
			$_SESSION['nameuser'] = $first[0]["cn"][0];

         	header('Location: ../index.php');
		}
		else
		{
			echo "Log In Fail";
		}
   }

?>

<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title>Trang Đăng Nhập </title>

  <link rel="stylesheet" href="css/reset.css">

    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />

</head>

<body>

  <div class="wrap">
      <div><img width="350" height="140" src="../images/logo1.png" />
      <form action = "" method = "post">
			<input name = "username" type="text" placeholder="Tài khoản (ten.ho, ví dụ:quanghuy.pham)" required>
			<div class="bar">
				<i></i>
			</div>
			<input name = "password" type="password" placeholder="Mật Khẩu" required>
			<button type = "submit" name = "btnSubmit">Đăng Nhập</button>
        </form>		
	</div>

  <script src="js/index.js"></script>

</body>

</html>