<?php
if (isset($con))
{
?>
<div class="modal fade" id="CuadreDiario" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h8 class="modal-title"><i class="fa fa-users"></i> Cuadre Diario General</h8>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="./Reportes/pagodiario.php" method="post" target="_blank">
          
          <div class="row form-group">
            <div class="col col-sm-3" align="center">
              <label>Fecha de Pago</label>
              <div class="input-group date" >
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                
                <input  id="fecha" name="fecha"  class="form-control" required value="<?php echo date('Y-m-d'); ?>" >
                
              </div>
            </div>
            
            
            
          </div>
      
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
        <button type="submit" class="btn btn-default" ><i class="fa fa-print"></i> Imprimir</button>
        
      </div>
    </form>
  </div>
</div>
</div>
<?php
}
?>