
<?php

require('/var/www/admin/html/config/api_mt_include2.php');

include('/var/www/admin/html/config/db.php');

date_default_timezone_set("America/Santo_Domingo");
$hoy = date('Y-m-d');

$query = mysqli_query($con,"SELECT * FROM clientesp WHERE fecha_final='$hoy' and disable='no' and anuncio='yes'");



  $API = new routeros_api();
                    $API->debug = false;




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

                            $address=$remoteaddress;
                              $list=    "Aviso";  
                              $port = "8080";
                              $action = "deny";
                              $link= jitechserver."/anuncio/index.php?id=".$id;
      
                     

  


    if ($API->connect($ServerList, $Username, $Pass, $Port)) {

                     $API->write("/ip/firewall/address-list/getall",false);
                       $API->write('?src-address='.$address,false);
                       $API->write('?list='.$list,true);       
                       $READ = $API->read(false);
                       $ARRAY = $API->parse_response($READ); // busco si ya existe
                        if(count($ARRAY)>0){ 
                            echo "Error: Ya existe " . $list ." con la direccion: ".$address;
                        }else{ // si no existe lo creo
                            $API->write("/ip/firewall/address-list/add",false);
                            $API->write('=address='.$address,false);  
                            $API->write('=list='.$list,false);      
                            $API->write('=comment='.$comentario,true);  
                            $READ = $API->read(false);
                            $ARRAY = $API->parse_response($READ);
                           
                        }




                     $ARRAY2 = $API->comm("/ip/proxy/access/print", array("?src-address" => "$address"));

                       

                        if(count($ARRAY2)==0){ 
                         

                            
                  
                    

                          $API->write("/ip/proxy/access/add",false);
                            $API->write('=src-address='.$address,false);  
                            $API->write('=local-port='.$port,false); 
                           $API->write('=action='.$action,false);
                            $API->write('=redirect-to='.$link,false);  
                            $API->write('=comment='.$comentario,true);  
                            $READ = $API->read(false);
                            $ARRAY = $API->parse_response($READ);
                          }

                        
                     






               
                }

  $API->disconnect();

}

?>
