<?php
require "../lib/dbConMSSQL.php";
require "../lib/dbCon.php";

   

if (isset($_GET["p"]))
    $p = $_GET["p"];
else
    $p = "";
	
$TimeSheet = $_POST['TimeSheet'];
	
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
    <link type="text/css" href="blocks/Style.css" rel="stylesheet" />
    <script type="text/javascript" src="blocks/Script.js"></script>
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
      <td><input type="text" name="Dept_ID" size="8" maxlength="8" value="<?php echo $rowtemp['FromDate']->format('d/m/Y') ?>"></td>
      <th>Đến Ngày:</th>
      <td><input type="text" name="Dept_ID" size="8" maxlength="8" value="<?php echo $rowtemp['Todate']->format('d/m/Y') ?>"></td>
    </tr>
    <tr>
      <th>Tháng Nhập Liệu</th>
      <td><input type="text" name="Dept_ID" size="8" maxlength="8" value="<?php echo $rowtemp['MonthNL']?>"></td>
      <th>Năm</th>
      <td><input type="text" name="Dept_ID" size="8" maxlength="8" value="<?php echo $rowtemp['YearNL']?>"></td>
    </tr>
    <tr>
      <th>Tháng T.Lương</th>
      <td><input type="text" name="Dept_ID" size="8" maxlength="8" value="<?php echo $rowtemp['MonthTL']?>"></td>
      <th>Năm</th>
      <td><input type="text" name="Dept_ID" size="8" maxlength="8" value="<?php echo $rowtemp['YearTL']?>"></td>
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