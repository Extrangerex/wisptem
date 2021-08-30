<?php
if (isset($con))
{
?>
<div class="modal fade" id="CuadreMensualB" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h8 class="modal-title"><i class="fa fa-list"></i> Depositos mensual por el banco</h8>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="./Reportes/pagomensualbanco.php" method="post" target="_blank">
          <div class="row">
            <div class="col-sm-3">
              <label>Fecha Inicial</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input  class="form-control" required name="fi" id="fi" value="<?php echo date('Y-m-01'); ?>">
              </div>
            </div>
            <div class="col-sm-3">
              <label>Fecha Final</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input class="form-control" required name="ff" id="ff" value="<?php echo date('Y-m-30'); ?>">
              </div>
            </div>
            
            
            
          </div>
          
          
        </div>
        <div class="modal-footer">
          
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
          <button type="submit" class="btn btn-default" ><i class="fa fa-print"></i> Imprimir</button>
          
        </div>
        
      </div>
    </div>
  </form>
</div>
<?php
}
?>