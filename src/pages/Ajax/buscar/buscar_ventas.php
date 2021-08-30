<?php 

date_default_timezone_set("America/Santo_Domingo");
require_once ("../../../config/db.php");
require_once ("../../../config/functions.php");

session_start();


$sentencia = $base_de_datos->query("SELECT ventas.total, ventas.fecha, ventas.id, GROUP_CONCAT(	productos.codigo, '..',  productos.descripcion, '..', productos_vendidos.cantidad SEPARATOR '__') AS productos FROM ventas INNER JOIN productos_vendidos ON productos_vendidos.id_venta = ventas.id INNER JOIN productos ON productos.id = productos_vendidos.id_producto GROUP BY ventas.id ORDER BY ventas.id desc;");
$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

	<div class="col-xs-12">
		<h1>Ventas de Productos</h1>
		<div>
			<a class="btn btn-success" href="#" data-toggle="modal" data-target="#nuevaVenta">Nueva Venta <i class="fa fa-plus"></i></a>
		</div>
		<br>
		<table class="table table-striped table-bordered table-hover" id="list-ventas" style="font-size:14px;" cellpadding="1" border="0">
			<thead>
				<tr>
					<th>Número</th>
					<th>Fecha</th>
					
					<th>Total</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($ventas as $venta){ ?>
				<tr>
					<td><?php echo $venta->id ?></td>
					<td><?php echo $venta->fecha ?></td>
					<td>
						<table class="table table-striped table-bordered table-hover"  style="font-size:12px;" cellpadding="1" border="0">
							<thead>
								<tr>
									<th>Código</th>
									<th>Descripción</th>
									<th>Cantidad</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach(explode("__", $venta->productos) as $productosConcatenados){ 
								$producto = explode("..", $productosConcatenados)
								?>
								<tr>
									<td><?php echo $producto[0] ?></td>
									<td><?php echo $producto[1] ?></td>
									<td><?php echo $producto[2] ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</td>
					<td><?php echo $venta->total ?></td>
					<td><a class="btn btn-danger" href="<?php echo "eliminarVenta.php?id=" . $venta->id?>"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>