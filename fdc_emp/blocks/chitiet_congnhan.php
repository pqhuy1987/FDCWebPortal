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

<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>

<script type="text/javascript" src="jquery.js"></script> 

<script>
$(document).ready(function(){

	 function load_data(query)
	 {
		  $.ajax({
			   type:"POST",
			   url:"fetch.php",
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
	 
});


	 
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
			
			#content-main #content-main-1 {border-right:solid 1px #E2E2E3; width:35%; float:left; padding: 5px; max-height:600px; margin: 0 0 0 0px; overflow:auto }
			#content-main #content-main-2 {border-right:solid 1px #E2E2E3; width:60%; float:right; display: inline-block; padding: 5px; max-height:600px; margin: 0 0 0 0px; overflow:auto }
			#content-main #content-main-3 {border-right:solid 1px #E2E2E3; width:17%; float:left; padding: 5px; max-height:600px; margin: 0 0 0 0px; overflow:auto }
			#content-main #content-main-4 {border-right:solid 1px #E2E2E3; width:50%; float:right; padding: 5px; max-height:600px; margin: 0 0 0 0px; overflow:auto }
            
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
                                                <td><input type="checkbox" name="check-tab1" value="<?php echo $row['EmpID'] ?>" /></td>
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
                    <h2>Thông Tin Bảng Chấm Công</h2>
                    
                        <table class="table1">
                        <!--- begin html form; 
                        put action page in the "action" attribute of the form tag --->
                        <form action="insert_action.cfm" method="post">
                        <tr>
                          <th>Mã Bảng C.Công :</th>
                          <td><input type="text" name="Emp_ID" size="40" maxlength="40" value=""></td>
                          <th>Người Dùng:</th>
                          <td><input type="Text" name="User_ID" size="4" maxlength="8" value="<?php echo $_SESSION['nameuser'] ?>"></td>
                        </tr>
                        </table>
                        <table class="table1">
                        <tr>
                          <th>Công Trường</th>
                          <td>
                              <select id="LSCompanyID">
                              <option value="" >----Chọn Tên Công Trường----</option>
                              <?php while ($row = sqlsrv_fetch_array($getResults_2, SQLSRV_FETCH_ASSOC)) { ?>
                                    <option value="<?php echo $row['LSCompanyID'] ?>" ><?php echo $row['LSCompanyID']; echo ' : '; echo $row['Name'];?></option>
                              <?php } ?>
                              </select>
                              
                          </td>
                        </tr>
                        </table>
                       <table class="table1">
                        <tr>
                          <th>Đội Quản Lý</th>
                          <td>
                              <select id="LSLevel1ID">
                              <option value="" >----Chọn Tên Đội Quản Lý----</option>
                              <?php while ($row = sqlsrv_fetch_array($getResults_3, SQLSRV_FETCH_ASSOC)) { ?>
                                    <option value="<?php echo $row['LSLevel1ID'] ?>"  ><?php echo $row['LSLevel1ID']; echo ' : '; echo $row['Name'];?></option>
                              <?php } ?>
                              </select>
                              
                          </td>
                        </tr>
                        </table>
                        <table class="table1">
                        <tr>
                          <th>Từ Ngày:</th>
                          <td><input id="FromDate" type="date" name="FromDate" size="8" maxlength="8" value=""> </td>
                          <th>Đến Ngày:</th>
                          <td><input id="Todate" type="date" name="Dept_ID" size="8" maxlength="8" value=""></td>
                        </tr>
                         </table>
                        <table class="table1">
                        <tr>
                          <th>Tháng Nhập Liệu</th>
                          <td>
                              <select id="MonthNL" >
                                   <option value=""  >--Chọn Tháng--</option>
                                   <option value="1"  >Tháng 01</option>
                                   <option value="2"  >Tháng 02</option>
                                   <option value="3"  >Tháng 03</option>
                                   <option value="4"  >Tháng 04</option>
                                   <option value="5"  >Tháng 05</option>
                                   <option value="6"  >Tháng 06</option>
                                   <option value="7"  >Tháng 07</option>
                                   <option value="8"  >Tháng 08</option>
                                   <option value="9"  >Tháng 09</option>
                                   <option value="10" >Tháng 10</option>
                                   <option value="11" >Tháng 11</option>
                                   <option value="12" >Tháng 12</option>
                              </select>
                          </td>
                          <th>Năm</th>
                          <td>
                              <select id="YearNL">
                                   <option value="" >--Chọn Năm--</option>
                                   <option value="2015" >Năm 2015</option>
                                   <option value="2016" >Năm 2016</option>
                                   <option value="2017" >Năm 2017</option>
                                   <option value="2018" >Năm 2018</option>
                                   <option value="2019" >Năm 2019</option>
                                   <option value="2020" >Năm 2020</option>
                              </select>
                          </td>
                        </tr>
                        <tr>
                          <th>Tháng T.Lương</th>
                          <td>
                              <select id="MonthTL">
                                   <option value=""  >--Chọn Tháng--</option>
                                   <option value="1"  >Tháng 01</option>
                                   <option value="2"  >Tháng 02</option>
                                   <option value="3"  >Tháng 03</option>
                                   <option value="4"  >Tháng 04</option>
                                   <option value="5"  >Tháng 05</option>
                                   <option value="6"  >Tháng 06</option>
                                   <option value="7"  >Tháng 07</option>
                                   <option value="8"  >Tháng 08</option>
                                   <option value="9"  >Tháng 09</option>
                                   <option value="10" >Tháng 10</option>
                                   <option value="11" >Tháng 11</option>
                                   <option value="12" >Tháng 12</option>
                              </select>
                          </td>
                          <th>Năm</th>
                          <td>
                              <select id="YearTL">
                                   <option value="" >--Chọn Năm--</option>
                                   <option value="2015" >Năm 2015</option>
                                   <option value="2016" >Năm 2016</option>
                                   <option value="2017" >Năm 2017</option>
                                   <option value="2018" >Năm 2018</option>
                                   <option value="2019" >Năm 2019</option>
                                   <option value="2020" >Năm 2020</option>
                              </select>
                          </td>
                        </tr>
                        <tr>
                          <th>Số Phiếu Kế Tóan</th>
                          <td><input type="text" name="Dept_ID" size="12" maxlength="8"></td>
                        </tr>
                        </table>
                        <table class="table1">
                        <tr>
                          <td> <button type="button" style=" width:125px" onClick="submit_change()">Tạo Mới </button> </td>
                          <td> <button type="button" style=" width:125px" onClick="alert('Hello world!')">Thoát</button> </td>
                        </tr>
                    
                        <!--- end html form --->
                        </table>
                        </form>

                </div>  
            </div>
       </div> 
     </div>
   </div>      
    </body>
</html>