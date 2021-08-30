<?php
date_default_timezone_set("America/Santo_Domingo");
require_once ("../../../config/db.php");

session_start();
require('../../../config/routeros_api.class.php');
require('../../../config/api_mt_include2.php');

               

                    
  $id=intval($_GET['id']);
   $ipcli=$_GET['q'];



    include('../is_logged.php');


	
    $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM mikrotik where idmikrotik=$id");
   
    $row= mysqli_fetch_array($count_query);
    $numrows = $row['numrows'];
   
    $sql="SELECT * FROM  mikrotik where idmikrotik=$id";
    $query = mysqli_query($con, $sql);
    $row=mysqli_fetch_array($query);
    
                        $mk_ip=$row['ip'];
                        $modelo=$row['modelo'];
                        $mk_usuario = $row['mk_usuario'];
                        $mk_password = $row['mk_password'];
                        $mk_puerto = $row['puerto'];
                        $estado="conectado";
                        $interface = $row['interface'];

                       
		//loop through fetched data
		if ($numrows>0){
			
			?>
              <div class="card-header bg-dark">
                    <strong class="card-title text-light"><i class="fa fa-list"></i> Ips de paginas visitadas de: <?php echo $ipcli; ?></strong>
                </div>
            <div class="card-body" >

     <table class="table table-striped table-bordered table-hover" id="listactive"  style="font-size:12px">
        <thead>
            <tr>
                <th>Src Address </th>
              
                 

                 <th>Dst Address</th>
                <th>Reply Src Address </th>
                <th>Reply Src Address </th>

                  <th>Protocol </th>
                 <th>Tcp State </th>
                 <th>Time Out</th>
                
                
            </tr>
        </thead>
        <tbody>
           <?php


$total=0;

    $API = new routeros_api();
    $API->debug = false;

     $API-$API->connect($mk_ip, $mk_usuario, $mk_password, $mk_puerto);
                        $API->write("/ip/firewall/connection/print",true);

                        $READ = $API->read(false);
                        $ARRAY = $API->parse_response($READ);
                        if(count($ARRAY)>0){   // si hay mas de 1 queue.
                            for($x=0;$x<count($ARRAY);$x++){
                $total=$total+1;

  
              





                             ?>


                                <tr>
                                    <td>

                                                    <?php echo $ARRAY[$x]['src-address']; ?>
                                                   
                                        </td>
                                        
                                       
                                       

                                        <td>
                                        <?php echo $ARRAY[$x]['dst-address']; ?>
                                        </td>

                                        <td>
                                        <?php echo $ARRAY[$x]['reply-src-address']; ?>
                                        </td>
                                        <td>
                                        <?php echo $ARRAY[$x]['reply-dst-address']; ?>
                                        </td>
                                        <td>
                                            
                                                <?php echo $ARRAY[$x]['protocol']; ?>
                                               
                                        </td>

                                        <td>
                                             <?php echo $ARRAY[$x]['tcp-state']; ?>
                                        </td>

                                        <td>
                                            <?php echo $ARRAY[$x]['timeout']; ?>
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
        $('#listactive').DataTable( {


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




</script>


