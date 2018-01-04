<?php
require "../lib/dbConMSSQL.php";
require "../lib/dbCon.php";
   
if (isset($_GET["p"]))
    $p = $_GET["p"];
else
    $p = "";
	
$EmpID = $_POST['EmpID'];

//––------------------------------------THÔNG TIN CÔNG NHÂN--------------------------------––---––//
$tsql= "SELECT * FROM [HRISWORKERSPCC].[dbo].[HR_tblEmpCV] where [HR_tblEmpCV].EmpID = '$EmpID' ;";
$getResults= sqlsrv_query($conn_mssql, $tsql);
$row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_BOTH);
//––-------------------------------------------------------------------------------------------––-//

//––------------------------------------THÔNG TIN HỢP ĐỒNG--------------------------------––---––-//
$tsql_2 			= "SELECT TOP 1 * FROM [HRISWORKERSPCC].[dbo].[HR_tblContract] where [HR_tblContract].EmpID = '$EmpID'  AND [HR_tblContract].Used = '1' order by [HR_tblContract].CreateTime desc ;";
$getResults_2 		= sqlsrv_query($conn_mssql, $tsql_2);
$row_2 				= sqlsrv_fetch_array($getResults_2, SQLSRV_FETCH_BOTH);

$tsql_2_1			= "SELECT * FROM [HRISWORKERSPCC].[dbo].[LS_tblCompany] order by  [LS_tblCompany].LSCompanyID desc ;";
$getResults_2_1		= sqlsrv_query($conn_mssql, $tsql_2_1);

$tsql_2_2 			= "SELECT * FROM [HRISWORKERSPCC].[dbo].[LS_tblLevel1] order by  [LS_tblLevel1].LSLevel1ID desc ;";
$getResults_2_2 	= sqlsrv_query($conn_mssql, $tsql_2_2);

$tsql_2_3 			= "SELECT * FROM [HRISWORKERSPCC].[dbo].[HR_tblContract] where [HR_tblContract].EmpID = '$EmpID' order by [HR_tblContract].CreateTime desc ;";
$getResults_2_3 	= sqlsrv_query($conn_mssql, $tsql_2_3);

$tsql_2_4 			= "SELECT * FROM [HRISWORKERSPCC].[dbo].[HR_tblContract] where [HR_tblContract].EmpID = '$EmpID' order by [HR_tblContract].CreateTime desc ;";
$getResults_2_4 	= sqlsrv_query($conn_mssql, $tsql_2_4, array(), array( "Scrollable" => 'static' ));
$rownum_2_4 		= sqlsrv_num_rows($getResults_2_4);

$tsql_2_5 			= "SELECT TOP 1 * FROM [HRISWORKERSPCC].[dbo].[HR_tblCommitment] where [HR_tblCommitment].EmpID = '$EmpID' order by [HR_tblCommitment].ComYear desc ;";
$getResults_2_5 	= sqlsrv_query($conn_mssql, $tsql_2_5);
$row_2_5 			= sqlsrv_fetch_array($getResults_2_5, SQLSRV_FETCH_BOTH);

/*----------------SUB----------------------------*/
$tsql_2_5_1			= "SELECT * FROM [HRISWORKERSPCC].[dbo].[LS_tblCompany] order by  [LS_tblCompany].LSCompanyID desc ;";
$getResults_2_5_1 	= sqlsrv_query($conn_mssql, $tsql_2_5_1);
	
$tsql_2_5_2 		= "SELECT * FROM [HRISWORKERSPCC].[dbo].[LS_tblLevel1] order by  [LS_tblLevel1].LSLevel1ID desc ;";
$getResults_2_5_2   = sqlsrv_query($conn_mssql, $tsql_2_5_2);
/*----------------SUB----------------------------*/

$tsql_2_6 			= "SELECT * FROM [HRISWORKERSPCC].[dbo].[HR_tblDependPerson] where [HR_tblDependPerson].EmpID = '$EmpID';";
$getResults_2_6 	= sqlsrv_query($conn_mssql, $tsql_2_6, array(), array( "Scrollable" => 'static' ));
$row_2_6 			= sqlsrv_fetch_array($getResults_2_6, SQLSRV_FETCH_BOTH);

