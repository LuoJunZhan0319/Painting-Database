<pre>
<?php
// Report all errors except E_NOTICE
// error_reporting(E_ALL & ~E_NOTICE);

$dbhost = '127.0.0.1'; #MySQL IP
$dbuser = 'root'; #�b��
$dbpass = ''; #�K�X
$dbname = 'art_paints'; #��Ʈw�W��

#�إ߳s�u
$conn = mysqli_connect($dbhost, $dbuser, $dbpass); # or die('Error with MySQL coonect');
mysqli_query($conn, "SET NAME 'utf8'"); #�s�X

#�Ыظ�Ʈw
$sql = "CREATE DATABASE art_paints;";

mysqli_query($conn, $sql); #or die('MySQL create_db error'); #�o�F��`�ڦn��debug = =!!

#��w�s����Ʈw
mysqli_select_db($conn, $dbname); #��ܭn�ϥΪ���Ʈw

#�إ߸�ƪ�
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

mysqli_query($conn, $sql); #or die('MySQL create_tb error'); #�o�F��`�ڦn��debug = =!!


#Ū��
$fptr = fopen("finally (2).txt", "r");

$index = 0;
#��J��Ʀܸ�Ʈw
while (!feof($fptr))
{
    $buffer = fgets($fptr);
    $buffer_t = explode(",",$buffer);
    $sql = "INSERT INTO paints_info(paint_index, name, paint_base64, id, author, year, size, material)
    VALUES($index,\"$buffer_t[0]\", \"$buffer_t[1]\",\"$buffer_t[2]\",\"$buffer_t[3]\",\"$buffer_t[4]\",\"$buffer_t[5]\",\"$buffer_t[6]\")";
    mysqli_query($conn, $sql); //or die('MySQL import_data error'); �o�F��`�ڦn��debug = =!!
    $index = $index+1;
    echo $index
}
fclose($fptr);

?>
</pre>