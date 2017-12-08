<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>

<script type="text/javascript" src="jquery.js"></script> 

<?php
	require "../lib/dbConMSSQL.php";
	require "../lib/dbCon.php";

	$Check_h = $_POST['Check_h'];
	$arrayFromPHP = $_POST['arrayFromPHP'];
	
	$output = "";
	if($Check_h > 0)
	{
		 $output .= '
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

		 ';
		 for ( $j = 7; $j < $Check_h; $j ++ ) {
		  $output .= '
		   <tr>
			<td><input type="checkbox" name="check-tab2" value='.$arrayFromPHP["CMND"][$j].'</td>
			<td>'.$arrayFromPHP['STT'][$j].'</td>
			<td>'.$arrayFromPHP['CMND'][$j].'</td>
			<td>'.$arrayFromPHP['fullname'][$j].'</td>
			<td><input type="text" name="Emp_Salary" size="9" maxlength="9" value='.$arrayFromPHP["salary"][$j].'></td>
			<td><input type="text" name="Emp_TT" size="12" maxlength="12" value='.$arrayFromPHP["ThueTT"][$j].'></td>
			<td><input type="text" name="Emp_TT" size="16" maxlength="12" value=""> </td>
		   </tr>
		  ';
		 }
			 $output .= '</table>';
		 echo $output;
	}
	else
	{
	 	echo 'Data Not Found';
	}

?>