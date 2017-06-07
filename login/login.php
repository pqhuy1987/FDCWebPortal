<?php
   require "../lib/dbCon.php";
   require "../lib/trangchu.php";

   session_start();

   if (isset($_POST["btnSubmit"])){
      $un = $_POST["username"];
      $pa = $_POST["password"];
      $pa = md5($pa);
      $qr = "
            select * from users
            where Username = '$un'
            and Password = '$pa'
      ";
      $user = mysqli_query($connect, $qr);
      if (mysqli_num_rows($user) == 1) {
         // đăng nhập đúng
         $row = mysqli_fetch_array($user);
         $_SESSION["idUser"] = $row['idUser'];
         $_SESSION["Username"] = $row['Username'];
         $_SESSION["idUser"] = $row['HoTen'];
         $_SESSION["idGroup"] = $row['idGroup'];
         header('Location: ../index.php');
         exit();
      } else {
         echo fail;
      }       

   }
?>

<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title>CodePen - Login </title>

  <link rel="stylesheet" href="css/reset.css">

    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />

</head>

<body>

  <div class="wrap">
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