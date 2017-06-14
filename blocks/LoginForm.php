<h3>
<p>Chào bạn <?php echo $_SESSION["idUser"];?>
<p>
</h3>
<form action = "" method = "post">
  <p>
    <input name="btnThoat" type = "submit" value="Thoát" />
  </p>
  <p>
    <a href="./admin/index.php">
    <input type="submit" name="Admin" id="Admin" value="Trang Quản Trị" />
  </a></p>
</form>