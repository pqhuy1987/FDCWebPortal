<?php
include "authheader.php";

if($block != true)
{
 include "heade.php"
 ?>
 <script type='text/javascript'>
$('#m6').html("<span class='curr_mnu'>Get Code</span>")           
        
 </script>
<h1>Get Codes :</h1>
 <h2>Copy the below code in to the pages where you want HRS (HIOX Review Script -user comments)</h2>

 <div class="form_element"><textarea name="" cols="" rows="" class="textarea" readonly="readonly">
<?php
$url = $_SERVER['SCRIPT_FILENAME'];
$pp = strrpos($url,"/");

$url = substr($url,0,$pp);

$ura = $_SERVER['SCRIPT_NAME'];
$host = $_SERVER['SERVER_NAME'];
$ser = "http://$host";
$ura= $ser.$ura;
$pp1 = strrpos($ura,"/");
$ura = substr($ura,0,$pp1);
$url=str_replace("/admin","",$url);
$ura=str_replace("/admin","",$ura);
echo "&lt?php
$"."hm = \"$url\";
$"."hm2 = \"$ura\";
include \"$"."hm/index.php\";
?&gt;";
?>

</textarea></div>
<?php
include './footer.php';
}
?>