<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>

<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="Script.js"></script>

<?php
	require "../lib/dbConMSSQL.php";
	require "../lib/dbCon.php";
	
	$tsql= "SELECT TOP 1 SUBSTRING(TimeSheetID, PATINDEX('%[0-9]%', TimeSheetID), LEN(TimeSheetID))
  FROM [HRISWORKERSPCC].[dbo].[PR_tblTimeSheet] ORDER BY Len(TimeSheetID) desc, TimeSheetID desc ;";
	$getResults= sqlsrv_query($conn_mssql, $tsql);
	$row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC);
	
	$TimeSheetID_Num = floatval($row['']);
	
	$TimeSheetID 		= 		"HO".($TimeSheetID_Num + 1);
	$LSCompanyID		=		$_POST['LSCompanyID'];
	$LSLevel1ID			=		$_POST['LSLevel1ID'];
	$FromDate			=		$_POST['FromDate'];
	$Todate				=		$_POST['Todate'];
	
	$MonthNL			=		$_POST['MonthNL'];
	$YearNL				=		$_POST['YearNL'];
	$MonthTL			=		$_POST['MonthTL'];
	$YearTL				=		$_POST['YearTL'];
	
	$FromDate_Temp = new DateTime($FromDate);
	$FromDate_Temp = $FromDate_Temp->format('Ydm');
	
	$Todate_Temp = new DateTime($Todate);
	$Todate_Temp = $Todate_Temp->format('Ydm');
	
	$TimeSheetCode = $LSCompanyID.".".$LSLevel1ID.".".$FromDate_Temp.$Todate_Temp;
					
	$query = "INSERT INTO [HRISWORKERSPCC].[dbo].[PR_tblTimeSheet] (TimeSheetID, TimeSheetCode, LSCompanyID, LSLevel1ID, FromDate, Todate, MonthNL, YearNL, MonthTL, YearTL) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
	$getResults= sqlsrv_query($conn_mssql, $query, array("$TimeSheetID", "$TimeSheetCode", "$LSCompanyID", "$LSLevel1ID", "$FromDate", "$Todate", "$MonthNL", "$YearNL", "$MonthTL", "$YearTL"));

	
	if($getResults)
    {
		echo "Update Sucessfully...";
    } else {
		echo "Update Fail...";
	} 

?>