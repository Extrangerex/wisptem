<?php
session_start();
require_once ("../../config/db.php");
$zona = $_GET['s'];
$fecha = $_GET['f'];

		//pagination variables

if ($fecha != NULL){

$query = "SELECT * FROM clientesp where fecha_final='$fecha' and sector='$zona'  ORDER BY id";
$result = mysqli_query($con,$query) or die(mysql_error());
$row = mysqli_fetch_array($result);
$numrows = mysqli_num_rows($result);

?>

<html>
	<div class="panel-body">
		 <div>
                <label>Total Clientes: </label>
                <a type="text" ><?php echo $numrows; ?></a>
            </div>
		<div class="table-responsive">
			<table class="table table-striped table-responsive" id="example">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombres</th>
						<th>Celular</th>
						<th>Usuario</th>
						<th>Monto</th>
						<th>Fecha</th>
						<th>Estado</th>
						
						
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php do { ?>
						
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['nombres']; ?> <?php echo $row['apellido']; ?></td>
						<td><?php echo $row['cell']; ?></td>
						<td><?php echo $row['usuario']; ?></td>
						<td width="5"><?php echo $row['pago_total']; ?></td>
						<td width="100"><?php echo $row['fecha_final']; ?></td>
						
						<?php
								$resp=$row['disable'];
								
						if ($resp=='no'){$text_estado="activo";$label_class='label-success';}
												else{$text_estado="Cortado";$label_class='label-danger';}
						?>
						<td><span class="label <?php echo $label_class;?>"><?php echo $text_estado; ?></span></td>
						
						
					</tr>
					<?php } while ($row = mysqli_fetch_array($result));

}
mysqli_close($con);
					 ?>
					
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- /.row --></div>

</div>
</div>
<!-- The end -->
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
</div>
<!-- jQuery -->

</html>