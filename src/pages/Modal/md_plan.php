    <?php
        if (isset($con))
        {
?>
<div class="modal fade" id="newplan" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h8 class="modal-title"><i class="fa fa-user-secret"></i> Nuevo Plan</h8>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                               <form method="post"  name="gdplan" id="gdplan" >
                                <div class="row form-group">
                                    <div id="resultados_ajax"></div>
                                </div>

                                     <div class="row form-group">
                                         <div class="col col-sm-3">
                                            <label for="nombre" class=" form-control-label">Nombre del Plan</label>
                                        </div>
                                         <div class="col-6 col-sm-6">
                                                <input type="text" id="nombre" name="nombre" placeholder="Nombre del plan" class="form-control"  >
                                        </div>
                                     </div>
                                      <div class="row form-group">
                                         <div class="col col-sm-3">
                                            <label for="plan" class=" form-control-label">Plan</label>
                                        </div>
                                         <div class="col-6 col-sm-6">
                                                <input type="text" id="plan" name="plan" placeholder="Velocidad de plan" class="form-control" ><small class="form-text text-muted">Ojo! este campo tiene que ser igual a los profiles del mikrotik</small>
                                        </div>
                                     </div>
                                    
                                      <div class="row form-group">
                                         <div class="col col-sm-3">
                                            <label for="precio" class=" form-control-label">Precio </label>
                                        </div>
                                         <div class="col-6 col-sm-6">
                                                <input type="number" id="precio" name="precio" placeholder="Precio del plan" class="form-control">
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
