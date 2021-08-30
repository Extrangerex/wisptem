<?php
date_default_timezone_set("America/Santo_Domingo");
header('Content-Type: application/json');
require_once ("../../config/db.php");
$ip = $_GET['ip'];
$idm = $_GET['idmk'];
$cliente = $_GET['id'];
$action = $_GET['action'];
$date = date('Y-m-d');
 $data = array();

// ============================================================================================= 

if ($action == 'mikrotik') {
          $subida = 0;
          $descarga =0;
           $sql="SELECT * FROM  mikrotik where idmikrotik=$idm";
              $query = mysqli_query($con, $sql);
              $row=mysqli_fetch_array($query);

             $mk_ip=$row['ip'];
                             
                                

          for ($i=0; $i <= 6; $i++) { 
                 $subida = 0;
                        $descarga =0;
            $fecha= date('Y-m-d',strtotime('-'.$i.' days'));

            $query ="SELECT * FROM trafico WHERE  fecha LIKE '%$fecha%'";
            $resultado = mysqli_query($con,$query);

            while ($row = mysqli_fetch_array($resultado)){
            	 $bytes = explode("/", $row["bytes"]);
                         $subida += $bytes[0];
                         $descarga += $bytes[1];


  }




	$elemento = array("descarga" => $descarga, "subida" =>$subida, "fecha" =>$fecha);

	array_push($data, $elemento);

}
echo json_encode($data);
mysqli_close($con);
}

// ============================================================================================= 


if ($action == 'clientehoy') {

                        $subida = 0;
                        $descarga =0;
                        $datos = array();


          

                        for ($i=0; $i <= 6; $i++) { 
                          $fec= date('Y-m-d',strtotime('-'.$i.' days'));
                               $subida = 0;
                        $descarga =0;

                          $query ="SELECT * FROM trafico WHERE cliente= $cliente and fecha LIKE '%$fec%' ";
                          $resultado = mysqli_query($con,$query);

                        $row = mysqli_fetch_array($resultado);
                        $bytes = explode("/", $row["bytes"]);
                         $subida += $bytes[0];
                         $descarga += $bytes[1];

                  

                          




                          $elemento = array("descarga" => $descarga, "subida" =>$subida, "fecha" =>$fec);

                          array_push($datos, $elemento);

                        }
                        echo json_encode($datos);
                        mysqli_close($con);
}


	
// ============================================================================================= 

  if ($action == 'topserver') {
    
                      $query ="select src, count(src) AS cuenta from conexiones WHERE ip='$ip' group by src order by count(src) desc LIMIT 10";
                    $resultado = mysqli_query($con,$query);

                       while ($row = mysqli_fetch_array($resultado)){ 
                        $dns = gethostbyaddr($row['src']);
                        $cuenta = $row['cuenta'];

                          $element = array("dns" => $dns, "cuenta" =>$cuenta);
                            array_push($data, $element);
                      }

                        echo json_encode($data);
                        mysqli_close($con);

  }

  // ============================================================================================= 


   if ($action == 'topserveradmin') {

                  
                  $query ="select src, count(src) AS cuenta from conexiones group by src order by count(src) desc LIMIT 10";
                $resultado = mysqli_query($con,$query);

                   while ($row = mysqli_fetch_array($resultado)){ 

                    $host = gethostbyaddr($row['src']);
                    $a=$row['src'];
                    $dns ="$host($a)";
                    $cuenta = $row['cuenta'];

                      $element = array("dns" => $dns, "cuenta" =>$cuenta);
                        array_push($data, $element);
                  }

                    echo json_encode($data);
                    mysqli_close($con);

  }

?>