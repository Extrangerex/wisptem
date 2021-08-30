<?php
session_start();
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("../libraries/password_compatibility_library.php");
}		
		if (empty($_POST['plan'])){
			$errors[] = "Plan Vacio";
		} elseif (empty($_POST['valor'])){
			$errors[] = "Valor vacío";
		} elseif (empty($_POST['valor'])){
			$errors[] = "Valor vacío";
		
        } elseif (
			!empty($_POST['precio'])
			&& !empty($_POST['valor'])
			
			&& !empty($_POST['plan'])
			
          )
         {
            require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			
			
				// escaping, additionally removing everything that could be (html/javascript-) code
                $plan = mysqli_real_escape_string($con,(strip_tags($_POST["plan"],ENT_QUOTES)));
				$valor = mysqli_real_escape_string($con,(strip_tags($_POST["valor"],ENT_QUOTES)));
				$precio = mysqli_real_escape_string($con,(strip_tags($_POST["precio"],ENT_QUOTES)));
				
				
				
				$user_id=intval($_POST['mod_id']);
				$fec = date("Y-m-d H:i:s");
				$iduser = $_SESSION['user_id'];
				$detalle = "actualizo el plan de $valor";


				 $SI  = "INSERT INTO  logs(user_id,fecha,detalle)
                            VALUES('".$iduser."','".$fec."','".$detalle."');";
                            $query = mysqli_query($con,$SI);
				
                   
                 
					
               
					// write new user's data into database
                    $sql = "UPDATE planes SET plan='".$plan."', valor='".$valor."',  precio='".$precio."' WHERE ID='".$user_id."';";
                     $query_update = mysqli_query($con,$sql);
                   

                    // if user has been added successfully
                    if ($query_update) {
                        $messages[] = "La cuenta ha sido modificada con éxito.";
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