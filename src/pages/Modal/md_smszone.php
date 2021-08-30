    <?php
        if (isset($con))
        {
          $sql = "select * from sector";
          $resultado = mysqli_query($con,$sql);


?>
<div class="modal fade" id="newsmszone" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><i class="fa fa-whatsapp"></i> Enviar SMS x Sector</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                               <form method="post"  name="gdsmsZ" id="gdsmsZ" >
                                <div class="row form-group">
                                  
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
                                                 
                                                 
                                                <div class="col-sm-6">
                                                     <label for="nodo" class="control-label mb-1">Selecionar Sector</label>
                                                     <select id="sector" name="sector" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                      <option value=""></option>
                                                      <option value="todo">Todos</option>
                                                      <?php while($row = mysqli_fetch_array($resultado)) { ?>
                                                      <option value="<?php echo $row['abreviacion']; ?>"><?php echo $row['nombre']; ?></option>
                                                       <?php } ?>




                                                     </select>
                                                </div>
                                            </div>
                                            <p></p>

                                             <div class="row">

                                                <div class="col-sm-12">
                                                 <label for="mensajeZ" class="control-label mb-1">Texto a enviar</label>
                                                    <textarea id="mensajeZ" name="mensajeZ" type="text" class="form-control" aria-required="true" aria-invalid="false"onkeyup="maximoZ();" style="height:  100px;" ></textarea>
                                               </div>
                                                <div class="counterZ" style="text-align:center; width:100%"></div>
                                                 
                                                
                                            </div>

                                           
                                               
                                               
                                              
                                        
                                    </div>
                                </div>

                           
                        </div> <!-- .Personal -->

                    </div>
                     


                          
                        
                                        
                               



                               
                                       
                            </div>
                            <div class="modal-footer">
                                
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                                 <button type="reset" class="btn btn-success btn-sm" ><i class="fa fa-refresh"></i> Refresh</button>
                                <button type="submit" class="btn btn-success btn-sm" id="btnsaveZ"><i class="fa fa-send"></i> Enviar</button>
                            </div>
                              </form>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
