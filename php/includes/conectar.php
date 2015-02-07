<?php
// include 'config.php';
$hostname = 'www.hectormurillo.net';
$database = 'db_pac_dev';
$username = 'pac';
$password = '+*V?e,!}tH$(';

// $hostname = '127.0.0.1';
// $database = 'db_pac';
// $username = 'root';
// $password = '';	

$db = new mysqli($hostname, $username, $password, $database);

if ($db->connect_errno) {
	die('Imposible conectar a la base de datos ['.$db->connect_error.']');
}
?>