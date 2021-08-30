<?php
if (isset($con))
{
$sql="select max(id) as mayor from clientesp";
$Records = mysqli_query($con,$sql) or die(mysql_error());
$resul=mysqli_fetch_array($Records);
$mayor=$resul['mayor']+1;

?>
<div class="modal fade" id="newcliente" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h8 class="modal-title"><i class="fa fa-users"></i> Nuevo Cliente</h8>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post"  name="gduser" id="gduser" autocomplete="off">
          
          
          
          
          <div class="card-body">
            
            <div id="ajax"></div>
            <div class="row">
            <div class="col-sm-3">
             <label>ID</label>
            <input style="background-color: #87CEEB;"  class="input-sm input-sm form-control-sm form-control-sm input-sm form-control-sm form-control"  type="number" name="id" id="id" value="<?php echo $mayor; ?>">
            </div>
            </div>
            
            
            
            
            <div class="row">
              
              <div class="col-sm-6">
                <label>Nombre</label>
                
                <input  style="background-color: #87CEEB;" type="text" class="input-sm input-sm form-control-sm form-control-sm input-sm form-control-sm form-control"   name="nombre" id="nombre" >
              </div>
              <div class="col-sm-6">
                <label>Apellido</label>
                <input  style="background-color: #87CEEB;" type="text" class="input-sm input-sm form-control-sm form-control-sm input-sm form-control-sm form-control"   name="apellido" id="apellido" >
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <label>Cedula o Pasaporte</label>
                <input  style="background-color: #87CEEB;" type="text" class="input-sm input-sm form-control-sm form-control-sm input-sm form-control-sm form-control"  name="documento" id="documento" >
              </div>
              <div class="col-sm-3">
                
                <label for="cell">Cell</label>
                <div class="input-group">
                  <input  style="background-color: #87CEEB;" name="cell" type="text" class="input-sm input-sm form-control-sm form-control-sm input-sm form-control-sm form-control" id="cell"   placeholder="(8xx) xxx-xxxx">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                </div>
                
              </div>
              <div class="col-sm-3">
                <label for="cell2">TEL.</label>
                <div class="input-group">
                  
                  <input  style="background-color: #87CEEB;" name="cell2" type="text" class="input-sm form-control-sm form-control" id="cell2" placeholder="(8xx) xxx-xxxx" >
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-sm-6">
                <label>Fecha de Instalacion</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  
                  <input  style="background-color: #87CEEB;" class="input-sm input-sm form-control-sm form-control-sm input-sm form-control-sm form-control"   name="fechainicial" id="fechainicial" >
                </div>
              </div>
              <div class="col-sm-6">
                <label>Fecha de Pago</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input  style="background-color: #87CEEB;"  class="input-sm input-sm form-control-sm form-control-sm input-sm form-control-sm form-control"   name="fechafinal" id="fechafinal" >
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <label>No de Poste</label>
                <input  style="background-color: #87CEEB;" type="text" class="input-sm form-control-sm form-control"  name="poste" id="poste" >
              </div>
              <div class="col-sm-6">
                <label>Sector</label>
                <select  style="background-color: #87CEEB;" name="sector" class="input-sm form-control"    id="sector">
                  <option value=""></option>
                  <?php
                  $sql="select * from sector order by nombre asc";
                  $resultado2=mysqli_query($con,$sql);
                  while ($res=mysqli_fetch_array($resultado2)){
                  
                  
                  echo "<option value='".$res['abreviacion']."' ";
                    
                    
                    
                    echo ">";
                    echo $res['nombre'];
                  echo "</option>";
                  
                  
                  }
                  mysqli_free_result($resultado2);
                  
                  
                  ?>
                  
                  
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <label>Direccion del Cliente</label>
                <input  style="background-color: #87CEEB;" type="text" class="input-sm form-control-sm form-control"   name="direccion" id="direccion ">
              </div>
              
            </div>
            
            <div class="row">
              <div class="col-sm-6">
                <label>Instalado Por:</label>
                <select  style="background-color: #87CEEB;" name="empleado" class="form-control"    id="empleado">
                  <option value=""></option>
                  <?php
                  $sql="select * from users order by firstname asc";
                  $resultado2=mysqli_query($con,$sql);
                  while ($res=mysqli_fetch_array($resultado2)){
                  
                  
                  echo "<option value='".$res['user_id']."' ";
                    
                    
                    echo ">";
                    echo $res['firstname'];
                    echo " ";
                    echo $res['lastname'];
                  echo "</option>";
                  
                  
                  }
                  mysqli_free_result($resultado2);
                  
                  
                  ?>
                  
                </select>
              </div>
              <div class="col-sm-3">
                <label>Costo de Instalacion</label>
                <input  style="background-color: #87CEEB;" type="number" class="input-sm form-control-sm form-control"   name="pago_instalacion" id="pago_instalacion">
              </div>
              <div class="col-sm-3">
                <label>Modo de pago</label>
                <select  style="background-color: #87CEEB;" name="tpago" class="form-control"    id="tpago" onChange="mostrar_npago();">
                  <option value=""></option>
                  <?php
                  $sql="select * from tipo_pago";
                  $resultado2=mysqli_query($con,$sql);
                  while ($res=mysqli_fetch_array($resultado2)){
                  
                  
                  echo "<option value='".$res['id']."' ";
                    
                    
                    echo ">";
                    echo $res['descripcion'];
                    
                  echo "</option>";
                  
                  
                  }
                  mysqli_free_result($resultado2);
                  
                  
                  ?>
                  
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <label>Planes</label>
                <select  style="background-color: #87CEEB;" name="plan" class="input-sm form-control"   id="plan" onChange="mostrar();">
                  <option value=" "></option>
                  <?php
                  $sql="select * from planes order by id asc";
                  $resultado2=mysqli_query($con,$sql);
                  while ($res=mysqli_fetch_array($resultado2)){
                  
                  
                  echo "<option value='".$res['plan']."' ";
                    
                    echo ">";
                    echo $res['nombre'];
                  echo "</option>";
                  
                  
                  }
                  mysqli_free_result($resultado2);
                  
                  
                  ?>
                </select>
              </div>
              <div class="col-sm-3">
                <label>Mensualidad</label>
                <input  style="background-color: #87CEEB;" type="text" class="input-sm form-control-sm form-control"   name="pago_total" id="pago_total">
              </div>
              <div class="col-sm-3">
                <label>Tipo de servicio</label>
                <select  style="background-color: #87CEEB;" name="servicio" class="form-control"    id="servicio">
                  <option value=""></option>
                  <?php
                  $sql="select * from tipo_servicio";
                  $resultado2=mysqli_query($con,$sql);
                  while ($res=mysqli_fetch_array($resultado2)){
                  
                  
                  echo "<option value='".$res['id']."' ";
                    
                    
                    echo ">";
                    echo $res['nombre'];
                    
                  echo "</option>";
                  
                  
                  }
                  mysqli_free_result($resultado2);
                  
                  
                  ?>
                  
                </select>
              </div>
            </div>
            
            
            <div class="row">
              <div class="col-sm-6">
                <label>Nodo</label>
                <select  style="background-color: #87CEEB;" name="nodo" class="input-sm form-control"   id="nodo">
                  <option value=""></option>
                  
                  <?php
                  
                  $sql="SELECT * FROM mikrotik";
                  $resultado=mysqli_query($con,$sql);
                  while ($res=mysqli_fetch_array($resultado)){
                  
                  
                  echo"<option value=".$res["idmikrotik"].">".$res["nodo"]."</option>";
                  }
                  mysqli_free_result($resultado);
                  ?>
                </select>
              </div>
              <div class="col-sm-6">
                <label>Remote Address</label>
                <select  style="background-color: #87CEEB;" name="remoteaddress" class="input-sm form-control"   id="remoteaddress">
                  
                  
                  
                  
                </select>
              </div>
              
              
              
            </div>
            <div class="row">
              <div class="col-sm-6">
                <label>Usuario</label>
                <input  style="background-color: #87CEEB;" type="text" class="input-sm form-control-sm form-control"   name="usuario" id="usuario" autocomplete="off" >
              </div>
              <div class="col-sm-6">
                <label>Contrasena</label>
                <input  style="background-color: #87CEEB;" type="text" class="input-sm form-control-sm form-control" name="password" id="password"     >
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <label>Mac Adress</label>
                <input  style="background-color: #87CEEB;" type="text" class="input-sm form-control-sm form-control" name="mac" id="mac" >
              </div>
              <div class="col-sm-3">
                <label>Router pertenece a</label>
                <select  style="background-color: #87CEEB;" name="router" class="form-control"    id="router">
                  <option value=""></option>
                  <?php
                  $sql="select * from router";
                  $resultado2=mysqli_query($con,$sql);
                  while ($res=mysqli_fetch_array($resultado2)){
                  
                  
                  echo "<option value='".$res['id']."' ";
                    
                    
                    echo ">";
                    echo $res['descripcion'];
                    
                  echo "</option>";
                  
                  
                  }
                  mysqli_free_result($resultado2);
                  
                  
                  ?>
                  
                </select>
              </div>
              <div class="col-sm-3" id="cuota">
                <label>No de cuotas</label>
                <input  style="background-color: #87CEEB;" type="number" class="input-sm form-control-sm form-control" name="numpag" id="numpag" value="0" >
              </div>
              
            </div>
            <div class="row">
              <div class="col-sm-12">
                <label>Observacion</label>
                <input  style="background-color: #87CEEB;" type="text" class="input-sm form-control-sm form-control" name="comentario" id="comentario" >
              </div>
              
            </div>
            
            
            
            
            
            
          </div>
          
          
          
          
          
          
          
          
          
          
          
        </div>
        <div class="modal-footer">
          
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
          <button type="reset" class="btn btn-success btn-sm" ><i class="fa fa-refresh"></i> Refresh</button>
          <button type="submit" class="btn btn-primary btn-sm" id="btnsave"><i class="fa fa-floppy-o"></i> Registrar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
}
?>