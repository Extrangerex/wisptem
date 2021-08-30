<?php
date_default_timezone_set("America/Santo_Domingo");
require_once ("../../../config/db.php");

session_start();

require('../../../config/api_mt_include2.php');

                $id=intval($_POST['id']);

                    
  $id=intval($_GET['q']);



    include('../is_logged.php');


	
    $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM mikrotik where idmikrotik=$id");
   
    $row= mysqli_fetch_array($count_query);
    $numrows = $row['numrows'];
   
    $sql="SELECT * FROM  mikrotik where idmikrotik=$id";
    $query = mysqli_query($con, $sql);
    $row=mysqli_fetch_array($query);
     $nodo=$row['nodo'];
                      
                        $modelo=$row['modelo'];
                        $mk_usuario = $row['mk_usuario'];
                        $mk_password = $row['mk_password'];
                         $estado="conectado";
                        $interface = $row['interface'];

                        $mk_puerto = $row['api'];
                        $tipocon = $row['tipocon'];
                        $api=$row['api']; 
                         $ip=$row['ip'];
                        if ($tipocon == 2) {
                          $mk_ip = "$ip:$api";
                        }else{
                             $mk_ip = $ip;
                        }
                  


                       
		//loop through fetched data
		if ($numrows>0){
			
			?>
             
          

        <table id="lstactive" class="table-hover table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Usuario </th>
                <th>Nombre </th>
                 <th>Poste</th>


                 <th>MAC</th>
                  <th>IP </th>
               
                 <th>Tiempo Conexi&oacute;n</th>
                
                
            </tr>
        </thead>
        <tbody>
           <?php




    $API = new routeros_api();
    $API->debug = false;

     $API-$API->connect($mk_ip, $mk_usuario, $mk_password, $mk_puerto);
                        $API->write("/ppp/active/getall",true);

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
                                








                                if (empty($row['usuario'])) {

                    $colour="red";
                    $codea = " <a href='#' data-target='#newcliente' data-toggle='modal' onclick='obtener_datos($total);'  > ";


                }
                    else{
                        $colour="green";
                        $codea = "<a  href='perfil.php?id=$id' title='Editar cliente'  >";

                }



                             ?>


                                <tr>
                                    <td>

                                
                                      
                                       
                                                     <input type="hidden" value="<?php echo $ARRAY[$x]['name']; ?>" id="username<?php echo $total;?>">
                                        <input type="hidden" value="<?php echo $ARRAY[$x]['caller-id']; ?>" id="macadd<?php echo $total;?>">
                                        
                                       





                                        <div><font color="<?php echo $colour ?>" face="Comic Sans MS,arial">
                                            <?php echo $codea; ?>
                                                <div>
                                                    <?php echo $ARRAY[$x]['name']; ?>
                                                    </font>
                                                </div>
                                        </td>
                                        
                                        <td>
                                            <?php echo $row['nombres'];?> <?php echo $row['apellido'];?>
                                        </td>
                                        <td>
                                            <?php echo $row['poste']; ?>
                                        </td>

                                        <td>
                                        <?php echo $ARRAY[$x]['caller-id']; ?>
                                        </td>
                                        <td>
                                            <a href="http://<?php echo $ARRAY[$x]['address']; ?>:8080" target=_blank>
                                                <?php echo $ARRAY[$x]['address']; ?>
                                                <div align="right">
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
        $('#lstactive').DataTable( {


            "dom": 'Bfrtip',

            lengthMenu: [[15, 25, 50,100, -1], [ '15 Registros', '25 Registros', '50 Registros', '100 Registros', 'Mostrar todos' ] ],
           buttons: ['pageLength','colvis',
            {extend: 'collection', text: '<i class="fa fa-floppy-o"></i> <span class="caret"></span>', 
            buttons: [{extend: 'print', title:'Lista Mikrotik', text: '<i class="fa fa-print"></i> Imprimir', },
             {extend: 'csvHtml5', title:'Lista Mikrotik', text: '<i class="fa fa-file-excel-o"></i> Exportar a EXCEL', },
              {extend: 'pdfHtml5', title:'Lista Mikrotik', text: '<i class="fa fa-file-pdf-o"></i> Exportar a PDF', } ] }, 

             ],
             



           

            
            "bsort": true,
            "paging": true,
             "forceResponsive": true,



          
            "stateSave": false,
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


