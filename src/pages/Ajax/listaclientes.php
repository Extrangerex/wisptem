<?php
require_once ("../../config/db.php");
$action = $_GET['action'];
$query ="SELECT c.id,concat(c.nombres,' ',apellido) AS nomcli,c.mac,c.cell,c.poste,t.nombre AS servicio,c.usuario,m.nodo,c.plan,c.pago_total+c.mora as pago_total,c.fecha_final,c.remoteaddress FROM clientesp
c LEFT JOIN mikrotik m ON m.idmikrotik=c.id_mk LEFT JOIN tipo_servicio t ON c.id_servicio = t.id WHERE c.disable='$action' ";
$resultado = mysqli_query($con,$query);
if ( !$resultado) {
	die("Error");
}else{
	while ($data = mysqli_fetch_array($resultado)) {

		$array["data"][] = $data;
	}
	echo json_encode($array);
}
mysqli_close($con);

?>