<?php
date_default_timezone_set("America/Santo_Domingo");
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("../libraries/password_compatibility_library.php");
}		
		if (empty($_POST['plan_plan'])){
			$errors[] = "Plan Vacio";
		} elseif (empty($_POST['valor_plan'])){
			$errors[] = "Valor vacio";
		} elseif (empty($_POST['precio_plan'])){
			$errors[] = "Valor vacio";
        } elseif (
			!empty($_POST['plan_plan'])
			&& !empty($_POST['valor_plan'])
			&& !empty($_POST['precio_plan'])
			)
        
{
            require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			
				// escaping, additionally removing everything that could be (html/javascript-) code
                $plan_plan = mysqli_real_escape_string($con,(strip_tags($_POST["plan_plan"],ENT_QUOTES)));
				$valor_plan = mysqli_real_escape_string($con,(strip_tags($_POST["valor_plan"],ENT_QUOTES)));
				$precio_plan = mysqli_real_escape_string($con,(strip_tags($_POST["precio_plan"],ENT_QUOTES)));
				
                // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
                // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
                // PHP 5.3/5.4, by the password hashing compatibility library
				//$user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);
					
                // check if user or email address already exists
                $sql = "SELECT * FROM planes WHERE valor = '".$valor_plan."'";
                $query_check_user_name = mysqli_query($con,$sql);
				$query_check_user=mysqli_num_rows($query_check_user_name);
                if ($query_check_user == 1) {
                    $errors[] = "Lo sentimos , este plan ya está agregado.";
                } else {

				$fec = date("Y-m-d H:i:s");
				$iduser = $_SESSION['user_id'];
				$detalle = "agrego el plan de $valor_plan";


				 $SI  = "INSERT INTO  logs(user_id,fecha,detalle)
                            VALUES('".$iduser."','".$fec."','".$detalle."');";
                            $query = mysqli_query($con,$SI);

					// write new user's data into database
                    $sql = "INSERT INTO planes (plan, valor, precio)
                            VALUES('".$plan_plan."','".$valor_plan."','".$precio_plan."');";
                    $query_new_user_insert = mysqli_query($con,$sql);

                    // if user has been added successfully
                    if ($query_new_user_insert) {
                        $messages[] = "La cuenta ha sido creada con éxito.";
                    } else {
                        $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
                    }
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