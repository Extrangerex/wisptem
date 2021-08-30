<?php
date_default_timezone_set("America/Santo_Domingo");
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/

	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_nombre'])) {
           $errors[] = "Nombre vacío";
        }  else if ($_POST['mod_disable']==""){
			$errors[] = "Selecciona el estado del cliente";
			 }  else if ($_POST['mod_usuario']==""){
			$errors[] = "Debes ingresar un usuario";
		}  else if (
			!empty($_POST['mod_id']) &&
			!empty($_POST['mod_nombre']) &&
			!empty($_POST['mod_usuario']) &&
			$_POST['mod_disable']!="" 
		){
		/* Connect To Database*/
		require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require('../../config/routeros_api.class.php');
 		require('../../config/api_mt_include2.php');
		
		// escaping, additionally removing everything that could be (html/javascript-) code
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["mod_nombre"],ENT_QUOTES)));
		$apellido=mysqli_real_escape_string($con,(strip_tags($_POST["mod_apellido"],ENT_QUOTES)));
		$cell=mysqli_real_escape_string($con,(strip_tags($_POST["mod_cell"],ENT_QUOTES)));
		$cell2=mysqli_real_escape_string($con,(strip_tags($_POST["mod_cell2"],ENT_QUOTES)));
		$documento=mysqli_real_escape_string($con,(strip_tags($_POST["mod_documento"],ENT_QUOTES)));
		$fechainicial=mysqli_real_escape_string($con,(strip_tags($_POST["mod_fechainicial"],ENT_QUOTES)));
		$fechafinal=mysqli_real_escape_string($con,(strip_tags($_POST["mod_fechafinal"],ENT_QUOTES)));
		
		$plan=mysqli_real_escape_string($con,(strip_tags($_POST["mod_plan"],ENT_QUOTES)));
		$pago_total=mysqli_real_escape_string($con,(strip_tags($_POST["mod_pago_total"],ENT_QUOTES)));
		$usuario=mysqli_real_escape_string($con,(strip_tags($_POST["mod_usuario"],ENT_QUOTES)));
		$password=mysqli_real_escape_string($con,(strip_tags($_POST["mod_password"],ENT_QUOTES)));
		$remoteaddress=mysqli_real_escape_string($con,(strip_tags($_POST["mod_remoteaddress"],ENT_QUOTES)));
		$mac=mysqli_real_escape_string($con,(strip_tags($_POST["mod_mac"],ENT_QUOTES)));
		$poste=mysqli_real_escape_string($con,(strip_tags($_POST["mod_poste"],ENT_QUOTES)));
		$sector=mysqli_real_escape_string($con,(strip_tags($_POST["mod_sector"],ENT_QUOTES)));
		$empleado=mysqli_real_escape_string($con,(strip_tags($_POST["mod_empleado"],ENT_QUOTES)));
		$pago_instalacion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_pago_instalacion"],ENT_QUOTES)));
		$disable=mysqli_real_escape_string($con,(strip_tags($_POST["mod_disable"],ENT_QUOTES)));
		$comentario=mysqli_real_escape_string($con,(strip_tags($_POST["mod_comentario"],ENT_QUOTES)));

		$direccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_direccion"],ENT_QUOTES)));
		
		
		$id=intval($_POST['mod_id']);
    $diasp = intval($_POST['mod_dias_p']);


		$sql="UPDATE clientesp SET  poste='".$poste."',dias_p='".$diasp."',sector='".$sector."',nombres='".$nombre."', apellido='".$apellido."', documento='".$documento."', cell='".$cell."', cell2='".$cell2."', fecha_inicial='".$fechainicial."', fecha_final='".$fechafinal."', plan='".$plan."', pago_total='".$pago_total."', usuario='".$usuario."', remoteaddress='".$remoteaddress."', mac='".$mac."', id_empleado='".$empleado."', pago_instalacion='".$pago_instalacion."', direcion='".$direccion."', comentario='".$comentario."', disable='".$disable."' WHERE id='".$id."'";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Cliente ha sido actualizado satisfactoriamente.";

$ServerList=mikrotik_ip;   
$Username=mikrotik_usuario; 
$Pass=mikrotik_contrasena; 
$Port=mikrotik_puerto; 
$name = $usuario;  
$pas= $password;
$servicio="pppoe";

