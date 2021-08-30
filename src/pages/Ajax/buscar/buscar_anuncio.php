<?php
date_default_timezone_set("America/Santo_Domingo");
require_once ("../../../config/db.php");
require_once ("../../../config/functions.php");
session_start();
if (isset($_POST['id'])){
$id=intval($_POST['id']);
$query=mysqli_query($con, "select * from webproxy where id=$id");
$rw_user=mysqli_fetch_array($query);
$count=$rw_user['id'];

$delete1=mysqli_query($con,"DELETE FROM webproxy WHERE id=$id");


}



include('../is_logged.php');
  

$sql="SELECT * FROM  webproxy w left join clientesp c on c.id = w.iduser ";
$query = mysqli_query($con, $sql);
  
      
?>

<table class="table table-striped table-bordered table-hover" id="list-planes" style="font-size:12px;" cellpadding="1" border="0">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      
     
      <th>Html</th>
      <th>Fecha</th>
      
      
      
      <th class="all" data-orderable="false" style="min-width:46px !important;max-width:46px !important">Acción</th>
    </tr>
  </thead>
  <tbody>
    <?php
    while ($row=mysqli_fetch_array($query)){
    $id=$row['id'];
    
    $nombre=$row['nombre'];
    $apellido=$row['apellido'];
    $nombres = "$nombre $apellido";
    $html=$row['html'];
     $fecha=$row['fecha'];
    
    
    
    
    ?>
    
    <tr>
      
      <td ><?php echo $id;  ?></td>
      <td><?php echo $nombres;?></td>
      <td><?php echo $html;?></td>
      
      
      <td><?php echo $fecha;?></a></td>
      
      
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
$(function() {
planes = $('#list-planes').DataTable( {
   responsive: true,

"dom": 'Bfrtip',
lengthMenu: [[5, 25, 50,100, -1], [ '5 Registros', '25 Registros', '50 Registros', '100 Registros', 'Mostrar todos' ] ],
buttons: ['pageLength','colvis',
{extend: 'collection', text: '<i class="fa fa-floppy-o"></i> <span class="caret"></span>',
buttons: [{extend: 'print', title:'Lista Mikrotik', text: '<i class="fa fa-print"></i> Imprimir', },
{extend: 'csvHtml5', title:'Lista Mikrotik', text: '<i class="fa fa-file-excel-o"></i> Exportar a EXCEL', },
{extend: 'pdfHtml5', title:'Lista Mikrotik', text: '<i class="fa fa-file-pdf-o"></i> Exportar a PDF', } ] },
],
"initComplete": function() {
$('#list-planes_wrapper .dt-buttons').after('<div class="btn-group dt-btns"></div>');
$('#list-planes_wrapper .dt-btns').append('<span><button type="button" data-toggle="modal" data-target="#newplan" class="btn btn-sm btn-primary" style="margin-left: 10px;"><i class="fa fa-commenting"></i> Nuevo anuncio</button></span>');

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
"supdatelistingRecords": "Cargando...",
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
$( "#gdplan" ).submit(function( event ) {
$('#btnsave').attr("disabled", true);

var parametros = $(this).serialize();
$.ajax({
type: "POST",
url: "Ajax/crear/nuevo_plan.php",
data: parametros,
beforeSend: function(objeto){
msgbox("loader","Guardando ...",3);
},
success: function(datos){

$("#resultados_ajax").html(datos);
$("#gdplan")[0].reset();
$('#btnsave').attr("disabled", false);
updatelist();
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
msgbox("loader","Actualizando ...",3);
},
success: function(datos){

$("#resultados_ajax2").html(datos);
$('#btnupdate').attr("disabled", false);
updatelist();

}
});
event.preventDefault();
})
eliminar_plan=function(e,d){

swal({
title: "Estas seguro?",
text: "Si elimina un plan con clientes va perder la configuracion que está asociada a este plan!",
type: "warning",
showCancelButton: true,
confirmButtonColor: "#DD6B55",
confirmButtonText: "Si, Eliminar!",
closeOnConfirm: true },
function(){
msgbox("loader","procesando...",0);
$.post( "Ajax/buscar/buscar_plan.php", {id: e})
.done(function( datas ) {
$('.notydiv').remove();
msgbox("success","Plan Eliminado correctamente",3);

updatelist();

});
});

}
updatelist=function(){


}
</script>