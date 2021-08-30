<?php
date_default_timezone_set("America/Santo_Domingo");
require_once 'include/db_functions.php';

require_once 'include/db_functions.php';
$response = array("error" => FALSE);
 


$idfac = $_GET['idfac'];
$id = intval($idfac);





        
        $consulta="select f.numero_factura,f.fecha_factura,c.cell,c.id,c.usuario,c.fecha_final,c.plan,c.sector,c.id,c.nombres,c.apellido,c.direcion,f.total_venta,u.firstname,u.lastname from facturas f left join  clientesp c on c.id=f.id_cliente left join users u on f.id_vendedor=u.user_id where f.numero_factura=$id";
        $resultado=mysqli_query($con,$consulta);

        if($resultado){
        
            $cliente = mysqli_fetch_array($resultado);
    	
       	   $response["error"] = FALSE;
       	   $fname = $cliente["firstname"];
       	   $lname = $cliente["lastname"];
       	   $name = "$fname $lname";
       	   $response["cliente"]["id"] = $cliente["id"];
        $response["cliente"]["nombres"]  =   $cliente["nombres"];
        $response["cliente"]["apellido"] =   $cliente["apellido"];
        $response["cliente"]["direcion"] =   $cliente["direcion"];
        $response["cliente"]["cell"]     =   $cliente["cell"];
         $response["cliente"]["pago_total"] = $cliente["total_venta"];
          $response["cliente"]["plan"]      =  $cliente["plan"];
           $response["cliente"]["fecha_final"] = $cliente["fecha_final"];
            $response["cliente"]["usuario"] = $cliente["usuario"];
              $response["cliente"]["id"] = $cliente["id"];
              $response["cliente"]["sector"] = $cliente["sector"];
              $response["cliente"]["fecfac"] = $cliente["fecha_factura"];
              $response["cliente"]["numero_factura"] = $cliente["numero_factura"];
              $response["cliente"]["cobrador"] = $name;

         


            echo json_encode($response);
               mysqli_close($con);
        }

  
    	

?>