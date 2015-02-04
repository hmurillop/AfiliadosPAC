<?php
include 'conectar.php';

$dataObject = json_decode(file_get_contents("php://input"));

$sql = 'SELECT * FROM `tb_afiliado` WHERE `afiliado_cedula` ='.$dataObject->{'cedula'};

if (!$result = $db->query($sql)) {
	die('There was an error running the query ['.$db->error.']');
}

$row = json_encode($result->fetch_assoc());

echo $row;

$db->close();
//$result->num_rows;

//$dataObject->{'cedula'};

?>

