<?php 
    $danhsachtheloai = DanhSachTheLoai($connect);
    while ($row_danhsachtheloai = mysqli_fetch_array($danhsachtheloai)) {
        $idTL = $row_danhsachtheloai['idTL'];
?>
<div class="box-cat">
	<div class="cat">
    	<div class="main-cat">
        	<a href="index.php?p=theloai&idTL=<?php echo $row_danhsachtheloai['idTL'] ?>"><?php echo $row_danhsachtheloai['TenTL']?></a>
        </div>
        <div class="child-cat">
        <?php 
            $danhsachtheloaitin = LocTenLoaiTin_Theo_DanhSachTheLoai($connect, $idTL);
            while ($row_danhsachtheloaitin = mysqli_fetch_array($danhsachtheloaitin)) {
        ?>
        	<a href="index.php?p=tintrongloai&idLT=<?php echo $row_danhsachtheloaitin['idLT'] ?>"><?php echo $row_danhsachtheloaitin['Ten']?></a>
        <?php 
            }
        ?>
        </div>
        <?php 
            $TinMoiNhat_TheoTheLoai_MotTin = TinMoiNhat_TheoTheLoai_MotTin($connect, $idTL);
            $row_TinMoiNhat_TheoTheLoai_MotTin = mysqli_fetch_array($TinMoiNhat_TheoTheLoai_MotTin)
        ?>
        <div class="clear"></div>
        <div class="cat-content">
        	<div class="col1">
            	<div class="news">
                    <h3 class="title" ><a href="index.php?p=chitiettin&idTin=<?php echo $row_TinMoiNhat_TheoTheLoai_MotTin['idTin'] ?>"><?php echo $row_TinMoiNhat_TheoTheLoai_MotTin['TieuDe']?> </a></h3>
                    <img class="images_news" src="upload/tintuc/<?php echo $row_TinMoiNhat_TheoTheLoai_MotTin['urlHinh']?>" align="left" />
                    <div class="des"><?php echo $row_TinMoiNhat_TheoTheLoai_MotTin['TomTat']?> </div>
                    <div class="clear"></div>
                   
				</div>
            </div>
            <?php 
                $TinMoiNhat_TheoTheLoai_HaiTin = TinMoiNhat_TheoTheLoai_HaiTin($connect, $idTL);
                while ($row_TinMoiNhat_TheoTheLoai_HaiTin = mysqli_fetch_array($TinMoiNhat_TheoTheLoai_HaiTin)){
            ?>
            <div class="col2">
             <p class="tlq"><a href="index.php?p=chitiettin&idTin=<?php echo $row_TinMoiNhat_TheoTheLoai_HaiTin['idTin'] ?>"> <?php echo $row_TinMoiNhat_TheoTheLoai_HaiTin['TieuDe']?> </a>
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



