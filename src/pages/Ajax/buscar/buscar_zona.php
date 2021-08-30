<?php
date_default_timezone_set("America/Santo_Domingo");
require_once ("../../../config/db.php");
require_once ("../../../config/functions.php");

session_start();



    if (isset($_POST['id'])){
        $id=intval($_POST['id']);
        $query=mysqli_query($con, "select * from sector where id_sec=$id");
        $rw_user=mysqli_fetch_array($query);
        $count=$rw_user['id'];
        
            if ($delete1=mysqli_query($con,"DELETE FROM sector WHERE id_sec=$id")){
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


	
   
    $sql="SELECT * FROM  sector";
    $query = mysqli_query($con, $sql);
	
			
			?>
           

     <table class="table table-striped table-bordered table-hover" id="listsector" style="font-size:12px;" >
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Abreviacion</th>
               
                <th>Activos</th>
                <th>Suspendidos</th>
              
                
                 <th class="all" data-orderable="false" style="min-width:46px !important;max-width:46px !important">Acción</th>
                
                
            </tr>
        </thead>
        <tbody>
            <?php
                while ($row=mysqli_fetch_array($query)){
                        $id=$row['id_sec'];
                        

            $nombre=$row['nombre'];
$abreviacion=$row['abreviacion'];





                    


 
                      
                        
                    ?>
                    

                         <tr>
             

                        <td ><?php echo $id;  ?></td>
                        <td><?php echo $nombre;?></td>
                        <td><?php echo $abreviacion;?></td>
                    
                       
                         
                         <td><span class="badge badge-success"><?php echo buscar_activozona($abreviacion);?></span></td>
                         <td><span class="badge badge-danger"><?php echo buscar_suspendidozona($abreviacion);?></span></td>
                         

                          <td >
                          
                           
                            <a href="#" onclick="obtener_datos('<?php echo $id;?>');" data-toggle="modal" data-target="#edtsector" class='btn btn-xs btn-default css-tooltip' title='Editar sector'><i class="fa fa-edit"></i></a>
                            
                            <a href="#" onclick="eliminar_zona('<?php echo $id; ?>');" class='btn btn-xs btn-default css-tooltip' id="btneliminarc" name="btneliminarc" title='Eliminar sector' <?php echo $disabled ?> ><i class="fa fa-trash-o "></i></a>




                         </td>





                        <input type="hidden" value="<?php echo $nombre;?>" id="nombre<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $abreviacion;?>" id="abreviacion<?php echo $id;?>">
                       
                        
                     
                      
                       
                        
                    
                        
                    </tr>
                    <?php
                }
                mysqli_close($con);
                ?>
        </tbody>
        
    </table>
		
<script>
$(function() {
zonas = $('#listsector').DataTable( {
   responsive: true,
"dom": 'Bfrtip',
lengthMenu: [[5, 25, 50,100, -1], [ '5 Registros', '25 Registros', '50 Registros', '100 Registros', 'Mostrar todos' ] ],
buttons: ['pageLength','colvis',
{extend: 'collection', text: '<i class="fa fa-floppy-o"></i> <span class="caret"></span>',
buttons: [{extend: 'print', title:'Lista zonas', text: '<i class="fa fa-print"></i> Imprimir', },
{extend: 'csvHtml5', title:'Lista zonas', text: '<i class="fa fa-file-excel-o"></i> Exportar a EXCEL', },
{extend: 'pdfHtml5', title:'Lista zonas', text: '<i class="fa fa-file-pdf-o"></i> Exportar a PDF', } ] },
],
"initComplete": function() {
$('#listsector_wrapper .dt-buttons').after('<div class="btn-group dt-btns"></div>');
$('#listsector_wrapper .dt-btns').append('<span><button type="button" data-toggle="modal" data-target="#newsector" class="btn btn-sm btn-primary" style="margin-left: 10px;"><i class="fa fa-plus"></i> Nueva zona</button></span>');

},



"bsort": true,
"paging": true,
"forceResponsive": true,
"deferRender": true,
"stateSave": true,
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



$( "#gdsector" ).submit(function( event ) {
  $('#btnsave').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "Ajax/crear/nuevo_sector.php",
            data: parametros,
             beforeSend: function(objeto){
               $('#resultados_ajax').html('<img src="../../../images/loader.gif"> Guardando...');
            },
            success: function(datos){
              
            $("#resultados_ajax").html(datos);
            $("#gdsector")[0].reset();
            $('#btnsave').attr("disabled", false);
            load();
          }
    });
  event.preventDefault();
})
$( "#updatesector" ).submit(function( event ) {
  $('#btnupdate').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "Ajax/update/update_sector.php",
            data: parametros,
             beforeSend: function(objeto){
               $('#resultados_ajax2').html('<img src="../../../images/loader.gif"> Actualizando...');
            },
            success: function(datos){
              
            $("#resultados_ajax2").html(datos);
            $('#btnupdate').attr("disabled", false);
            load();
          }
    });
  event.preventDefault();
})
eliminar_zona=function(e){

swal({
title: "Estas seguro?",
text: "Si elimina una zona con clientes va perder la configuracion que está asociada a esta zona!",
type: "warning",
showCancelButton: true,
confirmButtonColor: "#DD6B55",
confirmButtonText: "Si, Eliminar!",
closeOnConfirm: true },
function(){
msgbox("loader","procesando...",0);
$.post( "Ajax/buscar/buscar_zona.php", {id: e})
.done(function( datas ) {
$('.notydiv').remove();
msgbox("success","Plan Eliminado correctamente",3);

load();

});
});

}
updatelist=function(){
planes.ajax.reload();

}

</script>
