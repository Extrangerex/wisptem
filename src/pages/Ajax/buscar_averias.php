<?php

	
	include('is_logged.php');
	/* Connect To Database*/
	require_once ("../../config/db.php");
	
	include('is_logged.php');
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id=intval($_GET['id']);
		$query=mysqli_query($con, "select * from gastos where id='".$id."'");
		$rw_user=mysqli_fetch_array($query);
		$count=$rw_user['id'];
		
			if ($delete1=mysqli_query($con,"DELETE FROM averias WHERE id='".$id."'")){
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
			
		
		$total = 0;
		
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('idcliente', 'fecha','descripcion');//Columnas de busqueda
		 $sTable = "averias";
		 $sWhere = "";
		if ( $_GET['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		$sWhere.=" order by fecha desc";
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
		$reload = './usuario.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){


			
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="info">
					<th>No</th>
					<th>Fecha</th>
					<th>ID Cliente</th>
					<th>Descripcion</th>
					<th>Estado</th>

					<th>Acciones</th>
                    
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id=$row['id'];
						$fecha=$row['fecha'];
						$idcliente=$row['idcliente'];
						
						$descripcion=$row['descripcion'];
						$estado=$row['estado'];
						if ($estado == "pendiente") {
							$color = "red";
						}else
						{
							$color = "green";
						}

						$sql = mysqli_query($con,"select * from clientesp where id=$idcliente");
						$cliente = mysqli_fetch_array($sql);

						$nombre =$cliente['nombres'];
						$apellido =$cliente['apellido'];
						$cell = $cliente['cell'];
						$poste = $cliente['poste'];
						$direccion = $cliente['direcion'];



                 

                    ?>
					
					<input type="hidden" value="<?php echo $row['fecha'];?>" id="fecha<?php echo $id;?>">
					<input type="hidden" value="<?php echo $row['idcliente'];?>" id="idcliente<?php echo $id;?>">
					<input type="hidden" value="<?php echo $descripcion;?>" id="descripcion<?php echo $id;?>">
					<input type="hidden" value="<?php echo $estado;?>" id="estado<?php echo $id;?>">
					<input type="hidden" value="<?php echo $nombre;?>" id="nombre<?php echo $id;?>">
					<input type="hidden" value="<?php echo $apellido;?>" id="apellido<?php echo $id;?>">
					<input type="hidden" value="<?php echo $cell;?>" id="cell<?php echo $id;?>">
					<input type="hidden" value="<?php echo $poste;?>" id="poste<?php echo $id;?>">
					<input type="hidden" value="<?php echo $direccion;?>" id="direccion<?php echo $id;?>">
					
				
					<tr>

						<td><?php echo $id; ?></td>
						<td><?php echo $fecha; ?></td>
						<td ><?php echo $idcliente; ?></td>
						<td ><?php echo $descripcion; ?></td>
						<td ><font color="<?php echo $color; ?>"><?php echo $estado; ?></font></td>
                     
						
					<td ><span class="pull-left">
					<a href="#" class='btn btn-default' title='Editar usuario' onclick="obtener_datos('<?php echo $id;?>');" data-toggle="modal" data-target="#EditAveria"><i class="glyphicon glyphicon-edit"></i></a>
					
					<a href="#" class='btn btn-default' title='Borrar usuario' onclick="eliminar_averia('<?php echo $id; ?>');"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
						
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=9><span class="pull-right">
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