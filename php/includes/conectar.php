<?php
ini_set('default_mimetype', 'text/html');
ini_set('default_charset', 'utf-8');

// include 'config.php';
$hostname = 'www.hectormurillo.net';
$database = 'db_pac_dev';
$username = 'pac';
$password = '+*V?e,!}tH$(';	

$db = new mysqli($hostname, $username, $password, $database);

mysqli_set_charset($db, 'utf8') or die(__LINE__.mysqli_error($db));

if ($db->connect_error) {
	die('Imposible conectar a la base de datos ['.$db->connect_error.']');
}
?>