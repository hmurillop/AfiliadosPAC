<?php
include 'includes/conectar.php';

$dataObject = json_decode(file_get_contents("php://input"));

$sql = 'SELECT * FROM `tb_afiliado` WHERE `afiliado_cedula` ='.$dataObject->cedula;

if (!$result = $db->query($sql)) {
	die('There was an error running the query ['.$db->error.']');
}


$responseObject = json_encode($result->fetch_assoc());

echo $responseObject;

$db->close();


?>