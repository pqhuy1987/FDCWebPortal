
<html>
		     <head>
					  <title>FDC Hệ Thống Trắc Nghiệm</title>
		     </head>
</html>

<?php
require "../lib/dbCon.php";
require "../lib/trangchu.php";

error_reporting(0);
session_start();

if (!isset($_SESSION['ldap_dn']))
{
    header('Location: ../login/login.php');
    exit();
}

if($hm=="")
 	$hm=".";
if($hm2=="") 
 	$hm2=".";
require_once "$hm/admin/auth/config.php";
if(($hostname == "" || $dbname == "" || $username == "") )
{
  	echo "<div align='center' style='margin-top:20%;color:red;'><b>Installation process is not completed.kindly follow the read me file instruction.</b></div>";
}
else
{
	$connect_2 = mysqli_connect("$hostname","$username","$password");
	if($connect_2)
	{
		$dbcon = mysqli_select_db($connect_2, "$dbname");
	}
	$quiz_staus=0;
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	if(isset($_GET['logout']))
	{
		$_SESSION['catid']="";
		$_SESSION['uname']="";
		session_destroy();
		$bname= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
		echo "<script type='text/javascript'>window.location.href='./$bname';</script>";
		header('Location: index.php');
	}
  
	if((isset($_SESSION['catid']))||(isset($_POST['catid']) && isset($_POST['uname'])&& isset($_POST['uemail'])))
	{
		if($_SESSION['catid']==""){
		   $_SESSION['catid']=$_POST['catid'];
		   $_SESSION['catid_2']=$_POST['catid_2'];
		   $_SESSION['catid_3']=$_POST['catid_3'];
		   $_SESSION['catid_4']=$_POST['catid_4'];
		}
		if($_SESSION['uname']=="")   
		   $_SESSION['uname']=$_POST['uname'];
		if($_SESSION['uemail']=="")   
		   $_SESSION['uemail']=$_POST['uemail'];

		$catid	=	$_SESSION['catid'];
		$catid_2	=	$_SESSION['catid_2'];
		$catid_3	=	$_SESSION['catid_3'];
		$catid_4	=	$_SESSION['catid_4'];
		$uname 	=	$_SESSION['uname'];
		$email 	=	$_SESSION['uemail'];
		$settings_query = mysqli_query($connect_2,"SELECT * FROM settings WHERE id=$catid");
		$settings_row = mysqli_fetch_assoc($settings_query);
		$limit=$settings_row['pagenum'];
		$length=$settings_row['length'];
		$limit_num = round($limit/$length);
		$time = $settings_row['examtime'];
		
		if (!isset($_SESSION['FirstVisit']))
		{
    		$_SESSION['FirstVisit'] = 1;
    	} else {
			$_SESSION['FirstVisit'] = 2;
		}	

		$sql = "SELECT id FROM quizresults WHERE email='$email' and cat_id='$catid'";
		$result = mysqli_query($connect_2,$sql);
		
		if(mysqli_num_rows($result) >0)
		{
			echo "<script type='text/javascript'> alert(1); </script>";
		   	session_destroy();
		   	$bname= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
		 	echo "<script type='text/javascript'>window.location.href='./$bname';</script>";
			header('Location: index.php');
		}else{
		   $quiz_staus = 1;
		}
	} 
	else
	{
	    $uname="<b>     HỆ THỐNG ĐÁNH GIÁ GIÁM SÁT     </b>";		      
	}
?>
    <div class="top_2">
        <!-- top_con begins -->
        <div class="top_con_2">
            <div class="top_con_ul_pos1_2"> 
            	<h1>
                	<span style="color:#135194;"></span><span style="color:#ec2229;"></span><span style="color:#135194;"></span>
                </h1>            
            </div>
            <div class="top_con_ul_pos2_2">
            	 
    		</div>
         </div>
          <!-- top_con ends -->
	</div>
    <div class="top">
        <!-- top_con begins -->
        <div class="top_con">
            <ul class="top_con_ul_pos1">                    
                <li><span class="admin_name"><?php echo $uname;?></span></li>
            </ul>
    <?php
    if($quiz_staus==1)
    {
    ?>
            <ul class="top_con_ul_pos2">
              <li id='timee'><div id="hms"><?php echo $time;?></div></li>
                 <li><a href="<?php echo $actual_link;?>?logout=yes">Exit</a></li>
      <?php
    }
      ?>
    		</ul>
         </div>
          <!-- top_con ends -->
	</div>
<?php
 	echo "<div id='maindiv' class='frms clearfix'>";
   	if($quiz_staus==1)
    {
 		echo "<div id='res_id' class='clearfix'><div class='clearfix'>";

		$limit_tag="<br>";
		$setting_temp = mysqli_query($connect_2,"SELECT * FROM settings WHERE id=$catid" );
		$row_setting_temp = mysqli_fetch_array($setting_temp);
		
		$chuyende[1] 	= 	$row_setting_temp['chuyende_1'];
		$chuyende[2] 	= 	$row_setting_temp['chuyende_2'];
		$chuyende[3] 	= 	$row_setting_temp['chuyende_3'];
		$chuyende[4] 	= 	$row_setting_temp['chuyende_4'];
		$chuyende[5] 	= 	$row_setting_temp['chuyende_5'];
		$chuyende[6] 	= 	$row_setting_temp['chuyende_6'];
		$chuyende[7] 	= 	$row_setting_temp['chuyende_7'];
		$chuyende[8] 	= 	$row_setting_temp['chuyende_8'];
		$chuyende[9] 	= 	$row_setting_temp['chuyende_9'];
		$chuyende[10] 	= 	$row_setting_temp['chuyende_10'];
		
		$chuyende[11] 	= 	$row_setting_temp['chuyende_11'];
		$chuyende[12] 	= 	$row_setting_temp['chuyende_12'];
		$chuyende[13] 	= 	$row_setting_temp['chuyende_13'];
		$chuyende[14] 	= 	$row_setting_temp['chuyende_14'];
		$chuyende[15] 	= 	$row_setting_temp['chuyende_15'];
		$chuyende[16] 	= 	$row_setting_temp['chuyende_16'];
		$chuyende[17] 	= 	$row_setting_temp['chuyende_17'];
		$chuyende[18] 	= 	$row_setting_temp['chuyende_18'];
		$chuyende[19] 	= 	$row_setting_temp['chuyende_19'];
		$chuyende[20] 	= 	$row_setting_temp['chuyende_20'];
		
		$chuyende[21] 	= 	$row_setting_temp['chuyende_21'];
		$chuyende[22] 	= 	$row_setting_temp['chuyende_22'];
		$chuyende[23] 	= 	$row_setting_temp['chuyende_23'];
		$chuyende[24] 	= 	$row_setting_temp['chuyende_24'];
		$chuyende[25] 	= 	$row_setting_temp['chuyende_25'];
		$chuyende[26] 	= 	$row_setting_temp['chuyende_26'];
		$chuyende[27] 	= 	$row_setting_temp['chuyende_27'];
		$chuyende[28] 	= 	$row_setting_temp['chuyende_28'];
		$chuyende[29] 	= 	$row_setting_temp['chuyende_29'];
		$chuyende[30] 	= 	$row_setting_temp['chuyende_30'];
																				
    	echo "<input type='button' value='Previous' style='float:left;display:none;' id='top_prev' onclick=prevnext(0)>";
   
   		echo "<input type='button' value='Hoàn Thành' style='float:right;' id='top_next' onclick=results()>";
    
 		echo "</div><div class='clear'></div>";   
 		$lt=1;$pn=0;
		$lt2=1;
		$pcount=0;
		
		for ($i = 1; $i < 31; $i++)
		{
			$temp = $chuyende[$i];
			if ($temp != 0)
			{
				$category_sub_temp = mysqli_query($connect_2,"SELECT * FROM category_sub WHERE id_sub=$temp" );
				$row_category_sub_temp = mysqli_fetch_array($category_sub_temp); 
 				
				echo "<div class='sub_title'> Phần $lt2: $row_category_sub_temp[name_sub] </div>";
				$temp_category_sub = $row_category_sub_temp["name_sub"];
				
				if ($row_setting_temp['filter'] == 1) {
					$query = mysqli_query($connect_2,"SELECT * FROM quiz WHERE status='release' and id_sub=$temp order by id asc limit $limit_num " );
				} else if($row_setting_temp['filter'] == 2) {
					$query = mysqli_query($connect_2,"SELECT * FROM quiz WHERE status='release' and id_sub=$temp order by id desc limit $limit_num " );
				} else {
					if ($limit_num <=2){
						$limit_num_temp = ceil($limit_num/2);
						$query = mysqli_query($connect_2,"(SELECT * FROM quiz WHERE status='release' and id_sub=$temp and dokho=1 order by RAND() limit $limit_num_temp) union (SELECT * FROM quiz WHERE status='release' and id_sub=$temp and dokho=2 order by RAND() limit $limit_num_temp)" );							
					} else {
						$limit_num_temp = ceil($limit_num/3);
						$query = mysqli_query($connect_2,"(SELECT * FROM quiz WHERE status='release' and id_sub=$temp and dokho=1 order by RAND() limit $limit_num_temp) union (SELECT * FROM quiz WHERE status='release' and id_sub=$temp and dokho=2 order by RAND() limit $limit_num_temp) union (SELECT * FROM quiz WHERE status='release' and id_sub=$temp and (dokho=3 or dokho=4) order by RAND() limit $limit_num_temp)" );						
					}
				}
				$pcount = $pcount + mysqli_num_rows($query);
				$pages = ceil($pcount/$limit);
				while($row = mysqli_fetch_array($query))
				{
					$id = $row['id'];
					$qns = $row['question'];
					$ans = $row['answer'];
					$opt1 = $row['opt1'];
					$opt2 = $row['opt2'];
					$opt3 = $row['opt3'];
					$opt4 = $row['opt4'];
					$dokho = $row['dokho'];
			
					//if($lt>$limit)
					//  $disp="style='display:none;'";
					//else
					//  $disp="";
					 
					echo "<div class='news_poling disp_$pn'  $disp >";
					echo "<input type='hidden' id='ans_$id' value='$ans'>";
					if ($dokho == 1) {
						echo "<div class='news_poling_top'><b>Câu $lt </b>: $qns </div>";
					} else if ($dokho == 2) {
						echo "<div class='news_poling_top'><b>Câu $lt </b>: $qns </div>";
					} else if ($dokho == 3) {
						echo "<div class='news_poling_top'><b>Câu $lt </b>: $qns </div>";
					} else if ($dokho == 4) {
						echo "<div class='news_poling_top'><b>Câu $lt </b>: $qns </div>";
					}
					echo "<div class='news_poling_sele-ct'><form id='polingForm' method='post' action='survey-script/polling-result.php'>";
					echo "<div>
						  <input type='hidden' value='151' name='Qid'>
						  <fieldset class='radios' id='$id'>
						  <input type='radio' value='opt1' name='options_$id'  onclick=chkans(1,$id,$lt2,$temp) >$opt1 $limit_tag
						  <input type='radio' value='opt2' name='options_$id' onclick=chkans(2,$id,$lt2,$temp) >$opt2 $limit_tag";
					if($opt3!='')
					{
						echo "<input type='radio' value='opt3' name='options_$id' onclick=chkans(3,$id,$lt2,$temp)>$opt3 $limit_tag ";
					}
					if($opt4!='')
					{
						echo "<input type='radio' value='opt4' name='options_$id' onclick=chkans(4,$id,$lt2,$temp)>$opt4 $limit_tag ";
					}
								
					 echo "</fieldset>
							</div>";
					 echo "</div>";           
					 echo "</div>";
				  
					//if($lt%$limit==0)
						//$pn++;
					$lt++;       
				 }
				 $lt2++;
			}
		}

   		echo "<input type='button' value='Get Results' onclick=results() id='res_btn' style='display:none;'>";
     	echo "<input type='button' value='Previous' style='float:left;display:none;' id='prev' onclick=prevnext(0)>";
    	echo "<input type='button' value='Hoàn Thành' style='float:right;' id='next' onclick=results()>";
     	echo "</div><div id='results' align='center' style='display:none;'>
				  <div class='result' >
					  <div class='row'>
							<div class='column'><b>Bạn đã hoàn thành bài kiểm tra đánh giá giám sát: </b></div>
					  <div class='column'>$pcount câu</div>
				  </div>
				  </div><div class='clear'></div>
				  <div class='btn_style'><a href='$hm2/index.php?logout=yes'>Exit.</a></div></div>
     		 ";  
  ?>
 
<script type="text/javascript" src="<?php echo $hm2;?>/admin/jquery.js"></script>
<script type="text/javascript">
		     var cresult1=0;
		     var wresult1=0;
			 var tenchuyende1=0;
			 
			 var cresult2=0;
		     var wresult2=0;
			 var tenchuyende2=0;
			 
			 var cresult3=0;
		     var wresult3=0;
			 var tenchuyende3=0;
			 
			 var cresult4=0;
		     var wresult4=0;
			 var tenchuyende4=0;
			 
			 var cresult5=0;
		     var wresult5=0;
			 var tenchuyende5=0;
			 
			 var cresult6=0;
		     var wresult6=0;
			 var tenchuyende6=0;
			 
			 var cresult7=0;
		     var wresult7=0;
			 var tenchuyende7=0;
			 
			 var cresult8=0;
		     var wresult8=0;
			 var tenchuyende8=0;
			 
			 var cresult9=0;
		     var wresult9=0;
			 var tenchuyende9=0;
			 
			 var cresult10=0;
		     var wresult10=0;
			 var tenchuyende10=0;
			 
			 var cresult11=0;
		     var wresult11=0;
			 var tenchuyende11=0;
			 
			 var cresult12=0;
		     var wresult12=0;
			 var tenchuyende12=0;
			 
			 var cresult13=0;
		     var wresult13=0;
			 var tenchuyende13=0;
			 
			 var cresult14=0;
		     var wresult14=0;
			 var tenchuyende14=0;
			 
			 var cresult15=0;
		     var wresult15=0;
			 var tenchuyende15=0;
			 
			 var cresult16=0;
		     var wresult16=0;
			 var tenchuyende16=0;
			 
			 var cresult17=0;
		     var wresult17=0;
			 var tenchuyende17=0;
			 
			 var cresult18=0;
		     var wresult18=0;
			 var tenchuyende18=0;
			 
			 var cresult19=0;
		     var wresult19=0;
			 var tenchuyende19=0;
			 
			 var cresult20=0;
		     var wresult20=0;
			 var tenchuyende20=0;
			 
			 var cresult21=0;
		     var wresult21=0;
			 var tenchuyende21=0;
			 
			 var cresult22=0;
		     var wresult22=0;
			 var tenchuyende22=0;
			 
			 var cresult23=0;
		     var wresult23=0;
			 var tenchuyende23=0;
			 
			 var cresult24=0;
		     var wresult24=0;
			 var tenchuyende24=0;
			 
			 var cresult25=0;
		     var wresult25=0;
			 var tenchuyende25=0;
			 
			 var cresult26=0;
		     var wresult26=0;
			 var tenchuyende26=0;
			 
			 var cresult27=0;
		     var wresult27=0;
			 var tenchuyende27=0;
			 
			 var cresult28=0;
		     var wresult28=0;
			 var tenchuyende28=0;
			 
			 var cresult29=0;
		     var wresult29=0;
			 var tenchuyende29=0;
			 
			 var cresult30=0;
		     var wresult30=0;
			 var tenchuyende30=0;
			 
			 var $pcount_check = 0;			 
		     var currpage=0;
		     var time_out;
		     var prev=0;
		     var cstatus=0;
			 var email="<?php echo $email;?>";
			 var uname="<?php echo $uname;?>";
			 var cat_id="<?php echo $catid;?>";
			 var cat_id_2="<?php echo $catid_2;?>";
			 var cat_id_3="<?php echo $catid_3;?>";
			 var cat_id_4="<?php echo $catid_4;?>";
		     var total_pages="<?php echo $pages;?>";
			 var hm="<?php echo $hm;?>";
			 var hm2="<?php echo $hm2;?>";
		     total_pages=total_pages-1;
		     var total_ques = "<?php echo $pcount;?>";
			 
 function chkans(opt,ansid,chuyende,tenchuyende)
 {
	 $pcount_check = $pcount_check + 1;
	 if (chuyende == 1 )
	 {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende1=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult1=parseInt(cresult1)+1;
		 }
		 else
		 {
			  wresult1=parseInt(wresult1)+1;     
		 }
	 } else if (chuyende == 2 ) {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende2=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult2=parseInt(cresult2)+1;
		 }
		 else
		 {
			  wresult2=parseInt(wresult2)+1;     
		 }		 
	 } else if (chuyende == 3 ) {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende3=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult3=parseInt(cresult3)+1;
		 }
		 else
		 {
			  wresult3=parseInt(wresult3)+1;     
		 }		 
	 } else if (chuyende == 4 ) {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende4=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult4=parseInt(cresult4)+1;
		 }
		 else
		 {
			  wresult4=parseInt(wresult4)+1;     
		 }		 
	 } else if (chuyende == 5 ) {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende5=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult5=parseInt(cresult5)+1;
		 }
		 else
		 {
			  wresult5=parseInt(wresult5)+1;     
		 }		 
	 } else if (chuyende == 6 ) {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende6=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult6=parseInt(cresult6)+1;
		 }
		 else
		 {
			  wresult6=parseInt(wresult6)+1;     
		 }		 
	 } else if (chuyende == 7 ) {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende7=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult7=parseInt(cresult7)+1;
		 }
		 else
		 {
			  wresult7=parseInt(wresult7)+1;     
		 }		 
	 } else if (chuyende == 8 ) {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende8=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult8=parseInt(cresult8)+1;
		 }
		 else
		 {
			  wresult8=parseInt(wresult8)+1;     
		 }		 
	 } else if (chuyende == 9 ) {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende9=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult9=parseInt(cresult9)+1;
		 }
		 else
		 {
			  wresult9=parseInt(wresult9)+1;     
		 }		 
	 } else if (chuyende == 10 ) {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende10=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult10=parseInt(cresult10)+1;
		 }
		 else
		 {
			  wresult10=parseInt(wresult10)+1;     
		 }		 
	 } else if (chuyende == 11 ) {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende11=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult11=parseInt(cresult11)+1;
		 }
		 else
		 {
			  wresult11=parseInt(wresult11)+1;     
		 }		 
	 } else if (chuyende == 12 ) {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende12=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult12=parseInt(cresult12)+1;
		 }
		 else
		 {
			  wresult12=parseInt(wresult12)+1;     
		 }		 
	 } else if (chuyende == 13 ) {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende13=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult13=parseInt(cresult13)+1;
		 }
		 else
		 {
			  wresult13=parseInt(wresult13)+1;     
		 }		 
	 } else if (chuyende == 14 ) {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende14=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult14=parseInt(cresult14)+1;
		 }
		 else
		 {
			  wresult14=parseInt(wresult14)+1;     
		 }		 
	 } else if (chuyende == 15 ) {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende15=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult15=parseInt(cresult15)+1;
		 }
		 else
		 {
			  wresult15=parseInt(wresult15)+1;     
		 }		 
	 } else if (chuyende == 16 ) {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende16=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult16=parseInt(cresult16)+1;
		 }
		 else
		 {
			  wresult16=parseInt(wresult16)+1;     
		 }		 
	 } else if (chuyende == 17 ) {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende17=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult17=parseInt(cresult17)+1;
		 }
		 else
		 {
			  wresult17=parseInt(wresult17)+1;     
		 }		 
	 } else if (chuyende == 18 ) {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende18=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult18=parseInt(cresult18)+1;
		 }
		 else
		 {
			  wresult18=parseInt(wresult18)+1;     
		 }		 
	 } else if (chuyende == 19 ) {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende19=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult19=parseInt(cresult19)+1;
		 }
		 else
		 {
			  wresult19=parseInt(wresult19)+1;     
		 }		 
	 } else if (chuyende == 20 ) {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende20=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult20=parseInt(cresult20)+1;
		 }
		 else
		 {
			  wresult20=parseInt(wresult20)+1;     
		 }		 
	 } else if (chuyende == 21 ) {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende21=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult21=parseInt(cresult21)+1;
		 }
		 else
		 {
			  wresult21=parseInt(wresult21)+1;     
		 }		 
	 } else if (chuyende == 22 ) {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende22=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult22=parseInt(cresult22)+1;
		 }
		 else
		 {
			  wresult22=parseInt(wresult22)+1;     
		 }		 
	 } else if (chuyende == 23 ) {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende23=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult23=parseInt(cresult23)+1;
		 }
		 else
		 {
			  wresult23=parseInt(wresult23)+1;     
		 }		 
	 } else if (chuyende == 24 ) {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende24=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult24=parseInt(cresult24)+1;
		 }
		 else
		 {
			  wresult24=parseInt(wresult24)+1;     
		 }		 
	 } else if (chuyende == 25 ) {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende25=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult25=parseInt(cresult25)+1;
		 }
		 else
		 {
			  wresult25=parseInt(wresult25)+1;     
		 }		 
	 } else if (chuyende == 26 ) {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende26=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult26=parseInt(cresult26)+1;
		 }
		 else
		 {
			  wresult26=parseInt(wresult26)+1;     
		 }		 
	 } else if (chuyende == 27 ) {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende27=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult27=parseInt(cresult27)+1;
		 }
		 else
		 {
			  wresult27=parseInt(wresult27)+1;     
		 }		 
	 } else if (chuyende == 28 ) {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende28=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult28=parseInt(cresult28)+1;
		 }
		 else
		 {
			  wresult28=parseInt(wresult28)+1;     
		 }		 
	 } else if (chuyende == 29 ) {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende29=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult29=parseInt(cresult29)+1;
		 }
		 else
		 {
			  wresult29=parseInt(wresult29)+1;     
		 }		 
	 } else if (chuyende == 30 ) {
		 $ans=$('#ans_'+ansid).val()
		 tenchuyende30=parseInt(tenchuyende);
		 if ($ans==opt) {
			  cresult30=parseInt(cresult30)+1;
		 }
		 else
		 {
			  wresult30=parseInt(wresult30)+1;     
		 }		 
	 }
 }
  function prevnext(opt) {
	
    $('.disp_'+currpage).css('display','none');
    
    if (opt=="1") {
	currpage=parseInt(currpage)+1;
    }
    else
     {
	currpage=parseInt(currpage)-1;	     
     }
      
     if (currpage>=total_pages) {
	 $('#next').css('display','none');
	  $('#top_next').css('display','none');
	  
	 $('#res_btn').css('display','block');
	cstatus=1;
	
     }
     else{
	 $('#next').css('display','block');
	 $('#top_next').css('display','block');
	  $('#res_btn').css('display','none');
     }
    
     if (currpage<=0)
      {
	 $('#prev').css('display','none');
	 $('#top_prev').css('display','none'); 	     
      }
        else{
		       
	 $('#prev').css('display','block');
	  $('#top_prev').css('display','block'); 	     
     }
     if (cstatus==1) {
	$('#prev').css('display','none');
	 $('#top_prev').css('display','none'); 	    	
     }
    $('.disp_'+currpage).css('display','block'); 
 }

 function results()
 {
	$tcans	=	cresult1;
	$twans	=	wresult1;
	$tenchuyende1 = tenchuyende1;
	
	$tcans2	=	cresult2;
	$twans2	=	wresult2;
	$tenchuyende2 = tenchuyende2;
	
	$tcans3	=	cresult3;
	$twans3	=	wresult3;
	$tenchuyende3 = tenchuyende3;
	
	$tcans4	=	cresult4;
	$twans4	=	wresult4;
	$tenchuyende4 = tenchuyende4;
	
	$tcans5	=	cresult5;
	$twans5	=	wresult5;
	$tenchuyende5 = tenchuyende5;
	
	$tcans6	=	cresult6;
	$twans6	=	wresult6;
	$tenchuyende6 = tenchuyende6;
	
	$tcans7	=	cresult7;
	$twans7	=	wresult7;
	$tenchuyende7 = tenchuyende7;
	
	$tcans8	=	cresult8;
	$twans8	=	wresult8;
	$tenchuyende8 = tenchuyende8;
	
	$tcans9	=	cresult9;
	$twans9	=	wresult9;
	$tenchuyende9 = tenchuyende9;
	
	$tcans10	=	cresult10;
	$twans10	=	wresult10;
	$tenchuyende10 = tenchuyende10;
	
	$tcans11	=	cresult11;
	$twans11	=	wresult11;
	$tenchuyende11 = tenchuyende11;
	
	$tcans12	=	cresult12;
	$twans12	=	wresult12;
	$tenchuyende12 = tenchuyende12;
	
	$tcans13	=	cresult13;
	$twans13	=	wresult13;
	$tenchuyende13 = tenchuyende13;
	
	$tcans14	=	cresult14;
	$twans14	=	wresult14;
	$tenchuyende14 = tenchuyende14;
	
	$tcans15	=	cresult15;
	$twans15	=	wresult15;
	$tenchuyende15 = tenchuyende15;
	
	$tcans16	=	cresult16;
	$twans16	=	wresult16;
	$tenchuyende16 = tenchuyende16;
	
	$tcans17	=	cresult17;
	$twans17	=	wresult17;
	$tenchuyende17 = tenchuyende17;
	
	$tcans18	=	cresult18;
	$twans18	=	wresult18;
	$tenchuyende18 = tenchuyende18;
	
	$tcans19	=	cresult19;
	$twans19	=	wresult19;
	$tenchuyende19 = tenchuyende19;
	
	$tcans20	=	cresult20;
	$twans20	=	wresult20;
	$tenchuyende20 = tenchuyende20;
	
	$tcans21	=	cresult21;
	$twans21	=	wresult21;
	$tenchuyende21 = tenchuyende21;
	
	$tcans22	=	cresult22;
	$twans22	=	wresult22;
	$tenchuyende22 = tenchuyende22;
	
	$tcans23	=	cresult23;
	$twans23	=	wresult23;
	$tenchuyende23 = tenchuyende23;
	
	$tcans24	=	cresult24;
	$twans24	=	wresult24;
	$tenchuyende24 = tenchuyende24;
	
	$tcans25	=	cresult25;
	$twans25	=	wresult25;
	$tenchuyende25 = tenchuyende25;
	
	$tcans26	=	cresult26;
	$twans26	=	wresult26;
	$tenchuyende26 = tenchuyende26;
	
	$tcans27	=	cresult27;
	$twans27	=	wresult27;
	$tenchuyende27 = tenchuyende27;
	
	$tcans28	=	cresult28;
	$twans28	=	wresult28;
	$tenchuyende28 = tenchuyende28;
	
	$tcans29	=	cresult29;
	$twans29	=	wresult29;
	$tenchuyende29 = tenchuyende29;
	
	$tcans30	=	cresult30;
	$twans30	=	wresult30;
	$tenchuyende30 = tenchuyende30;

		if ($pcount_check == total_ques)
		{
			$examtime=$('#hms').html();
			$('#cans').html($tcans);
			$('#wans').html($twans);
			$('#marks').html(cresult1);
			$('#res_id').css('display','none');
			$('#results').css('display','block');
		   $.ajax({//Make the Ajax Request
						type: "POST",
						url: hm2+"/add-results.php",
						data:{name:uname,catid:cat_id,catid_2:cat_id_2,catid_3:cat_id_3,catid_4:cat_id_4,
						chuyende_1:$tenchuyende1,cans:$tcans,wans:$twans,
						chuyende_2:$tenchuyende2,cans_2:$tcans2,wans_2:$twans2,
						chuyende_3:$tenchuyende3,cans_3:$tcans3,wans_3:$twans3,
						chuyende_4:$tenchuyende4,cans_4:$tcans4,wans_4:$twans4,
						chuyende_5:$tenchuyende5,cans_5:$tcans5,wans_5:$twans5,
						chuyende_6:$tenchuyende6,cans_6:$tcans6,wans_6:$twans6,
						chuyende_7:$tenchuyende7,cans_7:$tcans7,wans_7:$twans7,
						chuyende_8:$tenchuyende8,cans_8:$tcans8,wans_8:$twans8,
						chuyende_9:$tenchuyende9,cans_9:$tcans9,wans_9:$twans9,
						chuyende_10:$tenchuyende10,cans_10:$tcans10,wans_10:$twans10,
						chuyende_11:$tenchuyende11,cans_11:$tcans11,wans_11:$twans11,
						chuyende_12:$tenchuyende12,cans_12:$tcans12,wans_12:$twans12,
						chuyende_13:$tenchuyende13,cans_13:$tcans13,wans_13:$twans13,
						chuyende_14:$tenchuyende14,cans_14:$tcans14,wans_14:$twans14,
						chuyende_15:$tenchuyende15,cans_15:$tcans15,wans_15:$twans15,
						chuyende_16:$tenchuyende16,cans_16:$tcans16,wans_16:$twans16,
						chuyende_17:$tenchuyende17,cans_17:$tcans17,wans_17:$twans17,
						chuyende_18:$tenchuyende18,cans_18:$tcans18,wans_18:$twans18,
						chuyende_19:$tenchuyende19,cans_19:$tcans19,wans_19:$twans19,
						chuyende_20:$tenchuyende20,cans_20:$tcans20,wans_20:$twans20,
						chuyende_21:$tenchuyende21,cans_21:$tcans21,wans_21:$twans21,
						chuyende_22:$tenchuyende22,cans_22:$tcans22,wans_22:$twans22,
						chuyende_23:$tenchuyende23,cans_23:$tcans23,wans_23:$twans23,
						chuyende_24:$tenchuyende24,cans_24:$tcans24,wans_24:$twans24,
						chuyende_25:$tenchuyende25,cans_25:$tcans25,wans_25:$twans25,
						chuyende_26:$tenchuyende26,cans_26:$tcans26,wans_26:$twans26,
						chuyende_27:$tenchuyende27,cans_27:$tcans27,wans_27:$twans27,
						chuyende_28:$tenchuyende28,cans_28:$tcans28,wans_28:$twans28,
						chuyende_29:$tenchuyende29,cans_29:$tcans29,wans_29:$twans29,
						chuyende_30:$tenchuyende30,cans_30:$tcans30,wans_30:$twans30,
						examtime:$examtime,hm:hm,hm2:hm2,email:email},
						success: function(data){
				
						$('#error_msg').html(""); 
						$('#msg').html(data);
						}
					});
		} 
		else {
			alert("Bạn vẫn chưa hoàn thành bài kiểm tra, vui lòng kiểm tra lại !!!");
		}
 }
 
 ///////////////////////////////////////////////////////
  function results_temp()
 {
	$tcans	=	cresult1;
	$twans	=	wresult1;
	$tenchuyende1 = tenchuyende1;
	
	$tcans2	=	cresult2;
	$twans2	=	wresult2;
	$tenchuyende2 = tenchuyende2;
	
	$tcans3	=	cresult3;
	$twans3	=	wresult3;
	$tenchuyende3 = tenchuyende3;
	
	$tcans4	=	cresult4;
	$twans4	=	wresult4;
	$tenchuyende4 = tenchuyende4;
	
	$tcans5	=	cresult5;
	$twans5	=	wresult5;
	$tenchuyende5 = tenchuyende5;
	
	$tcans6	=	cresult6;
	$twans6	=	wresult6;
	$tenchuyende6 = tenchuyende6;
	
	$tcans7	=	cresult7;
	$twans7	=	wresult7;
	$tenchuyende7 = tenchuyende7;
	
	$tcans8	=	cresult8;
	$twans8	=	wresult8;
	$tenchuyende8 = tenchuyende8;
	
	$tcans9	=	cresult9;
	$twans9	=	wresult9;
	$tenchuyende9 = tenchuyende9;
	
	$tcans10	=	cresult10;
	$twans10	=	wresult10;
	$tenchuyende10 = tenchuyende10;
	
	$tcans11	=	cresult11;
	$twans11	=	wresult11;
	$tenchuyende11 = tenchuyende11;
	
	$tcans12	=	cresult12;
	$twans12	=	wresult12;
	$tenchuyende12 = tenchuyende12;
	
	$tcans13	=	cresult13;
	$twans13	=	wresult13;
	$tenchuyende13 = tenchuyende13;
	
	$tcans14	=	cresult14;
	$twans14	=	wresult14;
	$tenchuyende14 = tenchuyende14;
	
	$tcans15	=	cresult15;
	$twans15	=	wresult15;
	$tenchuyende15 = tenchuyende15;
	
	$tcans16	=	cresult16;
	$twans16	=	wresult16;
	$tenchuyende16 = tenchuyende16;
	
	$tcans17	=	cresult17;
	$twans17	=	wresult17;
	$tenchuyende17 = tenchuyende17;
	
	$tcans18	=	cresult18;
	$twans18	=	wresult18;
	$tenchuyende18 = tenchuyende18;
	
	$tcans19	=	cresult19;
	$twans19	=	wresult19;
	$tenchuyende19 = tenchuyende19;
	
	$tcans20	=	cresult20;
	$twans20	=	wresult20;
	$tenchuyende20 = tenchuyende20;
	
	$tcans21	=	cresult21;
	$twans21	=	wresult21;
	$tenchuyende21 = tenchuyende21;
	
	$tcans22	=	cresult22;
	$twans22	=	wresult22;
	$tenchuyende22 = tenchuyende22;
	
	$tcans23	=	cresult23;
	$twans23	=	wresult23;
	$tenchuyende23 = tenchuyende23;
	
	$tcans24	=	cresult24;
	$twans24	=	wresult24;
	$tenchuyende24 = tenchuyende24;
	
	$tcans25	=	cresult25;
	$twans25	=	wresult25;
	$tenchuyende25 = tenchuyende25;
	
	$tcans26	=	cresult26;
	$twans26	=	wresult26;
	$tenchuyende26 = tenchuyende26;
	
	$tcans27	=	cresult27;
	$twans27	=	wresult27;
	$tenchuyende27 = tenchuyende27;
	
	$tcans28	=	cresult28;
	$twans28	=	wresult28;
	$tenchuyende28 = tenchuyende28;
	
	$tcans29	=	cresult29;
	$twans29	=	wresult29;
	$tenchuyende29 = tenchuyende29;
	
	$tcans30	=	cresult30;
	$twans30	=	wresult30;
	$tenchuyende30 = tenchuyende30;

			$examtime=$('#hms').html();
			$('#cans').html($tcans);
			$('#wans').html($twans);
			$('#marks').html(cresult1);
			$('#res_id').css('display','none');
			$('#results').css('display','block');
		   $.ajax({//Make the Ajax Request
						type: "POST",
						url: hm2+"/add-results.php",
						data:{name:uname,catid:cat_id,catid_2:cat_id_2,catid_3:cat_id_3,catid_4:cat_id_4,
						chuyende_1:$tenchuyende1,cans:$tcans,wans:$twans,
						chuyende_2:$tenchuyende2,cans_2:$tcans2,wans_2:$twans2,
						chuyende_3:$tenchuyende3,cans_3:$tcans3,wans_3:$twans3,
						chuyende_4:$tenchuyende4,cans_4:$tcans4,wans_4:$twans4,
						chuyende_5:$tenchuyende5,cans_5:$tcans5,wans_5:$twans5,
						chuyende_6:$tenchuyende6,cans_6:$tcans6,wans_6:$twans6,
						chuyende_7:$tenchuyende7,cans_7:$tcans7,wans_7:$twans7,
						chuyende_8:$tenchuyende8,cans_8:$tcans8,wans_8:$twans8,
						chuyende_9:$tenchuyende9,cans_9:$tcans9,wans_9:$twans9,
						chuyende_10:$tenchuyende10,cans_10:$tcans10,wans_10:$twans10,
						chuyende_11:$tenchuyende11,cans_11:$tcans11,wans_11:$twans11,
						chuyende_12:$tenchuyende12,cans_12:$tcans12,wans_12:$twans12,
						chuyende_13:$tenchuyende13,cans_13:$tcans13,wans_13:$twans13,
						chuyende_14:$tenchuyende14,cans_14:$tcans14,wans_14:$twans14,
						chuyende_15:$tenchuyende15,cans_15:$tcans15,wans_15:$twans15,
						chuyende_16:$tenchuyende16,cans_16:$tcans16,wans_16:$twans16,
						chuyende_17:$tenchuyende17,cans_17:$tcans17,wans_17:$twans17,
						chuyende_18:$tenchuyende18,cans_18:$tcans18,wans_18:$twans18,
						chuyende_19:$tenchuyende19,cans_19:$tcans19,wans_19:$twans19,
						chuyende_20:$tenchuyende20,cans_20:$tcans20,wans_20:$twans20,
						chuyende_21:$tenchuyende21,cans_21:$tcans21,wans_21:$twans21,
						chuyende_22:$tenchuyende22,cans_22:$tcans22,wans_22:$twans22,
						chuyende_23:$tenchuyende23,cans_23:$tcans23,wans_23:$twans23,
						chuyende_24:$tenchuyende24,cans_24:$tcans24,wans_24:$twans24,
						chuyende_25:$tenchuyende25,cans_25:$tcans25,wans_25:$twans25,
						chuyende_26:$tenchuyende26,cans_26:$tcans26,wans_26:$twans26,
						chuyende_27:$tenchuyende27,cans_27:$tcans27,wans_27:$twans27,
						chuyende_28:$tenchuyende28,cans_28:$tcans28,wans_28:$twans28,
						chuyende_29:$tenchuyende29,cans_29:$tcans29,wans_29:$twans29,
						chuyende_30:$tenchuyende30,cans_30:$tcans30,wans_30:$twans30,
						examtime:$examtime,hm:hm,hm2:hm2,email:email},
						success: function(data){
				
						$('#error_msg').html(""); 
						$('#msg').html(data);
						}
					});
 }
 //////////////////////////////////////////////////
