<?php
date_default_timezone_set("America/Santo_Domingo");
require_once ("../../config/db.php");
$ip = $_GET['ip'];
$date = date('Y-m-d');
$array[] = array(); 
$query ="SELECT hora,src from conexiones where ip='$ip' and fecha LIKE '%$date%' ";
$resultado = mysqli_query($con,$query);
if ( !$resultado) {
	die("Error");
}else{
	while ($data = mysqli_fetch_array($resultado)) {

		$dest = gethostbyaddr($data['src']);
		

		$elemento = array('ipdestino' =>$dest,'fecha' =>$data['hora']);

		$array["data"][] = $elemento;
	}
	echo json_encode($array);
}
mysqli_close($con);

?>