<?php
require "lib/dbCon.php";
require "lib/dbConMSSQL.php";
?>

<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>

<script type="text/javascript" src="./jquery.js"></script>
<script type='text/javascript'>
$(document).ready(function(){
	var TimeSheet;
	$('input[type="checkbox"]').on('change', function() {
	   $('input[type="checkbox"]').not(this).prop('checked', false);
	   	var checked = $(this).val();
	   		   $.ajax({//Make the Ajax Request
						type: 'POST',
						url: './blocks/ajax-listbangluongcongnhan.php',
						data: { TimeSheet: checked},
						success: function(data){
							$('#content-file').html(data);
						}
					});
	   		   $.ajax({//Make the Ajax Request
						type: 'POST',
						url: './blocks/ajax-thongtinbangchamcong.php',
						data: { TimeSheet: checked},
						success: function(data){
							$('#content-main-2').html(data);
						}
					});
	   		   $.ajax({//Make the Ajax Request
						type: 'POST',
						url: './blocks/ajax-bangdieukhien.php',
						data: { TimeSheet: checked},
						success: function(data){
							$('#content-right-general').html(data);
						}
					});
	});
	
});
</script>
<?php


if (!isset($_SESSION['ldap_dn']))
{
    header('Location: login/login.php');
    exit();
}


if (isset($_GET["p"]))
    $p = $_GET["p"];
else
    $p = "";
	
$tsql= "SELECT top 100 *
  FROM [HRISWORKERSPCC].[dbo].[PR_tblTimeSheet] order by [PR_tblTimeSheet].FromDate desc, [PR_tblTimeSheet].TimeSheetID desc, [PR_tblTimeSheet].Todate desc;";
$getResults= sqlsrv_query($conn_mssql, $tsql);
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <title>Fixed Headers</title>
    <link type="text/css" href="blocks/Style.css" rel="stylesheet" />
    <script type="text/javascript" src="blocks/Script.js"></script>
</head>
<body>


	<h1>Đội Thi Công</h1>
    <div id="response"></div>
	<div id="outerDiv">
		<div id="innerDiv">
			<table class="table2">
				<tr >
					<th width="50px" ></th>
					<th>Công Trường</th>
					<th>Đội</th>
					<th>Từ Ngày</th>
					<th>Đến Ngày</th>
					<th>Người Dùng</th>
				</tr>
<?php while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) { ?>
				<tr>
					<th><input type="checkbox" class="radio" value="<?php echo $row['TimeSheetID'] ?>" /></th>
					<td><?php echo $row['LSCompanyID'] ?></td>
					<td><?php echo $row['LSLevel1ID'] ?></td>
					<td><?php echo $row['FromDate']->format('d/m/Y') ?></td>
					<td><?php echo $row['Todate']->format('d/m/Y') ?></td>
					<td><?php echo $row['UserID'] ?></td>
				</tr>
<?php } ?>
			</table>
		</div>
	</div>
</body>
</html>
<script language="javascript">
	CreateScrollHeader(document.getElementById("innerDiv"), true, true);
</script>
