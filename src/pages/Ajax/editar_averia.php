<?php
date_default_timezone_set("America/Santo_Domingo");
session_start();
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    
}		
		if (empty($_POST['fecham'])){
			$errors[] = "Ingrese la fecha";
		} elseif (empty($_POST['descripcionm'])){
			$errors[] = "Ingrese la descripcion de la averia";
		} elseif (empty($_POST['idclientem'])){
			$errors[] = "Ingrese el id del cliente";
		
        } elseif (
			!empty($_POST['fecham'])
			&& !empty($_POST['idclientem'])
			
			&& !empty($_POST['descripcionm'])
			
          )
         {
            require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
			
				// escaping, additionally removing everything that could be (html/javascript-) code
                $descripcion = mysqli_real_escape_string($con,(strip_tags($_POST["descripcionm"],ENT_QUOTES)));
				$fecha = mysqli_real_escape_string($con,(strip_tags($_POST["fecham"],ENT_QUOTES)));
				$estado = mysqli_real_escape_string($con,(strip_tags($_POST["estadom"],ENT_QUOTES)));
				
				
				
				$idcliente=intval($_POST['idclientem']);
				$id=intval($_POST['mod_id']);

				
				
                   
                 
					
               
					// write new user's data into database
                    $sql = "UPDATE averias SET idcliente='".$idcliente."', fecha='".$fecha."',  descripcion='".$descripcion."',  estado='".$estado."' WHERE id='".$id."';";
                     $query_update = mysqli_query($con,$sql);
                   

                    // if user has been added successfully
                    if ($query_update) {
                        $messages[] = "La averia ha sido modificada con éxito.";
                    } else {
                        $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
                    }
                
            
        } else {
            $errors[] = "Un error desconocido ocurrió.";
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