$perfil = $plan;
$mac= $mac;


  $comment="$nombre $apellido $fechafinal";


   $fec = date("Y-m-d H:i:s");
				$iduser = $_SESSION['user_id'];


				$ssl=mysqli_query($con,"select fecha_final from clientesp where id=$id");
				$row = mysqli_fetch_array($ssl);

				if ($fechafinal > $row["fecha_final"]){
					$detalle = "cambio la fecha de $usuario";
					 $SI  = "INSERT INTO  logs(user_id,fecha,detalle)
                            VALUES('".$iduser."','".$fec."','".$detalle."');";
                            $query = mysqli_query($con,$SI);
				}
	
	

                switch ($disable) {
                  case "no":
                 
				$detalle = "activo el cliente de $usuario";


				 $SI  = "INSERT INTO  logs(user_id,fecha,detalle)
                            VALUES('".$iduser."','".$fec."','".$detalle."');";
                            $query = mysqli_query($con,$SI);


                      $resulta=mysqli_query($con,"update clientesp set mora=0 where id='".$id."'");

               
                     $API = new routeros_api();
                    $API->debug = false;
                if ($API->connect($ServerList, $Username, $Pass, $Port)) {

                 $BRIDGEINFO2 = $API->comm('/ppp/secret/print', array(
                              ".proplist" => ".id",
                              "?name"  => "$name",
                        
                  ));
                  $API->comm("/ppp/secret/set", array(
                            ".id"=>$BRIDGEINFO2[0]['.id'],
                             "name"     => $name,
                      "password" => $pas,
                      "comment"  => $comment,
                      "service"  => $servicio,
                      "profile"  => $perfil,
                      "caller-id" => $mac,
                      "remote-address" => $remoteaddress,
                       "disabled" =>"no",



                  ));
                   


                $API->disconnect();
                }

                    break;
                  case "yes":
                 
				$detalle = "corto el usuario de $usuario";


				 $SI  = "INSERT INTO  logs(user_id,fecha,detalle)
                            VALUES('".$iduser."','".$fec."','".$detalle."');";
                            $query = mysqli_query($con,$SI);

                      $resulta=mysqli_query($con,"update clientesp set mora='".Mora."' where id='".$id."'");


                 
                  
                     $API = new routeros_api();
                    $API->debug = false;
                if ($API->connect($ServerList, $Username, $Pass, $Port)) {

                 $BRIDGEINFO2 = $API->comm('/ppp/secret/print', array(
                              ".proplist" => ".id",
                              "?name"  => "$name",
                        
                  ));
                  $API->comm("/ppp/secret/set", array(
                            ".id"=>$BRIDGEINFO2[0]['.id'],
                             "name"     => $name,
                      "password" => $pas,
                      "comment"  => $comment,
                      "service"  => $servicio,
                      "profile"  => $perfil,
                      "caller-id" => $mac,
                      "remote-address" => $remoteaddress,
                      "disabled" =>"yes",
                      


                  ));
                   


                $API->disconnect();
                }
                  break;
                  case "retirado":
                 
				$detalle = "retiro el usuario de $usuario";


				 $SI  = "INSERT INTO  logs(user_id,fecha,detalle)
                            VALUES('".$iduser."','".$fec."','".$detalle."');";
                            $query = mysqli_query($con,$SI);



                 
                    $API = new routeros_api();
                     $API = new routeros_api();
                    $API->debug = false;
                if ($API->connect($ServerList, $Username, $Pass, $Port)) {
                //Busca ID por Nome
                $API->write('/ppp/secret/print
                ?name='.($name)
                );
                $find = $API->read();
                //Remove ID encontrado de Acordo com o Nome.
                foreach ($find as $find){
                $API->write('/ppp/secret/remove', false); // remove, enable, disable
                $API->write('=.id='.$find['.id']);
                $API->read();
                }



                $API->disconnect();
                }



                }
                $API = new routeros_api();
                    $API->debug = false;
                    if ($API->connect($ServerList , $Username , $Pass, $Port)) {
                       $API->write("/ppp/active/getall",false);
                       $API->write('?name='.$name,true);
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


      $sql="delete from remoteaddress where ip='$remoteaddress'";
  $Records = mysqli_query($con,$sql) or die(mysqli_error());
 
  			
mysqli_close($con);

			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
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