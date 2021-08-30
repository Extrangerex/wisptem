<?php
date_default_timezone_set("America/Santo_Domingo");
require_once 'include/db_functions.php';
 
// json response array
$response = array("error" => FALSE);

 
if (isset($_GET['usuario'])) {
 
    // receiving the post params
    $usuario = $_GET['usuario'];
    
    $query_mayor = "select max(numero_factura)+1 as mayor from facturas";
$res = mysqli_query($con,$query_mayor) or die(mysqli_error());
$row = mysqli_fetch_array($res);

$max= $row['mayor'];

 
    // get the cliente by email and password
    $cliente = buscarcliente($usuario);

	if ($cliente['usuario'] != " ") {
    
      

	   	    $response["error"] = FALSE;
        $response["cliente"]["nombres"]  =    $cliente["nombres"];
        $response["cliente"]["apellido"] =   $cliente["apellido"];
        $response["cliente"]["direcion"] =   $cliente["direcion"];
        $response["cliente"]["cell"]     =   $cliente["cell"];
         $response["cliente"]["pago_total"] = $cliente["pago_total"];
          $response["cliente"]["plan"]      =  $cliente["plan"];
           $response["cliente"]["fecha_final"] = $cliente["fecha_final"];
            $response["cliente"]["usuario"] = $cliente["usuario"];
              $response["cliente"]["id"] = $cliente["id"];
              $response["cliente"]["sector"] = $cliente["sector"];
              $response["cliente"]["numfac"] = $max;



                $fec=$cliente['fecha_final'];
    $actual=date('Y-m-d');
    $start_ts = strtotime($actual); 

    $end_ts = strtotime($fec); 

    $diff = $end_ts - $start_ts; 

    $ndias = round($diff / 86400); 
		  $response["cliente"]["ndias"] = $ndias;
		
       				 echo json_encode($response);
    	} 

    	else

    	 {
        // cliente is not found with the credentials
        $response["error"] = TRUE;
        $response["error_msg"] = "Usuario o contraseña incorrectos !";
    
        echo json_encode($response);
				 
   	}
} else {
    //required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Error de Conexion a la base de datos";
    echo json_encode($response);
}

mysqli_close($con);
?>