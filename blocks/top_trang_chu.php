<div id="slide-left">
          <?php
              $sql="select * from Tin order by idTin desc limit 0,1";
              $tinmoinhat_mottin=mysqli_query($connect,$sql);
              $row_tinmoinhatmottin = mysqli_fetch_array($tinmoinhat_mottin);
          ?>
        	<div id="slideleft-main">
                <img src="upload/tintuc/<?php echo $row_tinmoinhatmottin['urlHinh'] ?>"   /><br />
                <h2 class="title"><a href="index.php?p=chitiettin&idTin=<?php echo $row_tinmoinhatmottin['idTin'] ?>"><?php echo $row_tinmoinhatmottin['TieuDe'] ?></a> </h2>
                <div class="des">
                    <?php echo $row_tinmoinhatmottin['TomTat'] ?> 
                </div>
            	<p class="tlq"><a href="#">Hàng trăm chuyến bay bị hủy vì Trung Quốc tập trận</a></p>
                
        	</div>
            <div id="slideleft-scroll">
            	
              <div class="content_scoller width_common">
            <ul>
            <?php
              $sql="select * from Tin order by idTin desc limit 1,4";
              $tinmoinhat_bontin=mysqli_query($connect,$sql);
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
                <img alt="" src="http://khoapham.vn/images/logoKhoaPham.png" width="100%"></a>
                <div class="title_news"></div>
            </div>
                
            </div>
</div>


     