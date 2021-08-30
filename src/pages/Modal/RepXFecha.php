	    <?php
        if (isset($con))
        {
?>
<div class="modal fade" id="RepXfec" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h8 class="modal-title"><i class="fa fa-list"></i> Reporte de clientes por fecha /Sector</h8>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            	  <form action="./Reportes/reportexfecha.php" method="post" target="_blank">


              <div class="row">
                  <div class="col-sm-3">
                      <label>Fecha de Pago</label>
                        <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                      <input  class="form-control" required name="fecha" id="fecha" value="<?php echo date('Y-m-d'); ?>">
                  </div>
                </div>
                  <div class="col-sm-6">
                      <label>Sector</label>
                      <select name="sector" class="form-control" required  id="sector">
                          <option value=""></option>
                          <?php
                          $sql="select * from sector order by nombre asc";
                          $resultado2=mysqli_query($con,$sql) or die (mysqli_error());

                          while ($res=mysqli_fetch_array($resultado2)){


                              echo "<option value='".$res['abreviacion']."' ";

                              if ($res['abreviacion'] == $_POST['sector'])
                                  echo " SELECTED ";

                              echo ">";
                              echo $res['nombre'];
                              echo "</option>";


                          }
                          mysqli_free_result($resultado2);


                          ?>


                      </select>
                  </div>

                  
                  	
                   

              </div>
             


       
    </div>
      <div class="modal-footer">
                                
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                                <button type="submit" class="btn btn-default" ><i class="fa fa-print"></i> Imprimir</button>
                                 
                            </div>

                               </form> 
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>


