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
	$idLT = $_GET["idLT"];
	settype($idLT, "int");
	$qr = "delete from loaitin
	where idLT='$idLT' ";
	mysqli_query($connect, $qr);
	header("location: listLoaiTin.php");
?>