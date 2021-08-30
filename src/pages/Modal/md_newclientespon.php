<?php
if (isset($con))
{
$sql="select max(id) as mayor from clientesp";
$Records = mysqli_query($con,$sql) or die(mysql_error());
$resul=mysqli_fetch_array($Records);
$mayor=$resul['mayor']+1;

?>
<div class="modal fade" id="newclientepon" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h8 class="modal-title"><i class="fa fa-users"></i> Nuevo Cliente Gpon</h8>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post"  name="gduser" id="gduser" autocomplete="on">
          
          
          
          
          <div class="card-body">
            
            <div id="ajax"></div>
            <input type="hidden" name="id" id="id" value="<?php echo $mayor; ?>">
            
            
            
            
            
    
            
            
           
            
            <div class="row">
               <div class="col-sm-6">
                <label>ID CLIENTE</label>
                <input  style="background-color: #87CEEB;" type="number" name="idcliente" class="input-sm form-control"   id="idcliente">
                 
                </input>
              </div>
              
              
              
            
              
             <div class="col-sm-6">
                <label>Nodo OLT</label>
                <select  style="background-color: #87CEEB;" name="nodoolt" class="input-sm form-control"   id="nodoolt">
                  <option value=""></option>
                  
                  <?php
                  
                  $sql="SELECT * FROM olts";
                  $resultado=mysqli_query($con,$sql);
                  while ($res=mysqli_fetch_array($resultado)){
                  
                  
                  echo"<option value=".$res["id"].">".$res["name"]."</option>";
                  }
                  mysqli_free_result($resultado);
                  ?>
                </select>
              </div>
              
              
              
            </div>
            <div class="row">
               
               <div class="col-sm-3">
                <label>Usuario PPPOE</label>
                <input  style="background-color: #87CEEB;" type="text" class="input-sm form-control-sm form-control"   name="usuario" id="usuario" autocomplete="off" >
              </div>
              <div class="col-sm-3">
                <label>Contrasena</label>
                <input  style="background-color: #87CEEB;" type="text" class="input-sm form-control-sm form-control" name="password" id="password"  value="<?php echo ppp_pass ?> "    >
              </div>
              <div class="col-sm-3">
                <label>SN</label>
                <input  style="background-color: #87CEEB;" type="text" class="input-sm form-control-sm form-control" name="sn" id="sn" readonly>
              </div>
              
            </div>
            <div class="row">
                 <div class="col-sm-3">
                <label>Board</label>
                <input  style="background-color: #87CEEB;" type="text" class="input-sm form-control-sm form-control" name="board" id="board" readonly>
              </div>
                 <div class="col-sm-3">
                <label>Port</label>
                <input  style="background-color: #87CEEB;" type="text" class="input-sm form-control-sm form-control" name="port" id="port" readonly>
              </div>
                 <div class="col-sm-3">
                <label>Pon Index</label>
                <input  style="background-color: #87CEEB;" type=numeric class="input-sm form-control-sm form-control" name="ponidx" id="ponidx" >
              </div>
               <div class="col-sm-3">
                <label>Tipo de Onu</label>
               <select  style="background-color: #87CEEB;" name="onutype" class="input-sm form-control"   id="onutype">
                  <option value=""></option>
                  
                  <?php
                  
                  $sql="SELECT * FROM onu_type";
                  $resultado=mysqli_query($con,$sql);
                  while ($res=mysqli_fetch_array($resultado)){
                  
                  
                  echo"<option value=".$res["onu_type"].">".$res["onu_type"]."</option>";
                  }
                  mysqli_free_result($resultado);
                  ?>
                </select>
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