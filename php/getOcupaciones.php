<?php
 //echo utf8_encode ( $row['ocupacion_id'] )."<br>";
include 'includes/conectar.php';

$sql = 'SELECT * FROM tb_ocupacion';

$result = $db->query($sql);

$data = array();

foreach ($result as $row) {

		$data[] = array('id'=>$row['ocupacion_id'], 'nombre'=>utf8_encode($row['ocupacion_nombre']) );

}

$json = json_encode($data);
echo $json;

$db->close();
?>    
