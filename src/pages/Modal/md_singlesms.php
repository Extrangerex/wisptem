    <?php
        if (isset($con))
        {




?>
<div class="modal fade" id="sendSms" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><i class="fa fa-whatsapp"></i> Enviar SMS </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                               <form method="post"  name="gdsms" id="gdsms" >
                                <div class="row form-group">
                                    <div id="resultados_ajax"></div>
                                </div>
                                <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-success" >
                                <strong class="card-title text-light"><i class="fa fa-send"></i> Envio SMS</strong>
                            </div>
                            <div class="card-body">
                                <!-- Informacion Personal -->
                             
                                    <div class="card-body">
                                        
                                    
                                       
                                            <div class="row">
                                                 
                                                  <input type="hidden" id="idcli" name="idcli">

                                                  <div class="col-sm-6">
                                                     <label for="estado" class="control-label mb-1">Cliente</label>
                                                     <input id="cliente" name="cliente"  type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                      
                                                </div>
                                                 <div class="col-sm-6">
                                                     <label for="estado" class="control-label mb-1">Numero: </label>
                                                     <input id="numero"  name="numero" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                      
                                                </div>
                                                
                                            </div>
                                            <p></p>

                                             <div class="row">

                                                <div class="col-sm-12">
                                                 <label for="mensaje" class="control-label mb-1">Texto a enviar</label>
                                                    <textarea id="mensaje" name="mensaje" type="text" class="form-control" aria-required="true" aria-invalid="false"onkeyup="maximo();" style="height:  100px;" ></textarea>
                                               </div>
                                                <div class="counter" style="text-align:center; width:100%"></div>
                                                 
                                                
                                            </div>

                                           
                                               
                                               
                                              
                                        
                                    </div>
                                </div>

                           
                        </div> <!-- .Personal -->

                    </div>
                     


                          
                        
                                        
                               



                               
                                       
                            </div>
                            <div class="modal-footer">
                                
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                                 <button type="reset" class="btn btn-success btn-sm" ><i class="fa fa-refresh"></i> Refresh</button>
                                <button type="submit" class="btn btn-success btn-sm" id="btnenviar"><i class="fa fa-send"></i> Enviar</button>
                            </div>
                              </form>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
