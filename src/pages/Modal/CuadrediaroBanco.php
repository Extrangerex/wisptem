<?php
if (isset($con))
{
?>
<div class="modal fade" id="CuadreDiarioB" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h8 class="modal-title"><i class="fa fa-users"></i> Depositos por el banco</h8>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="./Reportes/pagodiariobanco.php" method="post" target="_blank">
          
          <div class="row form-group">
            <div class="col col-sm-3">
              <label for="nodomk" class=" form-control-label">Fecha: </label>
            </div>
            <div class="col-6 col-sm-6">
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>"  class="form-control" required >
                
              </div>
            </div>
            <div class="col-6 col-sm-2">
              
              <button type="submit" class="form-control btn btn-default" ><i class="fa fa-print"></i> Imprimir</button>
            </div>
            
            
            
          </div>
        </form>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
        
      </div>
    </form>
  </div>
</div>
</div>
<?php
}
?>