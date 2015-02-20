<?php
include 'includes/conectar.php';

$dataObject = json_decode(file_get_contents("php://input"));

$cedula = $dataObject->cedula;

// print 'Cedula '.$cedula; 

$sql = 'SELECT * FROM `tb_afiliado_old` WHERE  `afiliado_cedula` = '.$cedula.'';

$result = $db->query($sql) or die("Error in the consult.." . mysqli_error($db));

$resultRows = mysqli_num_rows($result);

if ($resultRows == 0) {
	$sql = 'SELECT * FROM `tb_afiliado` WHERE  `afiliado_cedula` = '.$cedula.'';
	if (!$result = $db->query($sql)) {
		die('There was an error running the query ['.$db->error.']');
	};
};

$response = json_encode($result->fetch_assoc());

echo $response;
	
$db->close();
?>