<?php
date_default_timezone_set("America/Santo_Domingo");
require_once ("../../../config/db.php");

session_start();
require('../../../config/routeros_api.class.php');
require('../../../config/api_mt_include2.php');

    if (isset($_GET['id'])){
        $id=intval($_GET['id']);
        $query=mysqli_query($con, "select * from users where user_id=$id");
        $rw_user=mysqli_fetch_array($query);
        $count=$rw_user['user_id'];
        
            if ($delete1=mysqli_query($con,"DELETE FROM users WHERE user_id=$id")){
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


	
    $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM users");
   
    $row= mysqli_fetch_array($count_query);
    $numrows = $row['numrows'];
   
    $sql="SELECT * FROM  users";
    $query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
            <div class="card" >

     <table class="table table-striped table-bordered table-hover" id="listuser">
        <thead>
            <tr>
                 <th>ID</th>
                <th>Nombre</th>
               
                <th>Apellido</th>
                <th>Cargo</th>
                 <th>Usuario</th>
                  <th>Cell</th>
                  
                 
                  <th>Email</th>
                <th>Nivel</th>
                <th>Estado</th>
                
                 <th>Acci??n</th>
                
                
            </tr>
        </thead>
        <tbody>
            <?php
                while ($row=mysqli_fetch_array($query)){

                  
                        $id=$row['user_id'];
                        

$nombre=$row['firstname'];
$apellido=$row['lastname'];
$usuario=$row['user_name'];
$cel = $row['cell'];
$cargo = $row['cargo'];

$correo = $row['user_email'];
$niv= $row['nivel'];
$est = $row['estado'];


if ($est=="si"){$estado="HABILITADO";$class="badge badge-success";}
                        else {$estado="DESHABILITADO";$class="badge badge-danger";}


                        if ($niv==1) {

                            $nivel="Administrador";}
                        if($niv==2) {
                            $nivel="Usuario";
                        }
                          if($niv==3) {
                            $nivel="Cobrador";
                        }
                       
                    
                      
                        
                    ?>



                
                
               
                        
                  

            <tr>
                  <td ><?php echo $id;  ?></td>
                       
                 <td ><?php echo $nombre;  ?></td>
                        <td><?php echo $apellido;?></td>
                        <td><?php echo $cargo;?></td>
                        <td><?php echo $usuario;?></td>
                    
                        <td><?php echo $cel;?></a></td>
                       
                          <td><?php echo $correo;?></a></td>
                           <td><?php echo $nivel;?></a></td>
                       <td><a href="#" class='<?php echo $class; ?>'><?php echo $estado;?></a></td>
                        
                        <td>
                           
                            <a href="#" onclick="obtener_datos('<?php echo $id;?>');" data-toggle="modal" data-target="#edituser" class='btn btn-xs btn-default css-tooltip' title='Editar Usuario'><i class="fa fa-edit"></i></a>
                            <a href="#" onclick="eliminar_usuario('<?php echo $id; ?>');" class='btn btn-xs btn-default css-tooltip' id="btneliminarc" name="btneliminarc" title='Eliminar Usuario' <?php echo $disabled ?> ><i class="fa fa-trash-o "></i></a>




                        </td>





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
                ?>
        </tbody>
        
    </table>
			<?php
		}
    
	mysqli_close($con);
?>
<script>
$(document).ready(function() {
        $('#listuser').DataTable( {


            "dom": 'Bfrtip',

            lengthMenu: [[5, 25, 50,100, -1], [ '5 Registros', '25 Registros', '50 Registros', '100 Registros', 'Mostrar todos' ] ],
           buttons: ['pageLength','colvis',
            {extend: 'collection', text: '<i class="fa fa-floppy-o"></i> <span class="caret"></span>', 
            buttons: [{extend: 'print', title:'Lista Mikrotik', text: '<i class="fa fa-print"></i> Imprimir', },
             {extend: 'csvHtml5', title:'Lista Mikrotik', text: '<i class="fa fa-file-excel-o"></i> Exportar a EXCEL', },
              {extend: 'pdfHtml5', title:'Lista Mikrotik', text: '<i class="fa fa-file-pdf-o"></i> Exportar a PDF', } ] }, 

              {text: '<i class=" update-router fa fa-refresh"></i>', } ],
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
    "sEmptyTable":     "Ning??n dato disponible en esta tabla",
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
        "sLast":     "??ltimo",
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




$( "#gduser" ).submit(function( event ) {
  $('#btnsave').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "Ajax/crear/nuevo_usuario.php",
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
$( "#edtuser" ).submit(function( event ) {
  $('#btnedit').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "Ajax/update/update_usuario.php",
            data: parametros,
             beforeSend: function(objeto){
               $('#resultados_ajax2').html('<img src="../../../images/ajax-loader.gif"> Cargando...');
            },
            success: function(datos){
              
            $("#resultados_ajax2").html(datos);
            $('#btnedit').attr("disabled", false);
            load();
          }
    });
  event.preventDefault();
})


</script>
