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
	$idTin = $_GET["idTin"];
	settype($idTin, "int");
	$qr = "delete from tin
	where idTin='$idTin' ";
	mysqli_query($connect, $qr);
	header("location: listTin.php");
?>