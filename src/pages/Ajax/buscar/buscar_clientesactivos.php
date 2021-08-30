<?php
date_default_timezone_set("America/Santo_Domingo");
require_once ("../../../config/db.php");
include ("../../../config/functions.php");

session_start();

require('../../../config/api_mt_include2.php');



$nivel=$_SESSION['nivel'];
if ($nivel != 1){
    $disabled = "disabled";
}
function Diff($start, $end) {

    $start_ts = strtotime($start);

    $end_ts = strtotime($end);

    $diff = $end_ts - $start_ts;

    return round($diff / 86400);

}
 


    if (isset($_GET['id'])){
        $id=intval($_GET['id']);
        $query=mysqli_query($con, "select * from clientesp where id=$id");
        $rw_user=mysqli_fetch_array($query);
        $count=$rw_user['user_id'];
        
            if ($delete1=mysqli_query($con,"DELETE FROM clientesp WHERE id=$id")){
            ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> Datos eliminados exitosamente.
            </div>
            <?php 
        }else {
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
            </div>
            <?php
            
        }
    }

             
                          

                    





    include('../is_logged.php');


    
   
   
    $sql="SELECT * FROM  clientesp,mikrotik  where clientesp.id_mk = mikrotik.idmikrotik and  disable='no'";
    $query = mysqli_query($con, $sql);
       
            
            ?>
         

     <table class="table table-striped table-bordered table-hover" id="listactive"  style="font-size:12px;">
        <thead>
            <tr>
               <th >ID</th>
          <th >Nombre</th>
          <th >Mac</th>
          <th >Instalado</th>
       
          <th >Movil</th>
          <th >Telefono</th>
                    <th >Usuario</th>
                    <th >Nodo</th>

          <th >Plan</th>
                    <th >Monto</th>
          <th >Proximo pago</th>
           
                    <th>Accion</th>
                
                
            </tr>
        </thead>
        <tbody>
            <?php
                while ($row=mysqli_fetch_array($query)){

                  
                      $id=$row['id'];
            

$nombre=$row['nombres'];
$cell=$row['cell'];
$cell2=$row['cell2'];
$direccion=$row['direcion'];
$comentario=$row['comentario'];
$categoria=$row['categoria'];
$pago=$row['pago_total'];
$fechainicial=$row['fecha_inicial'];
$fechafinal=$row['fecha_final'];
$dias=$row['dias_p'];
$apellido= $row['apellido'];
$disable=$row['disable'];
$password=$row['password'];
$documento= $row['documento'];
$usuario=  $row['usuario'];
$plan=  $row['plan'];
$mac=  $row['mac'];
$poste= $row['poste'];
$sector=$row['sector'];
$pagoinstalacion=$row['pago_instalacion'];
$remoteaddress=$row['remoteaddress'];
$empleado=$row['id_empleado'];
$nodo=$row['nodo'];

$today = date("Y-m-d");

$day=Diff($fechafinal,$today);


       
                      
                        
                    ?>



                
                
               
                        
                  

            <tr>
                <td><i class="fa fa-edit fa-xs"></i><a href="perfil.php?id=<?php echo $id; ?> " title='Editar cliente' > <?php echo $id; ?></a> </td>

            <td ><?php echo $nombre; ?> <?php echo $apellido; ?></td>
            <td><?php echo $mac;?></td>
            <td><?php echo $fechainicial;?></td>
            <td><?php echo $cell;?></td>
            <td><?php echo $cell2;?></td>
         
                        <td><?php echo $usuario;?></td>
                        <td><?php echo $nodo; ?></td>
            <td><?php echo $plan;?></td>
                        <td><?php echo $pago;?></td>
            <td><?php echo $fechafinal;?></td>
          
                        <td>
                              <a href="#" onclick="Suspender('<?php echo $id; ?>');" class='btn btn-sm btn-default' id="btneliminarc" name="btneliminarc" title='Suspender servicio' ><i class="fa fa-times"></i></a>
                            <a href="Reportes/cobro.php?id=<?php echo $id; ?>" target="_blank"class='btn btn-sm btn-default' title='Descargar factura'><i class="fa fa-download"></i></a>
                             <a href="#" onclick="send_sms('<?php echo $id;?>');" data-toggle="modal" data-target="#sendSms" class='btn btn-xs btn-default' title='enviar mensaje'><i class="fa fa-whatsapp fa-fw"></i></a>
                            
                            <a href="#" onclick="eliminar_cliente('<?php echo $id; ?>');" class='btn btn-sm btn-default' id="btneliminarc" name="btneliminarc" title='Eliminar Cliente' <?php echo $disabled ?> ><i class="fa fa-trash-o"></i></a>


                        </td>




                      
                       
                       
                        
                    
                        
                    </tr>
                    <?php
                }
                mysqli_close($con);
                ?>
        </tbody>
        
    </table>
            
<script>
$(document).ready(function() {
        $('#listactive').DataTable( {


            "dom": 'Bfrtip',

            lengthMenu: [[5, 25, 50,100, -1], [ '5 Registros', '25 Registros', '50 Registros', '100 Registros', 'Mostrar todos' ] ],
           buttons: ['pageLength','colvis',
            {extend: 'collection', text: '<i class="fa fa-floppy-o"></i> <span class="caret"></span>', 
            buttons: [{extend: 'print', title:'Lista Mikrotik', text: '<i class="fa fa-print"></i> Imprimir', },
             {extend: 'csvHtml5', title:'Lista Mikrotik', text: '<i class="fa fa-file-excel-o"></i> Exportar a EXCEL', },
              {extend: 'pdfHtml5', title:'Lista Mikrotik', text: '<i class="fa fa-file-pdf-o"></i> Exportar a PDF', } ] }, 

              {text: '<i class=" update-router fa fa-refresh"></i>', } ],
              "initComplete": function() {
$('#listactive_wrapper .dt-buttons').after('<div class="btn-group dt-btns"></div>');

$('#listactive_wrapper .dt-btns').append('<span><button type="button" data-toggle="modal" data-target="#newCliente" class="btn btn-sm btn-primary" style="margin-left: 10px;"><i class="fa fa-plus"></i> Nuevo Cliente</button></span>');
  
 },
               



           

            
            "bsort": true,
            "paging": true,
             "forceResponsive": true,



          
            "stateSave": true,
            "stateDuration": 0,
            "oLanguage": {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de 0 registros",
    "sInfoFiltered":   "(filtrado de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
}
        } );
 
    } );





</script>
