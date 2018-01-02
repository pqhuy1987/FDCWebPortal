<?php
	$serverName = "TECHNICAL02"; //serverName\instanceName, portNumber (1433 by default)
	$connectionInfo = array( "Database"=>"HRISWORKERSPCC", "UID"=>"sa", "PWD"=>"P@ssw0rd", "CharacterSet" => "UTF-8");
	$conn_mssql = sqlsrv_connect( $serverName, $connectionInfo);

	if( $conn_mssql ) {
     //echo "Successfuly connected.<br />";
	}else{
     echo "Connection error.<br />";
     die( print_r( sqlsrv_errors(), true));
	}
?>