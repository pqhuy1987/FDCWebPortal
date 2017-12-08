<?php
require "../lib/dbConMSSQL.php";
require "../lib/dbCon.php";

$TimeSheet = $_GET['TimeSheet'];

$tsql= "SELECT top 100 *
  FROM [HRISWORKERSPCC].[dbo].[HR_tblEmpCV] order by [HR_tblEmpCV].VFirstName ASC, [HR_tblEmpCV].CreateTime desc;";
$getResults= sqlsrv_query($conn_mssql, $tsql);

$tsql_2= "SELECT * FROM [HRISWORKERSPCC].[dbo].[PR_tblEmpSalary] where [PR_tblEmpSalary].TimeSheetID =  '$TimeSheet' ;";
$getResults_2= sqlsrv_query($conn_mssql, $tsql_2);

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

	 var TimeSheet = "<?php echo $TimeSheet?>";
	 var seq = [];
	 var EmpID = [];
	 var Salary = [];
	 var ThueTT = [];
	 var i = 0;
	 $('#SingleClick').click(function () {
		$('#table2 tr').each(function() {
			EmpID[i] 	= 	$(this).find("td").eq(2).html();  
			seq[i] 		= 	$(this).find("td").eq(1).html();  
			Salary[i] 	= 	$(this).find("td:eq(4) input[type='text']").val();  
			ThueTT[i] 	= 	$(this).find("td:eq(5) input[type='text']").val();       
			i++;
		 });
		 //console.log(TimeSheet);
		  $.ajax({
			   type:"POST",
			   url:"ajax-save-chitiet.php",
			   data:{EmpID:EmpID, i:i, seq:seq, Salary:Salary, ThueTT:ThueTT, TimeSheet:TimeSheet},
			   success:function(data)
			   {
				   location.reload();
					alert("Update Susccessfully");
			   }
		  });
    });
	
	 
	 $('#SingleClick_2').click(function () {
		 var Check_h = "<?php echo $h_temp ?>";	
		 var arrayFromPHP = <?php echo json_encode($data); ?>;
		 console.log(Check_h);
		 console.log(arrayFromPHP);
		  $.ajax({
			   type:"POST",
			   url:"ajax-save-chitiet-2.php",
			   data:{Check_h:Check_h, arrayFromPHP:arrayFromPHP},
			   success:function(data)
			   {
				    //location.reload();
					$('#test2').html(data);
			   }
		  });
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
			
			#content-main #content-main-1 {border-right:solid 1px #E2E2E3; width:30%; float:left; padding: 5px; max-height:600px; margin: 0 0 0 0px; overflow:auto }
			#content-main #content-main-2 {border-right:solid 1px #E2E2E3; width:50%; float:right; display: inline-block; padding: 5px; max-height:600px; margin: 0 0 0 0px; overflow:auto }
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
       <div id="content-main-3"> 
       <div class="tab"> 
            <div class="tab tab-btn">
                <button style=" width:80px" onclick="tab1_To_tab2();"> Thêm Vào </button>
                <button style=" width:80px" onclick="tab2_To_tab1();"> Bỏ ra </button>
            </div>
      </div>
      </div>
      <div id="content-main-2">      
            <div class="tab">
            	<div id="test2">
                    <table id="table2" border="1">
                        <tr>
                            <th>Chọn</th>
                            <th>STT</th>
                            <th>Số CMND</th>
                            <th>Họ và Tên</th>
                            <th>Số Tiền</th>
                            <th>Thuế Tạm</th>
                            <th>VuotCamKet</th>
                        <?php while ($row = sqlsrv_fetch_array($getResults_2, SQLSRV_FETCH_ASSOC)) { ?>
                                        <tr>
                                            <td><input type="checkbox" name="check-tab2" value="<?php echo $row['EmpID'] ?>"/></td>
                                            <td><?php echo $row['Seq'] ?></td>
                                            <td><?php echo $row['EmpID'] ?></td>
                                            <?php 
                                                $tsql_3= "SELECT * FROM [HRISWORKERSPCC].[dbo].[HR_tblEmpCV] where [HR_tblEmpCV].EmpID =  '$row[EmpID]' ;";
                                                $getResults_3= sqlsrv_query($conn_mssql, $tsql_3);
                                                $row_2 = sqlsrv_fetch_array($getResults_3, SQLSRV_FETCH_ASSOC);
                                             ?>
                                            <td><?php echo $row_2['VFirstName'] ?></td>
                                            <td><input type="text" name="Emp_Salary" size="9" maxlength="9" value='<?php echo "$row[Salary]"?>'> </td>
                                            <td><input type="text" name="Emp_TT" size="12" maxlength="12" value='<?php echo "$row[ThueTT]" ?>'> </td>
                                            <td><input type="text" name="Emp_TT" size="16" maxlength="12" value='0'> </td>
                                            
                                        </tr>
                        <?php } ?>
    
                        </tr>
                    </table>
            	</div>  
            </div>
       </div> 
       <div id="content-main-4"> 
       <div class="tab"> 
            <div class="tab tab-btn">
                <button style="margin-right: 10px; float:left; width:80px" id="SingleClick" > Lưu </button>
                <form method="post" enctype="multipart/form-data"> <input type="file" name="file"  onchange="this.form.submit()"> <input id="SingleClick_2" type="button" value="Parse" />  </form> 
            </div>
      </div>
      </div>
     </div>
   </div>      
        <script>
		
			//checkboxes_3 = document.getElementsByName("check-tab2");
			
            //var j = checkboxes_3.length + 1;
			
            function tab1_To_tab2()
            {
				checkboxes_3 = document.getElementsByName("check-tab2");
            	var j = checkboxes_3.length + 1;
				
                var table1 = document.getElementById("table1"),
                    table2 = document.getElementById("table2"),
                    checkboxes = document.getElementsByName("check-tab1");
					checkboxes_2 = document.getElementsByName("check-tab2");
            		console.log("Val_1_to_2 = " + checkboxes.length);
					
                 for(var i = 0; i < checkboxes.length; i++){
                     if(checkboxes[i].checked)
                        {
                            // create new row and cells
                            var newRow = table2.insertRow(table2.length),
                                cell1 = newRow.insertCell(0),
                                cell2 = newRow.insertCell(1),
                                cell3 = newRow.insertCell(2),
                                cell4 = newRow.insertCell(3);
								cell5 = newRow.insertCell(4);
								cell6 = newRow.insertCell(5);
								cell7 = newRow.insertCell(6);
                            // add values to the cells
                            cell1.innerHTML = "<input type='checkbox' name='check-tab2'>";
							if (j <= checkboxes_2.length){ 
								cell2.innerHTML = j;
								j++;
							}
							console.log(i);
                            cell3.innerHTML = table1.rows[i+1].cells[1].innerHTML;
							
                            cell4.innerHTML = table1.rows[i+1].cells[2].innerHTML;
							cell5.innerHTML = '<input type="text" name="Emp_Salary" size="9" maxlength="9" value="0">'
							cell6.innerHTML = '<input type="text" name="Emp_TT" size="12" maxlength="9" value="0">'
							cell7.innerHTML = '<input type="text" name="Emp_TT" size="16" maxlength="12" value="0">'
                           
                            // remove the transfered rows from the first table [table1]
                            var index = table1.rows[i+1].rowIndex;
                            table1.deleteRow(index);
                            // we have deleted some rows so the checkboxes.length have changed
                            // so we have to decrement the value of i
                            i--;
                           console.log(checkboxes.length);
                        }
				 }
            }
            
            function tab2_To_tab1()
            {
				checkboxes_3 = document.getElementsByName("check-tab2");
            	var j = checkboxes_3.length + 1;
				
                var table1 = document.getElementById("table1"),
                    table2 = document.getElementById("table2"),
                    checkboxes = document.getElementsByName("check-tab2");
            		console.log("Val_2_to_1 = " + checkboxes.length);
                 for(var i = 0; i < checkboxes.length; i++){
                     if(checkboxes[i].checked)
                        {
                            // create new row and cells
                            var newRow = table1.insertRow(table1.length),
                                cell1 = newRow.insertCell(0),
                                cell2 = newRow.insertCell(1),
                                cell3 = newRow.insertCell(2);
                            // add values to the cells
                            cell1.innerHTML = "<input type='checkbox' name='check-tab1'>";
                            cell2.innerHTML = table2.rows[i+1].cells[2].innerHTML;
                            cell3.innerHTML = table2.rows[i+1].cells[3].innerHTML;
                           
                            // remove the transfered rows from the second table [table2]
                            var index = table2.rows[i+1].rowIndex;
                            table2.deleteRow(index);
                            // we have deleted some rows so the checkboxes.length have changed
                            // so we have to decrement the value of i
                            i--;
							j--;
                           console.log(checkboxes.length);
                        }
				 }
				 
				 for(var k = 1; k <= j; k++){
					table2.rows[k].cells[1].innerHTML = k; 
				 }
            }
        </script>    
    </body>
</html>