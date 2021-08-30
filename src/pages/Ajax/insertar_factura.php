
<?php require_once ("../../config/db.php"); ?>


<?php
sleep(4);
session_start();


$id = $_POST['id'];

$idv = $_SESSION['user_id'];


$query_usuario = "select firstname, lastname from users where user_id=$idv";
$resulta = mysqli_query($con,$query_usuario);
$user = mysqli_fetch_array($resulta);
$fname = $user['firstname'];
$lname = $user['lastname'];

$fullname = "$fname $lname";



$query = "select max(numero_factura)+1 as mayor from facturas";
$res = mysqli_query($con,$query) or die(mysqli_error());
$rows = mysqli_fetch_array($res);
$num = mysqli_num_rows($res);
if ($rows['mayor'] == NULL){
  $max = 1;
}else{


$max= $rows['mayor'];
}


$query = "select * from clientesp where id=$id";
$resultado = mysqli_query($con,$query) or die(mysqli_error());
$row = mysqli_fetch_array($resultado);
$total = mysqli_num_rows($resultado);
$dat=date('Y-m-d H:i:s');
$plazo=1;
$pago=$row['pago_total'] + $row['mora'];
$fec=$row['fecha_final'];
$mora = $row['mora'];
$nombre=$row['nombres'];
$apellido = $row['apellido'];
  $cliente = "$nombre $apellido";
$actual=date('Y-m-d');
$fecha = date('Y-m-d',strtotime('+1 month', strtotime($fec)));

$ndias = $fec - $actual;



$sql="insert into facturas(numero_factura,fecha_factura,id_cliente,id_vendedor,condiciones,total_venta,estado_factura,mora)
	  values($max,'$dat','$id',$idv,'1','$pago','1',$mora)";
$Records = mysqli_query($con, $sql) or die(mysqli_error());

$sql="update clientesp set fecha_final='$fecha',mora=0 where id=$id";
$Records = mysqli_query($con,$sql) or die(mysqli_error());



                          
$fec = date("Y-m-d H:i:s");

$detalle = "le cobro RD$ ".$pago." al cliente ".$cliente." con el ID ".$id;
$SI  = "INSERT INTO  logs(user_id,fecha,detalle)
VALUES('".$idv."','".$fec."','".$detalle."');";
$query = mysqli_query($con,$SI);


                             $token = Token;
                             $mensaje = "$fullname le cobro RD$ ".$pago." al cliente ".$cliente." con el ID ".$id;
                              

                              $data = [
                                  'text' => $mensaje,
                                  'chat_id' => ChatId
                              ];

                              file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data) );

                        


 require('../../config/api_mt_include2.php');


$postes=$row['poste'];
$perfil = $row['plan'];
$mac= $row['mac'];
$fechafinal=$row['fecha_final'];
$nombre=$row['nombres'];
$apellido = $row['apellido'];
$remoteaddress = $row['remoteaddress'];
$comment = "$nombre $apellido $fechafinal";
$disable= $row['disable'];
$name = $row['usuario'];
$pas = $row['password'];
$servicio = "pppoe";
$nodo= $row['id_mk'];



$sq="SELECT * FROM  mikrotik where idmikrotik=$nodo";
    $quer = mysqli_query($con, $sq);
    $data=mysqli_fetch_array($quer);


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



if ($disable=='yes'){

   
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



                  ));
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
}
	
$sql="update clientesp set disable='no' where id=$id";
$update = mysqli_query($con,$sql) or die(mysql_error());

mysqli_close($con);
?>

