
<?php
date_default_timezone_set("America/Santo_Domingo");
session_start();
require('../../config/routeros_api.class.php');
require('../../config/api_mt_include2.php');


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
	include('is_logged.php');


	/* Connect To Database*/
	require_once ("../../config/db.php");
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id=intval($_GET['id']);
		$query=mysqli_query($con, "select * from facturas where id_cliente='".$id."'");
		$count=mysqli_num_rows($query);
		if ($count==0){

		    $ss=mysqli_query($con,"select usuario from clientesp where id='".$id."'");
		    $row = mysqli_fetch_array($ss);

            
            $ServerList=mikrotik_ip;  // tu RouterOS.
            $Username=mikrotik_usuario;
            $Pass=mikrotik_contrasena;
            $Port=mikrotik_puerto;
            $name = $row['usuario'];  // ---- nombre del usuario pppoe


            $API = new routeros_api();
            $API = new routeros_api();
            $API->debug = false;
            if ($API->connect($ServerList, $Username, $Pass, $Port)) {
//Busca ID por Nome
                $API->write('/ppp/secret/print
                    ?name='.($name)
                );
                $find = $API->read();
//Remove ID encontrado de Acordo com o Nome.
                foreach ($find as $find){
                    $API->write('/ppp/secret/remove', false); // remove, enable, disable
                    $API->write('=.id='.$find['.id']);
                    $API->read();
                }
                $API->disconnect();
            }
            $API = new routeros_api();
            $API->debug = false;
            if ($API->connect($ServerList , $Username , $Pass, $Port)) {
                $API->write("/ppp/active/getall",false);
                $API->write('?name='.$name,true);
                $READ = $API->read(false);
                $ARRAY = $API->parse_response($READ);
                if(count($ARRAY)>0){ // si el usuario esta activo lo pateo.
                    $API->write("/ppp/active/remove",false);
                    $API->write("=.id=".$ARRAY[0]['.id'],true);
                    $READ = $API->read(false);
                    $ARRAY = $API->parse_response($READ);
                }
                $API->disconnect();
            }



			if ($delete1=mysqli_query($con,"DELETE FROM clientesp WHERE id='".$id."'")){



                	$fec = date("Y-m-d H:i:s");
				$iduser = $_SESSION['user_id'];
				$detalle = "Elimino el cliente con el usuario $name";
				 $SI  = "INSERT INTO  logs(user_id,fecha,detalle)
                            VALUES('".$iduser."','".$fec."','".$detalle."');";
                             $query = mysqli_query($con,$SI);

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
			
		} else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se pudo eliminar éste  cliente. Existen facturas vinculadas a éste producto. 
			</div>
			<?php
		}
		
		
		
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('nombres','usuario','id','cell','cell2','poste','direcion','documento','remoteaddress','apellido','mac','fecha_final');//Columnas de busqueda
		 $sTable = "clientesp";
		 $sWhere = "";
		if ( $_GET['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR CONCAT(usuario,'',fecha_final) LIKE '%".$q."%' or CONCAT(nombres,' ',apellido) LIKE '%".$q."%' OR CONCAT(fecha_final,' ',usuario) LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		$sWhere.=" where disable='yes'";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './clientes.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
            <div>
                <label>Total Clientes: </label>
                <a type="text" ><?php echo $numrows; ?></a>
            </div>
			<div class="w3-responsive" >
  		 <table width="100%" class="table table-striped table-bordered table-hover" id="example">
				<tr  style="background-color: #7FB3D5;">
					<th onclick="w3.sortHTML('#example', '.item', 'td:nth-child(1)')" style="cursor:pointer">ID</th>
					<th onclick="w3.sortHTML('#example', '.item', 'td:nth-child(2)')" style="cursor:pointer">NOMBRE</th>
					<th onclick="w3.sortHTML('#example', '.item', 'td:nth-child(3)')" style="cursor:pointer">MAC</th>
					<th onclick="w3.sortHTML('#example', '.item', 'td:nth-child(4)')" style="cursor:pointer">CELL</th>
					<th onclick="w3.sortHTML('#example', '.item', 'td:nth-child(5)')" style="cursor:pointer">CELL2</th>
                    <th onclick="w3.sortHTML('#example', '.item', 'td:nth-child(6)')" style="cursor:pointer">Usuario</th>
					<th onclick="w3.sortHTML('#example', '.item', 'td:nth-child(7)')" style="cursor:pointer">PLAN</th>
                    <th onclick="w3.sortHTML('#example', '.item', 'td:nth-child(8)')" style="cursor:pointer">MONTO</th>
					<th onclick="w3.sortHTML('#example', '.item', 'td:nth-child(9)')" style="cursor:pointer">VENCE</th>
                    <th>Acciones</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id=$row['id'];
						

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
$mac=  $row['mac'];
$poste= $row['poste'];
$sector=$row['sector'];
$pagoinstalacion=$row['pago_instalacion'];
$remoteaddress=$row['remoteaddress'];
$empleado=$row['id_empleado'];

$today = date("Y-m-d");

$day=Diff($fechafinal,$today);


						if ($disable=="no"){$estado="Activo";$class="btn btn-success";}
						else {$estado="Cortado";$class="btn btn-danger";}
						if (( $day >= 5) && ($disable == "no")){
						    $class="btn btn-warning";
						}
						
					?>
					

					
					<tr class="item"  style="background-color: #87CEEB;">
						
						<td><a href="#" class='<?php echo $class; ?>' title='Editar cliente' onclick="obtener_datos('<?php echo $id;?>');" data-toggle="modal" data-target="#myModaledit"><?php echo $id; ?></a> </td>

						<td ><?php echo $nombre; ?> <?php echo $apellido; ?></td>
						<td><?php echo $mac;?></td>
						<td><?php echo $cell;?></td>
						<td><?php echo $cell2;?></td>
                        <td><?php echo $usuario;?></td>
						<td><?php echo $plan;?></td>
                        <td><?php echo $pago;?></td>
						<td><?php echo $fechafinal;?></td>
                        <td>
                            <a href="Reportes/cobro.php?id=<?php echo $id; ?>" target="_blank" class='btn btn-primary' title='Descargar factura'><i class="glyphicon glyphicon-print"></i></a>
                            <a href="#" onclick="ver_historial('<?php echo $id;?>');" data-toggle="modal" data-target="#HistorialP" class='btn btn-primary' title='ver historial de pago'><i class="fa fa-history fa-fw"></i></a>
                            <a href="#" onclick="eliminar_cliente('<?php echo $id; ?>');" class='btn btn-danger' id="btneliminarc" name="btneliminarc" title='Eliminar Cliente' <?php echo $disabled ?> ><i class="fa fa-trash-o"></i></a>




                        </td>





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
                        <input type="hidden" value="<?php echo $usuario;?>" id="usuario<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $plan;?>" id="plan<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $poste;?>" id="poste<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $sector;?>" id="sector<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $remoteaddress;?>" id="remoteaddress<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $empleado;?>" id="empleado<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $pagoinstalacion;?>" id="pagoinstalacion<?php echo $id;?>">

                        <input type="hidden" value="<?php echo $documento;?>" id="documento<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $mac;?>" id="mac<?php echo $id;?>">
                        <input type="hidden" value="<?php echo $disable;?>" id="disable<?php echo $id;?>">

						
					
						
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=7><span class="pull-right">
					<?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
	mysqli_close($con);
?>
<script type="text/javascript">
	
$(document).ready(function() {
$('#example').DataTable();
} );


</script>