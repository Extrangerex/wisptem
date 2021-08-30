    <?php
        if (isset($con))
        {
?>
<div class="modal fade" id="edituser" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><i class="fa fa-users"></i> Editar Usuario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                               <form method="post"  name="edtuser" id="edtuser" >
                                <div class="row form-group">
                                    <div id="resultados_ajax2"></div>
                                    <input type="hidden" id="mod_id"  name="mod_id">
                                </div>
                                <div class="col-lg-12">
                        <div class="box box-default">
                            <div class="box-header" >
                                <strong class="box-title text-light"><i class="fa fa-columns"></i> Datos Personales</strong>
                            </div>
                            <div class="box box-body">
                                <!-- Informacion Personal -->
                             
                                    <div class="box box-body">
                                        
                                    
                                       
                                            <div class="row">
                                                 <div class="col-sm-6">
                                                    <label for="nombre" class="control-label mb-2">Nombre</label>
                                                    <input id="mod_nombre" name="mod_nombre" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                 </div>
                                                  <div class="col-sm-6">
                                                     <label for="apellido" class="control-label mb-1">Apellido</label>
                                                     <input id="mod_apellido" name="mod_apellido" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                </div>
                                            </div>

                                             <div class="row">

                                                <div class="col-sm-6">
                                                 <label for="cell" class="control-label mb-1">Cell</label>
                                                    <input id="mod_cell" name="mod_cell" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                               </div>
                                                 <div class="col-sm-6">
                                                    <label for="cargo" class="control-label mb-1">Cargo</label>
                                                    <input id="mod_cargo" name="mod_cargo" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                              </div>
                                                
                                            </div>

                                            <div class="row">

                                              
                                              <div class="col-sm-6">
                                                    <label for="mod_correo" class="control-label mb-1">Correo</label>
                                                     <input id="mod_correo" name="mod_correo" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                               </div>
                                           </div>
                                               
                                               
                                              
                                        
                                    </div>
                                </div>

                           
                        </div> <!-- .Personal -->

                    </div>
                      <div class="col-lg-12">
                        <div class="box box-default">
                            <div class="box-header" >
                                <strong class="box-title "><i class="fa-sign-in"></i> Permisos del sistema</strong>
                            </div>
                            <div class="box box-body">
                                <!-- Informacion Personal -->
                             
                                    <div class="box-body">
                                        
                                    
                                        <div class="row">
                                            
                                           <div class="row form-group">
                                      <div class="col col-sm-6"><label for="input-small" class=" form-control-label">Activar/suspender Clientes</label></div>
                                      <div class="col col-sm-6">
                                     <input type="checkbox"   name="mchk_act" id="mchk_act" value="1">
                                   </div>
                    
                  </div>
                   <div class="row form-group">
                                      <div class="col col-sm-6"><label for="input-small" class=" form-control-label">Cambiar Fechas</label></div>
                                      <div class="col col-sm-6">
                                     <input type="checkbox"    id="mchk_fec"  name="mchk_fec" value="1" >
                                   </div>
                    
                  </div>
                                        
                                        </div>
                                         <div class="row">
                                            
                                           <div class="row form-group">
                                      <div class="col col-sm-6"><label for="input-small" class=" form-control-label">Actualizar Planes</label></div>
                                      <div class="col col-sm-6">
                                     <input type="checkbox"  id="mchk_plan"  name="mchk_plan" value="1" >
                                   </div>
                    
                  </div>
                   <div class="row form-group">
                                      <div class="col col-sm-6"><label for="input-small" class=" form-control-label">Cambiar Mac</label></div>
                                      <div class="col col-sm-6">
                                     <input type="checkbox"   id="mchk_mac"  name="mchk_mac"   value="1">
                                   </div>
                    
                  </div>
                                        
                                        </div>
                                         
                                               
                                               
                                              
                                        
                                    </div>
                                </div>

                           
                        </div> <!-- .Personal -->

                    </div>
                     <div class="col-lg-12">
                        <div class="box box-default">
                            <div class="box-header with-border" >
                                <strong class="box-title "><i class="fa-sign-in"></i> Datos Login</strong>
                            </div>
                            <div class="box-body">
                                <!-- Informacion Personal -->
                             
                                    <div class="box-body">
                                        
                                    
                                        <div class="row">
                                            
                                           <div class="col-sm-6">
                                                <label for="mod_usuario" class="control-label mb-1">Usuario</label>
                                                <input id="mod_usuario" name="mod_usuario" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="nivel" class="control-label mb-1">Nivel de seguridad</label>
                                                <select id="mod_nivel" name="mod_nivel" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                    <option value=""></option>
                                                     <option value="1">Administrador</option>
                                                      <option value="2">Usuario</option>
                                                       <option value="3">Cobrador</option>


                                                </select>


                                            </div>
                                           
                                        </div>
                                         <div class="row">
                                          
                                            
                                             <div class="col-sm-6">
                                                <label for="mod_estado" class="control-label mb-1">Estado</label>
                                                <select id="mod_estado" name="mod_estado" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                    <option value=""></option>
                                                     <option value="si">HABILITADO</option>
                                                      <option value="no">INACTIVO</option>
                                                      


                                                </select>


                                            </div>
                                        </div>
                                               
                                               
                                               
                                              
                                        
                                    </div>
                                </div>

                           
                        </div> <!-- .Personal -->

                    </div>


                          
                        
                                        
                               



                               
                                       
                            </div>
                            <div class="modal-footer">
                                
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                                 <button type="reset" class="btn btn-success btn-sm" ><i class="fa fa-refresh"></i> Refresh</button>
                                <button type="submit" class="btn btn-primary btn-sm" id="btnedit"><i class="fa fa-floppy-o"></i> Actualizar</button>
                            </div>
                              </form>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
