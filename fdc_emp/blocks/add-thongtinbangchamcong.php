<?php
require "../lib/dbConMSSQL.php";
require "../lib/dbCon.php";

   

if (isset($_GET["p"]))
    $p = $_GET["p"];
else
    $p = "";
	
$TimeSheet = $_GET['TimeSheet'];
	
$tsql= "SELECT *
  FROM [HRISWORKERSPCC].[dbo].[PR_tblTimeSheet] where [PR_tblTimeSheet].TimeSheetID =  '$TimeSheet' ;";
$getResults= sqlsrv_query($conn_mssql, $tsql);
$rowtemp = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC);

$tsql_2= "SELECT *
  FROM [HRISWORKERSPCC].[dbo].[LS_tblCompany] order by  [LS_tblCompany].LSCompanyID desc ;";
$getResults_2= sqlsrv_query($conn_mssql, $tsql_2);

$tsql_3= "SELECT *
  FROM [HRISWORKERSPCC].[dbo].[LS_tblLevel1] order by  [LS_tblLevel1].LSLevel1ID desc ;";
$getResults_3= sqlsrv_query($conn_mssql, $tsql_3);
	
?>

<html>
<head>
<title>Insert Data Form</title>
    <link type="text/css" href="Style.css" rel="stylesheet" />
    <script type="text/javascript" src="Script.js"></script>
</head>

