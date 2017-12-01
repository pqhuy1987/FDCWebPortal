<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>

<script type="text/javascript" src="jquery.js"></script>

<?php
	require "../lib/dbConMSSQL.php";
	require "../lib/dbCon.php";
	
	$TimeSheet = $_GET['TimeSheet'];	
		
	$sql = "DELETE FROM [HRISWORKERSPCC].[dbo].[PR_tblTimeSheet] WHERE TimeSheetID = '$TimeSheet'; ";
  	$getResults = sqlsrv_query($conn_mssql, $sql);

	
	if($getResults)
    {
		echo "Đã xóa thành công...";
    } else {
		echo "Đã xóa thất bại...";
	} 

?>