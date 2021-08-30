<?php
date_default_timezone_set("America/Santo_Domingo");
require_once ("../../../config/db.php");

session_start();

    if (isset($_GET['id'])){
        $id=intval($_GET['id']);
   
    }

             
                          

                    





    include('../is_logged.php');


	
   
   
    $ssql="SELECT facturas.numero_factura,facturas.fecha_factura,facturas.id_vendedor,facturas.total_venta,users.firstname,users.lastname FROM facturas  left join clientesp  on facturas.id_cliente=clientesp.id left join users on facturas.id_vendedor=users.user_id where clientesp.id=$id ";
    $query = mysqli_query($con, $ssql);
	
			
			?>
           
     <table class="table table-striped table-bordered table-hover" id="listfac" style="font-size:14px">
        <thead>
            <tr>
                <th>#</th>
                <th>No Factura</th>
                <th>Fecha Factura</th>
                <th>Pago</th>
                <th>Cobrador</th>
                
                
            </tr>
        </thead>
        <tbody>
            <?php
                while ($data=mysqli_fetch_array($query)){

                  
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
        </tbody>
        
    </table>
		
<script>
$(document).ready(function() {
        $('#listfac').DataTable( {


            "dom": 'Bfrtip',

            lengthMenu: [[5, 25, 50,100, -1], [ '5 Registros', '25 Registros', '50 Registros', '100 Registros', 'Mostrar todos' ] ],
           buttons: ['pageLength','colvis',
            {extend: 'collection', text: '<i class="fa fa-floppy-o"></i> <span class="caret"></span>', 
            buttons: [{extend: 'print', title:'Lista Mikrotik', text: '<i class="fa fa-print"></i> Imprimir', },
             {extend: 'csvHtml5', title:'Lista Mikrotik', text: '<i class="fa fa-file-excel-o"></i> Exportar a EXCEL', },
              {extend: 'pdfHtml5', title:'Lista Mikrotik', text: '<i class="fa fa-file-pdf-o"></i> Exportar a PDF', } ] }, 

               ],
              "initComplete": function() {
$('#listuser_wrapper .dt-buttons').after('<div class="btn-group dt-btns"></div>');

$('#listuser_wrapper .dt-btns').append('<span><button type="button" data-toggle="modal" data-target="#newuser" class="btn btn-sm btn-primary" style="margin-left: 10px;"><i class="fa fa-plus"></i> Nuevo Usuario</button></span>');
  
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