function count(i) {

	if (i == 1)  {
    	//cookie doesnt exists then you landed on this page
    	//SOME CODE
		var startTime = getCookie("Timer");
		setCookie("Timer", startTime, 1);
   		var pieces = startTime.split(":");
    	var time = new Date();
 	} else if (i == 2)  {
    	//cookie doesnt exists then you landed on this page
    	//SOME CODE
		var startTime = '<?php echo $time ;?>';
		setCookie("Timer", startTime, 1);
   		var pieces = startTime.split(":");
    	var time = new Date();
 	} else {
		var startTime = document.getElementById('hms').innerHTML;
		setCookie("Timer", startTime, 1);
   		var pieces = startTime.split(":");
    	var time = new Date();
	}

    time.setHours(pieces[0]);
    time.setMinutes(pieces[1]);
    time.setSeconds(pieces[2]);
    var timedif = new Date(time.valueOf() - 1000);
    var newtime = timedif.toTimeString().split(" ")[0];
    document.getElementById('hms').innerHTML=newtime;
    if (newtime=="00:00:00") {
		     clearTimeout(time_out);
		     $('#timee').css('display','none');
		     alert("Sorry!!your time is over..")
		      $('#next').css('display','none');
	  $('#top_next').css('display','none');
	  
	 $('#res_btn').css('display','block');
	cstatus=1;
	$('#prev').css('display','none');
	 $('#top_prev').css('display','none');
	results_temp();
	 
    }
    time_out= setTimeout(count, 1000);
}



