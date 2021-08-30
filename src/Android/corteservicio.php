<?php require_once('../config/db.php'); ?>
<?php
date_default_timezone_set("America/Santo_Domingo");
$response = array("error" => FALSE);


$id = $_GET['id'];

$query = "SELECT * FROM clientesp where id=$id";
$query = mysqli_query($con, $query);
$row = mysqli_fetch_array($query);






require('../config/api_mt_include2.php');





$usuario = $row['usuario']; 


$perfil = $row['plan'];
$mac= $row['mac'];
$fechafinal=$row['fecha_final'];
$nombre=$row['nombres'];
$apellido = $row['apellido'];
$password = $row['password'];
$remoteaddress = $row['remoteaddress'];

  $comentario = "$nombre $apellido $fechafinal";
  $disable= $row['disable'];
  $nodo= $row['id_mk'];



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
                      "password" => $password,
                      "comment"  => $comentario,
                      "service"  => "pppoe",
                      "profile"  => "cortado",
                     
                      "caller-id" => $mac,
                      


                  ));
                     $BRIDGEINFO2 = $API->comm('/ppp/secret/unset', array(
                              
                              "numbers"  => $usuario,
                              "value-name" =>"remote-address",
                        
                  ));
                 
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

              

               
                
              
                
              
  $update=mysqli_query($con,"update clientesp set disable='yes' where id=$id");
  
  
 mysqli_close($con);
?>
