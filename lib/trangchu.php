<?php

function TinMoiNhat_MotTin($connect)
{
	$qr = "
			select * from Tin
			order by idTin desc
			limit 0,1
	";
	return mysqli_query($connect, $qr);
}

function TinMoiNhat_BonTin($connect)
{
	$qr = "
			select * from Tin
			order by idTin desc
			limit 1,4
	";
	return mysqli_query($connect, $qr);
}

function TinXemNhieuNhat($connect)
{
	$qr = "
			select * from Tin
			order by SoLanXem desc
			limit 0,5
	";
	return mysqli_query($connect, $qr);
}

function TinMoiNhat_TheoLoaiTin_MotTin($connect, $idLT)
{
	$qr = "
			select * from Tin
			where idLT=$idLT
			order by idTin desc
			limit 0,1
	";
	return mysqli_query($connect, $qr);
}

function TinMoiNhat_TheoLoaiTin_BonTin($connect, $idLT)
{
	$qr = "
			select * from Tin
			where idLT=$idLT
			order by idTin desc
			limit 1,4
	";
	return mysqli_query($connect, $qr);
}

function TenLoanTin($connect, $idLT)
{
	$qr = "
			select Ten
			from loaitin
			where idLT=$idLT
	";
	return mysqli_query($connect, $qr);
}

function HienThiQuangCao($connect, $vitri)
{
	$qr = "
			select * from quangcao
			where vitri=$vitri
	";
	return mysqli_query($connect, $qr);
}

function DanhSachTheLoai($connect)
{
	$qr = "
			select * from theloai
	";
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

function TinMoiNhat_TheoTheLoai_MotTin($connect, $idTL)
{
	$qr = "
			select * from Tin
			where idTL=$idTL
			order by idTin desc
			limit 0,1
	";
	return mysqli_query($connect, $qr);
}

function TinMoiNhat_TheoTheLoai_HaiTin($connect, $idTL)
{
	$qr = "
			select * from Tin
			where idLT=$idTL
			order by idTin desc
			limit 1,2
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

function breadCrumb($connect, $idLT)
{
	$qr = "
			select TenTL, Ten
			from theloai, loaitin
			where theloai.idTL = loaitin.idTL
			and idLT = $idLT
	";
	return mysqli_query($connect, $qr);
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
?>