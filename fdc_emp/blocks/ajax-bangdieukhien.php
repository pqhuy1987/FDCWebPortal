<?php
require "../lib/dbConMSSQL.php";
require "../lib/dbCon.php";

   

if (isset($_GET["p"]))
    $p = $_GET["p"];
else
    $p = "";
	
$TimeSheet = $_POST['TimeSheet'];
	
$tsql= "SELECT *
  FROM [HRISWORKERSPCC].[dbo].[PR_tblEmpSalary] where [PR_tblEmpSalary].TimeSheetID =  '$TimeSheet' ;";
$getResults= sqlsrv_query($conn_mssql, $tsql, array(), array( "Scrollable" => 'static' ));

$rownum = sqlsrv_num_rows($getResults);

$total_1 = 0;
$total_2 = 0;

while($data = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
     $total_1 += $data['Salary'];
	 $total_2 += $data['ThueTT'];
    //other stuff you are doing with results, otherwise just do SQL sum.
}
	
?>

<html>
<head>
<title>Insert Data Form</title>
    <link type="text/css" href="blocks/Style.css" rel="stylesheet" />
    <script type="text/javascript" src="blocks/Script.js"></script>
</head>

<body>
<h2>Công Cụ Thao Tác</h2>

    <table class="table1">
    <!--- begin html form; 
    put action page in the "action" attribute of the form tag --->
    <form action="insert_action.cfm" method="post">
    <tr>
      <th>S.Người :</th>
      <td><input type="text" name="Emp_ID" size="8" maxlength="8" value="<?php echo $rownum ?>"></td>
      <th>Thuế TT:</th>
      <td><input type="Text" name="Dept_ID" size="8" maxlength="8" value="<?php echo $total_2 ?>"></td>
    </tr>
    </table>
    <table class="table1">
    <tr>
      <th>Tổng :</th>
      <td><input type="text" name="Emp_ID" size="38" maxlength="38" value="<?php echo $total_1 ?>"></td>
    </tr>
    </table>
    </form>

</body>
</html>