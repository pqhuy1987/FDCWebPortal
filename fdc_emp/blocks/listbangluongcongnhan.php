<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>

<script type="text/javascript" src="./jquery.js"></script>

<?php
require "lib/dbConMSSQL.php";
require "lib/dbCon.php";

if (isset($_GET["p"]))
    $p = $_GET["p"];
else
    $p = "";
	
$TimeSheet = $_POST['TimeSheet'];
	
$tsql= "SELECT *
  FROM [HRISWORKERSPCC].[dbo].[PR_tblEmpSalary] where [PR_tblEmpSalary].TimeSheetID =  '$TimeSheet' ;";
$getResults= sqlsrv_query($conn_mssql, $tsql);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <title>Fixed Headers</title>
    <link type="text/css" href="Style.css" rel="stylesheet" />
    <script type="text/javascript" src="Script.js"></script>
</head>
<body>
	<h1>Danh Sách Công Nhân Của Đội</h1>
	<div id="outerDiv">
		<div id="innerDiv">
			<table class="table2">
				<tr>
					<th>		</th>
					<th>STT</th>
					<th>Số CMND</th>
					<th>Họ và Tên</th>
					<th>MST</th>
					<th>Số Tiền</th>
					<th>Thuế TT</th>
				</tr>
<?php while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) { 
				$EmpID = $row['EmpID'];
				//echo $EmpID;
				$tsql_2= "SELECT [VFirstName] FROM [HRISWORKERSPCC].[dbo].[HR_tblEmpCV] where [HR_tblEmpCV].EmpID =  '$EmpID' ;";
				$getResults_2= sqlsrv_query($conn_mssql, $tsql_2);
				$row_2 = sqlsrv_fetch_array($getResults_2, SQLSRV_FETCH_BOTH);
				
				$tsql_3= "SELECT [TaxCode] FROM [HRISWORKERSPCC].[dbo].[HR_tblDependPerson] where [HR_tblDependPerson].EmpID =  '$EmpID' ;";
				$getResults_3= sqlsrv_query($conn_mssql, $tsql_3);
				$row_3 = sqlsrv_fetch_array($getResults_3, SQLSRV_FETCH_BOTH);
				//$row_2['VFirstName'] = iconv('UTF-16', 'UTF-8', $row_2['VFirstName']);
				//echo $row_2['VFirstName'];
?>
				<tr>
                	<th>		</th>
					<th><?php echo $row['Seq'] ?></th>
					<td><?php echo $row['EmpID'] ?></td>
					<td><?php echo $row_2['VFirstName'] ?></td>
					<td><?php echo $row_3['TaxCode']?></td>
					<td><?php echo $row['Salary'] ?></td>
					<td><?php echo $row['ThueTT'] ?></td>
				</tr>
<?php } ?>

			</table>
		</div>
	</div>
</body>
</html>
<script language="javascript">
	CreateScrollHeader(document.getElementById("innerDiv"), true, true);
</script>