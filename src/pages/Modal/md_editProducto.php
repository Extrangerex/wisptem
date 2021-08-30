<?php
if (isset($con))
{
?>
<div class="modal fade" id="editProducto" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h8 class="modal-title"><i class="fa fa-edit"></i> Modificar Producto</h8>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post"  name="updateproducto" id="updateproducto" >
          
          <div id="resultados_ajax4"></div>
          
          
          
          
          
          
          
          
          
          <div class="row">
            
            <div class="col-xs-12">
              
            
                <label for="codigo">Código de barras:</label>
             <div><input type="hidden" name="mid" id="mid"></div>
                <input class="form-control" name="mcodigo"  type="text" id="mcodigo" placeholder="Escribe el código">
                <label for="descripcion">Descripción:</label>
                <textarea  id="mdescripcion" name="mdescripcion" cols="30" rows="5" class="form-control"></textarea>
                <label for="precioVenta">Precio de venta:</label>
                <input class="form-control" name="mprecioVenta"  type="number" id="mprecioVenta" placeholder="Precio de venta">
                <label for="precioCompra">Precio de compra:</label>
                <input class="form-control" name="mprecioCompra"  type="number" id="mprecioCompra" placeholder="Precio de compra">
                <label for="existencia">Existencia:</label>
                <input class="form-control" name="mexistencia"  type="number" id="mexistencia" placeholder="Cantidad o existencia">
               
              
            </div>
          </div>
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
        </div>
        <div class="modal-footer">
          
          <button type="button" class=" btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
          
          <button type="submit" class="btn btn-primary btn-sm" id="btnupdate"><i class="fa fa-refresh"></i> Actualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
}
?>