//––-------------------------------------------------------------------------------------------––-//
?> 
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type='text/javascript'>
$(document).ready(function(){
	//$("input[@name='update1']").change(function(){
	$('#myForm1 input').on('change', function() {
	   var Var_ratio = $('input[name=update1]:checked', '#myForm1').val();
	   var Emp_ID = $("#Emp_ID_0").val();
	   
	   if (Var_ratio == 'add'){
		   $.ajax({
				type:"POST",
				url:"ajx_detail_chitiet_congnhan.php",
				data:{Var_ratio:1},
				success:function(data)
				{
					$('#FormRatio1').html(data);	
				}
			}); 
	   } else if ((Var_ratio == 'view') || (Var_ratio == 'edit'))
	   {
		   //alert(1);
		   $.ajax({
				type:"POST",
				url:"ajx_detail_chitiet_congnhan_edit.php",
				data:{Var_ratio:1, Emp_ID:Emp_ID},
				success:function(data)
				{
					$('#FormRatio1').html(data);	
				}
			}); 		   
	   }
	});
	
	$('#myForm2 input').on('change', function() {
	   var Var_ratio = $('input[name=update2]:checked', '#myForm2').val(); 
	   var Emp_ID = $("#Emp_ID_0").val();
	   if (Var_ratio == 'add'){
		   $.ajax({
				type:"POST",
				url:"ajx_detail_chitiet_congnhan.php",
				data:{Var_ratio:2},
				success:function(data)
				{
					$('#FormRatio2').html(data);	
				}
			}); 
	   } else if ((Var_ratio == 'view') || (Var_ratio == 'edit'))
	   {
		   //alert(2);
		   $.ajax({
				type:"POST",
				url:"ajx_detail_chitiet_congnhan_edit.php",
				data:{Var_ratio:2, Emp_ID:Emp_ID},
				success:function(data)
				{
					$('#FormRatio2').html(data);	
				}
			}); 		   
	   }
	});
	
	$('#myForm3 input').on('change', function() {
	   var Var_ratio = $('input[name=update3]:checked', '#myForm3').val();
	   var Emp_ID = $("#Emp_ID_0").val(); 
	   if (Var_ratio == 'add'){
		   $.ajax({
				type:"POST",
				url:"ajx_detail_chitiet_congnhan.php",
				data:{Var_ratio:3},
				success:function(data)
				{
					$('#FormRatio3').html(data);	
				}
			}); 
	   } else if ((Var_ratio == 'view') || (Var_ratio == 'edit'))
	   {
		   //alert(3);
		   $.ajax({
				type:"POST",
				url:"ajx_detail_chitiet_congnhan_edit.php",
				data:{Var_ratio:3, Emp_ID:Emp_ID},
				success:function(data)
				{
					$('#FormRatio3').html(data);	
				}
		 	}); 		   
	   }
	});
	
	$( "#button_add" ).click(function() {
		$.ajax({//Make the Ajax Request
			type: 'POST',
			url: 'ajx_chitiet_congnhan_2.php',
			data: { EmpID: 1},
					success: function(data){
					$('#content-main-2').html(data);
				}
		});
	});		
	
	$( "#button_save" ).click(function() {

		var Var_ratio_0 = $('input[name=update0]:checked', '#myForm0').val(); 		
		var Var_ratio_1 = $('input[name=update1]:checked', '#myForm1').val(); 
		var Var_ratio_2 = $('input[name=update2]:checked', '#myForm2').val(); 
		var Var_ratio_3 = $('input[name=update3]:checked', '#myForm3').val();
		
		//Thông tin công nhân.
		var Emp_ID_0 			= 	$("#Emp_ID_0").val();
		var User_ID_0 			= 	$("#User_ID_0").val();
		var Address_ID_0 		= 	$("#Address_ID_0").val();
		var FromDate_0 			= 	$("#FromDate_0").val();
		var FromMonth_0 		= 	$("#FromMonth_0").val();
		var FromDate_Issues_0 	= 	$("#FromDate_Issues_0").val();
		var FromMonth_Issues_0 	= 	$("#FromMonth_Issues_0").val();
		var Where_Issues_0 		= 	$("#Where_Issues_0").val();
		var Emp_ID_0_Length 	= 	$.trim($("#Emp_ID_0").val()).length;
		
		//Thông tin hợp đồng.
		var Emp_ID_1 			= 	$("#Emp_ID_1").val();
		var User_ID_1 			= 	$("#User_ID_1").val();
		var Contract_ID_1 		= 	$("#Contract_ID_1").val();
		var FromDate_ID_1 		= 	$("#FromDate_ID_1").val();
		var ToDate_ID_1 		= 	$("#ToDate_ID_1").val();
		
		//Thông tin bảng cam kết.
		//var Emp_ID_1 			= 	$("#Emp_ID_1").val();
		//var User_ID_1 			= 	$("#User_ID_1").val();
		//var Contract_ID_1 		= 	$("#Contract_ID_1").val();
		//var FromDate_ID_1 		= 	$("#FromDate_ID_1").val();
		//var ToDate_ID_1 		= 	$("#ToDate_ID_1").val();
		

		
		if ((Emp_ID_0_Length == 9) || (Emp_ID_0_Length == 12))
		{	 
			$.ajax({//Make the Ajax Request
				type: 'POST',
				url: 'chitiet_congnhan_add_edit.php',
				data: { Var_ratio_0: Var_ratio_0, Var_ratio_1: Var_ratio_1, Var_ratio_2: Var_ratio_2, Var_ratio_3: Var_ratio_3,
				
						Emp_ID_0: Emp_ID_0, User_ID_0: User_ID_0, Address_ID_0: Address_ID_0, FromDate_0: FromDate_0,
						FromMonth_0: FromMonth_0, FromDate_Issues_0: FromDate_Issues_0, FromMonth_Issues_0: FromMonth_Issues_0, Where_Issues_0:Where_Issues_0,
						
						Emp_ID_1: Emp_ID_1, User_ID_1: User_ID_1, Contract_ID_1: Contract_ID_1, FromDate_ID_1: FromDate_ID_1, ToDate_ID_1: ToDate_ID_1
						
						 },
						success: function(data){
						alert(data);
				}
			});
		} else {
			alert("Số CMND không đúng, bạn hãy nhập lại");
		}
	});			
	


});

