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
        
            if ($delete1=mysqli_query($con,"DELETE FROM lstcategoria WHERE id=$id")){
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


	
    $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM categoria_producto");
   
    $row= mysqli_fetch_array($count_query);
    $numrows = $row['numrows'];
   
    $sql="SELECT * FROM  categoria_producto";
    $query = mysqli_query($con, $sql);
		//loop through fetched data
	
			
			?>
           

     <table class="table table-striped table-bordered table-hover" id="lstcategoria" style="font-size:10px;" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Productos</th>
               
                <th>Descripcion</th>
                <th>Tipo</th>
                <th>Disponibles</th>
                
                 <th> </th>
                
                
            </tr>
        </thead>
        <tbody>
            <?php
                while ($row=mysqli_fetch_array($query)){
                        $id=$row['id'];
                        

            $nombre=$row['nombre'];
$plan=$row['plan'];

$precio=$row['precio'];




                    


 
                      
                        
                    ?>
                    

                         <tr>
             

                        <td ><?php echo $id;  ?></td>
                        <td><?php echo $nombre;?></td>
                        <td><?php echo $plan;?></td>
                    
                       
                         <td><?php echo $precio;?></a></td>
                         <td><span class="badge badge-success"><?php echo buscar_numcli($plan);?></span></td>
                         

                          <td >
                          
                           
                            <a href="#" onclick="obtener_datos('<?php echo $id;?>');" data-toggle="modal" data-target="#editplan" class='btn btn-xs btn-default css-tooltip' title='Editar plan'><i class="fa fa-edit"></i></a>
                            
                            <a href="#" onclick="eliminar_plan('<?php echo $id; ?>');" class='btn btn-xs btn-default css-tooltip' id="btneliminarc" name="btneliminarc" title='Eliminar plan' <?php echo $disabled ?> ><i class="fa fa-trash-o "></i></a>




                         </td>





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
        $('#lstcategoria').DataTable( {


            "dom": 'Bfrtip',

            lengthMenu: [[5, 25, 50,100, -1], [ '5 Registros', '25 Registros', '50 Registros', '100 Registros', 'Mostrar todos' ] ],
           buttons: ['pageLength','colvis',
            {extend: 'collection', text: '<i class="fa fa-floppy-o"></i> <span class="caret"></span>', 
            buttons: [{extend: 'print', title:'Lista Mikrotik', text: '<i class="fa fa-print"></i> Imprimir', },
             {extend: 'csvHtml5', title:'Lista Mikrotik', text: '<i class="fa fa-file-excel-o"></i> Exportar a EXCEL', },
              {extend: 'pdfHtml5', title:'Lista Mikrotik', text: '<i class="fa fa-file-pdf-o"></i> Exportar a PDF', } ] }, 

              {text: '<i class=" update-router fa fa-refresh"></i>', } ],
              "initComplete": function() {
$('#lstcategoria_wrapper .dt-buttons').after('<div class="btn-group dt-btns"></div>');

$('#lstcategoria_wrapper .dt-btns').append('<span><button type="button" data-toggle="modal" data-target="#newCategoria" class="btn btn-sm btn-primary" style="margin-left: 10px;"><i class="fa fa-plus"></i> Nueva categoria</button></span>');
  
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




$( "#gdplan" ).submit(function( event ) {
  $('#btnsave').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "Ajax/crear/nuevo_plan.php",
            data: parametros,
             beforeSend: function(objeto){
               $('#resultados_ajax').html('<img src="../../../images/ajax-loader.gif"> Cargando...');
            },
            success: function(datos){
              
            $("#resultados_ajax").html(datos);
            $('#btnsave').attr("disabled", false);
            load();
          }
    });
  event.preventDefault();
})
$( "#updateplan" ).submit(function( event ) {
  $('#btnupdate').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "Ajax/update/update_plan.php",
            data: parametros,
             beforeSend: function(objeto){
               $('#resultados_ajax2').html('<img src="../../../images/ajax-loader.gif"> Cargando...');
            },
            success: function(datos){
              
            $("#resultados_ajax2").html(datos);
            $('#btnupdate').attr("disabled", false);
            load();
          }
    });
  event.preventDefault();
})


</script>
