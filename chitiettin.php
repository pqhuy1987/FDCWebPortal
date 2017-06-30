<?php 
require "lib/dbCon.php";
require "lib/quantri.php";

?>

<?php 
$idLT = $_GET["idLT"];
settype($idLT, "int");
?>

			<?php
            $sotin1trang = 50;
        
            if (isset($_GET["trang"]))
            {
                $trang = $_GET["trang"];
                settype($trang, "int");
            }else {
                $trang = 1;
            }
        
            $from = ($trang - 1)*$sotin1trang;
    
            $ChonTin_Theo_PhanTrang = ChonTin_Theo_PhanTrang($connect, $from, $sotin1trang);
            
            while ($row_ChonTin_Theo_PhanTrang = mysqli_fetch_array($ChonTin_Theo_PhanTrang))
            {
            ?>
          <tr>
            <td>idTin:<?php echo $row_ChonTin_Theo_PhanTrang["idTin"]?></td>
            <td><a href="suaTin.php?idTin=<?php echo $row_ChonTin_Theo_PhanTrang["idTin"]?>"><?php echo $row_ChonTin_Theo_PhanTrang["TieuDe"]?></a><br />          <img src="<?php echo $row_ChonTin_Theo_PhanTrang["urlHinh"]?>" width="150" /><?php echo $row_ChonTin_Theo_PhanTrang["TomTat"]?></td>
            <td><?php echo $row_ChonTin_Theo_PhanTrang["TenTL"]?>-<?php echo $row_ChonTin_Theo_PhanTrang["Ten"]?></td>
            <td>Số Lần Xem:<?php echo $row_ChonTin_Theo_PhanTrang["SoLanXem"]?>-<br />
              <?php echo $row_ChonTin_Theo_PhanTrang["TinNoiBat"]?> - <?php echo $row_ChonTin_Theo_PhanTrang["AnHien"]?><br /></td>
            <td><a href="suaTin.php?idTin=<?php echo $row_ChonTin_Theo_PhanTrang["idTin"]?>">Sửa</a> - <a href="xoaTin.php?idTin=<?php echo $row_ChonTin_Theo_PhanTrang["idTin"]?>">Xóa</a></td>
          </tr>
          <?php 
            }
          ?>