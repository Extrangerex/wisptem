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
		
			if ($delete1=mysqli_query($con,"DELETE FROM gastos WHERE id='".$id."'")){
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
		 $aColumns = array('fecha', 'motivo');//Columnas de busqueda
		 $sTable = "gastos";
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
					
					<th>Fecha</th>
					<th>Motivo</th>
					<th>Monto</th>
					<th>Acciones</th>
                    
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id=$row['id'];
						$fecha=$row['fecha'];
						$motivo=$row['motivo'];
						
						$monto=$row['monto'];


                 

                    ?>
					
					<input type="hidden" value="<?php echo $row['fecha'];?>" id="fecha<?php echo $id;?>">
					<input type="hidden" value="<?php echo $row['motivo'];?>" id="motivo<?php echo $id;?>">
					<input type="hidden" value="<?php echo $monto;?>" id="monto<?php echo $id;?>">
					
				
					<tr>
						
						<td><?php echo $fecha; ?></td>
						<td ><?php echo $motivo; ?></td>
						<td >RD$<?php echo number_format($monto,2); ?></td>
                     
						
					<td ><span class="pull-left">
					<a href="#" class='btn btn-default' title='Editar usuario' onclick="obtener_datos('<?php echo $id;?>');" data-toggle="modal" data-target="#EditGasto"><i class="glyphicon glyphicon-edit"></i></a>
					
					<a href="#" class='btn btn-default' title='Borrar usuario' onclick="eliminar_gasto('<?php echo $id; ?>');"><i class="glyphicon glyphicon-trash"></i> </a></span></td>
						
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