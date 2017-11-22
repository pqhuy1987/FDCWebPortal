<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>

<script type="text/javascript" src="jquery.js"></script>

<?php
	require "../lib/dbConMSSQL.php";
	require "../lib/dbCon.php";

	$TimeSheetID		=		$_POST['TimeSheetID'];
	$LSCompanyID		=		$_POST['LSCompanyID'];
	$LSLevel1ID			=		$_POST['LSLevel1ID'];
	$FromDate			=		$_POST['FromDate'];
	$Todate				=		$_POST['Todate'];
	
	$TimeSheetCode = $LSCompanyID.".".$LSLevel1ID.".".$FromDate.$Todate;
	
	$MonthNL			=		$_POST['MonthNL'];
	$YearNL				=		$_POST['YearNL'];
	$MonthTL			=		$_POST['MonthTL'];
	$YearTL				=		$_POST['YearTL'];

	$tsql= "update [HRISWORKERSPCC].[dbo].[PR_tblTimeSheet] set 
	TimeSheetCode 	=  ? , LSCompanyID = ? , LSLevel1ID = ? , MonthNL = ? , YearNL = ? , MonthTL = ? , YearTL = ? where [PR_tblTimeSheet].TimeSheetID =  ?";
	$getResults= sqlsrv_query($conn_mssql, $tsql, array( "$TimeSheetCode", "$LSCompanyID", "$LSLevel1ID", "$MonthNL", "$YearNL", "$MonthTL", "$YearTL", "$TimeSheetID"));
	
	$tsql_2= "update [HRISWORKERSPCC].[dbo].[PR_tblTimeSheet] set FromDate = CAST('$FromDate' AS DATETIME) , Todate = CAST('$Todate' AS DATETIME) where [PR_tblTimeSheet].TimeSheetID =  ?";
	
	$getResults= sqlsrv_query($conn_mssql, $tsql_2, array( "$TimeSheetID"));
	
    if($getResults)
    {
		echo "Update Sucessfully...";
    } else {
		echo "Update Fail...";
	}

?>