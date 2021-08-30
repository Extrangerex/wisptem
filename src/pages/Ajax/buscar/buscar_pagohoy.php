<?php
date_default_timezone_set("America/Santo_Domingo");
require_once ("../../../config/db.php");
require_once ("../../../config/functions.php");

session_start();



    if (isset($_GET['id'])){
        $id=intval($_GET['id']);
        $query=mysqli_query($con, "select * from planes where id=$id");
        $rw_user=mysqli_fetch_array($query);
        $count=$rw_user['id'];
        
            if ($delete1=mysqli_query($con,"DELETE FROM planes WHERE id=$id")){
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

     //$fecha = '2019-04-19';
      $fecha = date('Y-m-d');
$sql = " select f.condiciones,f.numero_factura,f.fecha_factura,c.nombres,c.apellido,f.total_venta,u.firstname,u.lastname,u.user_id from facturas f left join  clientesp c on c.id=f.id_cliente left join users u on f.id_vendedor=u.user_id where f.fecha_factura like '%$fecha%'";         
                      

                    
 


    

   
    
    $query = mysqli_query($con, $sql);
      
    
            
            ?>
          

     <table class="table table-striped table-bordered table-hover" id="listppp" >
        <thead>
            <tr>
                <th>No Factura</th>
                <th>Fecha</th>
               
                <th>Nombre</th>
              
                <th>Cobrador</th>
                
                 <th>Monto</th>
                
                
            </tr>
        </thead>
        <tbody>
            <?php
                while ($row=mysqli_fetch_array($query)){
                        $id=$row['id'];
                        $nombre=$row['nombres'];
  $apellido= $row['apellido'];
  $noma="$nombre $apellido";
  $fname = $row['firstname'];
  $lname = $row['lastname'];
  $nom = "$fname $lname";

                        



                    


 
                      
                        
                    ?>
                    

                         <tr>
             

                        <td ><?php echo $row['numero_factura'];  ?></td>
                        <td><?php echo $row['fecha_factura'];?></td>
                        <td><?php echo $noma;?></td>
                    
                       
                         <td><?php echo $nom;?></a></td>


                         <td><?php echo number_format($row['total_venta'],2);?></a></td>

                         

                         





                        <input type="hidden" value="<?php echo $nombre;?>" id="nombre<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $plan;?>" id="plan<?php echo $id;?>">
                       
                        <input type="hidden" value="<?php echo $precio;?>" id="precio<?php echo $id;?>">
                     
                      
                       
                        
                    
                        
                    </tr>
                    <?php
                }
                mysqli_close($con);
                ?>
        </tbody>
        
    </table>
<script>
$(document).ready(function() {
        $('#listppp').DataTable( {
           responsive: true,


            "dom": 'Bfrtip',

            lengthMenu: [[5, 25, 50,100, -1], [ '5 Registros', '25 Registros', '50 Registros', '100 Registros', 'Mostrar todos' ] ],
           buttons: ['pageLength','colvis',
            {extend: 'collection', text: '<i class="fa fa-floppy-o"></i> <span class="caret"></span>', 
            buttons: [{extend: 'print', title:'Lista de pagos de hoy', text: '<i class="fa fa-print"></i> Imprimir', },
             {extend: 'csvHtml5', title:'Lista de pagos de hoy', text: '<i class="fa fa-file-excel-o"></i> Exportar a EXCEL', },
              {extend: 'pdfHtml5', title:'Lista de pagos de hoy', text: '<i class="fa fa-file-pdf-o"></i> Exportar a PDF', } ] }, 

             ],
              "initComplete": function() {
$('#listppp_wrapper .dt-buttons').after('<div class="btn-group dt-btns"></div>');

$('#listppp_wrapper .dt-btns').append('<span><a type="button" href="Reportes/pagodiariohoy.php" target="_blank" class="btn btn-sm btn-primary" style="margin-left: 10px;"><i class="fa fa-plus"></i> Imprimir Reporte</a></span>');
  
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
        "sNext":     ">>",
        "sPrevious": "<<"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
}
        } );
 
    } );




</script>
