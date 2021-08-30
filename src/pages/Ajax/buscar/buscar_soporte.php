<?php
date_default_timezone_set("America/Santo_Domingo");
require_once ("../../../config/db.php");

session_start();
require('../../../config/routeros_api.class.php');
require('../../../config/api_mt_include2.php');

                $id=intval($_GET['id']);

                    
  $id=intval($_GET['q']);



    include('../is_logged.php');


	
    $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM mikrotik where idmikrotik=1");
   
    $row= mysqli_fetch_array($count_query);
    $numrows = $row['numrows'];
   
    $sql="SELECT * FROM  mikrotik where idmikrotik=1";
    $query = mysqli_query($con, $sql);
    $row=mysqli_fetch_array($query);
     $nodo=$row['nodo'];
                        $mk_ip=$row['ip'];
                        $modelo=$row['modelo'];
                        $mk_usuario = $row['usuario'];
                        $mk_password = $row['password'];
                        $mk_puerto = $row['puerto'];
                        $estado="conectado";
                        $interface = $row['interface'];

                       
		//loop through fetched data
		if ($numrows>0){
			
			?>
              <div class="card-header bg-dark">
                    <strong class="card-title text-light"><i class="fa fa-list"></i> Active Connections Nodo <?php echo $nodo; ?></strong>
                </div>
            <div class="card-body" >

     <table class="table table-striped table-bordered table-hover" id="listmk">
        <thead>
            <tr>
                <th>Usuario </th>
                <th>Nombre </th>
                 <th>Poste</th>


                 <th>MAC</th>
                  <th>IP </th>
                 <th>Ping </th>
                 <th>Tiempo Conexi&oacute;n</th>
                
                
            </tr>
        </thead>
        <tbody>
           <?php


$total=0;

    $API = new routeros_api();
    $API->debug = false;

     $API-$API->connect($mk_ip, $mk_usuario, $mk_password, $mk_puerto);
                        $API->write("/ppp/secret/getall",true);

                        $READ = $API->read(false);
                        $ARRAY = $API->parse_response($READ);
                        if(count($ARRAY)>0){   // si hay mas de 1 queue.
                            for($x=0;$x<count($ARRAY);$x++){
                $total=$total+1;

    $nam= $ARRAY[$x]['name'];
               $sql=mysqli_query($con, "select * from clientesp where usuario='$nam'");




                $row=mysqli_fetch_array($sql);



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
                                $mac=  $ARRAY[$x]['address'];
                                $poste= $row['poste'];
                                $sector=$row['sector'];
                                $pagoinstalacion=$row['pago_instalacion'];
                                $remoteaddress=$row['remoteaddress'];
                                $empleado=$row['id_empleado'];
                                $id=$row['id'];
                                $lastl = "mamaguebo";








                                if (empty($row['usuario'])) {

                    $colour="red";
                    $modal = "#nuevoCliente";


                }
                    else{
                        $colour="green";
                        $modal="#myModaledit";

                }



                             ?>


                                <tr>
                                    <td>

                                        <input type="hidden" value="<?php echo $nombre;?>" id="nombre<?php echo $id;?>">
                                        <input type="hidden" value="<?php echo $apellido;?>" id="apellido<?php echo $id;?>">
                                        <input type="hidden" value="<?php echo $cell;?>" id="cell<?php echo $id;?>">
                                        <input type="hidden" value="<?php echo $cell2;?>" id="cell2<?php echo $id;?>">
                                        <input type="hidden" value="<?php echo $direccion;?>" id="direccion<?php echo $id;?>">
                                        <input type="hidden" value="<?php echo $comentario;?>" id="comentario<?php echo $id;?>">
                                        <input type="hidden" value="<?php echo $categoria;?>" id="categoria<?php echo $id;?>">
                                        <input type="hidden" value="<?php echo $pago;?>" id="pago<?php echo $id;?>">
                                        <input type="hidden" value="<?php echo $fechainicial;?>" id="fechainicial<?php echo $id;?>">
                                        <input type="hidden" value="<?php echo $fechafinal;?>" id="fechafinal<?php echo $id;?>">
                                        <input type="hidden" value="<?php echo $dias;?>" id="dias<?php echo $id;?>">
                                        <input type="hidden" value="<?php echo $password;?>" id="password<?php echo $id;?>">
                                        <input type="hidden" value="<?php echo $ARRAY[$x]['name'];?>" id="usuario<?php echo $id;?>">
                                        <input type="hidden" value="<?php echo $plan;?>" id="plan<?php echo $id;?>">
                                        <input type="hidden" value="<?php echo $poste;?>" id="poste<?php echo $id;?>">
                                        <input type="hidden" value="<?php echo $sector;?>" id="sector<?php echo $id;?>">
                                        <input type="hidden" value="<?php echo $ARRAY[$x]['address'];?>" id="remoteaddress<?php echo $id;?>">
                                        <input type="hidden" value="<?php echo $empleado;?>" id="empleado<?php echo $id;?>">
                                        <input type="hidden" value="<?php echo $pagoinstalacion;?>" id="pagoinstalacion<?php echo $id;?>">
                                         <input type="hidden" value="<?php echo $lastl;?>" id="lastl<?php echo $id;?>">
                                         

                                        <input type="hidden" value="<?php echo $documento;?>" id="documento<?php echo $id;?>">
                                        <input type="hidden" value="<?php echo $ARRAY[$x]['caller-id']; ?>" id="mac<?php echo $id;?>">
                                        <input type="hidden" value="<?php echo $disable;?>" id="disable<?php echo $id;?>">
                                       





                                        <div><font color="<?php echo $colour ?>" face="Comic Sans MS,arial">
                                            <a href="#" data-target="<?php echo $modal; ?>" data-toggle="modal" onclick="obtener_datos('<?php echo $id;?>');"  >
                                                <div>
                                                    <?php echo $ARRAY[$x]['name']; ?>
                                                    </font>
                                                </div>
                                        </td>
                                        <td>
                                            <?php echo $row['nombres'];?> <?php echo $row['apellido'];?>
                                        </td>
                                        <td>
                                            <?php echo $ARRAY[$x]['profile']; ?>
                                        </td>

                                        <td>
                                        <?php echo $ARRAY[$x]['caller-id']; ?>
                                        </td>
                                        <td>
                                           
                                                <?php echo $ARRAY[$x]['last-logged-out']; ?>
                                                
                                        </td>

                                        <td>
                                             <div><a href="ping.php?ip=<?php echo $ARRAY[$x]['address']; ?>" target=_blank class="badge badge-success" role="button">Ping</a></div>
                                        </td>

                                        <td>
                                            <?php echo $ARRAY[$x]['uptime']; ?>
                                        </td>

                                        </tr>
                                        <?php
                                        }

                                        } else { // si no hay ningun binding
                                            echo "No hay ningun IP-Bindings. //<br/>";
                                        }
                                        //var_dump($ARRAY);
                                        $API->disconnect();
                                        ?>

                            </tbody>
                        </table>
			<?php
		}
    mysqli_close($con);
	
?>
<script>
$(document).ready(function() {
        $('#listmk').DataTable( {


            "dom": 'Bfrtip',

            lengthMenu: [[15, 25, 50,100, -1], [ '15 Registros', '25 Registros', '50 Registros', '100 Registros', 'Mostrar todos' ] ],
           buttons: ['pageLength','colvis',
            {extend: 'collection', text: '<i class="fa fa-floppy-o"></i> <span class="caret"></span>', 
            buttons: [{extend: 'print', title:'Lista Mikrotik', text: '<i class="fa fa-print"></i> Imprimir', },
             {extend: 'csvHtml5', title:'Lista Mikrotik', text: '<i class="fa fa-file-excel-o"></i> Exportar a EXCEL', },
              {extend: 'pdfHtml5', title:'Lista Mikrotik', text: '<i class="fa fa-file-pdf-o"></i> Exportar a PDF', } ] }, 

              {text: '<i class=" update-router fa fa-refresh"></i>', } ],
             



           

            
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




$( "#gdrouter" ).submit(function( event ) {
  $('#btnsave').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "Ajax/crear/nuevo_router.php",
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
$( "#updatemk" ).submit(function( event ) {
  $('#btnupdate').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "Ajax/update/update_router.php",
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
