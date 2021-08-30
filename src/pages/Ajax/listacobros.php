<?php
require_once ("../../config/db.php");
$zona = $_GET['s'];
$fecha = $_GET['f'];
$query = "SELECT * FROM clientesp where fecha_final='$fecha' and sector='$zona' order by poste asc";
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