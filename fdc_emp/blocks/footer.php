<div class="thongtin-title">
	<div class="right">
    
          <a href="#"><span class="SetHomePage ico_respone_01">&nbsp;</span>Đặt VnExpress làm trang chủ</a>
          
          <a href="#"><span class="top">&nbsp;</span>Về đầu trang</a>
       
    </div>
</div>
<div class="thongtin-content">
<?php 
  $danhsachtheloai = DanhSachTheLoai($connect);
  while ($row_danhsachtheloai = mysqli_fetch_array($danhsachtheloai)) {
    $idTL = $row_danhsachtheloai['idTL'];
?>
	<ul class="ulBlockMenu">
      <li class="liFirst">
            <h2>
                <a class="mnu_giaoduc" href="/tin-tuc/giao-duc/"><?php echo $row_danhsachtheloai['TenTL']?></a>
            </h2>
      </li>
      <?php 
          $danhsachtheloaitin = LocTenLoaiTin_Theo_DanhSachTheLoai($connect, $idTL);
          while ($row_danhsachtheloaitin = mysqli_fetch_array($danhsachtheloaitin)) {
      ?>
      <li class="liFollow">
            <h2>
                <a href="index.php?p=tintrongloai&idLT=<?php echo $row_danhsachtheloaitin['idLT'] ?>"><?php echo $row_danhsachtheloaitin['Ten']?></a>
            </h2>
      </li>
      <?php 
        }
      ?>

  </ul>          
<?php 
  }
?>
</div>




