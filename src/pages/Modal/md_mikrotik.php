    <?php
        if (isset($con))
        {
?>
<div class="modal fade" id="listamk" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h8 class="modal-title"><i class="fa fa-list"></i> Registrar Nuevo Router</h8>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                               <form method="post"  name="gdrouter" id="gdrouter" >
                                <div class="row form-group">
                                    <div id="resultados_ajax"></div>
                                </div>

                                     <div class="row form-group">
                                         <div class="col col-sm-3">
                                            <label for="nodomk" class=" form-control-label">Nombre del Mikrotik</label>
                                        </div>
                                         <div class="col-6 col-sm-6">
                                                <input type="text" id="nodomk" name="nodomk" placeholder="Nombre del nodo" class="form-control"  >
                                        </div>
                                     </div>
                                      <div class="row form-group">
                                         <div class="col col-sm-3">
                                            <label for="modelomk" class=" form-control-label">Modelo del Mikrotik</label>
                                        </div>
                                         <div class="col-6 col-sm-6">
                                                <input type="text" id="modelomk" name="modelomk" placeholder="Modelo del Mikrotik" class="form-control" >
                                        </div>

                                     </div>
                                      <div class="row form-group">
                                         <div class="col col-sm-3">
                                            <label for="modelomk" class=" form-control-label">Tipo de conexion</label>
                                        </div>
                                         <div class="col-6 col-sm-6">
                                                <select id="tipocon"  name="tipocon" class="form-control" >
                                                    <option value=""></option>
                                                    <option value="1">Local</option>
                                                    <option value="2">Remota</option>

                                                </select>
                                        </div>
                                        
                                     </div>
                                      <div class="row form-group">
                                         <div class="col col-sm-3">
                                            <label for="ipmk" class=" form-control-label">IP Mikrotik</label>
                                        </div>
                                         <div class="col-6 col-sm-6">
                                                <input type="text" id="ipmk" name="ipmk" placeholder="IP o dns del Mikrotik " class="form-control">
                                        </div>
                                     </div>
                                      <div class="row form-group">
                                         <div class="col col-sm-3">
                                            <label for="usuariomk" class=" form-control-label">Usuario Mikrotik</label>
                                        </div>
                                         <div class="col-6 col-sm-6">
                                                <input type="text" id="usuariomk" name="usuariomk" placeholder="Usuario Mikrotik" class="form-control">
                                        </div>
                                     </div>
                                      <div class="row form-group">
                                         <div class="col col-sm-3">
                                            <label for="passwordmk" class=" form-control-label">Password Mikrotik</label>
                                        </div>
                                         <div class="col-6 col-sm-6">
                                                <input type="password" id="passwordmk" name="passwordmk" placeholder="Contraseña Mikrotik" class="form-control" value="">
                                        </div>
                                     </div>
                                      <div class="row form-group">
                                         <div class="col col-sm-3">
                                            <label for="interfacemk" class=" form-control-label">Interface Wan</label>
                                        </div>
                                         <div class="col-6 col-sm-6">
                                                <input type="text" id="interfacemk" name="interfacemk" placeholder="nombre del interface wan" class="form-control">
                                        </div>
                                     </div>
                                       <div class="row form-group">
                                         <div class="col col-sm-3">
                                            <label for="puertomk" class=" form-control-label">Puerto Api</label>
                                        </div>
                                         <div class="col-6 col-sm-6">
                                                <input type="number" id="api" name="api" placeholder="Puerto del Api" class="form-control">
                                        </div>
                                     </div>
                                     <div class="row form-group">
                                         <div class="col col-sm-3">
                                            <label for="puertomk" class=" form-control-label">Puerto web</label>
                                        </div>
                                         <div class="col-6 col-sm-6">
                                                <input type="number" id="puertoweb" name="puertoweb" placeholder="puerto web" class="form-control">
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
