    <?php
        if (isset($con))
        {
?>
<div class="modal fade" id="edtsector" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h8 class="modal-title"><i class="fa fa-list"></i> Editar Sector</h8>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                               <form method="post"  name="updatesector" id="updatesector" >
                                <div class="row form-group">
                                    <div id="resultados_ajax2"></div>
                                </div>

                                     <div class="row form-group">
                                         <div class="col col-sm-3">
                                            <label for="nombre" class=" form-control-label">Nombre del sector</label>
                                        </div>
                                         <div class="col-6 col-sm-6">
                                                <input type="hidden" name="mod_id" id="mod_id">
                                                <input type="text" id="mod_nombre" name="mod_nombre" placeholder="Nombre del sector" class="form-control"  >
                                        </div>
                                     </div>
                                      <div class="row form-group">
                                         <div class="col col-sm-3">
                                            <label for="mod_abreviacion" class=" form-control-label">Abreviacion</label>
                                        </div>
                                         <div class="col-6 col-sm-6">
                                                <input type="text" id="mod_abreviacion" name="mod_abreviacion" placeholder="Abreviacion del sector" class="form-control" >
                                        </div>
                                     </div>
                                      
                                        
                               



                               
                                       
                            </div>
                            <div class="modal-footer">
                                
                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                              
                                <button type="submit" class="btn btn-primary btn-sm" id="btnupdate"><i class="fa fa-refresh"></i> Actualizar</button>
                            </div>
                              </form>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
