<?php
	$tenmaychu='localhost';
	$taikhoan='root';
	$matkhau='';
	$csdl='quiz';
	$connect = mysqli_connect($tenmaychu,$taikhoan,$matkhau) or die ('Connect fail');
	mysqli_select_db($connect, $csdl);
	mysqli_query($connect,"SET NAMES 'utf8'");
	
	$db = new mysqli($tenmaychu, $taikhoan, $matkhau, $csdl);
	if ($db->connect_error) {
    	die("Connection failed: " . $db->connect_error);
	}
?>