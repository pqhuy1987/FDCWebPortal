<?php
function to_utf8($in) 
{ 
        if (is_array($in)) { 
            foreach ($in as $key => $value) { 
                $out[to_utf8($key)] = to_utf8($value); 
            } 
        } elseif(is_string($in)) { 
            if(mb_detect_encoding($in) != "UTF-8") 
                return utf8_encode($in); 
            else 
                return $in; 
        } else { 
            return $in; 
        } 
        return $out; 
} 

function DanhSachLich_MotTin($connect)
{
	$qr = "
			select * from events
			order by id desc
			limit 0,1
	";
	return mysqli_query($connect, $qr);
}

function DanhSachLich_BaMuoiTin($connect){

	$qr = " select * from events
			order by id desc
			limit 1,30
	";
	return mysqli_query($connect, $qr);
}

function TinMoiNhat_MotTin($connect)
{
	$qr = "
			select * from tin
			order by idTin desc
			limit 0,1
	";
	return mysqli_query($connect, $qr);
}

function TinMoiNhat_BonTin($connect)
{
	$qr = "
			select * from tin
			order by idTin desc
			limit 0,35
	";
	return mysqli_query($connect, $qr);
}

function TinXemNhieuNhat($connect)
{
	$qr = "
			select * from tin
			order by SoLanXem desc
			limit 0,5
	";
	return mysqli_query($connect, $qr);
}

function TinMoiNhat_TheoLoaiTin_MotTin($connect, $idLT)
{
	$qr = "
			select * from tin
			where idLT=$idLT
			order by idTin desc
			limit 0,1
	";
	return mysqli_query($connect, $qr);
}

function TinMoiNhat_TheoLoaiTin_BonTin($connect, $idLT)
{
	$qr = "
			select * from tin
			where idLT=$idLT
			order by idTin desc
			limit 1,2
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

function TenTheLoai($connect, $idTL)
{
	$qr = "
			select *
			from theloai
			where idTL=$idTL
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
			select * from tin
			where idTL=$idTL
			order by idTin desc
			limit 0,1
	";
	return mysqli_query($connect, $qr);
}

function TinMoiNhat_TheoTheLoai_HaiTin($connect, $idTL)
{
	$qr = "
			select * from tin
			where idTL=$idTL
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
			select loaitin.idTL, TenTL, Ten
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

function ChonNoiDungTin($connect, $idTin)
{
	$qr = "
			select * from tin
			where idTin=$idTin
			limit 0,100000
	";
	return mysqli_query($connect, $qr);
}

function TinCungLoaiTin($connect, $idTin, $idLT)
{
	$qr = "
			select * from tin
			where idTin <> $idTin
			and idLT = $idLT
			order by rand()
			limit 0,3
	";
	return mysqli_query($connect, $qr);
}

function CapNhatSoLanXemTin($connect, $idTin)
{
	$qr = "
			update tin
			set SoLanXem = SoLanXem + 1
			where idTin = $idTin
	";
	mysqli_query($connect, $qr);
}

function TimKiem($connect, $tukhoa)
{
	$qr = "
			select * from tin
			where TieuDe regexp '$tukhoa'
			order by idTin desc
	";
	return mysqli_query($connect, $qr);
}

?>