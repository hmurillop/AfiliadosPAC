<?php
	$hostname = '127.0.0.1';
	$username = 'root';
	$password = '';
	$database  = 'db_pac';   

	$con = mysqli_connect($hostname,$username,$password,$database) or die(mysql_error());

	mysqli_select_db($database,$con); 
	//mysqli_close($con)
?>