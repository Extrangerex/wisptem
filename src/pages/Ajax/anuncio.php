
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

  $comentario = "$nombre $apellido $remoteaddress";
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
                     



                            $address=$remoteaddress;
                              $list=    "Aviso";  
                              $port = "8080";
                              $ipserver= jitechserver;
                              $action = "deny";
                              $link= "$ipserver/anuncio/index.php?id=".$id;
      

               
                     $API = new routeros_api();
                    $API->debug = true;
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

                          	$url = "https://api.telegram.org/bot917766792:AAEkNJxk4nnRvyDFa2qYplV8132nLEnywUY/sendmessage\?chat_id=-336579228&text=$user conectado";


                           $API->write("/tool/fecth",false);
                       $API->write('=url='.$url,true);
                      
                       $READ = $API->read(false);
                       
                           
                     






                $API->disconnect();
                }

              

                
              



  mysqli_close($con);
  
?>
