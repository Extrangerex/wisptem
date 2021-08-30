    <?php
        if (isset($con))
        {
?>
<div class="modal fade" id="AbonarFac" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><i class="fa fa-list"></i> Abono</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form method="POST"  name="abono" id="abono">
                    <div id="resultados_ajax4"></div>

                               <div class="box-header with-border">
                  <strong class="box-title ">Abonar factura de :  <a type="text" > <?php echo $row['nombres']; ?> <?php echo $row['apellido']; ?></a></strong>
                </div>
                               <div class="row form-group">

                                    <div class="col col-sm-2"><label for="input-small" class=" form-control-label">Monto Totdsdal</label></div>
                                    <div class="col col-sm-3">
                                      <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" >
                                      <input type="number" id="montop" name="montop" value="<?php echo $montot; ?>" readonly class="input-sm form-control-sm form-control">
                                    </div>
                                  </div>
                                    <div class="row form-group">
                                    <div class="col col-sm-2"><label for="input-small" class=" form-control-label" required>Monto a Cobrar</label></div>
                                    <div class="col col-sm-3">
                                      <input type="number" id="montoc" name="montoc" value=""  class="input-sm form-control-sm form-control" required>
                                    </div>
                                  </div>
                                      <div class="row form-group">
                                    <div class="col col-sm-2"><label for="input-small" class=" form-control-label">Monto Restante</label></div>
                                    <div class="col col-sm-3">
                                      <input type="number" id="montor" readonly name="montor" value=""  class="input-sm form-control-sm form-control">
                                    </div>
                    
                    </div>


                          
                        
                                        
                               



                               
                                       
                            </div>
                            <div class="modal-footer">
                                
                               <button type="submit" class="btn btn-success btn-sm" id="gd-abono"  >
                                  <i class="fa fa-save"></i> Cobrar & Imprimir
                                  </button>
                               
                                 
                                 
                                 
                                
                            </div>
                              </form>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
