<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['nombre_empresa'])) {
           $errors[] = "Nombre de empresa esta vacío";
        }else if (empty($_POST['telefono'])) {
           $errors[] = "Teléfono esta vacío";
        } else if (empty($_POST['email'])) {
           $errors[] = "E-mail esta vacío";
        } else if (empty($_POST['impuesto'])) {
           $errors[] = "IVA esta vacío";
        } else if (empty($_POST['moneda'])) {
           $errors[] = "Moneda esta vacío";
        } else if (empty($_POST['direccion'])) {
           $errors[] = "Dirección esta vacío";
        } else if (empty($_POST['ciudad'])) {
           $errors[] = "Dirección esta vacío";
        }   else if (
			!empty($_POST['nombre_empresa']) &&
			!empty($_POST['telefono']) &&
			!empty($_POST['email']) &&
			!empty($_POST['impuesto']) &&
			!empty($_POST['moneda']) &&
			!empty($_POST['direccion']) &&
			!empty($_POST['ciudad']) 
		){
		/* Connect To Database*/
		require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		
		// escaping, additionally removing everything that could be (html/javascript-) code
		$nombre_empresa=mysqli_real_escape_string($con,(strip_tags($_POST["nombre_empresa"],ENT_QUOTES)));
		$telefono=mysqli_real_escape_string($con,(strip_tags($_POST["telefono"],ENT_QUOTES)));
		$email=mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
		$impuesto=mysqli_real_escape_string($con,(strip_tags($_POST["impuesto"],ENT_QUOTES)));
		$moneda=mysqli_real_escape_string($con,(strip_tags($_POST["moneda"],ENT_QUOTES)));
		$direccion=mysqli_real_escape_string($con,(strip_tags($_POST["direccion"],ENT_QUOTES)));
		$ciudad=mysqli_real_escape_string($con,(strip_tags($_POST["ciudad"],ENT_QUOTES)));
		$estado=mysqli_real_escape_string($con,(strip_tags($_POST["estado"],ENT_QUOTES)));
		$rnc=mysqli_real_escape_string($con,(strip_tags($_POST["rnc"],ENT_QUOTES)));

		$ip=mysqli_real_escape_string($con,(strip_tags($_POST["ip"],ENT_QUOTES)));
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
		$password=mysqli_real_escape_string($con,(strip_tags($_POST["password"],ENT_QUOTES)));
		$puerto=intval($_POST['puerto']);
		$prologa=intval($_POST['prologa']);
		$interface=mysqli_real_escape_string($con,(strip_tags($_POST["interface"],ENT_QUOTES)));
		$usuario=mysqli_real_escape_string($con,(strip_tags($_POST["usuario"],ENT_QUOTES)));
		
		$sql="UPDATE perfil SET nombre_empresa='".$nombre_empresa."', telefono='".$telefono."', email='".$email."', impuesto='".$impuesto."', moneda='".$moneda."', direccion='".$direccion."', ciudad='".$ciudad."', estado='".$estado."', rnc='".$rnc."', prologa='".$prologa."' WHERE id_perfil=1";
		$query_update = mysqli_query($con,$sql);

	

			if ($query_update){
				$messages[] = "Datos han sido actualizados satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
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