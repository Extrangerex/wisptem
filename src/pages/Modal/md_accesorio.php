<?php
if (isset($con))
{
?>
<div class="modal fade" id="newAccesorio" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h8 class="modal-title"><i class="fa fa-list"></i> Nuevo Accesorio</h8>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post"  name="gdaccesorio" id="gdaccesorio" >
                    <div class="row form-group">
                        <div id="resultados_ajax1"></div>
                    </div>
                    
                    
                    
                    
                    
                    
                    
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="cell" class="control-label mb-1">Nombre del accesorio</label>
                            <input id="nombre" name="nombre" type="text" class="input-sm form-control-sm form-control" aria-required="true" aria-invalid="false" >
                        </div>
                        <div class="col-sm-6">
                            <label for="cantidad" class="control-label mb-1">Unidades o Metros</label>
                            <input id="cantidad" name="cantidad" type="number" class="input-sm form-control-sm form-control" aria-required="true" aria-invalid="false" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="precio" class="control-label mb-1">Costo por unidad o metro</label>
                            <input id="precio" name="precio"class="input-sm form-control-sm form-control" type="number" >
                            
                        </div>
                        
                    </div>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                </div>
                <div class="modal-footer">
                    
                    <button type="button" class=" btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                    
                    <button type="submit" class="btn btn-primary btn-sm" id="saveaccesorio"><i class="fa fa-floppy-o"></i> Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
}
?>