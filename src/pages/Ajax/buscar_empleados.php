<?php
date_default_timezone_set("America/Santo_Domingo");
	include('is_logged.php');
	/* Connect To Database*/
	require_once ("../../config/db.php");
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id=intval($_GET['id']);
		$query=mysqli_query($con, "select * from empleados where id='".$id."'");
		$count=mysqli_num_rows($query);
		if ($count==0){
			if ($delete1=mysqli_query($con,"DELETE FROM empleados1 WHERE id='".$id."'")){
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
		 $aColumns = array('nombre','apellido','id','cell','cell2','documento');//Columnas de busqueda
		 $sTable = "empleados";
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
		$sWhere.=" order by id asc";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 50; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './empleados.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		

		if ($numrows>0){
			
		
				while ($row=mysqli_fetch_array($query)){
						

						$id=$row['id'];
						

$nombre=$row['nombre'];
$apellido=$row['apellido'];
$cell2=$row['cell2'];
$cell=$row['cell'];
$sexo=$row['sexo'];
$documento=$row['documento'];
$fecin=$row['fecha_contratacion'];
$fecnac=$row['fecha_nacimiento'];
$direccion=$row['direccion'];
$direccion=$row['direccion'];
$estado = $row['estado'];
$foto=$row['foto'];

$cargo=$row['cargo'];
						
						
					?>



									
		<input type="hidden" value="<?php echo $nombre;?>" id="nombre<?php echo $id;?>">
		<input type="hidden" value="<?php echo $apellido;?>" id="apellido<?php echo $id;?>">
		<input type="hidden" value="<?php echo $cell;?>" id="cell<?php echo $id;?>">
		<input type="hidden" value="<?php echo $cell2;?>" id="cell2<?php echo $id;?>">
		<input type="hidden" value="<?php echo $direccion;?>" id="direccion<?php echo $id;?>">
					
		<input type="hidden" value="<?php echo $sexo;?>" id="sexo<?php echo $id;?>">
					
		<input type="hidden" value="<?php echo $fecnac;?>" id="fecnac<?php echo $id;?>">
		<input type="hidden" value="<?php echo $fecin;?>" id="fecin<?php echo $id;?>">
					
		<input type="hidden" value="<?php echo $cargo;?>" id="cargo<?php echo $id;?>">
		<input type="hidden" value="<?php echo $foto;?>" id="foto<?php echo $id;?>">
					
					
					<input type="hidden" value="<?php echo $documento;?>" id="documento<?php echo $id;?>">
					
					<input type="hidden" value="<?php echo $estado;?>" id="estado<?php echo $id;?>">
		












					  <div class="col-xs-3">
        <p class="page-header"><?php echo $row['nombre']."&nbsp;/&nbsp;".$row['cargo']; ?></p>
        <img src="../fotos_empleados/<?php echo $row['foto']; ?>" class="img-rounded" width="250px" height="250px" />
        <p class="page-header">
        <span>
     <a class="btn btn-info" href="#" title="click for edit"  onclick="obtener_empleados('<?php echo $id;?>');" data-toggle="modal" data-target="#EditEmpleado"><span class="glyphicon glyphicon-edit"></span> Edit</a>
        <a class="btn btn-danger" href="?delete_id=<?php echo $row['id']; ?>" title="click for delete" onclick="return confirm('sure to delete ?')"><span class="glyphicon glyphicon-remove-circle"></span> Delete</a>
        </span>
        </p>
      </div>       
      <?php
    }
  }
  else
  {
    ?>
        <div class="col-xs-12">
          <div class="alert alert-warning">
              <span class="glyphicon glyphicon-info-sign"></span> &nbsp; No Data Found ...
            </div>
        </div>
        
		
			</div>
			<?php
		}
	}
	mysqli_close($con);
?>