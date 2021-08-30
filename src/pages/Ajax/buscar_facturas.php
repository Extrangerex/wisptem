<?php
date_default_timezone_set("America/Santo_Domingo");

	include('is_logged.php');
	/* Connect To Database*/
	require_once ("../../config/db.php");
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id=intval($_GET['id']);




		if ($count==0){
			if ($delete1=mysqli_query($con,"DELETE FROM facturas WHERE numero_factura ='".$id."'")){ 


                	$fec = date("Y-m-d H:i:s");
				$iduser = $_SESSION['user_id'];
				$detalle = "Elimino la factura # $id";
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
		
		$total = 0;
		
	}
if($action == 'ajax'){
    // escaping, additionally removing everything that could be (html/javascript-) code
    $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
    $sTable = "facturas, clientesp, users";
    $sWhere = "";
    $sWhere.=" WHERE facturas.id_cliente=clientesp.id and facturas.id_vendedor=users.user_id";
    if ( $_GET['q'] != "" )
    {
        $sWhere.= " and  (clientesp.nombres like '%$q%' or facturas.numero_factura like '%$q%'  or clientesp.apellido like '%$q%' or users.firstname like '%$q%' or users.lastname like '%$q%'  or facturas.fecha_factura like '%$q%' or clientesp.id like '%$q%')";

    }

    $sWhere.=" order by facturas.numero_factura desc";
    include 'pagination.php'; //include pagination file
    //pagination variables
    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    $per_page = 15; //how much records you want to show
    $adjacents  = 4; //gap between pages after number of adjacents
    $offset = ($page - 1) * $per_page;
    //Count the total number of row in your table*/
    $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
    $count_total =  mysqli_query($con, "SELECT SUM(total_venta) as total FROM $sTable  $sWhere");
    $row= mysqli_fetch_array($count_query);
    $numrows = $row['numrows'];
    $tot = mysqli_fetch_array($count_total);
    $total_pages = ceil($numrows/$per_page);
    $reload = './facturas.php';
    //main query to fetch the data
    $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
    $query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
            <div>
                <label>Total Facturas: </label>
                <a type="text" ><?php echo $numrows; ?></a>
            </div>
            <div>
                <label>Monto Total: RD $</label>
                <a><?php echo number_format($tot['total'],2); ?></a>
            </div>
			<div class="w3-responsive">
  			<table class="w3-table-all">
				<tr class="info">
                    <th>#</th>

					<th>NO FACTURA</th>
					<th>FECHA </th>
                    <th>ID CLIENTE</th>
					<th>NOMBRE</th>
					<th>PAGO</th>
                    <th>COBRADOR</th>

                    <th>Acciones</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id=$row['id'];
						$count ++;





						if ($disable=="no"){$estado="Activo";$class="btn btn-success";}
						else {$estado="Cortado";$class="btn btn-danger";}
						
						
					?>
					

					
					<tr>
						
						<td><?php echo $count; ?> </td>
                        <td><?php echo $row['numero_factura']; ?> </td>
                        <td><?php echo $row['fecha_factura']; ?> </td>
                        <td><?php echo $row['id']; ?> </td>
                       
                        <?php
                        if ($row['condiciones']==1){
							?>
							<td ><?php echo $row['nombres']; ?> <?php echo $row['apellido']; ?> <img src="../im/banco.png"></td>
						<?php
						}
						else if ($row['condiciones']==2){
							?>
							<td ><?php echo $row['nombres']; ?> <?php echo $row['apellido']; ?> <img src="../im/android.png"></td>
						<?php
						}
						else{
							?>

							<td ><?php echo $row['nombres']; ?> <?php echo $row['apellido']; ?></td>
							<?php

						}
						?>

						
                        <td><?php echo "RD $".number_format($row['total_venta'],2); ?> </td>

                        <td ><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></td>
                        <td>
                            <a href="Reportes/cobro.php?id=<?php echo $id; ?>" target="_blank" class='btn btn-success' title='Descargar factura'><i class="glyphicon glyphicon-print"></i></a>
                            <a href="#" onclick="eliminar_factura('<?php echo $row['numero_factura']; ?>');" class='btn btn-danger' title='Eliminar factura'><i class="fa fa-trash-o"></i></a>




                        </td>




					
						
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