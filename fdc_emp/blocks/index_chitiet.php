<?php
require "../lib/dbConMSSQL.php";
require "../lib/dbCon.php";

$tsql= "SELECT top 100 *
  FROM [HRISWORKERSPCC].[dbo].[HR_tblEmpCV] order by [HR_tblEmpCV].VFirstName ASC, [HR_tblEmpCV].CreateTime desc;";
$getResults= sqlsrv_query($conn_mssql, $tsql);

?>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>

<script type="text/javascript" src="jquery.js"></script> 

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
            
        </style>    
    <body>
     <div id="content-main">    
        <div class="container">
           <div id="content-main-1">	 
            <div class="tab">
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
                <table id="table2" border="1">
                    <tr>
                        <th>Chọn</th>
                        <th>STT</th>
                        <th>Số CMND</th>
                        <th>Họ và Tên</th>
                        <th>Số Tiền</th>
                        <th>Thuế Tạm</th>
                        <th>VuotCamKet</th>

                    </tr>
                </table>   
            </div>
       </div> 
     </div>
   </div> 
        
        <script>
            var j = 1;
            function tab1_To_tab2()
            {
                var table1 = document.getElementById("table1"),
                    table2 = document.getElementById("table2"),
                    checkboxes = document.getElementsByName("check-tab1");
					checkboxes_2 = document.getElementsByName("check-tab2");
            		console.log("Val1 = " + checkboxes.length);
					
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
                            cell3.innerHTML = table1.rows[i+1].cells[1].innerHTML;
							

							
                            cell4.innerHTML = table1.rows[i+1].cells[2].innerHTML;
							cell5.innerHTML = '<input type="text" name="Emp_Salary" size="9" maxlength="9" value="0">'
							cell6.innerHTML = '<input type="text" name="Emp_TT" size="12" maxlength="9" value="0">'
							cell7.innerHTML = '<input type="text" name="Emp_TT" size="12" maxlength="9" value="0">'

                           
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
                var table1 = document.getElementById("table1"),
                    table2 = document.getElementById("table2"),
                    checkboxes = document.getElementsByName("check-tab2");
            console.log("Val1 = " + checkboxes.length);
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