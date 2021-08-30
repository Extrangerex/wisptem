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
		if (empty($_POST['nodo'])){
			$errors[] = "Debes elegir un nodo";
		} elseif (empty($_POST['plan'])){
			$errors[] = "Debes elegir un plan ";
		} elseif (empty($_POST['remoteaddress'])){
			$errors[] = "Debes ingresar el ip";
		} elseif (empty($_POST['usuario'])){
			$errors[] = "Debes ingresar el usuario";
		} elseif (empty($_POST['password'])){
			$errors[] = "Debes ingresar el password";
		
       
		
        } elseif (empty($_POST['monto'])){
			$errors[] = "Debes ingresar el monto";
		
        }elseif (
			!empty($_POST['nodo'])
			&& !empty($_POST['plan'])
			&& !empty($_POST['usuario'])
			&& !empty($_POST['password'])
			
			&& !empty($_POST['remoteaddress'])
			

			
			&& !empty($_POST['monto'])
			)
        
{
            require_once ("../../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
       
 		require('../../../config/api_mt_include2.php');



			
			
		$plan = mysqli_real_escape_string($con,(strip_tags($_POST["plan"],ENT_QUOTES)));
		$remoteaddress = mysqli_real_escape_string($con,(strip_tags($_POST["remoteaddress"],ENT_QUOTES)));
		$mac = mysqli_real_escape_string($con,(strip_tags($_POST["mac"],ENT_QUOTES)));
		$usuario = mysqli_real_escape_string($con,(strip_tags($_POST["usuario"],ENT_QUOTES)));
		$password = mysqli_real_escape_string($con,(strip_tags($_POST["password"],ENT_QUOTES)));
		
		

		$precio = intval($_POST["monto"]);
		$id = intval($_POST["mod_id"]);
		$nodo = intval($_POST["nodo"]);
		$servicio = "pppoe";
				
				
				







				$fec = date("Y-m-d H:i:s");
				$iduser = $_SESSION['user_id'];



        $fname = $_SESSION['firstname'];
        $lname = $_SESSION['lastname'];

        $fullname = "$fname $lname";


        $query = "select * from clientesp where id=$id";
        $resultado = mysqli_query($con,$query) or die(mysqli_error());
        $row = mysqli_fetch_array($resultado);

        $plan_o=$row['plan'];
        $remoteadd=$row['remoteaddress'];
        $mac_o=$row['mac'];


        if ($remoteaddress != $remoteadd) {
          $detalle = "cambio la ip del cliente $id";
          $SI  = "INSERT INTO  logs(user_id,fecha,detalle)
                            VALUES('".$iduser."','".$fec."','".$detalle."');";
                            $query = mysqli_query($con,$SI);
                            
                              $token = Token;
                             $mensaje = "$fullname $detalle";
                              

                              $data = [
                                  'text' => $mensaje,
                                  'chat_id' => ChatId
                              ];

                              file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data) );
        }
          if ($mac_o != $mac) {
          $detalle = "cambio la mac del cliente $id";
          $SI  = "INSERT INTO  logs(user_id,fecha,detalle)
                            VALUES('".$iduser."','".$fec."','".$detalle."');";
                            $query = mysqli_query($con,$SI);


                              $token = Token;
                             $mensaje = "$fullname $detalle";
                              

                              $data = [
                                  'text' => $mensaje,
                                  'chat_id' => ChatId
                              ];

                              file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data) );
        }
         if ($plan_o != $plan) {
          $detalle = "cambio el plan del cliente $id a $plan";
          $SI  = "INSERT INTO  logs(user_id,fecha,detalle)
                            VALUES('".$iduser."','".$fec."','".$detalle."');";
                            $query = mysqli_query($con,$SI);

                              $token = Token;
                             $mensaje = "$fullname $detalle";
                              

                              $data = [
                                  'text' => $mensaje,
                                  'chat_id' => ChatId
                              ];

                              file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data) );
        }



				 

					// write new user's data into database
 				

 					  $sql = "UPDATE clientesp SET remoteaddress='".$remoteaddress."', plan='".$plan."', pago_total='".$precio."', id_mk='".$nodo."', mac='".$mac."', usuario='".$usuario."', password='".$password."'  WHERE id='".$id."';";

							
                     $query_update = mysqli_query($con,$sql);
                   
                      $delete = mysqli_query ($con,"delete from remoteaddress where ip='$remoteaddress'");
                    // if user has been added successfully
                    if ($query_update) {
                        $messages[] = "El plan ha sido modificado con éxito.....";

                        $sq="SELECT * FROM  mikrotik where idmikrotik=$nodo";
						    $quer = mysqli_query($con, $sq);
						    $rows=mysqli_fetch_array($quer);
    
                        $ip=$rows['ip'];
                    
                        $Username = $rows['mk_usuario'];
                        $Pass = $rows['mk_password'];
                        $Port = $rows['api'];

                         $tipocon = $rows['tipocon'];

                         if ($tipocon == 2) {
                            $ServerList = "$ip:$Port";
                         }else{
                          $ServerList = $ip;

                         }
                     

                    $API = new routeros_api();
                    $API->debug = false;
                if ($API->connect($ServerList, $Username, $Pass, $Port)) {

                 $BRIDGEINFO2 = $API->comm('/ppp/secret/print', array(
                              ".proplist" => ".id",
                              "?name"  => "$usuario",
                        
                  ));
                  $API->comm("/ppp/secret/set", array(
                            ".id"=>$BRIDGEINFO2[0]['.id'],
                             "name"     => $usuario,
                             "service"  => $servicio,
                             "password"     => $password,
                      
                      "profile"  => $plan,
                      "caller-id" => $mac,
                      "remote-address" => $remoteaddress,
                      


                  ));
                  $API->comm("/ppp/secret/add", array(																												
     		 						"name"     => $usuario,
     		 						"password" => $password,
     		 						
     		 						"caller-id" => $mac,
     		 						"service"  => $servicio,
	  		 						"profile"  => $plan,
	 								"remote-address" => $remoteaddress,
	  		 					
   				));
                   


                $API->disconnect();
                }
                 $API = new routeros_api();
                    $API->debug = false;
                    if ($API->connect($ServerList , $Username , $Pass, $Port)) {
                       $API->write("/ppp/active/getall",false);
                       $API->write('?name='.$usuario,true);
                       $READ = $API->read(false);
                       $ARRAY = $API->parse_response($READ);
                        if(count($ARRAY)>0){ // si el usuario esta activo lo pateo.
                             $API->write("/ppp/active/remove",false);
                             $API->write("=.id=".$ARRAY[0]['.id'],true);
                             $READ = $API->read(false);
                             $ARRAY = $API->parse_response($READ);
                        }
                       $API->disconnect();
                    }




                     
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