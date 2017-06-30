<!-- box cat -->
<?php
    $idLT = 1;
?>
<div class="box-cat">
	<div class="cat">
    	<div class="main-cat">
        	<a href="#">LỊCH CÔNG TY</a>
        </div>
       
        <div class="clear"></div>
        <div class="cat-content">
        <?php 
            $tinmoinhat_theoloaitin_mottin = TinMoiNhat_TheoLoaiTin_MotTin($connect, $idLT);
            $row_tinmoinhat_theoloaitin_mottin = mysqli_fetch_array($tinmoinhat_theoloaitin_mottin);
        ?>
        	<div class="col1">
            	<div class="news">
                <h3 class="title" ><a href="index.php?p=chitiettin&idTin=<?php echo $row_tinmoinhat_theoloaitin_mottin['idTin'] ?>"> <?php echo $row_tinmoinhat_theoloaitin_mottin['TieuDe']?> </a></h3>
                  <img class="images_news" src="upload/tintuc/<?php echo $row_tinmoinhat_theoloaitin_mottin['urlHinh']?>" align="left" />
                    <div class="des"><?php echo $row_tinmoinhat_theoloaitin_mottin['TomTat']?></div>
                  
                  
                    <div class="clear"></div>
                   
				</div>
            </div>
            <?php 
                $tinmoinhat_theoloaitin_bontin = TinMoiNhat_TheoLoaiTin_BonTin($connect, $idLT);
            while ($row_tinmoinhat_theoloaitin_bontin = mysqli_fetch_array($tinmoinhat_theoloaitin_bontin)){    
            ?>
            <div class="col2">
            <h3 class="tlq"><a href="index.php?p=chitiettin&idTin=<?php echo $row_tinmoinhat_theoloaitin_bontin['idTin'] ?>"><?php echo $row_tinmoinhat_theoloaitin_bontin['TieuDe']?></a></h3>
            </div> 
            <?php 
                }
            ?>
           
        </div>
    
    </div>

</div>
<div class="clear"></div>
<!-- //box cat -->
