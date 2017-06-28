<?php
    $idTL = $_GET["idTL"];
    settype($idTL, "int");
?>
<?php 
	$danhsachtheloaitin_2 = TenTheLoai($connect, $idTL);
    $row_danhsachtheloaitin_2 = mysqli_fetch_array($danhsachtheloaitin_2);
?>
<div class="box-cat">
    <div class="cat">
        <div class="main-cat">
			<a href="./">Trang chủ</a>
        </div>
        <div class="child-cat">
			<a href="index.php?p=theloai&idTL=<?php echo $row_danhsachtheloaitin_2["idTL"] ?>">-- <?php echo $row_danhsachtheloaitin_2["TenTL"]?>:
        </div>                
    </div>
</div>
<?php
	$danhsachtheloaitin = LocTenLoaiTin_Theo_DanhSachTheLoai($connect, $idTL);
    while ($row_danhsachtheloaitin = mysqli_fetch_array($danhsachtheloaitin)) {
		$idLT = $row_danhsachtheloaitin['idLT'];
?>
<div class="box-cat">
	<div class="cat">
    	<div class="child-cat">
        	<a href="index.php?p=tintrongloai&idLT=<?php echo $row_danhsachtheloaitin['idLT'] ?>"><?php echo $row_danhsachtheloaitin['Ten']?></a>
        </div>
        <?php 
            $TinMoiNhat_TheoLoaiTin_MotTin = TinMoiNhat_TheoLoaiTin_MotTin($connect, $idLT);
            $row_TinMoiNhat_TheoLoaiTin_MotTin = mysqli_fetch_array($TinMoiNhat_TheoLoaiTin_MotTin)
        ?>
        <div class="clear"></div>
        <div class="cat-content">
        	<div class="col1">
            	<div class="news">
                    <h3 class="title" ><a href="index.php?p=chitiettin&idTin=<?php echo $row_TinMoiNhat_TheoLoaiTin_MotTin['idTin'] ?>"><?php echo $row_TinMoiNhat_TheoLoaiTin_MotTin['TieuDe']?> </a></h3>
                    <img class="images_news" src="upload/tintuc/<?php echo $row_TinMoiNhat_TheoLoaiTin_MotTin['urlHinh']?>" align="left" />
                    <div class="des"><?php echo $row_TinMoiNhat_TheoLoaiTin_MotTin['TomTat']?> </div>
                    <div class="clear"></div>
                   
				</div>
            </div>
            <?php 
                $TinMoiNhat_TheoLoaiTin_BonTin = TinMoiNhat_TheoLoaiTin_BonTin($connect, $idLT);
                while ($row_TinMoiNhat_TheoLoaiTin_BonTin = mysqli_fetch_array($TinMoiNhat_TheoLoaiTin_BonTin)){
            ?>
            <div class="col2">
             <p class="tlq"><a href="index.php?p=chitiettin&idTin=<?php echo $row_TinMoiNhat_TheoLoaiTin_BonTin['idTin'] ?>"> <?php echo $row_TinMoiNhat_TheoLoaiTin_BonTin['TieuDe']?> </a>
                </a></p>
            </div> 
            <?php 
                }
            ?>

        </div>
    </div>
</div>
<div class="clear"></div>
<?php 
    }
?>