<body>
<h2>Thông Tin Bảng Chấm Công</h2>

    <table class="table1">
    <!--- begin html form; 
    put action page in the "action" attribute of the form tag --->
    <form action="insert_action.cfm" method="post">
    <tr>
      <th>Mã Bảng C.Công :</th>
      <td><input type="text" name="Emp_ID" size="40" maxlength="40" value="<?php echo $rowtemp['TimeSheetCode'] ?>"></td>
      <th>Người Dùng:</th>
      <td><input type="Text" name="Dept_ID" size="4" maxlength="8" value="<?php echo $rowtemp['UserID'] ?>"></td>
    </tr>
    </table>
    <table class="table1">
    <tr>
      <th>Công Trường</th>
      <td>
          <select>
          <?php while ($row = sqlsrv_fetch_array($getResults_2, SQLSRV_FETCH_ASSOC)) { ?>
                <option value="<?php echo $row['LSCompanyID'] ?>" <?php  if ($row['LSCompanyID'] == $rowtemp['LSCompanyID']) echo "selected='selected'" ?> ><?php echo $row['LSCompanyID']; echo ' : '; echo $row['Name'];?></option>
          <?php } ?>
          </select>
          
      </td>
    </tr>
    </table>
   <table class="table1">
    <tr>
      <th>Đội Quản Lý</th>
      <td>
          <select>
          <?php while ($row = sqlsrv_fetch_array($getResults_3, SQLSRV_FETCH_ASSOC)) { ?>
                <option value="<?php echo $row['LSLevel1ID'] ?>" <?php  if ($row['LSLevel1ID'] == $rowtemp['LSLevel1ID']) echo "selected='selected'" ?> ><?php echo $row['LSLevel1ID']; echo ' : '; echo $row['Name'];?></option>
          <?php } ?>
          </select>
          
      </td>
    </tr>
    </table>
    <table class="table1">
    <tr>
      <th>Từ Ngày:</th>
      <td><input id="date" type="date" name="Dept_ID" size="8" maxlength="8" value="<?php echo $rowtemp['FromDate']->format('Y-m-d')?>"></td>
      <th>Đến Ngày:</th>
      <td><input id="date" type="date" name="Dept_ID" size="8" maxlength="8" value="<?php echo $rowtemp['Todate']->format('Y-m-d') ?>"></td>
    </tr>
     </table>
    <table class="table1">
    <tr>
      <th>Tháng Nhập Liệu</th>
      <td>
          <select>
               <option value="1" <?php  if ($rowtemp['MonthNL'] == 1) echo "selected='selected'" ?> >Tháng 01</option>
               <option value="2" <?php  if ($rowtemp['MonthNL'] == 2) echo "selected='selected'" ?> >Tháng 02</option>
               <option value="3" <?php  if ($rowtemp['MonthNL'] == 3) echo "selected='selected'" ?> >Tháng 03</option>
               <option value="4" <?php  if ($rowtemp['MonthNL'] == 4) echo "selected='selected'" ?> >Tháng 04</option>
               <option value="5" <?php  if ($rowtemp['MonthNL'] == 5) echo "selected='selected'" ?> >Tháng 05</option>
               <option value="6" <?php  if ($rowtemp['MonthNL'] == 6) echo "selected='selected'" ?> >Tháng 06</option>
               <option value="7" <?php  if ($rowtemp['MonthNL'] == 7) echo "selected='selected'" ?> >Tháng 07</option>
               <option value="8" <?php  if ($rowtemp['MonthNL'] == 8) echo "selected='selected'" ?> >Tháng 08</option>
               <option value="9" <?php  if ($rowtemp['MonthNL'] == 9) echo "selected='selected'" ?> >Tháng 09</option>
               <option value="10" <?php  if ($rowtemp['MonthNL'] == 10) echo "selected='selected'" ?> >Tháng 10</option>
               <option value="11" <?php  if ($rowtemp['MonthNL'] == 11) echo "selected='selected'" ?> >Tháng 11</option>
               <option value="12" <?php  if ($rowtemp['MonthNL'] == 12) echo "selected='selected'" ?> >Tháng 12</option>
          </select>
      </td>
      <th>Năm</th>
      <td>
          <select>
          	   <option value="2017" <?php  if ($rowtemp['YearNL'] == 2017) echo "selected='selected'" ?> >Năm 2017</option>
          	   <option value="2018" <?php  if ($rowtemp['YearNL'] == 2018) echo "selected='selected'" ?> >Năm 2018</option>
          	   <option value="2019" <?php  if ($rowtemp['YearNL'] == 2019) echo "selected='selected'" ?> >Năm 2019</option>
          	   <option value="2020" <?php  if ($rowtemp['YearNL'] == 2020) echo "selected='selected'" ?> >Năm 2020</option>
          </select>
      </td>
    </tr>
    <tr>
      <th>Tháng T.Lương</th>
      <td>
          <select>
               <option value="1" <?php  if ($rowtemp['MonthTL'] == 1) echo "selected='selected'" ?> >Tháng 01</option>
               <option value="2" <?php  if ($rowtemp['MonthTL'] == 2) echo "selected='selected'" ?> >Tháng 02</option>
               <option value="3" <?php  if ($rowtemp['MonthTL'] == 3) echo "selected='selected'" ?> >Tháng 03</option>
               <option value="4" <?php  if ($rowtemp['MonthTL'] == 4) echo "selected='selected'" ?> >Tháng 04</option>
               <option value="5" <?php  if ($rowtemp['MonthTL'] == 5) echo "selected='selected'" ?> >Tháng 05</option>
               <option value="6" <?php  if ($rowtemp['MonthTL'] == 6) echo "selected='selected'" ?> >Tháng 06</option>
               <option value="7" <?php  if ($rowtemp['MonthTL'] == 7) echo "selected='selected'" ?> >Tháng 07</option>
               <option value="8" <?php  if ($rowtemp['MonthTL'] == 8) echo "selected='selected'" ?> >Tháng 08</option>
               <option value="9" <?php  if ($rowtemp['MonthTL'] == 9) echo "selected='selected'" ?> >Tháng 09</option>
               <option value="10" <?php  if ($rowtemp['MonthTL'] == 10) echo "selected='selected'" ?> >Tháng 10</option>
               <option value="11" <?php  if ($rowtemp['MonthTL'] == 11) echo "selected='selected'" ?> >Tháng 11</option>
               <option value="12" <?php  if ($rowtemp['MonthTL'] == 12) echo "selected='selected'" ?> >Tháng 12</option>
          </select>
      </td>
      <th>Năm</th>
      <td>
          <select>
          	   <option value="2017" <?php  if ($rowtemp['YearTL'] == 2017) echo "selected='selected'" ?> >Năm 2017</option>
          	   <option value="2018" <?php  if ($rowtemp['YearTL'] == 2018) echo "selected='selected'" ?> >Năm 2018</option>
          	   <option value="2019" <?php  if ($rowtemp['YearTL'] == 2019) echo "selected='selected'" ?> >Năm 2019</option>
          	   <option value="2020" <?php  if ($rowtemp['YearTL'] == 2020) echo "selected='selected'" ?> >Năm 2020</option>
          </select>
      </td>
    </tr>
    <tr>
      <th>Số Phiếu Kế Tóan</th>
      <td><input type="text" name="Dept_ID" size="8" maxlength="8"></td>
    </tr>
    </form>
    <!--- end html form --->
    </table>

</body>
</html>