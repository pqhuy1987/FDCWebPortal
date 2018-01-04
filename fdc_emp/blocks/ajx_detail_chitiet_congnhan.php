
<?php
require "../lib/dbConMSSQL.php";
require "../lib/dbCon.php";
$Var_ratio = $_POST['Var_ratio'];

$tsql_2_1			= "SELECT * FROM [HRISWORKERSPCC].[dbo].[LS_tblCompany] order by  [LS_tblCompany].LSCompanyID desc ;";
$getResults_2_1		= sqlsrv_query($conn_mssql, $tsql_2_1);

$tsql_2_2 			= "SELECT * FROM [HRISWORKERSPCC].[dbo].[LS_tblLevel1] order by  [LS_tblLevel1].LSLevel1ID desc ;";
$getResults_2_2 	= sqlsrv_query($conn_mssql, $tsql_2_2);

/*----------------SUB----------------------------*/
$tsql_2_5_1			= "SELECT * FROM [HRISWORKERSPCC].[dbo].[LS_tblCompany] order by  [LS_tblCompany].LSCompanyID desc ;";
$getResults_2_5_1 	= sqlsrv_query($conn_mssql, $tsql_2_5_1);
	
$tsql_2_5_2 		= "SELECT * FROM [HRISWORKERSPCC].[dbo].[LS_tblLevel1] order by  [LS_tblLevel1].LSLevel1ID desc ;";
$getResults_2_5_2   = sqlsrv_query($conn_mssql, $tsql_2_5_2);
/*----------------SUB----------------------------*/

	if ($Var_ratio == 1)
	{ ?>
    						<input type="hidden" id="Emp_Hidden" name="update_hidden" value="<?php echo $row_2['ContractID']?>">                 
							<table class="table1">
								<tr>
								  <th>Công Trường</th>
								  <td>
                                  	  <select id="Emp_ID_1">
										  <option value="" >----Chọn Tên Công Trường----</option>
										  <?php while ($row_2_1 = sqlsrv_fetch_array($getResults_2_1, SQLSRV_FETCH_ASSOC)) { ?>
												<option value="<?php echo $row_2_1['LSCompanyID'] ?>" ><?php echo $row_2_1['LSCompanyID']; echo ' : '; echo $row_2_1['Name'];?></option>
										  <?php } ?>
									  </select>
								  </td>
								</tr>
							</table>
							<table class="table1">
								<tr>
								  <th>Đội Quản Lý</th>
								  <td>
                                  	  <select id="User_ID_1">
										  <option value="" >----Chọn Tên Đội Quản Lý----</option>
										  <?php while ($row_2_2 = sqlsrv_fetch_array($getResults_2_2, SQLSRV_FETCH_ASSOC)) { ?>
												<option value="<?php echo $row_2_2['LSLevel1ID'] ?>" ><?php echo $row_2_2['LSLevel1ID']; echo ' : '; echo $row_2_2['Name'];?></option>
										  <?php } ?>
									  </select>
								  </td>
								</tr>
							</table>
							<table class="table1">
								<tr>
								  <th>Mã Hợp Đồng:</th>
								  <td><input id="Contract_ID_1" type="Text" name="User_ID" size="10" maxlength="10" value="" ></td>
								  <th>Đã Ký:</th>
								  <td><input type="Text" name="User_ID" size="4" maxlength="4" value="" ></td>
								  <th>Hợp Đồng:</th>
								  <td><input type="button" name="User_ID" size="4" maxlength="4" value="..." ></td>
								</tr>
							</table>
							<table class="table1">
								 <tr>
									<th>Ngày bắt đầu</th>
									<td><input id="FromDate_ID_1"  type="date" name="FromDate" size="8" maxlength="8" value=""> </td>
									<th>Ngày kết thúc</th>
									<td><input id="ToDate_ID_1" type="date" name="FromDate" size="8" maxlength="8" value=""> </td>
								 </tr>
							</table>
<?php
	} else if ($Var_ratio == 2) { ?>
    					<input type="hidden" id="Emp_Hidden_2" name="update_hidden" value="<?php echo $row_2_5['CommitmentID']?>"> 
                        <table class="table1">
                            <tr>
                              <th>Công Trường</th>
                              <td>
                                  <select id="Emp_ID_2">
                                      <option value="" >----Chọn Tên Công Trường----</option>
                                      <?php while ($row_2_5_1 = sqlsrv_fetch_array($getResults_2_5_1, SQLSRV_FETCH_ASSOC)) { ?>
                                            <option value="<?php echo $row_2_5_1['LSCompanyID'] ?>" ><?php echo $row_2_5_1['LSCompanyID']; echo ' : '; echo $row_2_5_1['Name'];?></option>
                                      <?php } ?>
                                  </select>
                              </td>
                            </tr>
                        </table>
                        <table class="table1">
                            <tr>
                              <th>Đội Quản Lý</th>
                              <td>
                                  <select id="User_ID_2">
                                  	  <option value="" >----Chọn Tên Đội Quản Lý----</option>
                                      <?php while ($row_2_5_2 = sqlsrv_fetch_array($getResults_2_5_2, SQLSRV_FETCH_ASSOC)) { ?>
                                            <option value="<?php echo $row_2_5_2['LSLevel1ID'] ?>" ><?php echo $row_2_5_2['LSLevel1ID']; echo ' : '; echo $row_2_5_2['Name'];?></option>
                                      <?php } ?>
                                  </select>
                              </td>
                            </tr>
                      	</table>
                        <table class="table1">
                             <tr>
                                <th>Ngày bắt đầu:</th>
                                <td><input id="FromDate_2" type="date" name="FromDate" size="8" maxlength="8" value=""> </td>
                                <th>Năm Cam Kết:</th>
                                <td>
                                    <select id="YearTL_2">
                                           <option value="2015" >Năm 2015</option>
                                           <option value="2016" >Năm 2016</option>
                                           <option value="2017" >Năm 2017</option>
                                           <option value="2018" >Năm 2018</option>
                                           <option value="2019" >Năm 2019</option>
                                           <option value="2020" >Năm 2020</option>
                                    </select> 
                                </td>
                             </tr>
                        </table>
                      	<table class="table1">
                            <tr>
                              <th>Số Tiền:</th>
                              <td><input id="User_ComMoney_2" type="Text" name="User_ID" size="10" maxlength="10" value="" ></td>
                              <th>Ghi Chú:</th>
                              <td><input id="User_Note_2" type="Text" name="User_ID" size="10" maxlength="10" value="" ></td>
                            </tr>
                       	</table>		
<?php	
	} else if ($Var_ratio == 3) { ?>
                        <input type="hidden" id="Emp_Hidden_3" name="update_hidden" value="<?php echo ''?>"> 
                      	<table class="table1">
                            <tr>
                              <th>Mã Số Thuế:</th>
                              <td><input id="Tax_ID_3" type="Text" name="User_ID" size="10" maxlength="10" value="" ></td>
                              <th>Số ng Phụ Thuộc:</th>
                              <td><input id="Person_ID_3" type="Text" name="User_ID" size="3" maxlength="3" value="" ></td>
                            </tr>
                       	</table>
                        <table class="table1">
                             <tr>
                                <th>Ngày bắt đầu:</th>
                                <td><input id="FromDate_3" type="date" name="FromDate" size="8" maxlength="8" value=""> </td>
                              	<th>Ghi Chú:</th>
                              	<td><input id="Note_3" type="Text" name="User_ID" size="10" maxlength="10" value="" ></td>
                             </tr>
                        </table>		
<?php
	} else if ($Var_ratio == 4) { ?>
                            <table class="table1">
                            <!--- begin html form; 
                            put action page in the "action" attribute of the form tag --->
                            <form action="insert_action.cfm" method="post">
                            <tr>
                              <th>Số CMND :</th>
                              <td><input type="text" name="Emp_ID" id="Emp_ID" size="16" maxlength="12" value="" ></td>
                            </tr>
                            </table>
                            <table class="table1">
                            <tr>
                              <th>Họ và Tên:</th>
                              <td><input type="Text" name="User_ID" size="40" maxlength="40" value="" ></td>
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
                              <td><input type="text" name="Dept_ID" size="12" maxlength="20" value=""></td>
                            </tr>
                            </table>
                            </form>

<?php } ?>


