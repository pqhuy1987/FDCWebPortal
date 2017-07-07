<?php

require "../lib/dbCon.php";
require "../lib/quantri.php";
	
if(isset($_POST['func']) && !empty($_POST['func'])){
	switch($_POST['func']){
		case 'getCalender':
			getCalender($_POST['year'],$_POST['month']);
			break;
		case 'getEvents':
			getEvents($_POST['date']);
			break;
		case 'addEvent':
			addEvent($_POST['date'],$_POST['title']);
			break;
		case 'delEvent':
			delEvent($_POST['id']);
			break;
		default:
			break;
	}
}
function getCalender($year = '',$month = '')
{
	$dateYear = ($year != '')?$year:date("Y");
	$dateMonth = ($month != '')?$month:date("m");
	$date = $dateYear.'-'.$dateMonth.'-01';
	$currentMonthFirstDay = date("N",strtotime($date));
	$totalDaysOfMonth = cal_days_in_month(CAL_GREGORIAN,$dateMonth,$dateYear);
	$totalDaysOfMonthDisplay = ($currentMonthFirstDay == 7)?($totalDaysOfMonth):($totalDaysOfMonth + $currentMonthFirstDay);
	$boxDisplay = ($totalDaysOfMonthDisplay <= 35)?35:42;
?>
	<div id="calender_section">
		<h2>
        	<select name="month_dropdown" class="month_dropdown dropdown"><?php echo getAllMonths($dateMonth); ?></select>
			<select name="year_dropdown" class="year_dropdown dropdown1"><?php echo getYearList($dateYear); ?></select>
        </h2>
		<div id="event_list" class="none"></div>
        <div id="event_add" class="none">
        	<p style="color:#FFF; font-weight: bold;"> THÊM SỰ KIỆN NGÀY: <span id="eventDateView"></span></p>
            <p ><b style="color:#FFF;">TÊN SỰ KIỆN: </b><input type="text" id="eventTitle" value=""/></p>
            <input type="hidden" id="eventDate" value=""/>
            <input type="button" id="addEventBtn" value="THÊM"/>
            <input type="button" id="delEventBtn" value="XÓA"/>
        </div>
		<div id="calender_section_top">
			<ul>
				<li>Chủ Nhật</li>
				<li>Thứ Hai</li>
				<li>Thứ Ba</li>
				<li>Thứ Tư</li>
				<li>Thứ Năm</li>
				<li>Thứ Sáu</li>
				<li>Thứ Bảy</li>
			</ul>
		</div>
		<div id="calender_section_bot">
			<ul>
			<?php 
				require "../lib/dbCon.php";
				$dayCount = 1; 
				for($cb=1;$cb<=$boxDisplay;$cb++){
					if(($cb >= $currentMonthFirstDay+1 || $currentMonthFirstDay == 7) && $cb <= ($totalDaysOfMonthDisplay)){
						$currentDate = $dateYear.'-'.$dateMonth.'-'.$dayCount;
						$eventNum = 0;
						$result = $db->query("SELECT title FROM events WHERE date = '".$currentDate."' AND status = 1");
						$eventNum = $result->num_rows;
						if(strtotime($currentDate) == strtotime(date("Y-m-d"))){
							echo '<li date="'.$currentDate.'" class="grey date_cell">';
						}elseif($eventNum > 0){
							echo '<li date="'.$currentDate.'" class="light_sky date_cell">';
						}else{
							echo '<li date="'.$currentDate.'" class="date_cell">';
						}
						echo '<span>';
						echo $dayCount;
						echo '</span>';
						echo '<div id="date_popup_'.$currentDate.'" class="date_popup_wrap none">';
						echo '<div class="date_window">';
						echo '<div class="popup_event">SỰ KIỆN ('.$eventNum.')</div>';
						echo ($eventNum > 0)?'<a href="javascript:;" onclick="getEvents(\''.$currentDate.'\');">XEM</a><br/>':'';
						echo '<a href="javascript:;" onclick="addEvent(\''.$currentDate.'\');">THÊM</a>';
						echo '</div></div>';
						echo '</li>';
						$dayCount++;
			?>
			<?php }else{ ?>
				<li><span>&nbsp;</span></li>
			<?php } } ?>
			</ul>
		</div>
	</div>
	<script type="text/javascript">
		function getCalendar(target_div,year,month){
			$.ajax({
				type:'POST',
				url:'functions.php',
				data:'func=getCalender&year='+year+'&month='+month,
				success:function(html){
					$('#'+target_div).html(html);
				}
			});
		}
		
		function getEvents(date){
			$.ajax({
				type:'POST',
				url:'functions.php',
				data:'func=getEvents&date='+date,
				success:function(html){
					$('#event_list').html(html);
					$('#event_add').slideUp('slow');
					$('#event_list').slideDown('slow');
				}
			});
		}
		function addEvent(date){
			$('#eventDate').val(date);
			$('#eventDateView').html(date);
			$('#event_list').slideUp('slow');
			$('#event_add').slideDown('slow');
		}
		$(document).ready(function(){
			$('#addEventBtn').on('click',function(){
				var date = $('#eventDate').val();
				var title = $('#eventTitle').val();
				$.ajax({
					type:'POST',
					url:'functions.php',
					data:'func=addEvent&date='+date+'&title='+title,
					success:function(msg){
						if(msg == 'ok'){
							$.ajax({
								type:'POST',
								url:'functions.php',
								data:'func=getEvents&date='+date,
								success:function(html){
									$('#event_list').html(html);
									//$('#event_add').slideUp('slow');
									$('#event_list').slideDown('slow');
								}
							});
						}else if (msg == 'notitle'){
							alert('Bạn chưa thêm tiêu đề.');
						} else {
							alert('Có lỗi phát sinh, vui lòng thử lại lần nữa.');
						}
					}
				});
			});
		});
		$(document).ready(function(){
			$('#delEventBtn').on('click',function(){
				var id = $('input[name="LuaChon"]:checked').val();
				$.ajax({
					type:'POST',
					url:'functions.php',
					data:'func=delEvent&id='+id,
					success:function(msg){
						var date = $('#eventDate').val();
						var title = $('#eventTitle').val();
						if(msg == 'ok'){
						 	$.ajax({
								type:'POST',
								url:'functions.php',
								data:'func=getEvents&date='+date,
								success:function(html){
									$('#event_list').html(html);
									//$('#event_add').slideUp('slow');
									$('#event_list').slideDown('slow');
								}
							});
						} else {
							alert('Có lỗi phát sinh, vui lòng thử lại lần nữa.');
						}
					}
				 });		
			 });
		});
		$(document).ready(function(){
			$('.date_cell').mouseenter(function(){
				date = $(this).attr('date');
				//$(".date_popup_wrap").fadeOut();
				//$("#date_popup_"+date).fadeIn();	
			});
			$('.date_cell').mouseleave(function(){
				$(".date_popup_wrap").fadeOut();		
			});
			$('.date_cell').on('click',function(){
				$('#eventDate').val(date);
				$('#eventDateView').html(date);
				//$('#event_list').slideUp('slow');
				$('#event_add').slideDown('slow');
				$.ajax({
					type:'POST',
					url:'functions.php',
					data:'func=getEvents&date='+date,
					success:function(html){
						$('#event_list').html(html);
						//$('#event_add').slideUp('slow');
						$('#event_list').slideDown('slow');
					}
				});
			});
			$('.month_dropdown').on('change',function(){
				getCalendar('calendar_div',$('.year_dropdown').val(),$('.month_dropdown').val());
			});
			$('.year_dropdown').on('change',function(){
				getCalendar('calendar_div',$('.year_dropdown').val(),$('.month_dropdown').val());
			});
		});
	</script>
<?php
}
function getAllMonths($selected = ''){
	$options = '';
	for($i=1;$i<=12;$i++)
	{
		$value = ($i < 01)?'0'.$i:$i;
		$selectedOpt = ($value == $selected)?'selected':'';
		$options .= '<option value="'.$value.'" '.$selectedOpt.' >'.date("F", mktime(0, 0, 0, $i+1, 0, 0)).'</option>';
	}
	return $options;
}
function getYearList($selected = ''){
	$options = '';
	for($i=2017;$i<=2035;$i++)
	{
		$selectedOpt = ($i == $selected)?'selected':'';
		$options .= '<option value="'.$i.'" '.$selectedOpt.' >'.$i.'</option>';
	}
	return $options;
}
function getEvents($date = ''){
	$eventListHTML = '';
	$date = $date?$date:date("Y-m-d");
	$result = $db->query("SELECT title, id FROM events WHERE date = '".$date."' AND status = 1");
	if($result->num_rows > 0){
		$eventListHTML = '<h2 >SỰ KIỆN NGÀY:'.date("l, d M Y",strtotime($date)).'</h2>'; 
		$eventListHTML .= '<ul>';
		while($row = $result->fetch_assoc()){ 
            $eventListHTML .= '<li style="font-size:18px; color:#FFF; font-weight: bold;">'.$row['title'].'<input style="float: right" type="radio" name="LuaChon" value='.$row['id'].'id="LuaChon"/>'.'</li>';
        }
		$eventListHTML .= '</ul>';
	}
	echo $eventListHTML;
}
function addEvent($date,$title){
	$currentDate = date("Y-m-d H:i:s");
	if ($title == null) {
		echo 'notitle';
	} else {
		$insert = $db->query("INSERT INTO events (title,date,created,modified) VALUES ('".$title."','".$date."','".$currentDate."','".$currentDate."')");
		if($insert){
			echo 'ok';
		}else{
			echo 'err';
		}
	}
}
function delEvent($id){
	$del = $db->query("delete from events
	where id='$id' ");
	if($del){
		echo 'ok';
	}else{
		echo 'err';
	}
}
?>