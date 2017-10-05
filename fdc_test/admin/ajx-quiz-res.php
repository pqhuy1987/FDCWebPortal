<?php
error_reporting(0);
require_once "./auth/config.php";
$connect_2 = mysqli_connect("$hostname","$username","$password");
if($connect_2)
{
	$dbcon = mysqli_select_db($connect_2, "$dbname");
}
$uidd  = $_SERVER['REQUEST_URI'];
    $host1 = $_SERVER['SERVER_NAME'];
    $uidd = "http://$host1$uidd";
   // echo $uidd;


$page = $_REQUEST['page'];

$start = ($page)*10;

		$res2 = mysqli_query($connect_2,"SELECT * FROM quizresults order by id desc limit $start,500");
		echo "<div id='maindiv'>";

//echo $start;

       	 $delcnt1=mysqli_num_rows($res2);
	     $tcount=$delcnt1;
	     echo "<input type='hidden' value='$tcount' id='tcount'>";
                    
		echo '<div class="admin_table"><table border="0" cellspacing="0" cellpadding="0" >
        <tr>
          	<th>Tên</th>
			<th>Email</th>
			<th>Phòng Ban/Công Trường</th>
			<th>Vị Trí</th>
			<th>Bậc Hợp Đồng</th>
          	<th>Bộ Đề</th>
	  		<th>Thời gian sử dụng</th>
	  		<th>Ngày</th>
          	<th>Chuyên Đề 1</th>
	  		<th>Chuyên Đề 2</th>
			<th>Chuyên Đề 3</th>
	  		<th>Chuyên Đề 4</th>
			<th>Chuyên Đề 5</th>
	  		<th>Chuyên Đề 6</th>
			<th>Chuyên Đề 7</th>
	  		<th>Chuyên Đề 8</th>
			<th>Chuyên Đề 9</th>
	  		<th>Chuyên Đề 10</th>
			<th>Chuyên Đề 11</th>
	  		<th>Chuyên Đề 12</th>
			<th>Chuyên Đề 13</th>
	  		<th>Chuyên Đề 14</th>
			<th>Chuyên Đề 15</th>
	  		<th>Chuyên Đề 16</th>
			<th>Chuyên Đề 17</th>
	  		<th>Chuyên Đề 18</th>
			<th>Chuyên Đề 19</th>
	  		<th>Chuyên Đề 20</th>
			<th>Chuyên Đề 21</th>
	  		<th>Chuyên Đề 22</th>
			<th>Chuyên Đề 23</th>
	  		<th>Chuyên Đề 24</th>
			<th>Chuyên Đề 25</th>
	  		<th>Chuyên Đề 26</th>
			<th>Chuyên Đề 27</th>
	  		<th>Chuyên Đề 28</th>
			<th>Chuyên Đề 29</th>
	  		<th>Chuyên Đề 30</th>
			<th>Xuất Excel File</th>
			<th>Xóa</th>
        </tr>';
	$xx=0;
		$d=0;
		
		 while($line = mysqli_fetch_assoc($res2))
		 {
			$id = $line['id'];
			
			$name = $line['name'];
			$catid = $line['cat_id'];
			$res3 			= mysqli_query($connect_2,"SELECT exam_name FROM settings where id='$catid'");
			$crow			= mysqli_fetch_assoc($res3);
			$cat_name		= $crow['exam_name'];
			
			
			//----------------------chuyende_1----------------------------//
			$chuyende_1 = $line['chuyende_1'];
			$res_chuyende_1 = mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_1'");
			$crow_chuyende_1 = mysqli_fetch_assoc($res_chuyende_1);
			$cat_name1=$crow_chuyende_1['name_sub'];
			
			$cans = $line['correct_ans'];
			$wans = $line['wrong_ans'];
			$total_1 = $cans + $wans;
			//----------------------chuyende_1----------------------------//
			
			//----------------------chuyende_2----------------------------//
			$chuyende_2 = $line['chuyende_2'];
			$res_chuyende_2 = mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_2'");
			$crow_chuyende_2 =mysqli_fetch_assoc($res_chuyende_2);
			$cat_name2=$crow_chuyende_2['name_sub'];
			
			$cans_2 = $line['correct_ans_2'];
			$wans_2 = $line['wrong_ans_2'];
			$total_2 = $cans_2 + $wans_2;
			//----------------------chuyende_2----------------------------//
			
			//----------------------chuyende_3----------------------------//
			$chuyende_3 = $line['chuyende_3'];
			$res_chuyende_3 = mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_3'");
			$crow_chuyende_3 =mysqli_fetch_assoc($res_chuyende_3);
			$cat_name3=$crow_chuyende_3['name_sub'];
			
			$cans_3 = $line['correct_ans_3'];
			$wans_3 = $line['wrong_ans_3'];
			$total_3 = $cans_3 + $wans_3;
			//----------------------chuyende_3----------------------------//
			
			//----------------------chuyende_4----------------------------//
			$chuyende_4 = $line['chuyende_4'];
			$res_chuyende_4 	= mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_4'");
			$crow_chuyende_4 	= mysqli_fetch_assoc($res_chuyende_4);
			$cat_name4			= $crow_chuyende_4['name_sub'];
			
			$cans_4 = $line['correct_ans_4'];
			$wans_4 = $line['wrong_ans_4'];
			$total_4 = $cans_4 + $wans_4;
			//----------------------chuyende_4----------------------------//
			
			//----------------------chuyende_5----------------------------//
			$chuyende_5 = $line['chuyende_5'];
			$res_chuyende_5 = mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_5'");
			$crow_chuyende_5 =mysqli_fetch_assoc($res_chuyende_5);
			$cat_name5=$crow_chuyende_5['name_sub'];
			
			$cans_5 = $line['correct_ans_5'];
			$wans_5 = $line['wrong_ans_5'];
			$total_5 = $cans_5 + $wans_5;
			//----------------------chuyende_5----------------------------//
			
			//----------------------chuyende_6----------------------------//
			$chuyende_6 = $line['chuyende_6'];
			$res_chuyende_6 = mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_6'");
			$crow_chuyende_6 =mysqli_fetch_assoc($res_chuyende_6);
			$cat_name6=$crow_chuyende_6['name_sub'];
			
			$cans_6 = $line['correct_ans_6'];
			$wans_6 = $line['wrong_ans_6'];
			$total_6 = $cans_6 + $wans_6;
			//----------------------chuyende_6----------------------------//

			//----------------------chuyende_7----------------------------//
			$chuyende_7 = $line['chuyende_7'];
			$res_chuyende_7 	= mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_7'");
			$crow_chuyende_7 	= mysqli_fetch_assoc($res_chuyende_7);
			$cat_name7			= $crow_chuyende_7['name_sub'];
			
			$cans_7 = $line['correct_ans_7'];
			$wans_7 = $line['wrong_ans_7'];
			$total_7 = $cans_7 + $wans_7;
			//----------------------chuyende_7----------------------------//
			
			//----------------------chuyende_8----------------------------//
			$chuyende_8 = $line['chuyende_8'];
			$res_chuyende_8 = mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_8'");
			$crow_chuyende_8 =mysqli_fetch_assoc($res_chuyende_8);
			$cat_name8=$crow_chuyende_8['name_sub'];
			
			$cans_8 = $line['correct_ans_8'];
			$wans_8 = $line['wrong_ans_8'];
			$total_8 = $cans_8 + $wans_8;
			//----------------------chuyende_8----------------------------//
			
			//----------------------chuyende_9----------------------------//
			$chuyende_9 = $line['chuyende_9'];
			$res_chuyende_9 = mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_9'");
			$crow_chuyende_9 =mysqli_fetch_assoc($res_chuyende_9);
			$cat_name9=$crow_chuyende_9['name_sub'];
			
			$cans_9 = $line['correct_ans_9'];
			$wans_9 = $line['wrong_ans_9'];
			$total_9 = $cans_9 + $wans_9;
			//----------------------chuyende_9----------------------------//
			
			//----------------------chuyende_10----------------------------//
			$chuyende_10 = $line['chuyende_10'];
			$res_chuyende_10 	= mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_10'");
			$crow_chuyende_10 	= mysqli_fetch_assoc($res_chuyende_10);
			$cat_name10			= $crow_chuyende_10['name_sub'];
			
			$cans_10 = $line['correct_ans_10'];
			$wans_10 = $line['wrong_ans_10'];
			$total_10 = $cans_10 + $wans_10;
			//----------------------chuyende_10----------------------------//
			
			//----------------------chuyende_11----------------------------//
			$chuyende_11 = $line['chuyende_11'];
			$res_chuyende_11 = mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_11'");
			$crow_chuyende_11 =mysqli_fetch_assoc($res_chuyende_11);
			$cat_name11=$crow_chuyende_11['name_sub'];
			
			$cans_11 = $line['correct_ans_11'];
			$wans_11 = $line['wrong_ans_11'];
			$total_11 = $cans_11 + $wans_11;
			//----------------------chuyende_11----------------------------//
			
			//----------------------chuyende_12----------------------------//
			$chuyende_12 = $line['chuyende_12'];
			$res_chuyende_12 = mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_12'");
			$crow_chuyende_12 =mysqli_fetch_assoc($res_chuyende_12);
			$cat_name12=$crow_chuyende_12['name_sub'];
			
			$cans_12 = $line['correct_ans_12'];
			$wans_12 = $line['wrong_ans_12'];
			$total_12 = $cans_12 + $wans_12;
			//----------------------chuyende_12----------------------------//
			
			//----------------------chuyende_13----------------------------//
			$chuyende_13 = $line['chuyende_13'];
			$res_chuyende_13 	= mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_13'");
			$crow_chuyende_13 	= mysqli_fetch_assoc($res_chuyende_13);
			$cat_name13			= $crow_chuyende_13['name_sub'];
			
			$cans_13 = $line['correct_ans_13'];
			$wans_13 = $line['wrong_ans_13'];
			$total_13 = $cans_13 + $wans_13;
			//----------------------chuyende_13----------------------------//
			
			//----------------------chuyende_14----------------------------//
			$chuyende_14 = $line['chuyende_14'];
			$res_chuyende_14 = mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_14'");
			$crow_chuyende_14 =mysqli_fetch_assoc($res_chuyende_14);
			$cat_name14=$crow_chuyende_14['name_sub'];
			
			$cans_14 = $line['correct_ans_14'];
			$wans_14 = $line['wrong_ans_14'];
			$total_14 = $cans_14 + $wans_14;
			//----------------------chuyende_14----------------------------//
			
			//----------------------chuyende_15----------------------------//
			$chuyende_15 = $line['chuyende_15'];
			$res_chuyende_15 = mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_15'");
			$crow_chuyende_15 =mysqli_fetch_assoc($res_chuyende_15);
			$cat_name15=$crow_chuyende_15['name_sub'];
			
			$cans_15 = $line['correct_ans_15'];
			$wans_15 = $line['wrong_ans_15'];
			$total_15 = $cans_15 + $wans_15;
			//----------------------chuyende_15----------------------------//
			
			//----------------------chuyende_16----------------------------//
			$chuyende_16 = $line['chuyende_16'];
			$res_chuyende_16 	= mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_16'");
			$crow_chuyende_16 	= mysqli_fetch_assoc($res_chuyende_16);
			$cat_name16			= $crow_chuyende_16['name_sub'];
			
			$cans_16 = $line['correct_ans_16'];
			$wans_16 = $line['wrong_ans_16'];
			$total_16 = $cans_16 + $wans_16;
			//----------------------chuyende_16----------------------------//
			
			//----------------------chuyende_17----------------------------//
			$chuyende_17 = $line['chuyende_17'];
			$res_chuyende_17 = mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_17'");
			$crow_chuyende_17 =mysqli_fetch_assoc($res_chuyende_17);
			$cat_name17=$crow_chuyende_17['name_sub'];
			
			$cans_17 = $line['correct_ans_17'];
			$wans_17 = $line['wrong_ans_17'];
			$total_17 = $cans_17 + $wans_17;
			//----------------------chuyende_17----------------------------//
			
			//----------------------chuyende_18----------------------------//
			$chuyende_18 = $line['chuyende_18'];
			$res_chuyende_18 = mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_18'");
			$crow_chuyende_18 =mysqli_fetch_assoc($res_chuyende_28);
			$cat_name18=$crow_chuyende_18['name_sub'];
			
			$cans_18 = $line['correct_ans_18'];
			$wans_18 = $line['wrong_ans_18'];
			$total_18 = $cans_18 + $wans_18;
			//----------------------chuyende_18----------------------------//
			
			//----------------------chuyende_19----------------------------//
			$chuyende_19 = $line['chuyende_19'];
			$res_chuyende_19 	= mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_19'");
			$crow_chuyende_19 	= mysqli_fetch_assoc($res_chuyende_19);
			$cat_name19			= $crow_chuyende_19['name_sub'];
			
			$cans_19 = $line['correct_ans_19'];
			$wans_19 = $line['wrong_ans_19'];
			$total_19 = $cans_19 + $wans_19;
			//----------------------chuyende_19----------------------------//
			
			//----------------------chuyende_20----------------------------//
			$chuyende_20 = $line['chuyende_20'];
			$res_chuyende_20 = mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_20'");
			$crow_chuyende_20 =mysqli_fetch_assoc($res_chuyende_20);
			$cat_name20=$crow_chuyende_20['name_sub'];
			
			$cans_20 = $line['correct_ans_20'];
			$wans_20 = $line['wrong_ans_20'];
			$total_20 = $cans_20 + $wans_20;
			//----------------------chuyende_20----------------------------//
			
			//----------------------chuyende_21----------------------------//
			$chuyende_21 = $line['chuyende_21'];
			$res_chuyende_21 = mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_21'");
			$crow_chuyende_21 =mysqli_fetch_assoc($res_chuyende_21);
			$cat_name21=$crow_chuyende_21['name_sub'];
			
			$cans_21 = $line['correct_ans_21'];
			$wans_21 = $line['wrong_ans_21'];
			$total_21 = $cans_21 + $wans_21;
			//----------------------chuyende_21----------------------------//
			
			//----------------------chuyende_22---------------------------//
			$chuyende_22 = $line['chuyende_22'];
			$res_chuyende_22 = mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_22'");
			$crow_chuyende_22 =mysqli_fetch_assoc($res_chuyende_22);
			$cat_name22=$crow_chuyende_22['name_sub'];
			
			$cans_22 = $line['correct_ans_22'];
			$wans_22 = $line['wrong_ans_22'];
			$total_22 = $cans_22 + $wans_22;
			//----------------------chuyende_22----------------------------//
			
			//----------------------chuyende_23----------------------------//
			$chuyende_23 = $line['chuyende_23'];
			$res_chuyende_23 = mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_23'");
			$crow_chuyende_23 =mysqli_fetch_assoc($res_chuyende_23);
			$cat_name23=$crow_chuyende_23['name_sub'];
			
			$cans_23 = $line['correct_ans_23'];
			$wans_23 = $line['wrong_ans_23'];
			$total_23 = $cans_23 + $wans_23;
			//----------------------chuyende_23----------------------------//
			
			//----------------------chuyende_24----------------------------//
			$chuyende_24 = $line['chuyende_24'];
			$res_chuyende_24 = mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_24'");
			$crow_chuyende_24 =mysqli_fetch_assoc($res_chuyende_24);
			$cat_name24=$crow_chuyende_24['name_sub'];
			
			$cans_24 = $line['correct_ans_24'];
			$wans_24 = $line['wrong_ans_24'];
			$total_24 = $cans_24 + $wans_24;
			//----------------------chuyende_24----------------------------//
			
			//----------------------chuyende_25----------------------------//
			$chuyende_25 = $line['chuyende_25'];
			$res_chuyende_25 = mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_25'");
			$crow_chuyende_25 =mysqli_fetch_assoc($res_chuyende_25);
			$cat_name25=$crow_chuyende_25['name_sub'];
			
			$cans_25 = $line['correct_ans_25'];
			$wans_25 = $line['wrong_ans_25'];
			$total_25 = $cans_25 + $wans_25;
			//----------------------chuyende_25----------------------------//
			
			//----------------------chuyende_26----------------------------//
			$chuyende_26 = $line['chuyende_26'];
			$res_chuyende_26 = mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_26'");
			$crow_chuyende_26 =mysqli_fetch_assoc($res_chuyende_26);
			$cat_name26=$crow_chuyende_26['name_sub'];
			
			$cans_26 = $line['correct_ans_26'];
			$wans_26 = $line['wrong_ans_26'];
			$total_26 = $cans_26 + $wans_26;
			//----------------------chuyende_26----------------------------//
			
			//----------------------chuyende_27----------------------------//
			$chuyende_27 = $line['chuyende_27'];
			$res_chuyende_27 = mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_27'");
			$crow_chuyende_27 =mysqli_fetch_assoc($res_chuyende_27);
			$cat_name27=$crow_chuyende_27['name_sub'];
			
			$cans_27 = $line['correct_ans_27'];
			$wans_27 = $line['wrong_ans_27'];
			$total_27 = $cans_27 + $wans_27;
			//----------------------chuyende_27----------------------------//
			
			//----------------------chuyende_28----------------------------//
			$chuyende_28 = $line['chuyende_28'];
			$res_chuyende_28 = mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_28'");
			$crow_chuyende_28 =mysqli_fetch_assoc($res_chuyende_28);
			$cat_name28=$crow_chuyende_28['name_sub'];
			
			$cans_28 = $line['correct_ans_28'];
			$wans_28 = $line['wrong_ans_28'];
			$total_28 = $cans_28 + $wans_28;
			//----------------------chuyende_28----------------------------//
			
			//----------------------chuyende_29----------------------------//
			$chuyende_29 = $line['chuyende_29'];
			$res_chuyende_29 = mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_29'");
			$crow_chuyende_29 =mysqli_fetch_assoc($res_chuyende_29);
			$cat_name29=$crow_chuyende_29['name_sub'];
			
			$cans_29 = $line['correct_ans_29'];
			$wans_29 = $line['wrong_ans_29'];
			$total_29 = $cans_29 + $wans_29;
			//----------------------chuyende_29----------------------------//
			
			//----------------------chuyende_30----------------------------//
			$chuyende_30 = $line['chuyende_30'];
			$res_chuyende_30 = mysqli_query($connect_2,"SELECT name_sub FROM category_sub where id_sub='$chuyende_30'");
			$crow_chuyende_30 =mysqli_fetch_assoc($res_chuyende_30);
			$cat_name30=$crow_chuyende_30['name_sub'];
			
			$cans_30 = $line['correct_ans_30'];
			$wans_30 = $line['wrong_ans_30'];
			$total_30 = $cans_30 + $wans_30;
			//----------------------chuyende_30----------------------------//
			
			$marks = $line['marks'];
			$examtime=$line['examtime'];
			$date = $line['datee'];
			$email=$line['email'];
			$workplace=$line['workplace'];
			$title=$line['title'];
			$contact=$line['contact'];
			
					echo "<tr id='row_$id'>";
			
			
			echo 
			"<td>$name</td><td>$email</td>
			<td>$workplace</td>
            <td>$title</td>
            <td>$contact</td>
			<td>$cat_name</td>
			<td>$examtime</td>
			<td>$date</td>
			<td>$cat_name1: ( đúng $cans/$total_1 câu)</td>
			<td>$cat_name2: ( đúng $cans_2/$total_2 câu)</td>
			<td>$cat_name3: ( đúng $cans_3/$total_3 câu)</td>
			<td>$cat_name4: ( đúng $cans_4/$total_4 câu)</td>
			<td>$cat_name5: ( đúng $cans_5/$total_5 câu)</td>
			<td>$cat_name6: ( đúng $cans_6/$total_6 câu)</td>
			<td>$cat_name7: ( đúng $cans_7/$total_7 câu)</td>
			<td>$cat_name8: ( đúng $cans_8/$total_8 câu)</td>
			<td>$cat_name9: ( đúng $cans_9/$total_9 câu)</td>
			
			<td>$cat_name10: ( đúng $cans_10/$total_10 câu)</td>
			<td>$cat_name11: ( đúng $cans_11/$total_11 câu)</td>
			<td>$cat_name12: ( đúng $cans_12/$total_12 câu)</td>
			<td>$cat_name13: ( đúng $cans_13/$total_13 câu)</td>
			<td>$cat_name14: ( đúng $cans_14/$total_14 câu)</td>
			<td>$cat_name15: ( đúng $cans_15/$total_15 câu)</td>
			<td>$cat_name16: ( đúng $cans_16/$total_16 câu)</td>
			<td>$cat_name17: ( đúng $cans_17/$total_17 câu)</td>
			<td>$cat_name18: ( đúng $cans_18/$total_18 câu)</td>
			<td>$cat_name19: ( đúng $cans_19/$total_19 câu)</td>
			<td>$cat_name20: ( đúng $cans_20/$total_20 câu)</td>
			
			<td>$cat_name21: ( đúng $cans_21/$total_21 câu)</td>
			<td>$cat_name22: ( đúng $cans_22/$total_22 câu)</td>
			<td>$cat_name23: ( đúng $cans_23/$total_23 câu)</td>
			<td>$cat_name24: ( đúng $cans_24/$total_24 câu)</td>
			<td>$cat_name25: ( đúng $cans_25/$total_25 câu)</td>
			<td>$cat_name26: ( đúng $cans_26/$total_26 câu)</td>
			<td>$cat_name27: ( đúng $cans_27/$total_27 câu)</td>
			<td>$cat_name28: ( đúng $cans_28/$total_28 câu)</td>
			<td>$cat_name29: ( đúng $cans_29/$total_29 câu)</td>
			<td>$cat_name30: ( đúng $cans_30/$total_30 câu)</td>

			<td><a href='./excel.php?eid=$id'>Xuất File</a></td>
			<td><a href='javascript:changestatus(\"delete\",$id);'>delete</a></td>
			
			
			</tr>";
			$xx++;
			$d++;
		}
	       
		
		
		echo "</table></div>";
		
	?>

