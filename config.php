
<?php
define('DB_SEVER', 'remotemysql.com');
define('DB_USERNAME', 'ynqRvo1lc5');
define('DB_PASSWORD', 'Otg8C5RjZH');
define('DB_NAME', 'ynqRvo1lc5');

$link = mysqli_connect(DB_SEVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link == false){
	die("ERROR: Could not connect." .mysqli_connect_error());
}
?>
