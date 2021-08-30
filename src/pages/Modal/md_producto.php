<?php
if (isset($con))
{
?>
<div class="modal fade" id="newproducto" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h8 class="modal-title"><i class="fa fa-list"></i> Nuevo Producto</h8>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post"  name="gdproducto" id="gdproducto" >
          
          <div id="resultados_ajax3"></div>
          
          
          
          
          
          
          
          
          
          <div class="row">
            
            <div class="col-xs-12">
              
            
                <label for="codigo">Código de barras:</label>
                <input class="form-control" name="codigo"  type="text" id="codigo" placeholder="Escribe el código">
                <label for="descripcion">Descripción:</label>
                <textarea  id="descripcion" name="descripcion" cols="30" rows="5" class="form-control"></textarea>
                <label for="precioVenta">Precio de venta:</label>
                <input class="form-control" name="precioVenta"  type="number" id="precioVenta" placeholder="Precio de venta">
                <label for="precioCompra">Precio de compra:</label>
                <input class="form-control" name="precioCompra"  type="number" id="precioCompra" placeholder="Precio de compra">
                <label for="existencia">Existencia:</label>
                <input class="form-control" name="existencia"  type="number" id="existencia" placeholder="Cantidad o existencia">
               
              
            </div>
          </div>
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
        </div>
        <div class="modal-footer">
          
          <button type="button" class=" btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
          
          <button type="submit" class="btn btn-primary btn-sm" id="saveproducto"><i class="fa fa-floppy-o"></i> Registrar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
}
?>