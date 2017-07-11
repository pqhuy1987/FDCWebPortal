<!-- box cat -->
<?php
    $idLT = 1;
?>
<div class="box-cat">
	<div class="cat">
    	<div class="main-cat">
        	<a href="#">TIN TỨC VÀ SỰ KIỆN MỚI NHẤT</a>
        </div>
       
        <div class="clear"></div>
        <div class="cat-content">
        <?php 
            $tinmoinhat= TinMoiNhat_MotTin($connect);
            $row_tinmoinhat = mysqli_fetch_array($tinmoinhat);
        ?>
            <?php 
                $tinmoinhat_bontin = TinMoiNhat_BonTin($connect, $idLT);
            while ($row_tinmoinhat_bontin = mysqli_fetch_array($tinmoinhat_bontin)){    
            ?>
            <div class="col2">
            <h3 class="tlq"><a href="index.php?p=chitiettin&idTin=<?php echo $row_tinmoinhat_bontin['idTin'] ?>">[<?php echo $row_tinmoinhat_bontin['Ngay']?>] <?php echo $row_tinmoinhat_bontin['TieuDe']?></a></h3>
            </div> 
            <?php 
                }
            ?>
           
        </div>
    
    </div>

</div>
<div class="clear"></div>
<!-- //box cat -->
