    <?php
        if (isset($con))
        {
?>
<div class="modal fade" id="AbonarFac" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><i class="fa fa-list"></i> Abono</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form method="POST"  name="abono" id="abono">
                    <div id="resultados_ajax4"></div>

                               
                              
                    
                    </div>


                          
                        
                                        
                               



                               
                                       
                            </div>
                            <div class="modal-footer">
                                
                               <button type="submit" class="btn btn-success btn-sm" id="gd-abono"  >
                                  <i class="fa fa-save"></i> Cobrar & Imprimir
                                  </button>
                               
                                 
                                 <button type="submit"  class="btn btn-success btn-sm" id="gd-mora"  >
                                  <i class="fa fa-save"></i> Cobrar Mora
                                  </button>
                                 
                                
                            </div>
                              </form>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
