<?php
    $idLT = $_GET["idLT"];
    settype($idLT, "int");
?>

<?php
    $bc = breadCrumb($connect, $idLT);
    $row_bc = mysqli_fetch_array($bc);
?>
<div class="box-cat">
    <div class="cat">
        <div class="main-cat">
			<a href="./">Trang chủ</a>
        </div>
        <div class="child-cat">
			<a href="index.php?p=theloai&idTL=<?php echo $row_bc["idTL"] ?>">--  <?php echo $row_bc["TenTL"]?> --</a> <a href="#"> <?php echo $row_bc["Ten"]?>: </a>
        </div>                
    </div>
</div>


<?php

    $sotin1trang = 4;

    if (isset($_GET["trang"]))
    {
        $trang = $_GET["trang"];
        settype($trang, "int");
    }else {
        $trang = 1;
    }

    $from = ($trang - 1)*$sotin1trang;
    $ChonTin_Theo_TenLoanTin_PhanTrang = ChonTin_Theo_TenLoanTin_PhanTrang($connect, $idLT, $from, $sotin1trang);
    while ($row_ChonTin_Theo_TenLoanTin_PhanTrang = mysqli_fetch_array($ChonTin_Theo_TenLoanTin_PhanTrang))
    {
?>
<div class="box-cat">
	<div class="cat1">
    	
        <div class="clear"></div>
        <div class="cat-content">
        	<div class="col0 col1">
            	<div class="news">
                    <h3 class="title" ><a href="index.php?p=chitiettin&idTin=<?php echo $row_ChonTin_Theo_TenLoanTin_PhanTrang['idTin'] ?>"><?php echo $row_ChonTin_Theo_TenLoanTin_PhanTrang['TieuDe']?></a></h3>
                    <img class="images_news" src="<?php echo $row_ChonTin_Theo_TenLoanTin_PhanTrang['urlHinh']?>" align="left" />
                    <div class="des"><?php echo $row_ChonTin_Theo_TenLoanTin_PhanTrang['TomTat']?> </div>
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

<style>
    #phantrang {text-align: center;}
    #phantrang a {background-color: #000; color:#ff0; padding:5px; margin-right: 3px;}
    #phantrang a:hover{background-color:#09f}
</style>
<div id="phantrang">
<?php 
    $Tongsotin = ChonTin_Theo_TenLoanTin($connect, $idLT);
    $row_Tongsotin = mysqli_num_rows($Tongsotin);
    $tongsotrang =  ceil($row_Tongsotin/$sotin1trang);
    for ($i = 1; $i <=$tongsotrang; $i++) {
?>

<a <?php if($i==$trang) echo "style='background-color:red' "; ?> href="index.php?p=tintrongloai&idLT=<?php echo $idLT?>&trang=<?php echo $i?>"><?php echo $i ?></a>

<?php 
    }
?>
</div>
