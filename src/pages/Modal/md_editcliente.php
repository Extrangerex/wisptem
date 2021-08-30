    <?php
        if (isset($con))
        {
?>
<div class="modal fade" id="editcliente" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h8 class="modal-title"><i class="fa fa-users"></i> Editar Usuario</h8>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                               <form method="post"  name="edtuser" id="edtuser" >
                                <div class="row form-group">
                                    <div id="resultados_ajax2"></div>
                                </div>
                                <div class="col-lg-12">
                       
                           
                            <div class="card-body">
                                <!-- Informacion Personal -->
                             
                                    
                                        
                                    
                                       
                                            <div class="row">
            <div class="col-sm-6">
            <label>Nombre</label>
              <input  style="background-color: #87CEEB;" type="text" class="input-sm input-sm form-control-sm form-control-sm input-sm form-control-sm form-control" required="" name="mod_nombre" id="mod_nombre" >
            </div>
              <div class="col-sm-6">
              <label>Apellido</label>
              <input  style="background-color: #87CEEB;" type="text" class="input-sm input-sm form-control-sm form-control-sm input-sm form-control-sm form-control" required name="mod_apellido" id="mod_apellido" >
            </div>
          </div>
           <div class="row">
            <div class="col-sm-6">
            <label>Cedula o Pasaporte</label>
              <input  style="background-color: #87CEEB;" type="text" class="input-sm input-sm form-control-sm form-control-sm input-sm form-control-sm form-control"  name="mod_documento" id="mod_documento" >
            </div>
              <div class="col-sm-3">
              
              <label for="cell">Cell</label>
                    <div class="input-group">
                      <input  style="background-color: #87CEEB;" name="mod_cell" type="text" class="input-sm input-sm form-control-sm form-control-sm input-sm form-control-sm form-control" id="mod_cell" required placeholder="(8xx) xxx-xxxx">
                      <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    </div>
                    
            </div>
            <div class="col-sm-3">
                <label for="cell2">TEL.</label>
                    <div class="input-group">
                    	

                      <input  style="background-color: #87CEEB;" name="mod_cell2" type="text" class="input-sm form-control-sm form-control" id="mod_cell2" placeholder="(8xx) xxx-xxxx" >
                       <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                     
                    </div>
          </div>
          </div>
          
       <div class="row">
            <div class="col-sm-6" id="txtfechaini">
            <label>Fecha de Instalación</label>
             <div class='input-group date' id='datetimepicker1'>
             	 <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

              <input  style="background-color: #87CEEB;"  class="input-sm form-control-sm form-control" required name="mod_fechainicial" id="mod_fechainicial">
               
            </div>
        	</div>
              <div class="col-sm-6" id="txtfechafin">
              <label>Fecha de Pago</label>
               <div class="input-group date">

         <input  style="background-color: #87CEEB;"  class="input-sm form-control-sm form-control" required name="mod_fechafinal" id="mod_fechafinal">
          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
          </div>
      	</div>
       <div class="row">
            <div class="col-sm-6">
            <label>No de Poste</label>
              <input  style="background-color: #87CEEB;" type="text" class="input-sm form-control-sm form-control"  name="mod_poste" id="mod_poste" >
            </div>
              <div class="col-sm-6">
              <label>Sector</label>
              <select  style="background-color: #87CEEB;" name="mod_sector" class="input-sm form-control" required  id="mod_sector">
              <option value=""></option>
                    <?php
              $sql="select * from sector order by nombre asc";
              $resultado2=mysqli_query($con,$sql);

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
           <div class="row">
            <div class="col-sm-12">
            <label>Direccion del Cliente</label>
              <input  style="background-color: #87CEEB;" type="text" class="input-sm form-control-sm form-control" required name="mod_direccion" id="mod_direccion" ">
            </div>
              
          </div>
          
          <div class="row">
          	 <div class="col-sm-6">
              <label>Instalado Por:</label>
              <select  style="background-color: #87CEEB;" name="mod_empleado" class="form-control" required  id="mod_empleado">
              <option value=""></option>
                    <?php
              $sql="select * from users order by firstname asc";
              $resultado2=mysqli_query($con,$sql);

              while ($res=mysqli_fetch_array($resultado2)){
       
       
                echo "<option value='".$res['user_id']."' ";
         
                if ($res['user_id'] == $_POST['empleado'])
                  echo " SELECTED ";
          
                  echo ">";
                  echo $res['firstname'];
                  echo " ";
                  echo $res['lastname'];
                  echo "</option>";
         
                  
                }
                mysqli_free_result($resultado2);
       
      
              ?>
    
                 </select>  
            </div>
            <div class="col-sm-3">
              <label>Pago de Instalacion</label>
              <input  style="background-color: #87CEEB;" type="number" class="input-sm form-control-sm form-control" required name="mod_pago_instalacion" id="mod_pago_instalacion">
            </div>


          </div>

          <div class="row">
            <div class="col-sm-6">
            <label>Planes</label>
            <select  style="background-color: #87CEEB;" name="mod_plan" class="input-sm form-control" required id="mod_plan" onChange="mostrar();">
            	<option value=" "></option>
                      <?php
       $sql="select * from planes order by id asc";
       $resultado2=mysqli_query($con,$sql);

       while ($res=mysqli_fetch_array($resultado2)){
       
  
       echo "<option value='".$res['plan']."' ";
          
          echo ">";
        echo $res['nombre'];
        echo "</option>";
         
        
       }
       mysqli_free_result($resultado2);
       
      
       ?>
                    </select>

              </div>
              <div class="col-sm-3">
              <label>Monto</label>
              <input  style="background-color: #87CEEB;" type="text" class="input-sm form-control-sm form-control" required name="mod_pago_total" id="mod_pago_total">
            </div>
          </div>      
          
         

          <div class="row">

            <div class="col-sm-6">  
             <label>Remote Address</label>
              <input type="text"  style="background-color: #87CEEB;" name="mod_remoteaddress" class="input-sm form-control"   id="mod_remoteaddress">
              
      
                </div>
                <div class="col-sm-6">  
             <label>Nodo</label>
              <select  style="background-color: #87CEEB;" name="mod_nodo" class="input-sm form-control"   id="mod_nodo">
              
      						<option value=""></option>
        
                       <?php
  

                          $sql="SELECT * FROM mikrotik";
                            $resultado=mysqli_query($con,$sql);

                             while ($res=mysqli_fetch_array($resultado)){
       
       
                             echo"<option value=".$res["idmikrotik"].">".$res["nodo"]."</option>";
                         }
                            mysqli_free_result($resultado);
                           ?>
                         </select>  
                </div>
                 
            
          </div>
           <div class="row">
            <div class="col-sm-6">
            <label>Usuario</label>
              <input  style="background-color: #87CEEB;" type="text" class="input-sm form-control-sm form-control" required name="mod_usuario" id="mod_usuario" >
            </div>
              <div class="col-sm-6">
              <label>Contrasena</label>
              <input  style="background-color: #87CEEB;" type="password" class="input-sm form-control-sm form-control" name="mod_password" id="mod_password"  value="<?php echo ppp_pass ?>" readonly required >
            </div>
          </div>
			<div class="row">
            <div class="col-sm-12">
            <label>Observacion</label>
              <input  style="background-color: #87CEEB;" type="text" class="input-sm form-control-sm form-control" name="mod_comentario" id="mod_comentario" >
            </div>
              
          </div>

         
          
          
                                               
                                              
                                        
                                    </div>
                                </div>

                           
                    

                   
                     

                          
                        
                                        
                               



                               
                                       
                            </div>
                            <div class="modal-footer">
                                
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                                 <button type="reset" class="btn btn-success btn-sm" ><i class="fa fa-refresh"></i> Refresh</button>
                                <button type="submit" class="btn btn-primary btn-sm" id="btnupdate"><i class="fa fa-floppy-o"></i> Registrar</button>
                            </div>
                              </form>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
