<?php
	$vitri = 1;
    $hienthiquangcao = HienThiQuangCao($connect, $vitri);

    while($row_hienthiquangcao = mysqli_fetch_array($hienthiquangcao)){
?>
<a href="<?php echo $row_hienthiquangcao['Url']?>"/>
<img width="280" src="upload/quangcao/<?php echo $row_hienthiquangcao['urlHinh']?>"/>
<div style="height:10px"></div>
<?php
	}
?>