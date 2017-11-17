<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>

<script type="text/javascript" src="./jquery.js"></script>

<?php
require "lib/dbConMSSQL.php";
require "lib/dbCon.php";

if (!isset($_SESSION['ldap_dn']))
{
    header('Location: login/login.php');
    exit();
}

   

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
<?php while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) { ?>
				<tr>
					<th><?php echo $row['Seq'] ?></th>
					<td><?php echo $row['EmpID'] ?></td>
					<td><?php echo $row['EmpSalaryID'] ?></td>
					<td><?php echo $row['Salary']?></td>
					<td><?php echo $row['EmpID'] ?></td>
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