/////////////////////////////////////////////////////

    function setCookie(c_name, value, exdays) {
            var exdate = new Date();
            exdate.setDate(exdate.getDate() + exdays);
            var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
            document.cookie = c_name + "=" + c_value;
        }

    function getCookie(c_name) {
        var i, x, y, ARRcookies = document.cookie.split(";");
        for (i = 0; i < ARRcookies.length; i++) {
            x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
            y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
            x = x.replace(/^\s+|\s+$/g, "");
            if (x == c_name) {
                return unescape(y);
            }
        }
    }

    function DeleteCookie(name) {
            document.cookie = name + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';
        }
/////////////////////////////////////////////////////

$(window).load(function () {
 //if IsRefresh cookie exists
 var IsRefresh = getCookie("IsRefresh");
 var first_time = 1;
 if (first_time == '<?php echo $_SESSION['FirstVisit'] ;?>'){
	 count(2);
 } else {
	 if (IsRefresh != null && IsRefresh != "") {
		//cookie exists then you refreshed this page(F5, reload button or right click and reload)
		//SOME CODE
		DeleteCookie("IsRefresh");
		count(1);
		//alert("Hello! I am an alert box 1!!");
	 }
	 else {
		//cookie doesnt exists then you landed on this page
		//SOME CODE
		setCookie("IsRefresh", "true", 1);
		count(1);
		//alert("Hello! I am an alert box 2!!");
	 }
 }
})
</script>

