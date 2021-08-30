<?php
date_default_timezone_set("America/Santo_Domingo");
include('is_logged.php');
/* Connect To Database*/
require_once ("../../config/db.php");

$id = intval($_POST['id']);
$sql = "select id,nombres,apellido,pago_total,mora,fecha_final from clientesp where id=$id";

$result = mysqli_query ($con,$sql);

$row = mysqli_fetch_array($result);

$montot = $row['pago_total'] + $row['mora'];
$fechafin=$row['fecha_final'];
?>

<div class="box">
                <div class="box-header with-border">
                  <strong class="box-title ">Abonar factura de :  <a type="text" > <?php echo $row['nombres']; ?> <?php echo $row['apellido']; ?></a></strong>
                </div>
<p>&nbsp;</p>

    <div class="row form-group">
                                    <div class="col col-sm-2"><label for="input-small" class=" form-control-label" >Efectivo</label></div>
                                    <div class="col col-sm-3">
                                      <input type="number" id="efectivo" name="efectivo" value=""  class="input-sm form-control-sm form-control" >
                                    </div>
                                  </div>
    <div class="row form-group">

                                    <div class="col col-sm-2"><label for="input-small" class=" form-control-label">Monto Total</label></div>
                                    <div class="col col-sm-3">
                                      <input type="hidden" id="idf" name="idf" value="<?php echo $id; ?>" >
                                      <input type="hidden" id="ff" name="ff" value="<?php echo $fechafin; ?>" >
                                      <input type="number" id="montop" name="montop" value="<?php echo $montot; ?>" readonly class="input-sm form-control-sm form-control">
                                    </div>
                                  </div>
                                    <div class="row form-group">

                                     <div class="col col-sm-2"><label for="input-small" class=" form-control-label" required>Monto a Cobrar</label></div>
                                    <div class="col col-sm-3">
                                      <input type="number" id="montoc" name="montoc" value=""  class="input-sm form-control-sm form-control" required>
                                    </div>
                                  </div>
                                      <div class="row form-group">
                                      <div class="col col-sm-2"><label for="input-small" class=" form-control-label">Monto Restante</label></div>
                                    <div class="col col-sm-3">
                                      <input type="number" id="montor" readonly name="montor" value=""  class="input-sm form-control-sm form-control">
                                    </div>
                                  </div>
                                     <div class="row form-group">
                                    <div class="col col-sm-2"><label for="input-small" class=" form-control-label" >Devuelta</label></div>
                                    <div class="col col-sm-3">
                                      <input type="number" id="devuelta" name="devuelta" value=""  class="input-sm form-control-sm form-control" readonly >
                                    </div>
                                  </div>




</div>

<p>&nbsp;</p>
 


<script type="text/javascript">
  $(document).ready(function(){
    $('#montoc').on('keyup',function(){
var montoc = $(this).val();
var montop= $("#montop").val();
var efectivo= $("#efectivo").val();
var montor = montop - montoc;
var devuelta = efectivo - montoc;
document.getElementById("montor").value = montor;
if (efectivo > 0){
document.getElementById("devuelta").value = devuelta;
}
});

  });
         
</script>