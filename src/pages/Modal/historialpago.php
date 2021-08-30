    <?php
        if (isset($con))
        {
?>
<div class="modal fade" id="HistorialP" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><i class="fa fa-list"></i> Historial de pago</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <form method="POST"  name="historial" id="historial">
                    <div id="resultados_ajax3"></div>

                               
                               
                    
                    </div>


                          
                        
                                        
                               



                               
                                       
                            </div>
                            <div class="modal-footer">
                                
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Salir</button>
                                 
                                
                            </div>
                              </form>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
