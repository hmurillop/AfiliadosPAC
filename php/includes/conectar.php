<?php
include 'config.php';

$db = new mysqli($hostname, $username, $password, $database);

if ($db->connect_errno) {
	die('Imposible conectar a la base de datos ['.$db->connect_error.']');
}
?>