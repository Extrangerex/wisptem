
<?php

require('/var/www/admin/html/config/api_mt_include2.php');

include('/var/www/admin/html/config/db.php');

date_default_timezone_set("America/Santo_Domingo");
$cant = Prologa;

$query = mysqli_query($con,"SELECT * FROM clientesp WHERE TIMESTAMPDIFF(DAY, fecha_final , CURDATE()) > $cant and disable='no' and corte_auto='yes'");








while($row = mysqli_fetch_array($query)){
  


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

$usuario = $row['usuario']; 
$id =  $row['id']; 
 $nodo= $row['id_mk'];








  $sql="update clientesp set disable='yes',mora=100 where id=$id";
  $update = mysqli_query($con,$sql);

  $perfil=$row['plan'];



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

  
  
  }


  $API->disconnect();

}

?>
