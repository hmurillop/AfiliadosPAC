<?php
<<<<<<< HEAD
// The request is a JSON request.
// We must read the input.
// $_POST or $_GET will not work!

$data = file_get_contents("php://input");

$objData = json_decode($data);

// perform query or whatever you wish, sample:

/*
$query = 'SELECT * FROM
tbl_content
WHERE
title="'. $objData->data .'"';
 */

// Static array for this demo
$values = array('php', 'web', 'angularjs', 'js');

// Check if the keywords are in our array
if (in_array($objData->data, $values)) {
	echo 'I have found what you\'re looking for!';
} else {
	echo 'Sorry, no match!';
}
?>
=======
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

>>>>>>> master
