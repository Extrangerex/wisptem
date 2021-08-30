<?php
if (isset($con))
{
?>
<div class="modal fade" id="nuevaVenta" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h8 class="modal-title"><i class="fa fa-money"></i> Nueva Venta</h8>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post"  name="gdproducto" id="gdproducto" >
          
          <div id="resultados_ajax3"></div>
          
          
          
          
          
          
          
          
          
          <div class="row">
          <form method="post" name="addproducto" id="addproducto">
      <label for="codigo">Código de barras:</label>
      <input autocomplete="off" autofocus class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código">
    </form>
    <br><br>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Código</th>
          <th>Descripción</th>
          <th>Precio de venta</th>
          <th>Cantidad</th>
          <th>Total</th>
          <th>Quitar</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($_SESSION["carrito"] as $indice => $producto){ 
            $granTotal += $producto->total;
          ?>
        <tr>
          <td><?php echo $producto->id ?></td>
          <td><?php echo $producto->codigo ?></td>
          <td><?php echo $producto->descripcion ?></td>
          <td><?php echo $producto->precioVenta ?></td>
          <td><?php echo $producto->cantidad ?></td>
          <td><?php echo $producto->total ?></td>
          <td><a class="btn btn-danger" href="<?php echo "quitarDelCarrito.php?indice=" . $indice?>"><i class="fa fa-trash"></i></a></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>

    <h3>Total: <?php echo $granTotal; ?></h3>
    <form action="./terminarVenta.php" method="POST">
      <input name="total" type="hidden" value="<?php echo $granTotal;?>">
      <button type="submit" class="btn btn-success">Terminar venta</button>
      <a href="./cancelarVenta.php" class="btn btn-danger">Cancelar venta</a>
    </form>
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