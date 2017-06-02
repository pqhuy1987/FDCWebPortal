<?php

function TinMoiNhat_MotTin()
{
	$qr = "
			select * from Tin
			order by idTin desc
			limit 0,1
	";
	return mysqli_query($connect, $qr);
}
?>