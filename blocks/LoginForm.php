<h3>
<p>Chào bạn <?php echo $_SESSION['ldap_dn'];?>
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
    <a href="#" onClick="MyWindow=window.open('../pqhuy1987_3/test/','MyWindow',width=1000,height=100); return false;">
    <input type="submit" name="Admin" id="Admin" value="Quản lý File" />
  	</a></p>
</form>