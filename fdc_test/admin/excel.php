<?php
error_reporting(0);

require_once "./auth/config.php";
$connect_2 = mysqli_connect("$hostname","$username","$password");
$output = '';
  
 $query = "SELECT * FROM quiz order by id";
 $result = mysqli_query($connect_2, $query);

  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>Tên</th>  
                         <th>Chuyên Mục</th>  
                         <th>Câu Trả Lời Đúng</th>  
       					 <th>Câu Trả Lời Sai</th>
      					 <th>Điểm</th>
	          			 <th>Thời gian sử dụng</th>
			         	 <th>Ngày</th>
					     <th>Email</th>
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
                         <td>'.$row["question"].'</td>  
                         <td>'.$row["opt1"].'</td>  
                         <td>'.$row["opt2"].'</td>  
       <td>'.$row["opt3"].'</td>  
       <td>'.$row["opt4"].'</td>
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
?>