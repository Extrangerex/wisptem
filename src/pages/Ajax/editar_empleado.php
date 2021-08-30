<?php
	include('is_logged.php');
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_nombre'])) {
           $errors[] = "Nombre vacío";
        }  else if ($_POST['mod_estado']==""){
			$errors[] = "Selecciona el estado del Empleado";
			 }  else if ($_POST['mod_documento']==""){
			$errors[] = "Debes ingresar la cedula";
		}  else if (
			!empty($_POST['mod_id']) &&
			!empty($_POST['mod_nombre']) &&
			!empty($_POST['mod_documento']) &&
			$_POST['mod_estado']!="" 
		){

		require_once ("../../config/db.php");

		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["mod_nombre"],ENT_QUOTES)));
		$apellido=mysqli_real_escape_string($con,(strip_tags($_POST["mod_apellido"],ENT_QUOTES)));
		$cell=mysqli_real_escape_string($con,(strip_tags($_POST["mod_cell"],ENT_QUOTES)));
		$cell2=mysqli_real_escape_string($con,(strip_tags($_POST["mod_cell2"],ENT_QUOTES)));
		
		$documento=mysqli_real_escape_string($con,(strip_tags($_POST["mod_documento"],ENT_QUOTES)));
		
		$cargo=mysqli_real_escape_string($con,(strip_tags($_POST["mod_cargo"],ENT_QUOTES)));
		$direccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_direccion"],ENT_QUOTES)));
		$fecnac=mysqli_real_escape_string($con,(strip_tags($_POST["mod_fecnac"],ENT_QUOTES)));
		$estado=mysqli_real_escape_string($con,(strip_tags($_POST["mod_estado"],ENT_QUOTES)));
        $sexo=mysqli_real_escape_string($con,(strip_tags($_POST["mod_sexo"],ENT_QUOTES)));



        $id=intval($_POST['mod_id']);


        $ruta = "../../fotos_empleados/";
        $archivo="imagen".date("dHis").".".pathinfo($_FILES["imagen"]["name"],PATHINFO_EXTENSION);
        $destino = $ruta.$archivo;



		$sql="UPDATE empleados SET   foto='".$archivo."',sexo='".$sexo."',nombre='".$nombre."',apellido='".$apellido."',cell='".$cell."', cell2='".$cell2."',fecha_nacimiento='".$fecnac."', documento='".$documento."', cargo='".$cargo."',  direccion='".$direccion."', estado='".$estado."' WHERE id='".$id."'";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Empleado ha sido actualizado satisfactoriamente.";
                if (move_uploaded_file($_FILES["imagen"]["tmp_name"],$destino)){
                    $messages[]="Subido correctamente.";

                }else {
                    $errors[] = "Error al subir el archivo.";
                }


			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}
mysqli_close($con);
?>