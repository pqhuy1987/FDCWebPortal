<?php
require "../lib/dbConMSSQL.php";
require "../lib/dbCon.php";

$tsql= "SELECT top 100 *
  FROM [HRISWORKERSPCC].[dbo].[HR_tblEmpCV] order by [HR_tblEmpCV].VFirstName ASC, [HR_tblEmpCV].CreateTime desc;";
$getResults= sqlsrv_query($conn_mssql, $tsql);

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
                                                <th><input type="checkbox" name="check-tab1" value="<?php echo $row['EmpID'] ?>" /></th>
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
                    
                    
                	<!––----------------------//THÔNG TIN HỢP ĐỒNG--------------------------––>
                	<!––--------------------------------------------------------------------––>
                    <h2>Thông Tin Hợp Đồng</h2>
                    
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
                    
                	<!––----------------------//THÔNG TIN BẢNG CAM KẾT------------------------>
                	<!––--------------------------------------------------------------------––>

                    <h2>Thông Tin Bảng Cam Kết</h2>
                    
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

                	<!––----------------------//THÔNG TIN BẢNG CAM KẾT------------------------>
                	<!––--------------------------------------------------------------------––>

                    <h2>Mã Số Thuế Và Người Phụ Thuộc</h2>
                    
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
       </div> 
     </div>
   </div>      
    </body>
</html>