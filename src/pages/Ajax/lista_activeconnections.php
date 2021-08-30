<?php 
date_default_timezone_set("America/Santo_Domingo");
require_once ("../../config/db.php");

session_start();

require('../../config/api_mt_include2.php');
$sql   = "SELECT * FROM  mikrotik";
$query = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($query)) {
    $nodo = $row['nodo'];
    $ip   = $row['ip'];
    $api  = $row['api'];
    
    $mk_usuario  = $row['mk_usuario'];
    $mk_password = $row['mk_password'];
    $mk_puerto   = $row['api'];
    $tipocon     = $row['tipocon'];
    
    if ($tipocon == 2) {
        $mk_ip = "$ip:$api";
    } else {
        $mk_ip = $ip;
    }
  $API = new routeros_api();
    $API->debug = false;

     $API-$API->connect($mk_ip, $mk_usuario, $mk_password, $mk_puerto);
                        $API->write("/ppp/active/getall",true);

                        $READ = $API->read(false);
                        $ARRAY = $API->parse_response($READ);
                        if(count($ARRAY)>0){   // si hay mas de 1 queue.
                            for($x=0;$x<count($ARRAY);$x++){
                $total=$total+1;

    $nam= $ARRAY[$x]['name'];
               $sql=mysqli_query($con, "select * from clientesp where usuario='$nam'");




                $row=mysqli_fetch_array($sql);



                                $nombre=$row['nombres'];
                                $cell=$row['cell'];
                                $cell2=$row['cell2'];
                                $direccion=$row['direcion'];
                                $comentario=$row['comentario'];
                                $categoria=$row['categoria'];
                                $pago=$row['pago_total'];
                                $fechainicial=$row['fecha_inicial'];
                                $fechafinal=$row['fecha_final'];
                                $dias=$row['dias_p'];
                                $apellido= $row['apellido'];
                                $disable=$row['disable'];
                                $password=$row['password'];
                                $documento= $row['documento'];
                                $usuario=  $row['usuario'];
                                $plan=  $row['plan'];
                                $mac=  $ARRAY[$x]['address'];
                                $poste= $row['poste'];
                                $sector=$row['sector'];
                                $pagoinstalacion=$row['pago_instalacion'];
                                $remoteaddress=$row['remoteaddress'];
                                $empleado=$row['id_empleado'];
                                $id=$row['id'];
                                








                                if (empty($row['usuario'])) {

                    $colour="red";
                    $codea = " <a href='#' data-target='#newcliente' data-toggle='modal' onclick='obtener_datos($total);'  > ";


                }
                    else{
                        $colour="green";
                        $codea = "<a  href='perfil.php?id=$id' title='Editar cliente'  >";

                }
}
mysqli_close($con);

?>