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
		$settings_query = mysqli_query($connect_2,"SELECT * FROM settings WHERE id=1");
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
  		$query = mysqli_query($connect_2,"SELECT * FROM quiz WHERE status='release' and catid=$catid" );
 		$pcount = mysqli_num_rows($query);
 		$pages = ceil($pcount/$limit);
  
    	echo "<input type='button' value='Previous' style='float:left;display:none;' id='top_prev' onclick=prevnext(0)>";
   
   		echo "<input type='button' value='Next' style='float:right;' id='top_next' onclick=prevnext(1)>";
    
 		echo "</div><div class='clear'></div>";   
 		$lt=1;$pn=0;

  		while($row = mysqli_fetch_array($query))
   		{
            $id = $row['id'];
			$qns = $row['question'];
			$ans = $row['answer'];
			$opt1 = $row['opt1'];
			$opt2 = $row['opt2'];
			$opt3 = $row['opt3'];
			$opt4 = $row['opt4'];
	
			if($lt>$limit)
			  $disp="style='display:none;'";
			else
			  $disp="";
			 
            echo "<div class='news_poling disp_$pn'  $disp >";
            echo "<input type='hidden' id='ans_$id' value='$ans'>";
            echo "<div class='news_poling_top'><b>$lt</b>.$qns</div>";
            echo "<div class='news_poling_sele-ct'><form id='polingForm' method='post' action='survey-script/polling-result.php'>";
            echo "<div>
                  <input type='hidden' value='151' name='Qid'>
                  <fieldset class='radios' id='$id'>
                  <input type='radio' value='opt1' name='options_$id'  onclick=chkans(1,$id)>$opt1 $limit_tag
                  <input type='radio' value='opt2' name='options_$id' onclick=chkans(2,$id)>$opt2 $limit_tag";
            if($opt3!='')
            {
				echo "<input type='radio' value='opt3' name='options_$id' onclick=chkans(3,$id)>$opt3 $limit_tag ";
			}
            if($opt4!='')
            {
				echo "<input type='radio' value='opt4' name='options_$id' onclick=chkans(4,$id)>$opt4 $limit_tag ";
			}
                        
             echo "</fieldset>
                    </div>";
             echo "</div>";           
           	 echo "</div>";
          
	   		if($lt%$limit==0)
	    		$pn++;
      		$lt++;       
   		 }
 
   		echo "<input type='button' value='Get Results' onclick='results()' id='res_btn' style='display:none;'>";
     	echo "<input type='button' value='Previous' style='float:left;display:none;' id='prev' onclick=prevnext(0)>";
    	echo "<input type='button' value='Next' style='float:right;' id='next' onclick=prevnext(1)>";
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
		     var cresult=0;
		     var wresult=0;
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
 function chkans(opt,ansid)
 {
	
     $ans=$('#ans_'+ansid).val()
     if ($ans==opt) {
		  cresult=parseInt(cresult)+1;
     }
     else
     {
	
		  wresult=parseInt(wresult)+1;     
	 
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
		     
		  
	$tcans=	cresult;
	$twans=	wresult;
	$examtime=$('#hms').html();
	$('#cans').html($tcans);
	$('#wans').html($twans);
	$('#marks').html(cresult);
	$('#res_id').css('display','none');
	$('#results').css('display','block');
	   $.ajax({//Make the Ajax Request
                    type: "POST",
                    url: hm2+"/add-results.php",
                    data:{name:uname,catid:cat_id,cans:$tcans,wans:$twans,examtime:$examtime,hm:hm,hm2:hm2,email:email},
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

</script>



<?php
    }
    else
    {
		  $cquery = mysqli_query($connect_2,"SELECT * FROM category WHERE status='release'" );
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
			 		$catname = $crow['category'];
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