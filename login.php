
		  	
<?php

$host_db = 'localhost';
$login_db = 'admin_uchet';
$pass_db = '12345';
$name_db = 'UCHET';
$link = mysqli_connect($host_db, $login_db, $pass_db, $name_db);
mysqli_query($link, ' SET NAMES utf8'); //or die(mysql_error());
mysqli_query($link, "set character set 'utf8'");// or die(mysql_error());
mysqli_query($link, "set session collation_connection = 'utf8_general_ci'");
?>

