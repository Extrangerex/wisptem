<?php
require_once ("../../config/db.php");
$query ="select *,concat(c.nombres,' ',apellido) AS nomcli from onus_configured o left join clientesp c on o.id_cliente=c.id";
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