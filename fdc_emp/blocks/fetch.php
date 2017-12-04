<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>

<script type="text/javascript" src="jquery.js"></script> 

<?php
	require "../lib/dbConMSSQL.php";
	require "../lib/dbCon.php";

	if(isset($_POST['query']))
	{
		$search = $_POST['query'];
	 	$tsql= "SELECT top 300 * FROM [HRISWORKERSPCC].[dbo].[HR_tblEmpCV] WHERE [HR_tblEmpCV].VFirstName LIKE N'%".$search."%' OR [HR_tblEmpCV].EmpID LIKE '%".$search."%';";
		$getResults= sqlsrv_query($conn_mssql, $tsql, array(), array( "Scrollable" => 'static' ));
	}
	else
	{
	 	$tsql = "SELECT top 300 *
  FROM [HRISWORKERSPCC].[dbo].[HR_tblEmpCV] order by [HR_tblEmpCV].VFirstName ASC, [HR_tblEmpCV].CreateTime desc;";
		$getResults= sqlsrv_query($conn_mssql, $tsql, array(), array( "Scrollable" => 'static' ));
	}
	$output = "";
	if(sqlsrv_num_rows($getResults) > 0)
	{
	 $output .= '
	 <table id="table1" border="1">
           <tr>
               	<th>Chọn</th>
                <th>Số CMND</th>
                <th>Họ và Tên</th>
           </tr>
	 ';
	 while($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC))
	 {
	  $output .= '
	   <tr>
		<td>'."<input type='checkbox' name='check-tab1' value='<?php echo $row[EmpID] ?>'/>".'</td>
		<td>'.$row["EmpID"].'</td>
		<td>'.$row["VFirstName"].'</td>
	   </tr>
	  ';
	 }
	 	 $output .= '</table>';
	 echo $output;
	}
	else
	{
	 echo 'Data Not Found';
	}

?>