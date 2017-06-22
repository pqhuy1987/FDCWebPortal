<div id="slide-left">
          <?php
              $tinmoinhat_mottin = TinMoiNhat_MotTin($connect);
              $row_tinmoinhatmottin = mysqli_fetch_array($tinmoinhat_mottin);
          ?>
        	<div id="slideleft-main">
                <img src="upload/tintuc/<?php echo $row_tinmoinhatmottin['urlHinh'] ?>" width="486" height="316"  /><br />
                <h2 class="title"><a href="index.php?p=chitiettin&idTin=<?php echo $row_tinmoinhatmottin['idTin'] ?>"><?php echo $row_tinmoinhatmottin['TieuDe'] ?></a> </h2>
                <div class="des">
                    <?php echo $row_tinmoinhatmottin['TomTat'] ?> 
                </div>
                
        	</div>
            <div id="slideleft-scroll">
            	
              <div class="content_scoller width_common">
            <ul>
            <?php
              $tinmoinhat_bontin=TinMoiNhat_BonTin($connect);
              while ($row_tinmoinhatbontin = mysqli_fetch_array($tinmoinhat_bontin)) {
              # code...
            ?>
               <li>
                <div class="title_news">
               		<a href="index.php?p=chitiettin&idTin=<?php echo $row_tinmoinhatbontin['idTin'] ?>" class="txt_link"> <?php echo $row_tinmoinhatbontin['TieuDe'] ?>  </a> 
                </div>
              </li>
            <?php
              }
            ?>
            </ul>
            </div>			
            
			<div id="gocnhin">
                <div class="title_news"></div>
            </div>
                
            </div>
</div>


     