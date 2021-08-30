    <?php
        if (isset($con))
        {
?>
<div class="modal fade" id="newsector" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h8 class="modal-title"><i class="fa fa-list"></i> Registrar Nuevo Sector</h8>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                               <form method="post"  name="gdsector" id="gdsector" >
                                <div class="row form-group">
                                    <div id="resultados_ajax"></div>
                                </div>

                                     <div class="row form-group">
                                         <div class="col col-sm-3">
                                            <label for="nombre" class=" form-control-label">Nombre del sector</label>
                                        </div>
                                         <div class="col-6 col-sm-6">
                                                <input type="text" id="nombre" name="nombre" placeholder="Nombre del sector" class="form-control"  >
                                        </div>
                                     </div>
                                      <div class="row form-group">
                                         <div class="col col-sm-3">
                                            <label for="abreviacion" class=" form-control-label">Abreviacion</label>
                                        </div>
                                         <div class="col-6 col-sm-6">
                                                <input type="text" id="abreviacion" name="abreviacion" placeholder="Abreviacion del sector" class="form-control" >
                                        </div>
                                     </div>
                                      
                                        
                               



                               
                                       
                            </div>
                            <div class="modal-footer">
                                
                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                              
                                <button type="submit" class="btn btn-primary btn-sm" id="btnsave"><i class="fa fa-floppy-o"></i> Registrar</button>
                            </div>
                              </form>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
