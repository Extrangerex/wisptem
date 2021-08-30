<?php
date_default_timezone_set("America/Santo_Domingo");
require_once ("../../../config/db.php");
include ("../../../config/functions.php");


session_start();
//require('../../../config/routeros_api.class.php');
require('../../../config/api_mt_include2.php');

    if (isset($_POST['id'])){
        $id=intval($_POST['id']);
        $query=mysqli_query($con, "select * from mikrotik where idmikrotik=$id");
        $rw_user=mysqli_fetch_array($query);
        $count=$rw_user['id'];
        
      $delete1=mysqli_query($con,"DELETE FROM mikrotik WHERE idmikrotik=$id");
            
    }

              

                
                
              
                          

                    



$nivel=$_SESSION['nivel'];
if ($nivel != 1){
    $disabled = "disabled";
}
function Diff($start, $end) {

    $start_ts = strtotime($start);

    $end_ts = strtotime($end);

    $diff = $end_ts - $start_ts;

    return round($diff / 86400);

}
    include('../is_logged.php');



   
    $sql="SELECT * FROM  mikrotik";
    $query = mysqli_query($con, $sql);
		//loop through fetched data
	
			
			?>
           

     <table class="table table-striped table-bordered table-hover" id="listmk" style="font-size:12px">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nodo</th>
               
                <th>Modelo</th>
                 <th>IP (DNS)</th>
                  <th>Usuario</th>
                  <th>Clientes</th>
                  <th>Interface</th>
                  <th>Puerto</th>
                <th>Estado</th>
                
                  <th class="all" data-orderable="false" style="min-width:46px !important;max-width:46px !important">Acción</th>
                
                
            </tr>
        </thead>
        <tbody>
            <?php
                while ($row=mysqli_fetch_array($query)){
                        $id=$row['idmikrotik'];
                        

$nodo=$row['nodo'];
$ip=$row['ip'];
$modelo=$row['modelo'];
$usuario = $row['mk_usuario'];
$password = $row['mk_password'];
$api = $row['api'];
$estado="conectado";
$interface = $row['interface'];
$puertoweb = $row['puertoweb'];
$tipocon = $row['tipocon'];
 $ServerList=$ip;   
                $Username=$usuario; 
                $Pass=$password; 
                $Port=$api; 


                if ($tipocon == 2) {
                  $ServerList = "$ip:$api";
                }
          

                
                
                $API = new routeros_api();
                $API->debug = false;

                     if ($API->connect($ServerList , $Username , $Pass, $Port)) {
                         $API->write("/system/ident/getall",true);

                        $READ = $API->read(false);
                        $ARRAY = $API->parse_response($READ);

                        $name = $ARRAY[0]["name"];
                        if(count($ARRAY)>0){ // si esta conectado

                            $state=1;
                            $API->disconnect();


                        }else{
                            $state = 2;
                            $API->disconnect();

                        }
                       

                     
                            }else{

                        $state=3;
                        $API->disconnect();
                    }



 if ($state==1){$estado="Conectado";$class="badge badge-success badge-sm";}
                        else if ($state==2) {$estado=="Desconectado";$class="badge badge-danger badge-sm";}
                       
                        if ($state==3){$estado="Api failed";$class="badge badge-danger badge-sm";}

                      
                        
                    ?>
                    

            <tr>
               <td><?php echo $id; ?></td>

                        <td ><?php echo $nodo;  ?></td>
                        <td><?php echo $name;?></td>
                        <td><?php echo $ip;?></td>
                    
                        <td><?php echo $usuario;?></a></td>
                         <td><span class="badge badge-success"><?php echo clientevsmikrotik($id);?></span></td>
                          <td><?php echo $interface;?></a></td>
                           <td><?php echo $api;?></a></td>
                        <td><a href="#" class='<?php echo $class; ?>'><?php echo $estado;?></a></td>
                        
                        <td>
                           
                            <a href="#" onclick="obtener_datos('<?php echo $id;?>');" data-toggle="modal" data-target="#editmk" class='btn btn-xs btn-default css-tooltip' title='Editar Router'><i class="fa fa-edit"></i></a>
                            <a href="#" onclick="eliminar_router('<?php echo $id; ?>');" class='btn btn-xs btn-default css-tooltip' id="btneliminarc" name="btneliminarc" title='Eliminar Router' <?php echo $disabled ?> ><i class="fa fa-trash-o "></i></a>




                        </td>





                        <input type="hidden" value="<?php echo $nodo;?>" id="nodo<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $modelo;?>" id="modelo<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $ip;?>" id="ip<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $usuario;?>" id="usuario<?php echo $id;?>">
                     
                        <input type="hidden" value="<?php echo $password;?>" id="password<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $api;?>" id="api<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $interface;?>" id="interface<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $puertoweb;?>" id="puertoweb<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $tipocon;?>" id="tipocon<?php echo $id;?>">
                       
                        
                    
                        
                    </tr>
                    <?php
                }
                mysqli_close($con);
                ?>
        </tbody>
        
    </table>
			
<script>

   $(function() {
            mikrotik = $('#listmk').DataTable( {
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
$('#listmk_wrapper .dt-buttons').after('<div class="btn-group dt-btns"></div>');

$('#listmk_wrapper .dt-btns').append('<span><button type="button" data-toggle="modal" data-target="#listamk" class="btn btn-sm btn-primary" style="margin-left: 10px;"><i class="fa fa-plus"></i> Nuevo Router</button></span>');
  
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




$( "#gdrouter" ).submit(function( event ) {
  $('#btnsave').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "Ajax/crear/nuevo_router.php",
            data: parametros,
             beforeSend: function(objeto){
            msgbox("loader","Guardando ...",3);
            },
            success: function(datos){
              
          $("#resultados_ajax").html(datos);
          $("#gdrouter")[0].reset();
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
             msgbox("loader","Actualizando...",0);
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
