<?php
date_default_timezone_set("America/Santo_Domingo");
require_once ("../../config/db.php");

$id = $_GET['id'];

$sql = "SELECT MAX(fecha_factura) AS fecha FROM facturas WHERE id_cliente=$id ";
$resultado = mysqli_query($con,$sql);
$row = mysqli_fetch_array($resultado);









echo $row['fecha'];
mysqli_close($con);

?>

