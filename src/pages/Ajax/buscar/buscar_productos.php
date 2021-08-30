<?php
date_default_timezone_set("America/Santo_Domingo");
require_once ("../../../config/db.php");
require_once ("../../../config/functions.php");

session_start();



    if (isset($_GET['id'])){
        $id=intval($_GET['id']);
        $query=mysqli_query($con, "select * from productos where id=$id");
        $rw_user=mysqli_fetch_array($query);
        $count=$rw_user['id'];
        
            if ($delete1=mysqli_query($con,"DELETE FROM productofs WHERE id=$id")){
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


	
   
  
   
    $sql="SELECT * FROM  productos";
    $query = mysqli_query($con, $sql);

			
			?>
           

     <table class="table table-striped table-bordered table-hover" id="lstproductos" style="font-size:12px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Codigo</th>
               
                <th>Descripcion</th>
                <th>Precio Compra</th>
                <th>Precio Venta</th>
                
                
                 <th>Existencia</th>
                
                  <th class="all" data-orderable="false" style="min-width:46px !important;max-width:46px !important">Acción</th>
                            
                
                
            </tr>
        </thead>
        <tbody>
            <?php
                while ($row=mysqli_fetch_array($query)){
                        $id=$row['id'];
                        

            $codigo=$row['codigo'];
$descripcion=$row['descripcion'];

$preciov=$row['precioVenta'];
$precioc=$row['precioCompra'];
$cant=$row['existencia'];





                    


 
                      
                        
                    ?>
                    

                         <tr>
             

                        <td ><?php echo $id;  ?></td>
                        <td><?php echo $codigo;?></td>
                        <td><?php echo $descripcion;?></td>
                    
                       
                         <td><?php echo $precioc;?></a></td>
                         <td><?php echo $preciov;?></a></td>
                          <td><?php echo $cant;?></a></td>
                        

                          <td >
                          
                           
                            <a href="#" onclick="obtener_producto('<?php echo $id;?>');" data-toggle="modal" data-target="#editProducto" class='btn btn-xs btn-default css-tooltip' title='Editar plan'><i class="fa fa-edit"></i></a>
                            
                            <a href="#" onclick="eliminar_producto('<?php echo $id; ?>');" class='btn btn-xs btn-default css-tooltip' id="btneliminarP" name="btneliminarP" title='Eliminar plan' <?php echo $disabled ?> ><i class="fa fa-trash-o "></i></a>




                         </td>





                        <input type="hidden" value="<?php echo $descripcion;?>" id="descripcion<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $codigo;?>" id="codigo<?php echo $id;?>">
                       
                        <input type="hidden" value="<?php echo $precioc;?>" id="precioc<?php echo $id;?>">
                         <input type="hidden" value="<?php echo $preciov;?>" id="preciov<?php echo $id;?>">
                          <input type="hidden" value="<?php echo $cant;?>" id="cant<?php echo $id;?>">
                     
                      
                       
                        
                    
                        
                    </tr>
                    <?php
                }
                mysqli_close($con);
                ?>
        </tbody>
        
    </table>
			
    
	

<script>
$(document).ready(function() {
        $('#lstproductos').DataTable( {
          responsive: true,


            "dom": 'Bfrtip',

            lengthMenu: [[25, 45, 60,100, -1], [ '25 Registros', '45 Registros', '60 Registros', '100 Registros', 'Mostrar todos' ] ],
           buttons: ['pageLength','colvis',
            {extend: 'collection', text: '<i class="fa fa-floppy-o"></i> <span class="caret"></span>', 
            buttons: [{extend: 'print', title:'Lista Producto', text: '<i class="fa fa-print"></i> Imprimir', },
             {extend: 'csvHtml5', title:'Lista Producto', text: '<i class="fa fa-file-excel-o"></i> Exportar a EXCEL', },
              {extend: 'pdfHtml5', title:'Lista Producto', text: '<i class="fa fa-file-pdf-o"></i> Exportar a PDF', } ] }, 

          ],
              "initComplete": function() {
$('#lstproductos_wrapper .dt-buttons').after('<div class="btn-group dt-btns"></div>');

$('#lstproductos_wrapper .dt-btns').append('<span><button type="button" data-toggle="modal" data-target="#newproducto" class="btn btn-sm btn-primary" style="margin-left: 10px;"><i class="fa fa-plus"></i> Nuevo Producto</button></span>');
  
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
