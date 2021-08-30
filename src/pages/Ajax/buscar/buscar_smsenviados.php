<?php
date_default_timezone_set("America/Santo_Domingo");
require_once ("../../../config/db.php");


require_once ("../../../config/functions.php");


session_start();

$res = mysqli_query($con,"select * from sms_gateway where id=1");
$gateway = mysqli_fetch_array($res);
$api = $gateway['api'];
$numero= $gateway['numero'];

	
    
   
    $sql="SELECT * FROM  mensajes, clientesp where clientesp.id = mensajes.id_cliente ";
    $query = mysqli_query($con, $sql);
		
			
			?>
            
     <table class="table table-striped table-bordered table-hover" id="listsms">
        <thead>
            <tr>
                 <th>ID</th>
                <th>Cliente</th>
               
               
                <th>Fecha</th>
                 <th>Nº Destino</th>
                  <th>Estado</th>
                  
                 
                  <th>Mensaje</th>
               
                
                 
                
                
            </tr>
        </thead>
        <tbody>
            <?php
                while ($row=mysqli_fetch_array($query)){

                  
                        $id=$row['id_mensaje'];
                        

$nombre=$row['nombres'];
$apellido=$row['apellido'];
$fecha=$row['fecha'];
$cel = $row['cell'];
$estadp = "";

$mensaje = $row['mensaje'];


$status = $message["status"];

if ($status=="sent"){$estado="sent";$class="badge badge-success badge-sm";}
if ($status=="failed") {$estado="failed";$class="badge badge-danger badge-sm";}


                        
                    
                      
                        
                    ?>



                
                
               
                        
                  

            <tr>
                     <td ><?php echo $id;  ?></td>
                       
                       <td ><?php echo $nombre;  ?> <?php echo $apellido;?></td>
                        
                        <td><?php echo $fecha;?></td>
                        <td><?php echo $cel;?></td>
                    
                         <td><a href="#" class='<?php echo $class; ?>'><?php echo $estado;?></a></td>
                       
                          <td><?php echo $mensaje;?></a></td>
                        
                        
                      




                        <input type="hidden" value="<?php echo $nombre;?>" id="nombre<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $apellido;?>" id="apellido<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $cel;?>" id="cel<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $usuario;?>" id="usuario<?php echo $id;?>">
                     
                        <input type="hidden" value="<?php echo $correo;?>" id="correo<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $niv;?>" id="niv<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $est;?>" id="est<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $cargo;?>" id="cargo<?php echo $id;?>">
                       
                       
                        
                    
                        
                    </tr>
                    <?php
                }
                mysqli_close($con);
                ?>
        </tbody>
        
    </table>
		
<script>
$(document).ready(function() {
        $('#listsms').DataTable( {


            "dom": 'Bfrtip',

            lengthMenu: [[5, 25, 50,100, -1], [ '5 Registros', '25 Registros', '50 Registros', '100 Registros', 'Mostrar todos' ] ],
           buttons: ['pageLength','colvis',
            {extend: 'collection', text: '<i class="fa fa-floppy-o"></i> <span class="caret"></span>', 
            buttons: [{extend: 'print', title:'Lista Sms Enviados', text: '<i class="fa fa-print"></i> Imprimir', },
             {extend: 'csvHtml5', title:'Lista Sms Enviados', text: '<i class="fa fa-file-excel-o"></i> Exportar a EXCEL', },
              {extend: 'pdfHtml5', title:'Lista Sms Enviados', text: '<i class="fa fa-file-pdf-o"></i> Exportar a PDF', } ] }, 

              {text: '<i class=" update-router fa fa-refresh"></i>', } ],
              "initComplete": function() {
$('#listsms_wrapper .dt-buttons').after('<div class="btn-group dt-btns"></div>');

$('#listsms_wrapper .dt-btns').append('<span><button type="button" data-toggle="modal" data-target="#newsms" class="btn btn-sm btn-success" style="margin-left: 10px;"><i class="fa fa-send"></i> Enviar SMS</button></span>');
$('#listsms_wrapper .dt-btns').append('<span><button type="button" data-toggle="modal" data-target="#newsmszone" class="btn btn-sm btn-success" style="margin-left: 10px;"><i class="fa fa-send"></i> Enviar SMS x Sector</button></span>');
  
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




$( "#gdsms" ).submit(function( event ) {
  $('#btnsave').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "Ajax/crear/nuevo_sms.php",
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
$( "#gdsmsZ" ).submit(function( event ) {
  $('#btnsaveZ').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "Ajax/crear/nuevo_smsZ.php",
            data: parametros,
             beforeSend: function(objeto){
               $('#resultados_ajax').html('<img src="../../../images/ajax-loader.gif"> Cargando...');
            },
            success: function(datos){
              
            $("#resultados_ajax").html(datos);
            $('#btnsaveZ').attr("disabled", false);
            load();
          }
    });
  event.preventDefault();
})



 function maximo(){
if($("#mensaje").val().length>=460){
$('#mensaje').val($("#mensaje").val().substring(0,460));
 }
$('.counter').html('Caracteres <b>'+$("#mensaje").val().length+'/460</b>');
}

$('.counter').html('Caracteres <b>'+$("#mensaje").val().length+'/460</b>');
 function maximoZ(){
if($("#mensajeZ").val().length>=460){
$('#mensajeZ').val($("#mensajeZ").val().substring(0,460));
 }
$('.counterZ').html('Caracteres <b>'+$("#mensajeZ").val().length+'/460</b>');
}
$('.counterZ').html('Caracteres <b>'+$("#mensaje").val().length+'/460</b>');
</script>
