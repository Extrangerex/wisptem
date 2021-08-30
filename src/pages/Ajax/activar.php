
<?php
require_once("../../config/db.php"); 


$id = intval($_POST['id']);


$query = "SELECT * FROM clientesp where id=$id";
$query = mysqli_query($con, $query);
$row = mysqli_fetch_array($query);






 require('../../config/api_mt_include2.php');





$usuario = $row['usuario']; 





$servicio="pppoe";
$postes=$row['poste'];
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
                      "service"  => $servicio,
                      "profile"  => $perfil,
                      "remote-address" => $remoteaddress,
                      "caller-id" => $mac,
                      


                  ));
                   $API->comm("/ppp/secret/add", array(                                                       
                    "name"     => $usuario,
                    "password" => $password,
                    
                    "caller-id" => $mac,
                    "service"  => $servicio,
                    "profile"  => $perfil,
                  "remote-address" => $remoteaddress,
                  
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


                        $list = "Aviso";

                         $API->write("/ip/firewall/address-list/getall",false);
       $API->write('?address='.$remoteaddress,false);
       $API->write('?list='.$list,true);       
       $READ = $API->read(false);
       $ARRAY = $API->parse_response($READ); // busco si ya existe
        if(count($ARRAY)>0){ 
            $ID = $ARRAY[0]['.id'];
            $API->write('/ip/firewall/address-list/remove', false);
            $API->write('=.id='.$ID, true);
            $READ = $API->read(false);
        }
                    

                   


                $API->disconnect();
                }

              

             
            
              
  $update=mysqli_query($con,"update clientesp set disable='no' where id=$id");
  

mysqli_close($con);
  
?>
