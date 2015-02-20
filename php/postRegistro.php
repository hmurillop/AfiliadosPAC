<?php
include 'includes/conectar.php';

$dataObject = json_decode(file_get_contents("php://input"));


foreach ($dataObject as $key => $value) {
	if ($value) {
		
	}else{
		$dataObject->$key = 'NULL';
	};
};



$cedula= mysql_real_escape_string($dataObject->cedula);
$nombre= strtoupper($dataObject->nombre);
$apellido1= strtoupper($dataObject->apellido1);
$apellido2= strtoupper($dataObject->apellido2);
$ocupacion= $dataObject->ocupacion;
$tel=mysql_real_escape_string($dataObject->tel);
$tel_oficina=mysql_real_escape_string($dataObject->tel_oficina);
$tel_cel=mysql_real_escape_string($dataObject->tel_cel);
$tel_fax=mysql_real_escape_string($dataObject->tel_fax);
$email=strtolower($dataObject->email);
$direccion=strtolower($dataObject->direccion);
$vive=mysql_real_escape_string($dataObject->distelec->provincia.$dataObject->distelec->canton.$dataObject->distelec->distrito);
$postal=mysql_real_escape_string($dataObject->postal);

$contribuyente 			= mysql_real_escape_string($dataObject->contribuyente);
$colaborador 			= mysql_real_escape_string($dataObject->colaborador);
$colabora_organizacion 	= mysql_real_escape_string($dataObject->colabora_organizacion);
$colabora_miembro_mesa 	= mysql_real_escape_string($dataObject->colabora_miembro_mesa);
$colabora_fiscal 		= mysql_real_escape_string($dataObject->colabora_fiscal);
$colabora_transporte 	= mysql_real_escape_string($dataObject->colabora_transporte);
$colabora_otros = mysql_real_escape_string(strtolower($dataObject->colabora_otros));







// print	$cedula." "
// 		.$nombre." "
// 		.$apellido1." "
// 		.$apellido2." "
// 		.$ocupacion." "
// 		.$tel." "
// 		.$tel_oficina." "
// 		.$tel_cel." "
// 		.$tel_fax." "
// 		.$email." "
// 		.$direccion." "
// 		.$vive." "
// 		.$postal." "
// 		.$contribuyente." "
// 		.$colaborador." "
// 		.$colabora_organizacion." "
// 		.$colabora_miembro_mesa." "
// 		.$colabora_fiscal." "
// 		.$colabora_transporte." "
// 		.$colabora_otro." ";



$sql = "INSERT INTO `tb_afiliado` (
	`afiliado_id` ,
	`afiliado_boleta` ,
	`afiliado_cedula` ,
	`afiliado_nombre` ,
	`afiliado_apellido1` ,
	`afiliado_apellido2` ,
	`afiliado_sexo` ,
	`afiliado_nacimiento` ,
	`afiliado_ocupacion` ,
	`afiliado_tel` ,
	`afiliado_tel_oficina` ,
	`afiliado_cel` ,
	`afiliado_fax` ,
	`afiliado_email` ,
	`afiliado_direccion` ,
	`afiliado_vive` ,
	`afiliado_postal` ,
	`afiliado_contribuyente` ,
	`afiliado_colaborador` ,
	`afiliado_colabora_organizacion` ,
	`afiliado_colabora_miembro_mesa` ,
	`afiliado_colabora_fiscal` ,
	`afiliado_colabora_transporte` ,
	`afiliado_colabora_otros`
)
VALUES (
	NULL , 
	NULL ,  
	'$cedula',  
	'$nombre',  
	'$apellido1',  
	'$apellido2', 
	NULL , 
	NULL ,  
	'$ocupacion',  
	'$tel',
	'$tel_oficina',
	'$tel_cel',
	'$tel_fax' ,
	'$email',
	'$direccion',  
	'$vive',  
	'$postal',  
	'$contribuyente',
	'$colaborador',
	'$colabora_organizacion',
	'$colabora_miembro_mesa',
	'$colabora_fiscal',
	'$colabora_transporte',
	'$colabora_otros'
)";


$result = $db->query($sql) or die("Error in the consult.." . mysqli_error($db));

if ($result) {
	$arr = array('msg'=>"Registro existoso",'success'=>true,'error'=>false);
	$json = json_encode($arr);
	echo $json;
} else {
	$arr = array('msg'=>"Registro fracasado",'success'=>false,'error'=>true);
	$json = json_encode($arr);
	echo $json;
}

	
$db->close();
?>