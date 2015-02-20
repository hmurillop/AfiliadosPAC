<?php
 //echo utf8_encode ( $row['ocupacion_id'] )."<br>";
include 'includes/conectar.php';

$sql = 'SELECT * FROM tb_distelec';

$result = $db->query($sql);


$aProvincias  = [];
	/* JSON FORMAT
	[
		c_provincia: {			 
			nombre : nombre provincia
			cantones : [{
				id:
				nombre:
				distrito : [{
					
					nombre :
				},{}]
			},{}]		
		}
	]
	*/
foreach ($result as $row) {

	$sCodelec = $row['distelec_codelec']; 

	$sCodigoProvincia	=	substr($sCodelec, 0 , 1); 
	$sCodigoCanton		=	substr($sCodelec, 1 , 2);
	$sCodigoDistrito	=	substr($sCodelec, -3 , 3);

	// $sProvincia = utf8_encode($row['distelec_provincia']);
	// $sCanton 	= utf8_encode($row['distelec_canton']);
	// $sDistrito 	= utf8_encode($row['distelec_distrito']);

	$sProvincia = $row['distelec_provincia'];
	$sCanton 	= $row['distelec_canton'];
	$sDistrito 	= $row['distelec_distrito'];

	// $oProvincia = $aProvincias['provincia'][$sCodigoProvincia];
	// $oCanton 	= $aProvincias['provincia'][$sCodigoProvincia]['canton'][$sCodigoCanton];
	// $oDistrito 	= $aProvincias['provincia'][$sCodigoProvincia]['canton'][$sCodigoCanton]['distrito'][$sCodigoDistrito];

	$aProvincias['provincia'][$sCodigoProvincia]['codigo'] = $sCodigoProvincia;;
	$aProvincias['provincia'][$sCodigoProvincia]['nombre'] = $sProvincia;

	$aProvincias['provincia'][$sCodigoProvincia]['canton'][$sCodigoCanton]['codigo'] = $sCodigoCanton;
	$aProvincias['provincia'][$sCodigoProvincia]['canton'][$sCodigoCanton]['nombre'] = $sCanton;

	$aProvincias['provincia'][$sCodigoProvincia]['canton'][$sCodigoCanton]['distrito'][$sCodigoDistrito]['codigo'] = $sCodigoDistrito;
	$aProvincias['provincia'][$sCodigoProvincia]['canton'][$sCodigoCanton]['distrito'][$sCodigoDistrito]['nombre'] = $sDistrito;
	
};
$json = json_encode($aProvincias);

echo $json;

$db->close();
?>    
