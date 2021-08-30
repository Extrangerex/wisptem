<?php
	
date_default_timezone_set("America/Santo_Domingo");
require_once ("../../config/db.php");

require('../../config/api_mt_include2.php');


$id = intval($_GET['id']);
$name = $_GET['usuario'];

 $sql="SELECT * FROM  mikrotik where idmikrotik=$id";
    $query = mysqli_query($con, $sql);
    $row=mysqli_fetch_array($query);
     
                        $mk_ip=$row['ip'];
                   
                        $mk_usuario = $row['mk_usuario'];
                        $mk_password = $row['mk_password'];
                        $mk_puerto = $row['api'];
                        
                        $tipocon = $row['tipocon'];
                        $api=$row['api']; 
                         $ip=$row['ip'];
                        if ($tipocon == 2) {
                          $mk_ip = "$ip:$api";
                        }else{
                             $mk_ip = $ip;
                        }

                          $API = new routeros_api();
    $API->debug = false;
                    
 
                        $API-$API->connect($mk_ip, $mk_usuario, $mk_password, $mk_puerto);
                         $API->write('/ppp/active/print
                ?name='.($name)
                );

                       $READ = $API->read(false);
                        $ARRAY = $API->parse_response($READ);
                       
                           if(count($ARRAY)>0){ // si esta conectado

                            $data = "<label><span class='badge badge-success'>Online</span></label>";
                            
                             


                        }else{
                           $data = "<label><span class='badge badge-danger'>Offline</span></label>";
                          
                           

                        }

    $API->disconnect();
  


  echo $data;

    mysqli_close($con);

   
?>