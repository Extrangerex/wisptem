<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
// if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
// (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
		}
		if (empty($_POST['fecha'])){
			$errors[] = "Ingresa Fecha";
		} elseif (empty($_POST['idcliente'])){
			$errors[] = "Debes ingresar el id del cliente";
		} elseif (empty($_POST['descripcion'])){
			$errors[] = "Debes ingresar la descripcion de la averia";
} elseif (
			!empty($_POST['fecha'])
			&& !empty($_POST['descripcion'])
			&& !empty($_POST['idcliente'])
			)
{
require_once ("../../config/db.php");
$fecha = mysqli_real_escape_string($con,(strip_tags($_POST["fecha"],ENT_QUOTES)));
				$descripcion = mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));
				$idcliente=intval($_POST['idcliente']);
$ssl = "select * from clientesp where id=$idcliente";
$resultado = mysqli_query($con,$ssl);
$numrow =  mysqli_num_rows($resultado);
if ($numrow == 0 ) {
	$errors[] = "Lo sentimos , el codigo no existe.";
	
}else{
$sql = "INSERT INTO averias (fecha, idcliente, descripcion)
VALUES('".$fecha."','".$idcliente."','".$descripcion."');";
$query_new_user_insert = mysqli_query($con,$sql);
// if user has been added successfully
if ($query_new_user_insert) {
$messages[] = "La averia ha sido agregada con éxito.";
} else {
$errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
}
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