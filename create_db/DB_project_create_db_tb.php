<pre>
<?php
// Report all errors except E_NOTICE
// error_reporting(E_ALL & ~E_NOTICE);

$dbhost = '127.0.0.1'; #MySQL IP
$dbuser = 'root'; #帳號
$dbpass = ''; #密碼
$dbname = 'art_paints'; #資料庫名稱

#建立連線
$conn = mysqli_connect($dbhost, $dbuser, $dbpass); # or die('Error with MySQL coonect');
mysqli_query($conn, "SET NAME 'utf8'"); #編碼

#創建資料庫
$sql = "CREATE DATABASE art_paints;";

mysqli_query($conn, $sql); #or die('MySQL create_db error'); #這東西害我好難debug = =!!

#選定連結資料庫
mysqli_select_db($conn, $dbname); #選擇要使用的資料庫

#建立資料表
$sql =  "CREATE TABLE paints_info(
paint_index int NOT NULL,
name varchar(300) , 
paint_base64 varchar(200000) NOT NULL , 
id varchar(50) NOT NULL, 
author varchar(50) NOT NULL,
year varchar(20) NOT NULL,
size varchar(50) NOT NULL, 
material varchar(100) NOT NULL,
PRIMARY KEY (paint_index) );";

mysqli_query($conn, $sql); #or die('MySQL create_tb error'); #這東西害我好難debug = =!!


#讀檔
$fptr = fopen("finally (2).txt", "r");

$index = 0;
#輸入資料至資料庫
while (!feof($fptr))
{
    $buffer = fgets($fptr);
    $buffer_t = explode(",",$buffer);
    $sql = "INSERT INTO paints_info(paint_index, name, paint_base64, id, author, year, size, material)
    VALUES($index,\"$buffer_t[0]\", \"$buffer_t[1]\",\"$buffer_t[2]\",\"$buffer_t[3]\",\"$buffer_t[4]\",\"$buffer_t[5]\",\"$buffer_t[6]\")";
    mysqli_query($conn, $sql); //or die('MySQL import_data error'); 這東西害我好難debug = =!!
    $index = $index+1;
    echo $index
}
fclose($fptr);

?>
</pre>