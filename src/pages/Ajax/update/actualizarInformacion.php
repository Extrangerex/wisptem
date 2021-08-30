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
		if (empty($_POST['nombre'])){
			$errors[] = "Debes elegir un nodo";
		} elseif (empty($_POST['apellido'])){
			$errors[] = "Debes elegir un plan ";
		} elseif (empty($_POST['fechafinal'])){
			$errors[] = "Debes ingresar el ip";
		} elseif (empty($_POST['empleado'])){
			$errors[] = "Debes elegir el empleado";
		} elseif (empty($_POST['pago_total'])){
			$errors[] = "Debes ingresar la mensualidad";
		
        } elseif (empty($_POST['sector'])){
			$errors[] = "Debes ingresar la mac-address";
		
       
		
        }elseif (
			!empty($_POST['nombre'])
			&& !empty($_POST['apellido'])
			
			&& !empty($_POST['fechafinal'])
			
			
			
       		 && !empty($_POST['empleado'])
			
			&& !empty($_POST['pago_total'])
			)
        
{
            require_once ("../../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
            	
			
			
		$nombre = mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
		$apellido = mysqli_real_escape_string($con,(strip_tags($_POST["apellido"],ENT_QUOTES)));
		$documento = mysqli_real_escape_string($con,(strip_tags($_POST["documento"],ENT_QUOTES)));
		$cell = mysqli_real_escape_string($con,(strip_tags($_POST["cell"],ENT_QUOTES)));
		$cell2 = mysqli_real_escape_string($con,(strip_tags($_POST["cell2"],ENT_QUOTES)));
		$fechafinal = mysqli_real_escape_string($con,(strip_tags($_POST["fechafinal"],ENT_QUOTES)));
		$sector = mysqli_real_escape_string($con,(strip_tags($_POST["sector"],ENT_QUOTES)));
		$poste = mysqli_real_escape_string($con,(strip_tags($_POST["poste"],ENT_QUOTES)));
		$direccion = mysqli_real_escape_string($con,(strip_tags($_POST["direccion"],ENT_QUOTES)));
		$comentario = mysqli_real_escape_string($con,(strip_tags($_POST["comentario"],ENT_QUOTES)));
		$lat = mysqli_real_escape_string($con,(strip_tags($_POST["lat"],ENT_QUOTES)));
		$lon = mysqli_real_escape_string($con,(strip_tags($_POST["lon"],ENT_QUOTES)));
		
		

		$empleado = intval($_POST["empleado"]);
		$id = intval($_POST["id"]);
		$mora = intval($_POST["mora"]);
		$pago_total = intval($_POST["pago_total"]);
		$pago_instalacion = intval($_POST["pago_instalacion"]);
		$router = intval($_POST["router"]);
		$servicio = intval($_POST["servicio"]);


				
		
 				

 						$sql="UPDATE clientesp SET poste='".$poste."',sector='".$sector."',nombres='".$nombre."', apellido='".$apellido."', documento='".$documento."', cell='".$cell."', cell2='".$cell2."',  fecha_final='".$fechafinal."', pago_total='".$pago_total."', id_empleado='".$empleado."', pago_instalacion='".$pago_instalacion."', direcion='".$direccion."', comentario='".$comentario."', id_servicio='".$servicio."', id_router='".$router."', mora='".$mora."' WHERE id='".$id."'";

							
                     $query_update = mysqli_query($con,$sql);
                   

                    // if user has been added successfully
                    if ($query_update) {
                        $messages[] = "Los datos han sido modificados con éxito.....";

                      


                     
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