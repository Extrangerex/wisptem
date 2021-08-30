    <?php
        if (isset($con))
        {
?>
<div class="modal fade" id="newCategoria" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h8 class="modal-title"><i class="fa fa-list"></i> Categoria</h8>
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
                       
                            <div class="card-body">
                                <!-- Informacion Personal -->
                             
                                  
                                        
                                    
                                       
                                            <div class="row">
                                                 <div class="col-sm-12">
                                                    <label for="tipo" class="control-label mb-2">Selecionar Tipo</label>
                                                    <select id="tipo" name="tipo" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                       <?php
                                                                    $sql="select * from tipos_productos";
                                                                    $resultado2=mysqli_query($con,$sql);

                                                                    while ($res=mysqli_fetch_array($resultado2)){
                                                             
                                                             
                                                                      echo "<option value='".$res['id']."' ";
                                                               
                                                                      
                                                                
                                                                        echo ">";
                                                                        echo $res['desc'];
                                                                        echo "</option>";
                                                               
                                                                        
                                                                      }
                                                                      mysqli_free_result($resultado2);
                                                             
                                                            
                                                                    ?>
        
    


                                                    </select>
                                                 </div>
                                                  
                                            </div>

                                             <div class="row">

                                                <div class="col-sm-12">
                                                 <label for="cell" class="control-label mb-1">Nombre del producto</label>
                                                    <input id="nombre" name="nombre" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                               </div>
                                                 <div class="col-sm-12">
                                                    <label for="cantidad" class="control-label mb-1">Cantidad</label>
                                                    <input id="cantidad" name="cantidad" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                              </div>
                                              <div class="col-sm-12">
                                                    <label for="descripcion" class="control-label mb-1">Descripcion</label>
                                                    <textarea id="descripcion" name="descripcion"class="form-control"  >
                                                    </textarea>
                                              </div>
                                                
                                            </div>

                                            
                                               
                                               
                                              
                                        
                                    </div>
                              

                           
                        </div> <!-- .Personal -->

                   


                          
                        
                                        
                               



                               
                                       
                            </div>
                            <div class="modal-footer">
                                
                                <button type="button" class=" btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                              
                                <button type="submit" class="btn btn-primary btn-sm" id="btnsave"><i class="fa fa-floppy-o"></i> Registrar</button>
                            </div>
                              </form>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
