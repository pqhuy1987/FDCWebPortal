<?php
	$domain = 'FDC.LOCAL';
   if (isset($_POST["btnSubmit"]))
   {
		$ldap_dn = $_POST["username"];
		$ldap_password = $_POST["password"];
		
		$ldap_con = ldap_connect("SRBDC-02.FDC.LOCAL", 389) or die('Could not connect to LDAP server.');
		
		//$ldap_dn = "quanghuy.pham@FDC.LOCAL";
		//$ldap_password = "fdc@2017";
									
		
		if (!ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3)) 
		{
			fatal_error("Failed to set LDAP Protocol version to 3, TLS not supported.");
		}
		
	
		if(@ldap_bind($ldap_con, $ldap_dn.'@'.$domain, $ldap_password))
			echo "Authenticated";
		else
			echo "Invalid Credential";
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
      <div><img width="250" height="140" src="../images/logo1.png" />
      <form action = "" method = "post">
			<input name = "username" type="text" placeholder="username" required>
			<div class="bar">
				<i></i>
			</div>
			<input name = "password" type="password" placeholder="password" required>
			<a href="" class="forgot_link">forgot ?</a>
			<button type = "submit" name = "btnSubmit">Sign in</button>
        </form>		
	</div>

  <script src="js/index.js"></script>

</body>

</html>