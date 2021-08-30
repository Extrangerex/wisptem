<?php
require_once ("../../config/db.php");
$action = $_GET['action'];
$query ="select *,concat(nombres,' ',apellido) as nomcli,(monto/plazo) AS cuota from clientesp,financiamiento where clientesp.id=financiamiento.id_cliente and estado='$action'";
$resultado = mysqli_query($con,$query);
if ( !$resultado) {
	die("Error");
}else{
	while ($data = mysqli_fetch_assoc($resultado)) {

		$array["data"][] = $data;
	}
	echo json_encode($array);
}
mysqli_close($con);
?>