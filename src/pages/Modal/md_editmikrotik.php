    <?php
        if (isset($con))
        {
?>
<div class="modal fade" id="editmk" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h8 class="modal-title"><i class="fa fa-list"></i> Editar Router</h8>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                               <form method="post"  name="updatemk" id="updatemk">
                                <div class="row form-group">
                                    <div id="resultados_ajax2"></div>
                                   
                                </div>
                                 <div class="row form-group">
                                   
                                    <div><input type="hidden" name="mod_id" id="mod_id"></div>
                                </div>



                                     <div class="row form-group">
                                         <div class="col col-sm-3">
                                            <label for="mod_nodo" class=" form-control-label">Nombre del Mikrotik</label>
                                        </div>
                                         <div class="col-6 col-sm-6">
                                                <input type="text" id="mod_nodo" name="mod_nodo" placeholder="Nombre del nodo" class="form-control" autocomplete="off" >
                                        </div>
                                     </div>
                                      <div class="row form-group">
                                         <div class="col col-sm-3">
                                            <label for="mod_modelo" class=" form-control-label">Modelo del Mikrotik</label>
                                        </div>
                                         <div class="col-6 col-sm-6">
                                                <input type="text" id="mod_modelo" name="mod_modelo" placeholder="Modelo del Mikrotik" class="form-control" >
                                        </div>
                                     </div>
                                       <div class="row form-group">
                                         <div class="col col-sm-3">
                                            <label for="modelomk" class=" form-control-label">Tipo de conexion</label>
                                        </div>
                                         <div class="col-6 col-sm-6">
                                                <select id="mod_tipocon" name="mod_tipocon"   class="form-control" >
                                                    <option value=""></option>
                                                    <option value="1">Local</option>
                                                    <option value="2">Remota</option>

                                                </select>
                                        </div>
                                        
                                     </div>
                                      <div class="row form-group">
                                         <div class="col col-sm-3">
                                            <label for="mod_ip" class=" form-control-label">IP Mikrotik</label>
                                        </div>
                                         <div class="col-6 col-sm-6">
                                                <input type="text" id="mod_ip" name="mod_ip" placeholder="IP o dns del Mikrotik " class="form-control">
                                        </div>
                                     </div>
                                      <div class="row form-group">
                                         <div class="col col-sm-3">
                                            <label for="mod_usuario" class=" form-control-label">Usuario Mikrotik</label>
                                        </div>
                                         <div class="col-6 col-sm-6">
                                                <input type="text" id="mod_usuario" name="mod_usuario" placeholder="Usuario Mikrotik" class="form-control">
                                        </div>
                                     </div>
                                      <div class="row form-group">
                                         <div class="col col-sm-3">
                                            <label for="mod_password" class=" form-control-label">Password Mikrotik</label>
                                        </div>
                                         <div class="col-6 col-sm-6">
                                                <input type="password" id="mod_password" name="mod_password" placeholder="Contraseña Mikrotik" class="form-control">
                                        </div>
                                     </div>
                                      <div class="row form-group">
                                         <div class="col col-sm-3">
                                            <label for="mod_interface" class=" form-control-label">Interface Wan</label>
                                        </div>
                                         <div class="col-6 col-sm-6">
                                                <input type="text" id="mod_interface" name="mod_interface" placeholder="nombre del interface wan" class="form-control">
                                        </div>
                                     </div>
                                       <div class="row form-group">
                                         <div class="col col-sm-3">
                                            <label for="mod_puerto" class=" form-control-label">Puerto Api</label>
                                        </div>
                                         <div class="col-6 col-sm-6">
                                                <input type="number" id="mod_api" name="mod_api" placeholder="Puerto del Api" class="form-control">
                                        </div>
                                     </div>
                                      <div class="row form-group">
                                         <div class="col col-sm-3">
                                            <label for="mod_puerto" class=" form-control-label">Puerto web</label>
                                        </div>
                                         <div class="col-6 col-sm-6">
                                                <input type="number" id="mod_puertoweb" name="mod_puertoweb" placeholder="Clave de los secrets" class="form-control">
                                        </div>
                                     </div>
                                                            
                                        
                               



                               
                                       
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                                <button type="submit" class="btn btn-primary btn-sm" id="btnupdate"><i class="fa fa-refresh"></i> Actualizar</button>
                            </div>
                              </form>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
