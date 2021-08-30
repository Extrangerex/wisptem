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
		if (empty($_POST['mod_nodo'])){
			$errors[] = "Ingresa nodo del mikrotik";
		} elseif (empty($_POST['mod_modelo'])){
			$errors[] = "Debes ingresar el modelo del mikrotik";
		} elseif (empty($_POST['mod_ip'])){
			$errors[] = "Debes ingresar una direccion IP o dns del mikrotik";
		} elseif (empty($_POST['mod_usuario'])){
			$errors[] = "Debes ingresar el usuario del mikrotik";
		} elseif (empty($_POST['mod_tipocon'])){
			$errors[] = "Debes elegir el tipo de conexion del mikrotik";
		} elseif (empty($_POST['mod_password'])){
			$errors[] = "Debes ingresar la contraseña del mikrotik";
		} elseif (empty($_POST['mod_interface'])){
			$errors[] = "Debes ingresar el interface Wan del mikrotik";
		} elseif (empty($_POST['mod_api'])){
			$errors[] = "Debes ingresar el puerto del Api";
		} elseif (empty($_POST['mod_puertoweb'])){
			$errors[] = "Debes ingresar el puerto web";
        } elseif (
			!empty($_POST['mod_nodo'])
			&& !empty($_POST['mod_ip'])
			&& !empty($_POST['mod_usuario'])
			&& !empty($_POST['mod_tipocon'])
			&& !empty($_POST['mod_password'])
			&& !empty($_POST['mod_interface'])
			&& !empty($_POST['mod_puertoweb'])
			&& !empty($_POST['mod_api'])
			)
        
{
            require_once ("../../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			
			$nodo = mysqli_real_escape_string($con,(strip_tags($_POST["mod_nodo"],ENT_QUOTES)));
		$modelo = mysqli_real_escape_string($con,(strip_tags($_POST["mod_modelo"],ENT_QUOTES)));
		$ip = mysqli_real_escape_string($con,(strip_tags($_POST["mod_ip"],ENT_QUOTES)));
		$usuario = mysqli_real_escape_string($con,(strip_tags($_POST["mod_usuario"],ENT_QUOTES)));
		$password = mysqli_real_escape_string($con,(strip_tags($_POST["mod_password"],ENT_QUOTES)));
		$interface = mysqli_real_escape_string($con,(strip_tags($_POST["mod_interface"],ENT_QUOTES)));
		
		$puerto = intval($_POST["mod_puertoweb"]);
		$api = intval($_POST["mod_api"]);
		$id = intval($_POST["mod_id"]);
			$tipocon = intval($_POST["mod_tipocon"]);

				
				
				
				$fec = date("Y-m-d H:i:s");
				$iduser = $_SESSION['user_id'];
				$detalle = "Actualizó el Nodo de $nodo";


				 $SI  = "INSERT INTO  logs(user_id,fecha,detalle)
                            VALUES('".$iduser."','".$fec."','".$detalle."');";
                            $query = mysqli_query($con,$SI);

					// write new user's data into database
 				

 					  $sql = "UPDATE mikrotik SET  tipocon='".$tipocon."',nodo='".$nodo."', modelo='".$modelo."', ip='".$ip."', mk_usuario='".$usuario."', mk_password='".$password."', interface='".$interface."', puertoweb='".$puerto."', api='".$api."' WHERE idmikrotik='".$id."';";

							
                     $query_update = mysqli_query($con,$sql);
                   

                    // if user has been added successfully
                    if ($query_update) {
                        $messages[] = "El router ha sido modificado con éxito.....";
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