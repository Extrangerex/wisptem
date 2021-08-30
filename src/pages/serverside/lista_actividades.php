 <?php
date_default_timezone_set("America/Santo_Domingo");
require_once ("../../config/db.php");
include_once ("../../config/functions.php");
$id = intval($_POST['id']);

$sql="SELECT * FROM logs,users WHERE users.user_id=logs.user_id AND users.user_id  =$id order by logs.fecha desc";
$res=mysqli_query($con,$sql);

$salida='';
while ($data=mysqli_fetch_array($res)){
  $fname = $data['firstname'];
$lname = $data['lastname'];
$fecha = $data['fecha'];
$detalle = $data['detalle'];
$nombre="$fname $lname";
$hoy = date('Y-m-d H:i:s');
$tiempo = tiempoTranscurridoFechas($fsesion,$hoy);

    $salida .='  <li class="time-label">
  <span class="bg-red">'.$fecha.'</span>
</li>
<li>
  <i class="fa fa-user"></i> Topic
  <div class="timeline-item">
    
    <h8 class="timeline-header"><a href="#">'.$nombre.'</a> '.$detalle.'</h8>
   
   
  </div>
</li><p></p>';
}


echo $salida;
mysqli_close($con);

?>


  

              

