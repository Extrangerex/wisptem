<?php 
session_start();
require_once ("../../config/db.php");

        $idf=intval($_POST['idf']);
         $idc=intval($_POST['idc']);


	$fecc = date("Y-m-d H:i:s");
				$iduser = $_SESSION['user_id'];


$fname = $_SESSION['firstname'];
$lname = $_SESSION['lastname'];

$fullname = "$fname $lname";
				
      
  $query = "select * from clientesp where id=$idc";
$resultado = mysqli_query($con,$query) or die(mysqli_error());
$row = mysqli_fetch_array($resultado);

$fecfi=$row['fecha_final'];
$nombre=$row['nombres'];
$apellido = $row['apellido'];
  $cliente = "$nombre $apellido";

$fecha = date("Y-m-d",strtotime($fecfi."- 1 month"));

$update = mysqli_query($con, "update clientesp set fecha_final='$fecha' where id=$idc");
sleep(3);

        
        $delete1=mysqli_query($con,"DELETE FROM facturas WHERE numero_factura=$idf");




         $detalle = "Elimino la factura No: $idf del cliente $cliente (# $id)";
          $SI  = "INSERT INTO  logs(user_id,fecha,detalle)
                            VALUES('".$iduser."','".$fecc."','".$detalle."');";
                            $query = mysqli_query($con,$SI);
      

         $token = Token;
                             $mensaje = "$fullname elimino la factura No: ".$idf." del cliente ".$cliente." con el ID ".$idc;
                              

                              $data = [
                                  'text' => $mensaje,
                                  'chat_id' => ChatId
                              ];

                              file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data) );

           
  mysqli_close($con);
?>