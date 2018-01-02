<?php
require "../lib/dbConMSSQL.php";
require "../lib/dbCon.php";

$tsql= "SELECT top 100 *
  FROM [HRISWORKERSPCC].[dbo].[HR_tblEmpCV] order by [HR_tblEmpCV].VFirstName ASC, [HR_tblEmpCV].CreateTime desc;";
$getResults= sqlsrv_query($conn_mssql, $tsql);

$tsql_temp= "SELECT top 1 *
  FROM [HRISWORKERSPCC].[dbo].[HR_tblEmpCV] order by [HR_tblEmpCV].VFirstName ASC, [HR_tblEmpCV].CreateTime desc;";
$getResults_temp= sqlsrv_query($conn_mssql, $tsql_temp);
$row_temp = sqlsrv_fetch_array($getResults_temp, SQLSRV_FETCH_ASSOC);

$EmpID = $row_temp['EmpID'];

//––------------------------------------THÔNG TIN HỢP ĐỒNG--------------------------------––---––-//
$tsql_2 			= "SELECT TOP 1 * FROM [HRISWORKERSPCC].[dbo].[HR_tblContract] where [HR_tblContract].EmpID = '$EmpID' order by [HR_tblContract].CreateTime desc ;";
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

<?php
require_once "PHPExcel.php";
$h = 0;
if (isset($_FILES['file'])) {
		$data[][] = null;

		$excelReader = PHPExcel_IOFactory::createReaderForFile($_FILES['file']['tmp_name']);
		$excelObj = $excelReader->load($_FILES['file']['tmp_name']);
		$worksheet = $excelObj->getSheet(0);
		$lastRow = $worksheet->getHighestRow();
		if ($lastRow > 150) $lastRow = 150;

		for ($row = 1; $row <= $lastRow; $row++) {
			 $data['STT'][] = $worksheet->getCell('A'.$row)->getValue();
			 $data['fullname'][] = $worksheet->getCell('B'.$row)->getValue();
			 $data['CMND'][] = $worksheet->getCell('D'.$row)->getValue();
			 $data['salary'][] = $worksheet->getCell('F'.$row)->getValue();
			 $data['ThueTT'][] = $worksheet->getCell('G'.$row)->getValue();
		}

		//print_r($data);
		for ( $k = 6; $k < 100; $k ++ ) {
				if (($data['fullname'][$k] != null) && ($data['CMND'][$k] != null)) {
					$h = $h + 1;
				} else {
					break;
				}
		}
		$h_temp = $h + 6;
}
?>  

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type='text/javascript'>
$(document).ready(function(){
	
	 function load_data(query)
	 {
		  $.ajax({
			   type:"POST",
			   url:"fetch2.php",
			   data:{query:query},
			   success:function(data)
			   {
					$('#test1').html(data);	
			   }
		  });
	 }
 
	 $('#search_text').keyup(function(){
			var search = $(this).val();
			if(search != '')
			{
				load_data(search);
			}
			else
			{
				//load_data();
			}
	 });
	 
	$('input[type="checkbox"]').on('change', function() {
	   $('input[type="checkbox"]').not(this).prop('checked', false);
	   	var checked = $(this).val();
			   	$.ajax({//Make the Ajax Request
					type: 'POST',
					url: 'ajx_chitiet_congnhan.php',
					data: { EmpID: checked},
					success: function(data){
						$('#content-main-2').html(data);
					}
				});
	});
	
	$('#myForm1 input').on('change', function() {
	   var Var_ratio = $('input[name=update1]:checked', '#myForm1').val();
	   var Emp_ID = $("#Emp_ID").val();
	   
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
	   var Emp_ID = $("#Emp_ID").val();
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
	   var Emp_ID = $("#Emp_ID").val();
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
		
		var Var_ratio_1 = $('input[name=update1]:checked', '#myForm1').val(); 
		var Var_ratio_2 = $('input[name=update2]:checked', '#myForm2').val(); 
		var Var_ratio_3 = $('input[name=update3]:checked', '#myForm3').val();
		 
		$.ajax({//Make the Ajax Request
			type: 'POST',
			url: 'chitiet_congnhan_add_edit.php',
			data: { Var_ratio_1: Var_ratio_1, Var_ratio_2:Var_ratio_2, Var_ratio_3:Var_ratio_3 },
					success: function(data){
					alert(data);
			}
		});
	});			
	 
});

</script>

<script type='text/javascript'>

</script>

<!DOCTYPE html>
<html>
    <head>
        <title>Transfer Rows Between Two HTML Table</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" href="Style.css" rel="stylesheet" />
    <script type="text/javascript" src="Script.js"></script>
