<?php

//Quan Li TheLoai

function ChonNoiDungTin($connect, $idTin)
{
	$qr = "
			select * from tin
			where idTin=$idTin
			limit 0,100000
	";
	return mysqli_query($connect, $qr);
}

function DanhSachTheLoai($connect){

	$qr = " select * from theloai
			order by idTL desc
	";
	return mysqli_query($connect, $qr);
}

function ChiTietTheLoai($connect, $idTL){

	$qr = " select * from theloai
			where idTL='$idTL
			'
	";
	$row = mysqli_query($connect, $qr);
	return mysqli_fetch_array($row);
}

//Quan Li LoaiTin
function DanhSachLoaiTin($connect){

	$qr = " select * from loaitin, theloai
			where theloai.idTL = loaitin.idTL
			order by loaitin.idTL asc
			limit 0,1000
	";
	return mysqli_query($connect, $qr);
}

function ChiTietLoaiTin($connect, $idLT){

	$qr = " select * from loaitin
			where idLT='$idLT'
	";
	$row = mysqli_query($connect, $qr);
	return mysqli_fetch_array($row);
}

//Quan Li Tin
function DanhSachTin($connect){
	$qr = "
			select tin.*, TenTL, Ten
			from tin, theloai, loaitin
			where tin.idTL = theloai.idTL
			and tin.idLT = loaitin.idLT
			order by idTin desc
			limit 0,20";
	return mysqli_query($connect, $qr);
}

function LocTenLoaiTin_Theo_DanhSachTheLoai($connect, $idTL)
{
	$qr = "
			select * from loaitin
			where idTL=$idTL
	";
	return mysqli_query($connect, $qr);
}

function stripUnicode($str){
  if(!$str) return false;
   $unicode = array(
     'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
     'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
     'd'=>'đ',
     'D'=>'Đ',
	  'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
	  'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
	  'i'=>'í|ì|ỉ|ĩ|ị',	  
	  'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
     'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
	  'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
     'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
	  'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
     'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
     'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
   );
foreach($unicode as $khongdau=>$codau) {
	$arr=explode("|",$codau);
	$str = str_replace($arr,$khongdau,$str);
}
return $str;
}
function changeTitle($str){
	$str=trim($str);
	if ($str=="") return "";
	$str =str_replace('"','',$str);
	$str =str_replace("'",'',$str);
	$str = stripUnicode($str);
	$str = mb_convert_case($str,MB_CASE_TITLE,'utf-8');
	
	// MB_CASE_UPPER / MB_CASE_TITLE / MB_CASE_LOWER
	$str = str_replace(' ','-',$str);
	return $str;
}




function mail_utf8($to, $from_user, $from_email, $subject = '(No subject)', $message = '')
{
	$from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
	$subject = "=?UTF-8?B?".base64_encode($subject)."?=";
	$headers = "From: $from_user <$from_email>\r\n".
               "MIME-Version: 1.0" . "\r\n" .
               "Content-type: text/html; charset=UTF-8" . "\r\n";
	return mail($to, $subject, $message, $headers);
}

function PhatSinhRandomKey(){
	$s = "";
	
	$m = array(0,1,2,3,4,5,6,7,8,9,"a", "b", "c", "d", "e", "f", "g","h","i", "j");
	
	for($i=1; $i<=32; $i++){
		$r = rand(0, count($m)-1);
		$s = $s . $m[$r];
	}
	
	return $s;
}

function ChonTin_Theo_TenLoanTin_PhanTrang($connect, $idLT, $from, $sotin1trang)
{
	$qr = "
			select * from tin
			where idLT=$idLT
			order by idTin desc
			limit $from, $sotin1trang
	";
	return mysqli_query($connect, $qr);
}

function ChonTin_Theo_TenTheLoai_PhanTrang($connect, $idTL, $from, $sotin1trang)
{
	$qr = "
			select * from tin
			where idTL=$idTL
			order by idTin desc
			limit $from, $sotin1trang
	";
	return mysqli_query($connect, $qr);
}
function ChonTin_Theo_PhanTrang($connect, $from, $sotin1trang)
{
	$qr = "
			select tin.*, TenTL, Ten
			from tin, theloai, loaitin
			where tin.idTL = theloai.idTL
			and tin.idLT = loaitin.idLT
			order by idTin desc
			limit $from, $sotin1trang
	";
	return mysqli_query($connect, $qr);
}
function ChonTin_TatCa($connect)
{
	$qr = "
			select * from tin
			order by idTin desc
			limit 0,100000
	";
	return mysqli_query($connect, $qr);
}

function ChonTin_Theo_TenLoanTin($connect, $idLT)
{
	$qr = "
			select * from tin
			where idLT=$idLT
			order by idTin desc
			limit 0,100000
	";
	return mysqli_query($connect, $qr);
}
?>