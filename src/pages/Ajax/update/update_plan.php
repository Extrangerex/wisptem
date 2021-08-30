<?php
session_start();
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
		if (empty($_POST['mod_nombre'])){
			$errors[] = "Ingresa nombre del plan";
		} elseif (empty($_POST['mod_plan'])){
			$errors[] = "Debes ingresar el plan ";
		} elseif (empty($_POST['mod_precio'])){
			$errors[] = "Debes ingresar el precio";
		
        } elseif (
			!empty($_POST['mod_nombre'])
			&& !empty($_POST['mod_precio'])
			
			&& !empty($_POST['mod_plan'])
			)
        
{
            require_once ("../../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			
			$nombre = mysqli_real_escape_string($con,(strip_tags($_POST["mod_nombre"],ENT_QUOTES)));
		$plan = mysqli_real_escape_string($con,(strip_tags($_POST["mod_plan"],ENT_QUOTES)));
		
		

		$precio = intval($_POST["mod_precio"]);
		$id = intval($_POST["mod_id"]);

				
				
				
				$fec = date("Y-m-d H:i:s");
				$iduser = $_SESSION['user_id'];
				$detalle = "Actualizó el plan de $nombre";


				 $SI  = "INSERT INTO  logs(user_id,fecha,detalle)
                            VALUES('".$iduser."','".$fec."','".$detalle."');";
                            $query = mysqli_query($con,$SI);

					// write new user's data into database
 				

 					  $sql = "UPDATE planes SET nombre='".$nombre."', plan='".$plan."', precio='".$precio."'  WHERE id='".$id."';";

							
                     $query_update = mysqli_query($con,$sql);
                   

                    // if user has been added successfully
                    if ($query_update) {
                        $messages[] = "El plan ha sido modificado con éxito.....";
                    } else {
                        $errors[] = "Lo sentimos , la actualización falló. Por favor, regrese y vuelva a intentarlo.";
                    }
                
            
        } else {
            $errors[] = "Un error desconocido ocurrió.";
        }
	    if (isset($errors)){
            
            
                        foreach ($errors as $error) {


                                echo '<script>msgbox("danger","'.$error.'",3);</script>';

                            }
                       
            }
            if (isset($messages)){
                
                
                            foreach ($messages as $message) {
                                    
                                echo '<script>msgbox("success","'.$message.'",3);</script>';
                                }
                          

                
            }

mysqli_close($con);
			
?>