<?php
    }
    else
    {
		  $cquery = mysqli_query($connect_2,"SELECT * FROM settings order by id desc" );
       	  echo "<div class='frms'>
          <form name='quiz' action='' method='post'>
		  <label> Họ và Tên : </label>
		  <input type='text' name='uname'  value=' ";?> <?php echo $_SESSION['nameuser']; ?> <?php echo"' maxlength='20'> 
		  <label>E-mail : </label>
		  <input type='text' name='uemail'  value=' ";?> <?php echo $_SESSION['mail']; ?> <?php echo"' maxlength='20'> 
		   </div>
		   <div class='frms_sub1'>
		  <label>Tên Công Trường/Phòng Ban : </label>
		  <input type='text' name='catid_2' value=' ";?> <?php  ?> <?php echo"' maxlength='40'> 
		  <label>Vị trí/Chức Vụ : </label>
		  <select name='catid_3'>";

		  echo "<option value='Giám Sát'>Giám Sát</option>";
		  echo "<option value='Nhân Viên'>Nhân Viên</option>";

		  echo "</select>
		  <label>Loại Hợp Đồng : </label>
		  <select name='catid_4'>";

		  echo "<option value='Hợp Đồng Thử Việc'>Hợp Đồng Thử Việc</option>";
		  echo "<option value='Hợp Đồng Bậc 4'>Hợp Đồng Bậc 4</option>";
		  echo "<option value='Hợp Đồng Bậc 3'>Hợp Đồng Bậc 3</option>";
		  echo "<option value='Hợp Đồng Bậc 2'>Hợp Đồng Bậc 2</option>";
		  echo "<option value='Hợp Đồng Bậc 1'>Hợp Đồng Bậc 1</option>";

		  echo "</select>
		  <label>Chọn chuyên mục đánh giá : </label>
		  <select name='catid'>";
		   if($cquery)
		   {
              while($crow = mysqli_fetch_array($cquery))
              {
		         	$catid = $crow['id'];
			 		$catname = $crow['exam_name'];
			 		echo "<option value='$catid'>$catname</option>";
		      }
		   }
		  echo "</select>
		  <input type='submit' value='Bắt đầu' >
		 </form>
        </div>";
    }
?>
<link href="<?php echo $hm2;?>/style.css" rel="stylesheet" type="text/css">
<?php
}
?>

