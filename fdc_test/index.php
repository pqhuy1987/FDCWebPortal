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
		if($_SESSION['catid']=="")
		   $_SESSION['catid']=$_POST['catid'];
		if($_SESSION['uname']=="")   
		   $_SESSION['uname']=$_POST['uname'];
		if($_SESSION['uemail']=="")   
		   $_SESSION['uemail']=$_POST['uemail'];

		$catid	=	$_SESSION['catid'];
		$uname 	=	$_SESSION['uname'];
		$email 	=	$_SESSION['uemail'];
		$settings_query = mysqli_query($connect_2,"SELECT * FROM settings WHERE id=$catid");
		$settings_row = mysqli_fetch_assoc($settings_query);
		$limit=$settings_row['pagenum'];
		$time =$settings_row['examtime'];
		
		$sql = "SELECT id FROM quizresults WHERE email='$email' and cat_id='$catid'";
		$result = mysqli_query($connect_2,$sql);
		
		if(mysqli_num_rows($result) >0)
		{
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
                	<span style="color:#135194;">F</span><span style="color:#ec2229;">D</span><span style="color:#135194;">C</span>
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
				$query = mysqli_query($connect_2,"SELECT * FROM quiz WHERE status='release' and id_sub=$temp" );
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
			
					if($lt>$limit)
					  $disp="style='display:none;'";
					else
					  $disp="";
					 
					echo "<div class='news_poling disp_$pn'  $disp >";
					echo "<input type='hidden' id='ans_$id' value='$ans'>";
					if ($dokho == 1) {
						echo "<div class='news_poling_top'><b>Câu $lt (Trung Bình)</b>: $qns </div>";
					} else if ($dokho == 2) {
						echo "<div class='news_poling_top'><b>Câu $lt (Khá Khó)</b>: $qns </div>";
					} else if ($dokho == 3) {
						echo "<div class='news_poling_top'><b>Câu $lt (Khó)</b>: $qns </div>";
					} else if ($dokho == 4) {
						echo "<div class='news_poling_top'><b>Câu $lt (Rất Khó)</b>: $qns </div>";
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
				  
					if($lt%$limit==0)
						$pn++;
					$lt++;       
				 }
				 $lt2++;
			}
		}

   		echo "<input type='button' value='Get Results' onclick='results()' id='res_btn' style='display:none;'>";
     	echo "<input type='button' value='Previous' style='float:left;display:none;' id='prev' onclick=prevnext(0)>";
    	echo "<input type='button' value='Hoàn Thành' style='float:right;' id='next' onclick=results()>";
     	echo "</div><div id='results' align='center' style='display:none;'>
				  <div class='result' >
					  <div class='row'>
							<div class='column'><b>Total Questions : </b></div>
					  <div class='column'>$pcount</div>
				  </div>
				  <div class='row'>
					  <div class='column'><b>Total Correct answers : </b></div>
					  <div class='column'><span id='cans'></span></div>
				  </div>
				  <div class='row'>
					  <div class='column'><b>Total Wrong answers : </b></div>
					  <div class='column'><span id='wans'></span></div>
				  </div>
				  <div class='row'>
					  <div class='column'><b>Total Marks : </b></div>
					  <div class='column'> <span id='marks'></span></div>
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
		     var currpage=0;
		     var time_out;
		     var prev=0;
		     var cstatus=0;
			 var email="<?php echo $email;?>";
			 var uname="<?php echo $uname;?>";
			 var cat_id="<?php echo $catid;?>";
		     var total_pages="<?php echo $pages;?>";
			 var hm="<?php echo $hm;?>";
			 var hm2="<?php echo $hm2;?>";
		     total_pages=total_pages-1;
		     var total_ques="<?php echo   $pcount ;?>";
 function chkans(opt,ansid,chuyende,tenchuyende)
 {
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
	
	$examtime=$('#hms').html();
	$('#cans').html($tcans);
	$('#wans').html($twans);
	$('#marks').html(cresult1);
	$('#res_id').css('display','none');
	$('#results').css('display','block');
	   $.ajax({//Make the Ajax Request
                    type: "POST",
                    url: hm2+"/add-results.php",
                    data:{name:uname,catid:cat_id,chuyende_1:$tenchuyende1,cans:$tcans,wans:$twans,chuyende_2:$tenchuyende2,cans_2:$tcans2,wans_2:$twans2,examtime:$examtime,hm:hm,hm2:hm2,email:email},
                    success: function(data){
			
                       $('#error_msg').html(""); 
                 $('#msg').html(data);

                    }
                });
 }
    function count() {
     
    var startTime = document.getElementById('hms').innerHTML;
    var pieces = startTime.split(":");
    var time = new Date();
	
	localStorage.getItem("startTime");
	
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
	results();
	 
    }
    time_out= setTimeout(count, 1000);
}
count();
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
 if (IsRefresh != null && IsRefresh != "") {
    //cookie exists then you refreshed this page(F5, reload button or right click and reload)
    //SOME CODE
    DeleteCookie("IsRefresh");
	//alert("Hello! I am an alert box 1!!");
 }
 else {
    //cookie doesnt exists then you landed on this page
    //SOME CODE
    setCookie("IsRefresh", "true", 1);
	//alert("Hello! I am an alert box 2!!");
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
		  <input type='text' name='uname' readonly value=' ";?> <?php echo $_SESSION['nameuser']; ?> <?php echo"' maxlength='20'> 
		  <label>E-mail : </label>
		  <input type='text' name='uemail' readonly value=' ";?> <?php echo $_SESSION['mail']; ?> <?php echo"' maxlength='20'> 
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
		  <input type='submit' value='Bắt đầu'>
		 </form>
        </div>";
    }
?>
<link href="<?php echo $hm2;?>/style.css" rel="stylesheet" type="text/css">
<?php
}
?>