</script>
  
            <div class="tab">
                <div id="test2">
                	<!––----------------------//THÔNG TIN CÔNG NHÂN-------------------------––>
                	<!––--------------------------------------------------------------------––>
                            <h2>THÔNG TIN CÔNG NHÂN</h2>
                            <form id="myForm0">
                                <input type="radio" name="update0" value="edit" checked="checked"> Sửa
                                <input type="radio" name="update0" value="add" disabled > Thêm
                            </form>
                            <div id="FormRatio4">
                                <table class="table1">
                                <!--- begin html form; 
                                put action page in the "action" attribute of the form tag --->
                                <form action="insert_action.cfm" method="post">
                                <tr>
                                  <th>Số CMND :</th>
                                  <td><input type="text" name="Emp_ID" id="Emp_ID_0" size="16" maxlength="12" value="<?php echo $row['EmpID'] ?>" ></td>
                                </tr>
                                </table>
                                <table class="table1">
                                <tr>
                                  <th>Họ và Tên:</th>
                                  <td><input type="Text" name="User_ID" id="User_ID_0" size="40" maxlength="40" value="<?php echo $row['VFirstName'] ?>" ></td>
                                </tr>
                                </table>
                                <table class="table1">
                                <tr>
                                  <th>Địa Chỉ:</th>
                                  <td><input type="Text" name="User_ID" id="Address_ID_0" size="64" maxlength="64" value="<?php echo $row['P_Address'] ?>"></td>
                                </tr>
                                </table>
                                <table class="table1">
                                    <tr>
                                      <th>Ngày Sinh</th>
                                      <td><input id="FromDate_0" type="date" name="FromDate" size="8" maxlength="8" value="<?php if ($row['DOB'] != NULL)  echo $row['DOB']->format('Y-m-d')?>"> </td>
                                      <th>Tháng/Năm Sinh</th>
                                      <td><input id="FromMonth_0" type="Text" name="User_ID" size="16" maxlength="16" value=""></td>
                                    </tr>
                                </table>
                                <table class="table1">
                                    <tr>
                                      <th>Ngày Cấp CMND</th>
                                      <td><input id="FromDate_Issues_0" type="date" name="FromDate" size="8" maxlength="8" value="<?php if ($row['IDIssuedDate'] != NULL) echo  $row['IDIssuedDate']->format('Y-m-d')?>"> </td>
                                      <th>Tháng/Năm Cấp CMND</th>
                                      <td><input id="FromMonth_Issues_0" type="Text" name="User_ID" size="16" maxlength="16" value=""></td>
                                    </tr>
                                </table>
                                <table class="table1">
                                <tr>
                                  <th>Nơi Cấp CMND</th>
                                  <td><input id="Where_Issues_0" type="text" name="Dept_ID" size="12" maxlength="20" value="<?php echo $row['IDIssuedPlace'] ?>"></td>
                                </tr>
                                </table>
                                </form>
                    		</div>                                   
                	<!––--------------------------------------------------------------------––>
                	<!––--------------------------------------------------------------------––>
                    
                	<!––----------------------//THÔNG TIN HỢP ĐỒNG--------------------------––>
                	<!––--------------------------------------------------------------------––>
                        <h2>THÔNG TIN HỢP ĐỒNG</h2>

                        <form id="myForm1">
                            <input type="radio" name="update1" value="view" checked="checked"> Xem 
                            <input type="radio" name="update1" value="add"> Thêm
                            <input type="radio" name="update1" value="edit" <?php if ($row_2['ContractID'] == NULL) echo "disabled" ?> > Sửa
                        </form>
                        <div id="FormRatio1"> 
                        <input type="hidden" id="Emp_Hidden" name="update_hidden" value="<?php echo $row_2['ContractID']?>">                  
                        <table class="table1">
                            <tr>
                              <th>Công Trường</th>
                              <td>
                                  <select id="Emp_ID_1">
                                      <option value="" >----Chọn Tên Công Trường----</option>
                                      <?php while ($row_2_1 = sqlsrv_fetch_array($getResults_2_1, SQLSRV_FETCH_ASSOC)) { ?>
                                            <option value="<?php echo $row_2_1['LSCompanyID'] ?>" <?php  if ($row_2_1['LSCompanyID'] == $row_2['LSCompanyID']) echo "selected='selected'" ?> ><?php echo $row_2_1['LSCompanyID']; echo ' : '; echo $row_2_1['Name'];?></option>
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
                                            <option value="<?php echo $row_2_2['LSLevel1ID'] ?>" <?php   if ($row_2_2['LSLevel1ID'] == $row_2['LSLevel1ID']) echo "selected='selected'" ?> ><?php echo $row_2_2['LSLevel1ID']; echo ' : '; echo $row_2_2['Name'];?></option>
                                      <?php } ?>
                                  </select>
                              </td>
                            </tr>
                      	</table>
                      	<table class="table1">
                            <tr>
                              <th>Mã Hợp Đồng:</th>
                              <td><input id="Contract_ID_1" type="Text" name="User_ID" size="10" maxlength="10" value="<?php echo $row_2['ContractNo'] ?>" ></td>
                              <th>Đã Ký:</th>
                              <td><input type="Text" name="User_ID" size="4" maxlength="4" value="<?php echo $rownum_2_4 ?>" ></td>
                              <th>Hợp Đồng:</th>
                              <td><input type="button" name="User_ID" size="4" maxlength="4" value="..." ></td>
                            </tr>
                       	</table>
                        <table class="table1">
                             <tr>
                                <th>Ngày bắt đầu</th>
                                <td><input id="FromDate_ID_1" type="date" name="FromDate" size="8" maxlength="8" value="<?php if ($row_2['EffectiveDate'] != NULL)  echo $row_2['EffectiveDate']->format('Y-m-d')?>"> </td>
                                <th>Ngày kết thúc</th>
                                <td><input id="ToDate_ID_1" type="date" name="FromDate" size="8" maxlength="8" value="<?php if ($row_2['ToDate'] != NULL)  echo $row_2['ToDate']->format('Y-m-d')?>"> </td>
                             </tr>
                        </table>
					</div>
                	<!––--------------------------------------------------------------------––>
                	<!––--------------------------------------------------------------------––>
                    
                	<!––----------------------//THÔNG TIN BẢNG CAM KẾT----------------------––>
                	<!––--------------------------------------------------------------------––>
                        <h2>THÔNG TIN BẢNG CAM KẾT</h2>
                        <form id="myForm2">
                            <input type="radio" name="update2" value="view" checked="checked"> Xem 
                            <input type="radio" name="update2" value="add"> Thêm
                            <input type="radio" name="update2" value="edit" <?php if ($row_2_5['CommitmentID'] == NULL) echo "disabled" ?> > Sửa
                        </form>
                    <div id="FormRatio2">
                       <input type="hidden" id="Emp_Hidden_2" name="update_hidden" value="<?php echo $row_2_5['CommitmentID']?>"> 
                       <table class="table1">
                            <tr>
                              <th>Công Trường</th>
                              <td>
                                  <select id="Emp_ID_2">
                                      <option value="" >----Chọn Tên Công Trường----</option>
                                      <?php while ($row_2_5_1 = sqlsrv_fetch_array($getResults_2_5_1, SQLSRV_FETCH_ASSOC)) { ?>
                                            <option value="<?php echo $row_2_5_1['LSCompanyID'] ?>" <?php  if ($row_2_5_1['LSCompanyID'] == $row_2_5['LScompanyID']) echo "selected='selected'" ?> ><?php echo $row_2_5_1['LSCompanyID']; echo ' : '; echo $row_2_5_1['Name'];?></option>
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
                                            <option value="<?php echo $row_2_5_2['LSLevel1ID'] ?>" <?php   if ($row_2_5_2['LSLevel1ID'] == $row_2_5['LSlevel1ID']) echo "selected='selected'" ?> ><?php echo $row_2_5_2['LSLevel1ID']; echo ' : '; echo $row_2_5_2['Name'];?></option>
                                      <?php } ?>
                                  </select>
                              </td>
                            </tr>
                      	</table>
                        <table class="table1">
                             <tr>
                                <th>Ngày bắt đầu:</th>
                                <td><input id="FromDate_2" type="date" name="FromDate" size="8" maxlength="8" value="<?php if ($row_2_5['StartDate'] != NULL)  echo $row_2_5['StartDate']->format('Y-m-d')?>"> </td>
                                <th>Năm Cam Kết:</th>
                                <td>
                                    <select id="YearTL_2">
                                           <option value="2015" <?php  if ($row_2_5['ComYear'] == 2015) echo "selected='selected'" ?> >Năm 2015</option>
                                           <option value="2016" <?php  if ($row_2_5['ComYear'] == 2016) echo "selected='selected'" ?> >Năm 2016</option>
                                           <option value="2017" <?php  if ($row_2_5['ComYear'] == 2017) echo "selected='selected'" ?> >Năm 2017</option>
                                           <option value="2018" <?php  if ($row_2_5['ComYear'] == 2018) echo "selected='selected'" ?> >Năm 2018</option>
                                           <option value="2019" <?php  if ($row_2_5['ComYear'] == 2019) echo "selected='selected'" ?> >Năm 2019</option>
                                           <option value="2020" <?php  if ($row_2_5['ComYear'] == 2020) echo "selected='selected'" ?> >Năm 2020</option>
                                    </select> 
                                </td>
                             </tr>
                        </table>
                      	<table class="table1">
                            <tr>
                              <th>Số Tiền</th>
                              <td><input id="User_ComMoney_2" type="Text" name="User_ID" size="10" maxlength="10" value="<?php echo $row_2_5['ComMoney'] ?>" ></td>
                              <th>Ghi Chú:</th>
                              <td><input id="User_Note_2" type="Text" name="User_ID" size="10" maxlength="10" value="<?php echo $row_2_5['Note'] ?>" ></td>
                            </tr>
                       	</table>
                    </div>
                	<!––--------------------------------------------------------------------––>
                	<!––--------------------------------------------------------------------––>     
                    
                	<!––----------------------//MÃ SỐ THUẾ VÀ NGƯỜI PHỤ THUỘC---------------––>
                	<!––--------------------------------------------------------------------––>
                        <h2>MÃ SỐ THUẾ VÀ NGƯỜI PHỤ THUỘC</h2>
                        <form id="myForm3">
                        	<input type="radio" name="update3" value="view" checked="checked"> Xem 
                        	<input type="radio" name="update3" value="add"> Thêm
                        	<input type="radio" name="update3" value="edit" <?php if ($row_2_6['DependPersonID'] == NULL) echo "disabled" ?> > Sửa
                        </form>
                       	<div id="FormRatio3">
                      	<table class="table1">
                            <tr>
                              <th>Mã Số Thuế:</th>
                              <td><input type="Text" name="User_ID" size="10" maxlength="10" value="<?php echo $row_2_6['TaxCode'] ?>" ></td>
                              <th>Số ng Phụ Thuộc:</th>
                              <td><input type="Text" name="User_ID" size="3" maxlength="3" value="<?php echo $row_2_6['Person'] ?>" ></td>
                            </tr>
                       	</table>
                        <table class="table1">
                             <tr>
                                <th>Ngày bắt đầu:</th>
                                <td><input id="FromDate" type="date" name="FromDate" size="8" maxlength="8" value="<?php if ($row_2_6['FromDate'] != NULL)  echo $row_2_6['FromDate']->format('Y-m-d')?>"> </td>
                              	<th>Ghi Chú:</th>
                              	<td><input type="Text" name="User_ID" size="10" maxlength="10" value="<?php echo $row_2_6['Note'] ?>" ></td>
                             </tr>
                        </table>
                  </div> 
                	<!––--------------------------------------------------------------------––>
                	<!––--------------------------------------------------------------------––> 
                    
                	<!––----------------------//CÔNG CỤ-------------------------------------––>
                	<!––--------------------------------------------------------------------––>
                        <h2>CÔNG CỤ</h2>
                        <span style="display: inline;">
                          <input type="button" id="button_add" value="THÊM"/> <input type="button" id="button_save" value="LƯU"/> <input type="button" value="XÓA"/>
                        </span>

                	<!––--------------------------------------------------------------------––>
                	<!––--------------------------------------------------------------------––>                                         
                    
                </div>  
            </div>