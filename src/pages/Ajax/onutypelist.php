<?php
require_once ("../../config/db.php");

$query ="select * from onu_type";
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