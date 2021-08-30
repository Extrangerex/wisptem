<?php
date_default_timezone_set("America/Santo_Domingo");
require_once ("../../../config/db.php");
require_once ("../../../config/functions.php");

session_start();

 $id=$_POST['id'];

     
                      

                    
   


	$count_query   = mysqli_query($con, "SELECT count(*) AS total FROM clientesp where id=$id");
    $rows= mysqli_fetch_array($count_query);
    $numrows = $rows['total'];
   
    $sql="SELECT * FROM  clientesp where id=$id";
    $query = mysqli_query($con, $sql);
	$row=mysqli_fetch_array($query);
	
if ($numrows>0){
  if ($row['id_pago'] !=2 ) {
    echo "Este cliente no debe la instalacion";
    
  }else{
      ?>
    
<div class="row form-group">
  <div class="col-3 col-sm-3">
      <label class=" form-control-label">Nombre: </label>
  </div>
  
   <div class="col-3 col-sm-3">
      <label class=" form-control-label"><?php echo $row['nombres']; ?></label>
  </div>
  <div class="col-3 col-sm-3">
      <label class=" form-control-label">Apellido: </label>
  </div>
  <div class="col-3 col-sm-3">
      <label class=" form-control-label"><?php echo $row['apellido']; ?></label>
  </div>
</div>
<div class="row form-group">
    <div class="col-3 col-sm-3">
      <label class=" form-control-label">Monto del crédito: </label>
  </div>
  <div class="col-3 col-sm-3">
      <label class=" form-control-label"><?php echo $row['pago_instalacion']; ?></label>
  </div>
  
</div>
<?php 
}
}
else{
  echo "No existe cliente con este ID";
}
mysqli_close($con);
?>
