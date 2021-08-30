    <?php
        if (isset($con))
        {
          $sql="select max(id) as mayor from clientesp";
$Records = mysqli_query($con,$sql) or die(mysql_error());
$resul=mysqli_fetch_array($Records);
$mayor=$resul['mayor']+1;

         
?>
<div class="modal fade" id="financiamiento" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h8 class="modal-title"><i class="fa fa-dollar"></i> Financiamiento</h8>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                               <form name="buscar" id="buscar" autocomplete="off">
                                
                               <div class="card-body">
                                <div id="loaderS"></div>
                              
                                <div class="row form-group">
                                     <div class="col col-sm-1"><label for="input-small" class=" form-control-label">ID </label></div>
                                    <div class="input-group col col-sm-3">
                                     
                                        <input type="text"  class="form-control" id="id" name="id" required >
                                   
                                      </div>
                                      <div class="input-group col col-sm-1">
                                     
                                         <button type="submit"  class="form-control" id="btn-buscar"><i class="fa fa-search"></i></button>
                                   
                                      </div>
                               </div>
                               <div class="card-header">
                                  <h8>Datos del cliente</h8>
                                </div>
                                <div class="card-body">
                                  
                                  <div id="loaderbuscar"></div>
                                  <div class="informacion"></div>
                                      
                                  </div>
                                    
                                 
                                </div>

                              </form>
                              <form method="post"  name="gdfin" id="gdfin" autocomplete="off">


                              <div class="card-body">
                                <div class="row form-group">
                                      <div class="col-3 col-sm-3">
                                        <label class=" form-control-label">Cantidad de pago: </label>
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <input type="number" id="numpag" name="numpag" class="input-sm form-control-sm form-control" required>
                                    </div>
                                    
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
