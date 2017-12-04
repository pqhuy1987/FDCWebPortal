<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>

<script type="text/javascript" src="jquery.js"></script>

<?php
	require "../lib/dbConMSSQL.php";
	require "../lib/dbCon.php";
	
	$tsql= "SELECT TOP 1 SUBSTRING(EmpSalaryID, PATINDEX('%[0-9]%', EmpSalaryID), LEN(EmpSalaryID))
  FROM [HRISWORKERSPCC].[dbo].[PR_tblEmpSalary] ORDER BY Len(EmpSalaryID) desc, EmpSalaryID desc ;";
	$getResults= sqlsrv_query($conn_mssql, $tsql);
	$row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC);
	
	$EmpSalaryID_Num = floatval($row['']);
	
	$EmpSalaryID = "HO".$EmpSalaryID_Num;
	
	$EmpID			=		$_POST['EmpID'];
	$seq			=		$_POST['seq'];
	$Salary			=		$_POST['Salary'];
	$ThueTT			=		$_POST['ThueTT'];
	$i				=		$_POST['i'];
	$TimeSheet		=		$_POST['TimeSheet'];
	
	$sql = "DELETE FROM [HRISWORKERSPCC].[dbo].[PR_tblEmpSalary] WHERE TimeSheetID = '$TimeSheet'; ";
  	$res = sqlsrv_query($conn_mssql, $sql);
  
	for ($j = 1; $j < $i; $j++ )
	{
		$EmpSalaryID = "HO".($EmpSalaryID_Num + $j);
		
		$query = "INSERT INTO [HRISWORKERSPCC].[dbo].[PR_tblEmpSalary] (EmpSalaryID, EmpID, Salary, TimeSheetID, Seq, ThueTT) VALUES(?, ?, ?, ?, ?, ?)";
		$getResults= sqlsrv_query($conn_mssql, $query, array("$EmpSalaryID", "$EmpID[$j]", "$Salary[$j]", "$TimeSheet", "$seq[$j]", "$ThueTT[$j]"));
	}
	
	if($getResults)
    {
		echo "Update Sucessfully...";
    } else {
		echo "Update Fail...";
	} 

?>