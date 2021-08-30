 <?php
date_default_timezone_set("America/Santo_Domingo");
require_once ("../../config/db.php");
include_once ("../../config/functions.php");
$sql="SELECT * FROM users WHERE online=1";
$res=mysqli_query($con,$sql);

 $salida='<ul class="menu">';
while ($data=mysqli_fetch_array($res)){
  $fname = $data['firstname'];
$lname = $data['lastname'];
$fsesion = $data['fecha_sesion'];
$nombre="$fname $lname";
$hoy = date('Y-m-d H:i:s');
$tiempo = tiempoTranscurridoFechas($fsesion,$hoy);

    $salida .='   <li>
                      <a href="perfilusuario.php?id='.$data['user_id'].'">
                        <div class="pull-left">
                          <img style="width: 20px; height: 20px;" src="'.$data['foto'].'" class="img-circle" alt="User Image">
                        </div>
                        <small> ' .$nombre.' conectado(a) hace
                        <small><i class="fa fa-clock-o"></i> '.$tiempo.'</small>
                        </small>
                        
                      </a>
                    </li><p></p>';
}
$salida .='</ul>';
echo $salida;
mysqli_close($con);

?>

  

              

