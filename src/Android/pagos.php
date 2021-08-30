<?php
date_default_timezone_set("America/Santo_Domingo");
require_once 'include/db_functions.php';



 


$id=$_GET['id'];
    
$date=date("Y-m-d");
        
        $consulta="select f.numero_factura,f.fecha_factura,c.cell,c.id,c.nombres,c.apellido,f.total_venta from facturas f left join  clientesp c on c.id=f.id_cliente left join users u on f.id_vendedor=u.user_id where f.fecha_factura like '%".$date."%' and id_vendedor='".$id."'  order by numero_factura desc";
        $resultado=mysqli_query($con,$consulta);

        if($resultado){
        
             while($row = mysqli_fetch_array($resultado))
    			{
       				 $response[] = $row;
       					
   				 }

         


            echo json_encode($response);
               mysqli_close($con);
        }

  
    	

?>