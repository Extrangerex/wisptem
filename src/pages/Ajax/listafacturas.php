<?php
require_once ("../../config/db.php");
$action = $_GET['action'];
$query ="SELECT f.numero_factura,f.fecha_factura,f.id_cliente,concat(c.nombres,' ',c.apellido) AS nombrecli,f.total_venta,
CONCAT(u.firstname,' ',u.lastname) AS nombrecobrador FROM facturas f LEFT JOIN clientesp c ON c.id=f.id_cliente 
LEFT JOIN users u ON u.user_id=f.id_vendedor order by numero_factura desc";
$resultado = mysqli_query($con,$query);
if ( !$resultado) {
	die("Error");
}else{
	while ($data = mysqli_fetch_assoc($resultado)) {

		$array["data"][] = $data;
	}
	
}
echo json_encode($array);
mysqli_close($con);
?>