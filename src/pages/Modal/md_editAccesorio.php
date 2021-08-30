<?php
if (isset($con))
{
?>
<div class="modal fade" id="edtAccesorio" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h8 class="modal-title"><i class="fa fa-list"></i> Editar Accesorio</h8>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post"  name="edtaccesorio" id="edtaccesorio" >
          <div class="row form-group">
            <div id="resultados_ajax2"></div>
          </div>
          
          
          
          
          
          
          
          <div class="row">
            <div class="col-sm-12">
              <label for="cell" class="control-label mb-1">Nombre del accesorio</label>
              <input type="hidden" name="mod_id" id="mod_id">
              <input id="mod_nombre" name="mod_nombre" type="text" class="form-control" aria-required="true" aria-invalid="false" >
            </div>
            <div class="col-sm-6">
              <label for="cantidad" class="control-label mb-1">Unidades o Metros</label>
              <input id="mod_cantidad" name="mod_cantidad" type="number" class="form-control" aria-required="true" aria-invalid="false" >
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <label for="mod_precio" class="control-label mb-1">Costo por unidad o metro</label>
              <input id="mod_precio" name="precio"class="form-control" type="number" >
              
            </div>
            
          </div>
          
          
          
          
          
          
          
          
          
          
          
          
        </div>
        <div class="modal-footer">
          
          <button type="button" class=" btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
          
          <button type="submit" class="btn btn-primary btn-sm" id="updateaccesorio"><i class="fa fa-refresh"></i> Registrar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
}
?>