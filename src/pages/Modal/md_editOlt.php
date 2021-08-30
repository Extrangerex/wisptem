
    <?php
        if (isset($con))
        {
?>
<div class="modal fade" id="editolt" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h8 class="modal-title"><i class="fa fa-list"></i> Add OLT</h8>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="resultados_ajax2"></div>
                               

        <form class="form-horizontal" id="updateolt" method="post" accept-charset="utf-8" name="updateolt">

             <div><input type="hidden" name="mod_id" id="mod_id"></div>
    
    <div class="form-group">
        <label class="control-label col-sm-2" for="name">Name</label>
        <div class="col-sm-8">
            <input type="text" id="mname" name="mname" class="form-control" value="" title="A name for your OLT">
        </div>
    </div>
     <div class="form-group">
        <label class="control-label col-sm-2" for="mname">Nodo</label>
        <div class="col-sm-8">
            <input type="text" id="mnodo" name="mnodo" class="form-control" value="" title="A name for your OLT Nodo">
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-sm-2" for="olt_ip">OLT IP</label>
        <div class="col-sm-8">
            <input type="text" id="molt_ip" name="molt_ip" class="form-control" value="" title="Only valid IPv4 or FQDN addresses" required>
        </div>
    </div>
        
    <div class="form-group">
        <label class="control-label col-sm-2" for="telnet_port">Telnet TCP port</label>
        <div class="col-sm-8">
            <input type="text" id="mtelnet_port" name="mtelnet_port" class="form-control" value="2333" pattern="^[0-9]{1,5}$" title="example: 2333">
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-sm-2" for="olt_user">OLT telnet username</label>
        <div class="col-sm-8">
            <input type="text" id="molt_user" name="molt_user" class="form-control" value="" pattern="^\w{1,20}$" title="Maximum 20 characters">
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-sm-2" for="olt_password">OLT telnet password</label>
        <div class="col-sm-8">
            <input type="text" id="molt_password" name="molt_password" class="form-control" value="" pattern="^[a-zA-Z0-9!~%@#$&amp;()\\-`.+,/_]{1,20}$" title="Maximum 20 characters">
        </div>
    </div>
    

    
  
    
   
    
    <div class="form-group">
        <label class="control-label col-sm-2" for="olt_hardware_version">OLT hardware version</label>
        <div class="col-sm-8">
            <select name="molt_hardware_version" id="omlt_hardware_version" class="form-control">
                                   
                                    <option value="2" data-type="zte">ZTE-C320</option>
                                    <option value="18" data-type="zte">ZTE-C350</option>
                                    <option value="15" data-type="zte">ZTE-C600</option>
                                    <option value="19" data-type="zte">ZTE-C610</option>
                                    <option value="20" data-type="zte">ZTE-C620</option>
                                 
                            </select>       
           
        </div>
    </div>
    
  
   
    
  
    
    
   </div>
              
              <p></p>
                 <p></p>      
                                

                                <p></p>
                 <p></p> 

<p></p>
                 <p></p> 
                               



                               
                                       
                            
                            <div class="modal-footer">
                                
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                                 
                                <button type="submit" class="btn btn-primary btn-sm" id="btnupdate"><i class="fa fa-floppy-o"></i> Update</button>
                            </div>
                              </form>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
