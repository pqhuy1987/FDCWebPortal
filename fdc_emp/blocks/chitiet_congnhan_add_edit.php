<?php
	require "../lib/dbConMSSQL.php";
	require "../lib/dbCon.php";


	$Var_ratio_0		=		$_POST['Var_ratio_0'];
	$Var_ratio_1		=		$_POST['Var_ratio_1'];
	$Var_ratio_2		=		$_POST['Var_ratio_2'];
	$Var_ratio_3		=		$_POST['Var_ratio_3'];

	//--------------Thông tin công nhân------------------------------------------------------
		
	$Emp_ID_0			=		$_POST['Emp_ID_0'];
	$User_ID_0			=		$_POST['User_ID_0'];
	$Address_ID_0		=		$_POST['Address_ID_0'];
	$FromDate_0			=		$_POST['FromDate_0'];
	$FromMonth_0		=		$_POST['FromMonth_0'];
	$FromDate_Issues_0	=		$_POST['FromDate_Issues_0'];
	$FromMonth_Issues_0	=		$_POST['FromMonth_Issues_0'];
	$Where_Issues_0		=		$_POST['Where_Issues_0'];
	
	//--------------Thông tin hợp đồng-------------------------------------------------------
	
	$ContractID_1 		= 	$_POST['ContractID_1'];
	
	$Emp_ID_1 			= 	$_POST['Emp_ID_1'];
	$User_ID_1 			= 	$_POST['User_ID_1'];
	$Contract_ID_1 		= 	$_POST['Contract_ID_1'];
	$FromDate_ID_1 		= 	$_POST['FromDate_ID_1'];
	$ToDate_ID_1 		= 	$_POST['ToDate_ID_1'];
	
	//--------------Thông tin bảng cam kết----------------------------------------------------
	
	$CommitmentID 		= 	$_POST['CommitmentID'];
	
	$LScompanyID 		= 	$_POST['LScompanyID'];
	$LSlevel1ID 		= 	$_POST['LSlevel1ID'];
	$StartDate 			= 	$_POST['StartDate'];
	$ComYear 			= 	$_POST['ComYear'];
	$ComMoney 			= 	$_POST['ComMoney'];
	$Note 				= 	$_POST['Note'];
	
	//--------------Thông tin bảng cam kết----------------------------------------------------
	
	$DependPersonID 	= 	$_POST['DependPersonID'];
	$TaxCode 			= 	$_POST['TaxCode'];
	$Person 			= 	$_POST['Person'];
	$FromDate 			= 	$_POST['FromDate'];
	$Note_3 			= 	$_POST['Note_3'];
	
	if ($Var_ratio_0 == 'add')
	{
		$date = new DateTime();
		$date = $date->format('Y-m-d H:i:s');
		
		$query = "INSERT INTO [HRISWORKERSPCC].[dbo].[HR_tblEmpCV] (EmpID, EmpCode, VFirstName, P_Address, DOBText, IDIssuedDateText, IDIssuedPlace, DOB, IDIssuedDate, CreateTime, VLastName, Gender, IDNo) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$getResults= sqlsrv_query($conn_mssql, $query, array( "$Emp_ID_0", "$Emp_ID_0", "$User_ID_0", "$Address_ID_0", "$FromMonth_0", "$FromMonth_Issues_0", "$Where_Issues_0", "$FromDate_0", "$FromDate_Issues_0", "$date", "   ", "0", "$Emp_ID_0"));
		
		if($getResults)
		{
			echo "Đã thêm vào một công nhân mới thành công...";
		} else 
		{
			echo "Đã thêm vào một công nhân mới thất bại...";
		} 
	}	
	if ($Var_ratio_1 == 'add')
	{
		$date = new DateTime();
		$date = $date->format('Y-m-d H:i:s');
		
		$tsql= "SELECT TOP 1 SUBSTRING(ContractID, PATINDEX('%[0-9]%', ContractID), LEN(ContractID)) FROM [HRISWORKERSPCC].[dbo].[HR_tblContract] ORDER BY Len(ContractID) desc, ContractID desc ;";
		$getResults= sqlsrv_query($conn_mssql, $tsql);
		$row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC);
	
		$ContractID_Num = floatval($row['']);
	
		$ContractID = "HO".($ContractID_Num + 1);
		
		$tsql= "update [HRISWORKERSPCC].[dbo].[HR_tblContract] set  Used =  ? where [HR_tblContract].EmpID =  ?";
		$getResults= sqlsrv_query($conn_mssql, $tsql, array( "0", "$Emp_ID_0"));
				
		$query = "INSERT INTO [HRISWORKERSPCC].[dbo].[HR_tblContract] (ContractID, EmpID, ContractNo, EffectiveDate, ToDate, CreateTime, LSCompanyID, LSLevel1ID, Used) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$getResults= sqlsrv_query($conn_mssql, $query, array( "$ContractID", "$Emp_ID_0", "$Contract_ID_1", "$FromDate_ID_1", "$ToDate_ID_1", "$date", "$Emp_ID_1", "$User_ID_1", "1"));
		
		if($getResults)
		{
			echo "Đã thêm vào một thông tin hợp đồng mới thành công...";
		} else 
		{
			echo "Đã thêm vào một thông tin hợp đồng mới thất bại...";
		} 
	}
	if ($Var_ratio_2 == 'add') 
	{
		$date = new DateTime();
		$date = $date->format('Y-m-d H:i:s');
		
		$query = "INSERT INTO [HRISWORKERSPCC].[dbo].[HR_tblCommitment] (EmpID, LScompanyID, LSlevel1ID, StartDate, ComYear, Note, ComMoney, CreateTime) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
		$getResults= sqlsrv_query($conn_mssql, $query, array( "$Emp_ID_0", "$LScompanyID", "$LSlevel1ID", "$StartDate", "$ComYear", "$Note", "$ComMoney", "$date"));
		
		if($getResults)
		{
			echo "Đã thêm vào một cam kết mới thành công...";
		} else 
		{
			echo "Đã thêm vào một cam kết mới thất bại...";
		} 
	} 
	if ($Var_ratio_3 == 'add') 
	{
		$date = new DateTime();
		$date = $date->format('Y-m-d H:i:s');
		
		$tsql= "SELECT TOP 1 SUBSTRING(DependPersonID, PATINDEX('%[0-9]%', DependPersonID), LEN(DependPersonID)) FROM [HRISWORKERSPCC].[dbo].[HR_tblDependPerson] ORDER BY Len(DependPersonID) desc, DependPersonID desc ;";
		$getResults= sqlsrv_query($conn_mssql, $tsql);
		$row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC);
	
		$DependPersonID_Num = floatval($row['']);
	
		$DependPersonID = "HO".($DependPersonID_Num + 1);
					
		$query = "INSERT INTO [HRISWORKERSPCC].[dbo].[HR_tblDependPerson] (DependPersonID, EmpID, TaxCode, Person, FromDate, Note, CreateTime) VALUES(?, ?, ?, ?, ?, ?, ?)";
		$getResults= sqlsrv_query($conn_mssql, $query, array( "$DependPersonID", "$Emp_ID_0", "$TaxCode", "$Person", "$FromDate", "$Note", "$date"));
		
		if($getResults)
		{
			echo "Đã thêm vào một thông tin hợp đồng mới thành công...";
		} else 
		{
			echo "Đã thêm vào một thông tin hợp đồng mới thất bại...";
		} 
	}
	if ($Var_ratio_0 == 'edit')
	{
		$date = new DateTime();
		$date = $date->format('Y-m-d H:i:s');
		
		$tsql= "update [HRISWORKERSPCC].[dbo].[HR_tblEmpCV] set  EmpID 	=  ? , EmpCode = ? , VFirstName = ? , P_Address = ? , DOBText = ? , IDIssuedDateText = ? , IDIssuedPlace = ? where [HR_tblEmpCV].EmpID =  ?";
		$getResults= sqlsrv_query($conn_mssql, $tsql, array( "$Emp_ID_0", "$Emp_ID_0", "$User_ID_0", "$Address_ID_0", "$FromMonth_0", "$FromMonth_Issues_0", "$Where_Issues_0", "$Emp_ID_0"));
		
		$tsql_2= "update [HRISWORKERSPCC].[dbo].[HR_tblEmpCV] set DOB = CAST('$FromDate_0' AS DATETIME), IDIssuedDate = CAST('$FromDate_Issues_0' AS DATETIME), EditTime = CAST('$date' AS DATETIME) where [HR_tblEmpCV].EmpID =  ? ";
		
		$getResults= sqlsrv_query($conn_mssql, $tsql_2, array( "$Emp_ID_0"));
		
		
	} 
	if ($Var_ratio_1 == 'edit')
	{
		$date = new DateTime();
		$date = $date->format('Y-m-d H:i:s');
		
		$tsql= "update [HRISWORKERSPCC].[dbo].[HR_tblContract] set  LSCompanyID =  ? , LSLevel1ID = ? , ContractNo = ? where [HR_tblContract].ContractID =  ?";
		$getResults= sqlsrv_query($conn_mssql, $tsql, array( "$Emp_ID_1", "$User_ID_1", "$Contract_ID_1", "$ContractID_1"));
		
		$tsql_2= "update [HRISWORKERSPCC].[dbo].[HR_tblContract] set EffectiveDate = CAST('$FromDate_ID_1' AS DATETIME), ToDate = CAST('$ToDate_ID_1' AS DATETIME), EditTime = CAST('$date' AS DATETIME) where [HR_tblContract].ContractID =  ? ";
		
		$getResults= sqlsrv_query($conn_mssql, $tsql_2, array( "$ContractID_1"));
		
		if($getResults)
		{
			echo "Cập nhật thành công...";
		} else {
			echo "Cập nhật thất bại...";
		}

	}
	if ($Var_ratio_2 == 'edit') 
	{
		$date = new DateTime();
		$date = $date->format('Y-m-d H:i:s');
		
		$tsql= "update [HRISWORKERSPCC].[dbo].[HR_tblCommitment] set  LScompanyID 	=  ? , LSlevel1ID = ? , ComYear = ? , ComMoney = ? , Note = ? where [HR_tblCommitment].CommitmentID = ? ";
		$getResults= sqlsrv_query($conn_mssql, $tsql, array( "$LScompanyID", "$LSlevel1ID", "$ComYear", "$ComMoney", "$Note", "$CommitmentID"));
		
		$tsql_2= "update [HRISWORKERSPCC].[dbo].[HR_tblCommitment] set StartDate = CAST('$StartDate' AS DATETIME), EditTime = CAST('$date' AS DATETIME) where [HR_tblCommitment].CommitmentID =  ? ";
		
		$getResults= sqlsrv_query($conn_mssql, $tsql_2, array( "$CommitmentID"));
		
		if($getResults)
		{
			echo "Cập nhật thành công...";
		} else {
			echo "Cập nhật thất bại...";
		}
	}
	if ($Var_ratio_3 == 'edit') 
	{
		$date = new DateTime();
		$date = $date->format('Y-m-d H:i:s');
		
		$tsql= "update [HRISWORKERSPCC].[dbo].[HR_tblDependPerson] set TaxCode =  ? , Person = ? , Note = ? where [HR_tblDependPerson].DependPersonID = ? ";
		$getResults= sqlsrv_query($conn_mssql, $tsql, array( "$TaxCode", "$Person", "$Note_3", "$DependPersonID"));
		
		$tsql_2= "update [HRISWORKERSPCC].[dbo].[HR_tblDependPerson] set FromDate = CAST('$FromDate' AS DATETIME), EditTime = CAST('$date' AS DATETIME) where [HR_tblDependPerson].DependPersonID =  ? ";
		
		$getResults= sqlsrv_query($conn_mssql, $tsql_2, array( "$DependPersonID"));
		
		if($getResults)
		{
			echo "Cập nhật thành công...";
		} else {
			echo "Cập nhật thất bại...";
		}	}

?>