<?php
require_once ("../../config/db.php");

$query ="select * from clientesp,mikrotik where clientesp.id_mk=mikrotik.idmikrotik and disable NOT IN ('yes','no'); ";
$resultado = mysqli_query($con,$query);
if ( !$resultado) {
	die("Error");
}else{
	while ($data = mysqli_fetch_assoc($resultado)) {

		$array["data"][] = $data;
	}
	echo json_encode($array);
}
mysqli_free_result($resultado);
mysql_close($con);
?>