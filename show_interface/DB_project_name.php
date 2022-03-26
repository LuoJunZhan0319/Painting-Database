<html>
<head>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>


<script type="text/javascript" class="init">
	$(document).ready(function() {
		$('#example').DataTable();
	} );
</script>
	
</head>

<pre>
<?php
#�s����Ʈw
error_reporting(E_ALL & ~E_NOTICE);
$dbhost = '127.0.0.1'; #MySQL IP
$dbuser = 'root'; #�b��
$dbpass = '';
$dbname = 'art_paints'; #��Ʈw�W��

$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection'); 
mysqli_query($conn, "SET NAMES 'utf8'"); #�s�X
mysqli_select_db($conn, $dbname); #��ܭn�ϥΪ���Ʈw

#�����ϥΪ�post��ơA�é��Ʈw�d��
$search = $_POST["sql_query2"];

$sql_info = "SELECT `name`,`paint_base64` as 'paint',`id`,`author`,`year`,`size`,`material`
FROM `paints_info`
WHERE `author` LIKE '%$search%';";
$result_info = mysqli_query($conn, $sql_info) or die('MySQL query error');

#��ܬd�ߵ��G
$output_head = "<table id='example'>";
$output_body ='';
while($row = mysqli_fetch_array($result_info)){
	$output_body .=  "<tr>";
	foreach($row as $key => $each){
		if(is_numeric($key)){
      if($key != 1){
        $output_body .=  "<td>".$each."</td>";
			}elseif($key == 1){
        $output_body .="<td><img src='data:image/png;base64, $each'></td>";
			}
		}elseif(!is_numeric($key)){
			$columnName[$key] = $key;
		}//end if
	}//end foreach
	$output_body .=  "</tr>";	
}

$output_columnName =  "<thead><tr><td>".implode("</td><td>", $columnName)."</td></tr></thead>";

$output_foot =  "</table>";


#��ܽҪ�
echo $output_head;
echo $output_columnName;
echo $output_body;
echo $output_foot;

?>
</pre>