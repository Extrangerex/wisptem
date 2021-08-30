<?php
date_default_timezone_set("America/Santo_Domingo");
include('is_logged.php');
/* Connect To Database*/
require_once ("../../config/db.php");

$id = intval($_POST['id']);
$sql = "select nombres,apellido from clientesp where id=$id";

$result = mysqli_query ($con,$sql);

$row = mysqli_fetch_array($result);

$ssql="SELECT facturas.numero_factura,facturas.fecha_factura,facturas.id_vendedor,facturas.total_venta,users.firstname,users.lastname FROM facturas  left join clientesp  on facturas.id_cliente=clientesp.id left join users on facturas.id_vendedor=users.user_id where clientesp.id=$id";

$resultado = mysqli_query($con,$ssql);

$numrows =mysqli_num_rows($resultado);

if ($numrows > 0){
    $valor = $numrows;
}
else{
    $valor= "No hay facturas guardas";
}

?>

<div class="box">
                <div class="box-header with-border">
                  <strong class="box-title ">Histotial de pago de:  <a type="text" ><?php echo $row['nombres']; ?> <?php echo $row['apellido']; ?></a></strong>
                </div>
<p>&nbsp;</p>


    <div>
        <label>Total Facturas: </label>
        <a type="text" ><?php echo $valor; ?></a>
    </div>

<p>&nbsp;</p>


   <div class="box">
  		 <table id="list-usuarios-r" class="table-hover table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

            <tr class="info">
                <th>#</th>
                <th>No Factura</th>
                <th>Fecha Factura</th>
                <th>Pago</th>
                <th>Cobrador</th>

            </tr>


              <?php

              while ($data=mysqli_fetch_array($resultado)){
                  $count ++;

                  ?>

                <tr>
            <td><?php echo $count;?></td>
            <td><?php echo $data['numero_factura'];?></td>
            <td><?php echo $data['fecha_factura'];?></td>
            <td><?php echo $data['total_venta'];?></td>

            <td ><?php echo $data['firstname'];?> <?php echo $data['lastname'];?></td>


                </tr>

           <?php
           }

           mysqli_close($con);
           ?>



            </table>
   </div>
