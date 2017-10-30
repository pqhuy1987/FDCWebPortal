<div class="box-cat">
	<div class="cat">
    	<div class="main-cat">
        	<a href="#">Tin xem nhiều</a>
        </div>
       
        <div class="clear"></div>
        <div class="cat-content">
        	<?php 
                $xemnhieunhat=TinXemNhieuNhat($connect);
                while($row_xemnhieunhat = mysqli_fetch_array($xemnhieunhat))
                {
            ?>
                <div class="col1">
                	<div class="news">
                      <img class="images_news" src="<?php echo $row_xemnhieunhat['urlHinh']?>" />
                        <h3 class="title" ><a href="index.php?p=chitiettin&idTin=<?php echo $row_xemnhieunhat['idTin'] ?>"><?php echo $row_xemnhieunhat['TieuDe']?></a><span class="hit"><?php echo $row_xemnhieunhat['SoLanXem']?></span></h3>
                        <div class="clear"></div>
    				</div>
                </div>                   
            <?php 
                }
            ?>
        </div>
    </div>
</div>
<div class="clear"></div>