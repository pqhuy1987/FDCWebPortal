<?php
error_reporting(0);
include "authheader.php";
if($block != true)
{
require_once "auth/config.php";

include "heade.php" ;
?>

<script type="text/javascript">
 var chk_id='';

 $(document).ready(function(){
     $('#m9').html("<span class='curr_mnu'>Kết Quả Kiểm Tra</span>");   
	
	function showLoader(){
	
		$('.search-background').fadeIn(200);
	}
	
	function hideLoader(){
	
		$('.search-background').fadeOut(200);
	};
	
	$("#paging_button li").click(function(){
		
		showLoader();
		
		$("#paging_button li").css({'background-color' : ''});
		$(this).css({'background-color' : '#006699'});

		$("#content").load("ajx-quiz-res.php?page=" + this.id, hideLoader);
		
		return false;
	});
	
	$("#1").css({'background-color' : '#006699'});
	showLoader();
	$("#content").load("ajx-quiz-res.php?page=0", hideLoader);
	
});

function changestatus(statuss,idd)
{
	if (statuss=="edit") {
	 	 $('#catname_'+idd).removeAttr('readonly');
	 	 $('#catstatus_'+idd).removeAttr('disabled');
	}
	else
	{
		 $catname=$('#catname_'+idd).val();
		 $catstatus=$('#catstatus_'+idd).val();
		 doIt=confirm('Are you Sure want to '+statuss+' this?');
	{	if(doIt)

				 $.ajax({//Make the Ajax Request
						type: "POST",
						url: "./ajx-quiz-results-status.php",
						data:{catname: $catname,catstatus: $catstatus,status:statuss,id:idd},
						success: function(data){
						alert(data)
						window.location.reload();
						}
					});
	 }
	}
}

</script>



 
  	
<?php

$per_page = 1000;  //Display Images or Content
$count=mysqli_query($connect_2,"select count(*) from quizresults");
while ($row2 = mysqli_fetch_row($count)) 
{
   $total=$row2[0];
}

 
$pages = ceil($total/$per_page);

?>
		<h1>Kết Quả Kiểm Tra</h1>
<div class="search-background" style='margin-left:250px;'>
			<label><img src="./images/load.gif" alt="" /></label>
		</div>
		<div id="content">
		 <?php
		   if($total==0)
		    echo "<font color='red'><b>No Results.....</b></font>";
		 ?>
		&nbsp;
		</div>
<div id="paging_button" style="margin: 0 auto;" align='center'>

		<ul>
		<?php
			//echo '<li id=1>First</li>';
			if($pages>1)
			{
		for($i=1; $i<=$pages; $i++)
		{
		 $jk=$i-1;
			echo '<li id="'.$jk.'">'.$i.'</li>';
		}
		//echo '<li id="'.$pages.'">Last</li>';
          }
    ?>
		</ul>
	</div>
  <?php
  }
  ?>