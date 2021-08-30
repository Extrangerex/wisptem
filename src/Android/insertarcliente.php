<?php 
require_once('../config/db.php'); 

 		require('../config/api_mt_include2.php');
date_default_timezone_set("America/Santo_Domingo");

$id_empleado = intval($_REQUEST['id_empleado']);
$password = ppp_pass;
$cmd = "select firstname,lastname from users where user_id=$id_empleado";
$emp = mysqli_query($con,$cmd);
$row = mysqli_fetch_array($emp);
$fname = $row['firstname'];
$lname = $row['lastname'];


$comentario = "agregado por $fname $lname desde la aplicacion android";



$remote = mysqli_query($con,"select min(id),ip from remoteaddress");
$rows = mysqli_fetch_array($remote);

$remoteaddress = $rows['ip'];




$nombre = $_REQUEST['nombre'];
$apellido = $_REQUEST['apellido'];
$documento = $_REQUEST['documento'];
$cell = $_REQUEST['cell'];
$fechainicial = $_REQUEST['fechaini'];
$fechafinal = $_REQUEST['fechafin'];
$plan = $_REQUEST['plan'];
$pago_total = intval($_REQUEST['monto']);
$usuario = $_REQUEST['usuario'];
$poste = $_REQUEST['poste'];
$sector = $_REQUEST['sector'];
$direccion = $_REQUEST['direccion'];

$respuesta = array();
$date_added = date('Y-m-d H:i:s');

$sql="insert into clientesp(nombres,apellido,documento,cell,fecha_inicial,fecha_final,plan,pago_total,usuario,remoteaddress,password,poste,sector,id_empleado,direcion,comentario,disable,date_added) VALUE ('$nombre','$apellido','$documento','$cell','$fechainicial','$fechafinal','$plan',$pago_total,'$usuario','$remoteaddress','$password','$poste','$sector',$id_empleado,'$direccion','$comentario','no','$date_added')";
$insertar = mysqli_query($con,$sql);
if ($insertar){

$respuesta['resultado'] = true;
$respuesta['mensaje'] = "Cliente agregado con exito";
$fec = date("Y-m-d H:i:s");
				
				$detalle = "agrego el cliente con el usuario $usuario desde la aplicacion android";


				 $SI  = "INSERT INTO  logs(user_id,fecha,detalle)
                            VALUES('".$id_empleado."','".$fec."','".$detalle."');";
                $query = mysqli_query($con,$SI);



				$ServerList=mikrotik_ip;   
				$Username=mikrotik_usuario; 
				$Pass=mikrotik_contrasena; 
				$Port=mikrotik_puerto; 

				$servicio="pppoe";
				$comment="$nombre $apellido $fechafinal";
				$name = $usuario;
				
				$API = new routeros_api();
   		 		$API->debug = false;

   					 if ($API->connect($ServerList , $Username , $Pass, $Port)) {
      			 			$API->write("/ppp/active/getall",false);
       						$API->write('?name='.$name,true);      
      			 			$READ = $API->read(false);
      						 $ARRAY = $API->parse_response($READ);
        					if(count($ARRAY)>0){ // si el usuario esta activo lo pateo.
  								$API = new routeros_api();
    							$API->debug = false;
								if ($API->connect($ServerList, $Username, $Pass, $Port)) { 
					
										$API->write('/ppp/secret/print
										?name='.($name)
										);
										$find = $API->read();
										
										foreach ($find as $find){
											$API->write('/ppp/secret/remove', false); // remove, enable, disable
											$API->write('=.id='.$find['.id']);
											$API->read();
										}


						  			$API->comm("/ppp/secret/add", array(
      								"name"     => $name,
      								"password" => $password,
     						 		"comment"  => $comment,
     							 	
      								"service"  => $servicio,
	 						 		"profile"  => $plan,
	 						 		"remote-address" => $remoteaddress,
	 						 		"local-address" => local_address
	  
  							 		));



									$API->disconnect();
								}
        					}
						else
							{																																										
			  						$API->comm("/ppp/secret/add", array(																												
     		 						"name"     => $usuario,
     		 						"password" => $password,
     		 						"comment"  => $comment,
     		 					
     		 						"service"  => $servicio,
	  		 						"profile"  => $plan,
	 								"remote-address" => $remoteaddress
   									));
							}
       								$API->disconnect();

       								

    				}














}

$delete = "delete from remoteaddress where ip='$remoteaddress'";
$del = mysqli_query($con,$delete);


echo json_encode($respuesta);

mysqli_close($con);







?>