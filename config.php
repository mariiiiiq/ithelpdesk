
<?php
define('DB_SEVER', 'remotemysql.com');
define('DB_USERNAME', 'Tbzjhb7Cod');
define('DB_PASSWORD', 'JbzqlW6NkW');
define('DB_NAME', 'Tbzjhb7Cod');

$link = mysqli_connect(DB_SEVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link == false){
	die("ERROR: Could not connect." .mysqli_connect_error());
}
?>
