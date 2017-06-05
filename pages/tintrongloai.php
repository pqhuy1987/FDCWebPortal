<?php
    $idLT = $_GET["idLT"];
    settype($idLT, "int");
?>

<?php
    $bc = breadCrumb($connect, $idLT);
    $row_bc = mysqli_fetch_array($bc);
?>

<div> Trang chủ >> <?php echo $row_bc["TenTL"]?> >> <?php echo $row_bc["Ten"]?> </div>
<?php
    $ChonTin_Theo_TenLoanTin = ChonTin_Theo_TenLoanTin($connect, $idLT);
    while ($row_ChonTin_Theo_TenLoanTin = mysqli_fetch_array($ChonTin_Theo_TenLoanTin)) {
?>
<div class="box-cat">
	<div class="cat1">
    	
        <div class="clear"></div>
        <div class="cat-content">
        	<div class="col0 col1">
            	<div class="news">
                    <h3 class="title" ><a href="index.php?p=chitiettin&idTin=<?php echo $row_ChonTin_Theo_TenLoanTin['idTin'] ?>"><?php echo $row_ChonTin_Theo_TenLoanTin['TieuDe']?></a></h3>
                    <img class="images_news" src="upload/tintuc/<?php echo $row_ChonTin_Theo_TenLoanTin['urlHinh']?>" align="left" />
                    <div class="des"><?php echo $row_ChonTin_Theo_TenLoanTin['TomTat']?> </div>
                    <div class="clear"></div>
                   
				</div>
            </div>
            
        </div>
    </div>
</div>
<div class="clear"></div>
<?php 
    }
?>
<!-- box cat-->
