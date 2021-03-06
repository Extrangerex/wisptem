<?php
date_default_timezone_set("America/Santo_Domingo");
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("../../../libraries/password_compatibility_library.php");
}       
        if (empty($_POST['mcodigo'])){
            $errors[] = "El Codigo no puedo estar vacio";
        } elseif (empty($_POST['mdescripcion'])){
            $errors[] = "La descripcion no puede estar vacia";
        
        }  elseif (empty($_POST['mprecioVenta'])){
            $errors[] = "El precio de venta no puede estar vacio";
        
        } elseif (empty($_POST['mprecioCompra'])){
            $errors[] = "El precio de compra no puede estar vacio";
        
        } elseif (empty($_POST['mexistencia'])){
            $errors[] = "La existencia no puede estar vacia";
        
        } elseif (
            !empty($_POST['mcodigo'])
            && !empty($_POST['mdescripcion'])
             && !empty($_POST['mprecioCompra'])
              && !empty($_POST['mprecioVenta'])
               && !empty($_POST['mexistencia'])
            
            )
        
{
            require_once ("../../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
            
                // escaping, additionally removing everything that could be (html/javascript-) code
                $codigo = mysqli_real_escape_string($con,(strip_tags($_POST["mcodigo"],ENT_QUOTES)));
                
                $descripcion = mysqli_real_escape_string($con,(strip_tags($_POST["mdescripcion"],ENT_QUOTES)));
               
               $preciov=intval($_POST['mprecioVenta']);
               $precioc=intval($_POST['mprecioCompra']);
               $existencia=intval($_POST['mexistencia']);
                $id=intval($_POST['mid']);




              
                
                
                $fec = date("Y-m-d H:i:s");
                $iduser = $_SESSION['user_id'];
                $detalle = "Actualiz?? el plan de $nombre";


                 $SI  = "INSERT INTO  logs(user_id,fecha,detalle)
                            VALUES('".$iduser."','".$fec."','".$detalle."');";
                            $query = mysqli_query($con,$SI);

                    // write new user's data into database
                

                      $sql = "UPDATE productos SET codigo='".$codigo."', descripcion='".$descripcion."', precioVenta='".$preciov."', precioCompra='".$precioc."', existencia='".$existencia."'  WHERE id='".$id."';";

                            
                     $query_update = mysqli_query($con,$sql);
                   

                    // if user has been added successfully
                    if ($query_update) {
                        $messages[] = "El Producto ha sido modificado con ??xito.....";
                    } else {
                        $errors[] = "Lo sentimos , la actualizaci??n fall??. Por favor, regrese y vuelva a intentarlo.";
                    }
                
            
        } else {
            $errors[] = "Un error desconocido ocurri??.";
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