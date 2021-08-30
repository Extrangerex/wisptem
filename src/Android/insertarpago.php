
<?php
require_once 'include/db_functions.php';

date_default_timezone_set("America/Santo_Domingo");
$response = array("error" => FALSE);
$idv= $_REQUEST['idv'];

$id =  $_REQUEST['id'];


$query_usuario = "select firstname, lastname from users where user_id=$idv";
$resulta = mysqli_query($con,$query_usuario);
$user = mysqli_fetch_array($resulta);
$fname = $user['firstname'];
$lname = $user['lastname'];

$fullname = "$fname $lname";


$query_mayor = "select max(numero_factura)+1 as mayor from facturas";
$res = mysqli_query($con,$query_mayor);
$row = mysqli_fetch_array($res);

$max= $row['mayor'];



$sql = "select * from clientesp where id=$id";
$query = mysqli_query($con,$sql);
$rows = mysqli_fetch_array($query);
$totalRows_query = mysqli_num_rows($query);
$dat=date('Y-m-d H:i:s');
$plazo=1;
$pago=$rows['pago_total'];
$fec=$rows['fecha_final'];
$nodo= $rows['id_mk'];
$disable= $rows['disable'];
$usuario = $rows['usuario'];  // ---- nombre del usuario pppoe
$password= $rows['password'];
$servicio="pppoe";
$postes=$rows['poste'];
$perfil = $rows['plan'];
$mac= $rows['mac'];
$fechafinal=$rows['fecha_final'];
$nombre=$rows['nombres'];
$apellido = $rows['apellido'];
$remoteaddress = $rows['remoteaddress'];

  $comentario = "$fechafinal $nombre $apellido";
  $cliente = "$nombre $apellido";

$actual=date('Y-m-d');
$fecha = date('Y-m-d',strtotime('+1 month', strtotime($fec)));

$sql="insert into facturas(numero_factura,fecha_factura,id_cliente,id_vendedor,condiciones,total_venta,estado_factura)
    values($max,'$dat','$id','$idv','2','$pago','1')";
$registrar_pago = mysqli_query($con,$sql);


sleep(1);

if ($registrar_pago){

   $response["error"] = FALSE;

  $response["resultado"]= "Guardado con Exito";
   echo json_encode($response);



    $fec = date("Y-m-d H:i:s");
      
        $detalle = "le cobro RD$ ".$pago." al cliente ".$cliente." con el ID ".$id;
         $SI  = "INSERT INTO  logs(user_id,fecha,detalle)
                            VALUES('".$idv."','".$fec."','".$detalle."');";
                             $query = mysqli_query($con,$SI);





                             $token = "914014782:AAH_lovY8VUjYxS6JcGZGhKvz86CaiJ688k";
                             $mensaje = "$fullname le cobro RD$ ".$pago." al cliente ".$cliente." con el ID ".$id;
                              

                              $data = [
                                  'text' => $mensaje,
                                  'chat_id' => '-378479363'
                              ];

                              file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data) );

                        
   
            

}
else
{
   $response["error"] = TRUE;
    $response["error_msg"] = "Error guardando el pago !";
    echo json_encode($response);
         
    
}


$sql="update clientesp set fecha_final='$fecha' where id=$id";
$update_fecha = mysqli_query($con,$sql);




$sq="SELECT * FROM  mikrotik where idmikrotik=$nodo";
    $quer = mysqli_query($con, $sq);
    $data=mysqli_fetch_array($quer);






 require('../config/api_mt_include2.php');
   

$Username = $data['mk_usuario'];
$Pass = $data['mk_password'];
$Port = $data['api'];

                        $tipocon = $data['tipocon'];
                        $api=$data['api']; 
                         $ip=$data['ip'];
                        if ($tipocon == 2) {
                          $ServerList = "$ip:$api";
                        }else{
                             $ServerList = $ip;
                        }


$list=    "Aviso";

  if( $remoteaddress !="" && $list!=""  ){
    $API = new routeros_api();
    $API->debug = false;
    if ($API->connect($ServerList, $Username, $Pass, $Port)) {

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
}

  
  
  If ($disable=='yes'){

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


}

$sql="update clientesp set disable='no' where id=$id";
$update_estado = mysqli_query($con,$sql);


sleep(1);


mysqli_close($con);
unset($registrar_pago);
unset($con);

?>
