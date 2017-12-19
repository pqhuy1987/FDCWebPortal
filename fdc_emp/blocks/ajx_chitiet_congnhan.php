<?php
require "../lib/dbConMSSQL.php";
require "../lib/dbCon.php";
   
if (isset($_GET["p"]))
    $p = $_GET["p"];
else
    $p = "";
	
$EmpID = $_POST['EmpID'];
	
$tsql= "SELECT * FROM [HRISWORKERSPCC].[dbo].[HR_tblEmpCV] where [HR_tblEmpCV].EmpID = '$EmpID' ;";
$getResults= sqlsrv_query($conn_mssql, $tsql);

	
?>   
            <div class="tab">
                <div id="test2">
                	<!––----------------------//THÔNG TIN CÔNG NHÂN-------------------------––>
                	<!––--------------------------------------------------------------------––>
                        <h2>Thông Tin Công Nhân</h2>
                        
                            <table class="table1">
                            <!--- begin html form; 
                            put action page in the "action" attribute of the form tag --->
                            <form action="insert_action.cfm" method="post">
                            <tr>
                              <th>Số CMND :</th>
                              <td><input type="text" name="Emp_ID" size="16" maxlength="12" value=""></td>
                            </tr>
                            </table>
                            <table class="table1">
                            <tr>
                              <th>Họ và Tên:</th>
                              <td><input type="Text" name="User_ID" size="40" maxlength="40" value=""></td>
                            </tr>
                            </table>
                            <table class="table1">
                            <tr>
                              <th>Địa Chỉ:</th>
                              <td><input type="Text" name="User_ID" size="64" maxlength="64" value=""></td>
                            </tr>
                            </table>
                            <table class="table1">
                                <tr>
                                  <th>Ngày Sinh</th>
                                  <td><input id="FromDate" type="date" name="FromDate" size="8" maxlength="8" value=""> </td>
                                  <th>Tháng/Năm Sinh</th>
                                  <td><input type="Text" name="User_ID" size="16" maxlength="16" value=""></td>
                                </tr>
                            </table>
                            <table class="table1">
                                <tr>
                                  <th>Ngày Cấp CMND</th>
                                  <td><input id="FromDate" type="date" name="FromDate" size="8" maxlength="8" value=""> </td>
                                  <th>Tháng/Năm Cấp CMND</th>
                                  <td><input type="Text" name="User_ID" size="16" maxlength="16" value=""></td>
                                </tr>
                            </table>
                            <table class="table1">
                            <tr>
                              <th>Nơi Cấp CMND</th>
                              <td><input type="text" name="Dept_ID" size="12" maxlength="20"></td>
                              <td><button type="button" style="width:125px" onClick="alert('Hello world!')">Tạo Mới </button> </td>
                              <td><button type="button" style="width:125px" onClick="alert('Hello world!')">Thoát</button> </td>
                            </tr>
                            </table>
                            </form>
                	<!––--------------------------------------------------------------------––>
                	<!––--------------------------------------------------------------------––>
                </div>  
            </div>