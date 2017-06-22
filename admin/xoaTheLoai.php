<?php 
	ob_start();
    session_start();
    
    if (isset($_SESSION['admin']))
    {
    	;
    } else {
    	header("location: ../index.php");
    }
    
    require "../lib/dbCon.php";
    require "../lib/quantri.php";
?>
<?php 
	$idTL = $_GET["idTL"];
	settype($idTL, "int");
	$qr = "delete from theloai
	where idTL='$idTL' ";
	mysqli_query($connect, $qr);
	header("location: listTheLoai.php");
?>