    <?php
        if (isset($con))
        {
?>
<div class="modal fade" id="newuser" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><i class="fa fa-users"></i> Nuevo Usuario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                               <form method="post"  name="gduser" id="gduser" >
                                <div class="row form-group">
                                    <div id="resultados_ajax"></div>
                                </div>
                                <div class="col-lg-12">
                        <div class="box box-default">
                            <div class="box-header " >
                                <strong class="box-title"><i class="fa fa-columns"></i> Datos Personales</strong>
                            </div>
                            <div class="box box-body">
                                <!-- Informacion Personal -->
                             
                                    <div class="box-body">
                                        
                                    
                                       
                                            <div class="row">
                                                 <div class="col-sm-6">
                                                    <label for="nombre" class="control-label mb-2">Nombre</label>
                                                    <input id="nombre" name="nombre" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                 </div>
                                                  <div class="col-sm-6">
                                                     <label for="apellido" class="control-label mb-1">Apellido</label>
                                                     <input id="apellido" name="apellido" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                </div>
                                            </div>

                                             <div class="row">

                                                <div class="col-sm-6">
                                                 <label for="cell" class="control-label mb-1">Cell</label>
                                                    <input id="cell" name="cell" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                               </div>
                                                 <div class="col-sm-6">
                                                    <label for="cargo" class="control-label mb-1">Cargo</label>
                                                    <input id="cargo" name="cargo" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                              </div>
                                                
                                            </div>

                                            <div class="row">

                                              
                                              <div class="col-sm-6">
                                                    <label for="correo" class="control-label mb-1">Correo</label>
                                                     <input id="correo" name="correo" type="text" class="form-control" aria-required="true" aria-invalid="false" >
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
                                  	 <input type="checkbox"  data-toggle="toggle" data-style="ios" data-size="mini" id="chk_act"  name="chk_act" value="1" >
									                 </div>
										
									</div>
									 <div class="row form-group">
                                  	  <div class="col col-sm-6"><label for="input-small" class=" form-control-label">Cambiar Fechas</label></div>
                                  	  <div class="col col-sm-6">
                                  	 <input type="checkbox"  data-toggle="toggle" data-style="ios" data-size="mini"  id="chk_fec"  name="chk_fec" value="1" >
									                 </div>
										
									</div>
                                        
                                        </div>
                                         <div class="row">
                                            
                                           <div class="row form-group">
                                  	  <div class="col col-sm-6"><label for="input-small" class=" form-control-label">Actualizar Planes</label></div>
                                  	  <div class="col col-sm-6">
                                  	 <input type="checkbox"  data-toggle="toggle" data-style="ios" data-size="mini" id="chk_plan"  name="chk_plan" value="1" >
									                 </div>
										
									</div>
									 <div class="row form-group">
                                  	  <div class="col col-sm-6"><label for="input-small" class=" form-control-label">Cambiar Mac</label></div>
                                  	  <div class="col col-sm-6">
                                  	 <input type="checkbox"  data-toggle="toggle" data-style="ios" data-size="mini"  id="chk_mac"  name="chk_mac" value="1" >
									                 </div>
										
									</div>
                                        
                                        </div>
                                         
                                               
                                               
                                              
                                        
                                    </div>
                                </div>

                           
                        </div> <!-- .Personal -->

                    </div>
                     <div class="col-lg-12">
                        <div class="box box-default">
                            <div class="box-header" >
                                <strong class="box-title "><i class="fa-sign-in"></i> Datos Login</strong>
                            </div>
                            <div class="box box-body">
                                <!-- Informacion Personal -->
                             
                                    <div class="box-body">
                                        
                                    
                                        <div class="row">
                                            
                                           <div class="col-sm-6">
                                                <label for="usuario" class="control-label mb-1">Usuario</label>
                                                <input id="usuario" name="usuario" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                            </div>
                                           <div class="col-sm-6">
                                                <label for="password" class="control-label mb-1">Password</label>
                                                <input id="password" name="password" type="password" class="form-control" aria-required="true" aria-invalid="false" >
                                            </div>
                                        </div>
                                         <div class="row">
                                           <div class="col-sm-6">
                                                <label for="password-repeat" class="control-label mb-1">Repetir Password</label>
                                                <input id="password-repeat" name="password-repeat" type="password" class="form-control" aria-required="true" aria-invalid="false" >
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="nivel" class="control-label mb-1">Nivel de seguridad</label>
                                                <select id="nivel" name="nivel" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                    <option value=""></option>
                                                     <option value="1">Administrador</option>
                                                      <option value="2">Usuario</option>
                                                       <option value="3">Cobrador</option>


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
                                <button type="submit" class="btn btn-primary btn-sm" id="btnsave"><i class="fa fa-floppy-o"></i> Registrar</button>
                            </div>
                              </form>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