</head>
        <style>
            
            .container{overflow: hidden}
            .tab{float: left}
            .tab-btn{margin: 65px;}
            button{display:block;margin-bottom: 20px;}
            tr{transition:all .25s ease-in-out}
            tr:hover{background-color: #ddd;}
			
			#content-main #content-main-1 {border-right:solid 1px #E2E2E3; width:35%; float:left; padding: 5px; max-height:800px; margin: 0 0 0 0px; overflow:auto }
			#content-main #content-main-2 {border-right:solid 1px #E2E2E3; width:60%; float:right; display: inline-block; padding: 5px; max-height:1200px; margin: 0 0 0 0px; overflow:auto }
			#content-main #content-main-3 {border-right:solid 1px #E2E2E3; width:17%; float:left; padding: 5px; max-height:800px; margin: 0 0 0 0px; overflow:auto }
			#content-main #content-main-4 {border-right:solid 1px #E2E2E3; width:50%; float:right; padding: 5px; max-height:800px; margin: 0 0 0 0px; overflow:auto }
            
        </style>    
    <body>
     <div id="content-main">
        <div class="container">
           <div id="content-main-1">	 
             <div class="tab">
            		<table id="table3" border="1">
                    	<th>Tìm Kiếm</th> 
                    	<td><input type="text" name="search_text" id="search_text" placeholder="" class="form-control"/></td>
                    </table>
                    <div id="test1">
                        <table id="table1" border="1"> 
                            <tr>
                                <th>Chọn</th>
                                <th>Số CMND</th>
                                <th>Họ và Tên</th>
                            </tr>
                            <?php while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) { ?>
                                            <tr>
                                                <th><input type="checkbox" name="check-tab1" value="<?php echo $row['EmpID']?>" <?php if($row['EmpID']==$row_temp['EmpID']) echo 'checked="checked"' ?>  /></th>
                                                <td><?php echo $row['EmpID'] ?></td>
                                                <td><?php echo $row['VFirstName'] ?></td>
                                            </tr>
                            <?php } ?>
                            
                        </table>
                   </div>
            </div>
       </div>

      <div id="content-main-2">      
            <div class="tab">
                <div id="test2">
            <div class="tab">
                <div id="test2">
                	<!––----------------------//THÔNG TIN CÔNG NHÂN-------------------------––>
                	<!––--------------------------------------------------------------------––>
                    
                        <h2>THÔNG TIN CÔNG NHÂN</h2>
						<div id="FormRatio4">
                            <table class="table1">
                            <!--- begin html form; 
                            put action page in the "action" attribute of the form tag --->
                            <form action="insert_action.cfm" method="post">
                            <tr>
                              <th>Số CMND :</th>
                              <td><input type="text" name="Emp_ID" id="Emp_ID" size="16" maxlength="12" value="<?php echo $row_temp['EmpID'] ?>" ></td>
                            </tr>
                            </table>
                            <table class="table1">
                            <tr>
                              <th>Họ và Tên:</th>
                              <td><input type="Text" name="User_ID" size="40" maxlength="40" value="<?php echo $row_temp['VFirstName'] ?>" ></td>
                            </tr>
                            </table>
                            <table class="table1">
                            <tr>
                              <th>Địa Chỉ:</th>
                              <td><input type="Text" name="User_ID" size="64" maxlength="64" value="<?php echo $row_temp['P_Address'] ?>"></td>
                            </tr>
                            </table>
                            <table class="table1">
                                <tr>
                                  <th>Ngày Sinh</th>
                                  <td><input id="FromDate" type="date" name="FromDate" size="8" maxlength="8" value="<?php if ($row_temp['DOB'] != NULL)  echo $row_temp['DOB']->format('Y-m-d')?>"> </td>
                                  <th>Tháng/Năm Sinh</th>
                                  <td><input type="Text" name="User_ID" size="16" maxlength="16" value=""></td>
                                </tr>
                            </table>
                            <table class="table1">
                                <tr>
                                  <th>Ngày Cấp CMND</th>
                                  <td><input id="FromDate" type="date" name="FromDate" size="8" maxlength="8" value="<?php if ($row_temp['IDIssuedDate'] != NULL) echo  $row_temp['IDIssuedDate']->format('Y-m-d')?>"> </td>
                                  <th>Tháng/Năm Cấp CMND</th>
                                  <td><input type="Text" name="User_ID" size="16" maxlength="16" value=""></td>
                                </tr>
                            </table>
                            <table class="table1">
                            <tr>
                              <th>Nơi Cấp CMND</th>
                              <td><input type="text" name="Dept_ID" size="12" maxlength="20" value="<?php echo $row_temp['IDIssuedPlace'] ?>"></td>
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
                        <table class="table1">
                            <tr>
                              <th>Công Trường</th>
                              <td>
                                  <select>
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
                                  <select>
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
                              <td><input type="Text" name="User_ID" size="10" maxlength="10" value="<?php echo $row_2['ContractNo'] ?>" ></td>
                              <th>Đã Ký:</th>
                              <td><input type="Text" name="User_ID" size="4" maxlength="4" value="<?php echo $rownum_2_4 ?>" ></td>
                              <th>Hợp Đồng:</th>
                              <td><input type="Text" name="User_ID" size="4" maxlength="4" value="..." ></td>
                            </tr>
                       	</table>
                        <table class="table1">
                             <tr>
                                <th>Ngày bắt đầu</th>
                                <td><input id="FromDate" type="date" name="FromDate" size="8" maxlength="8" value="<?php if ($row_2['EffectiveDate'] != NULL)  echo $row_2['EffectiveDate']->format('Y-m-d')?>"> </td>
                                <th>Ngày kết thúc</th>
                                <td><input id="FromDate" type="date" name="FromDate" size="8" maxlength="8" value="<?php if ($row_2['ToDate'] != NULL)  echo $row_2['ToDate']->format('Y-m-d')?>"> </td>
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
                       <table class="table1">
                            <tr>
                              <th>Công Trường</th>
                              <td>
                                  <select>
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
                                  <select>
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
                                <td><input id="FromDate" type="date" name="FromDate" size="8" maxlength="8" value="<?php if ($row_2_5['StartDate'] != NULL)  echo $row_2_5['StartDate']->format('Y-m-d')?>"> </td>
                                <th>Năm Cam Kết:</th>
                                <td>
                                    <select id="YearTL">
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
                              <td><input type="Text" name="User_ID" size="10" maxlength="10" value="<?php echo $row_2_5['ComMoney'] ?>" ></td>
                              <th>Ghi Chú:</th>
                              <td><input type="Text" name="User_ID" size="10" maxlength="10" value="<?php echo $row_2_5['Note'] ?>" ></td>
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

                </div>  
            </div>
       </div> 
     </div>
   </div>      
    </body>
</html>