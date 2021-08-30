
    <?php
        if (isset($con))
        {
?>
<div class="modal fade" id="listaolt" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h8 class="modal-title"><i class="fa fa-list"></i> Add OLT</h8>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

        <form class="form-horizontal" id="gdrouter" method="post" accept-charset="utf-8" name="gdrouter">
    
    <div class="form-group">
        <label class="control-label col-sm-2" for="name">Name</label>
        <div class="col-sm-8">
            <input type="text" id="name" name="name" class="form-control" value="" title="A name for your OLT">
        </div>
    </div>
     <div class="form-group">
        <label class="control-label col-sm-2" for="name">Nodo</label>
        <div class="col-sm-8">
            <input type="text" id="nodo" name="nodo" class="form-control" value="" title="A name for your OLT Nodo">
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-sm-2" for="olt_ip">OLT IP</label>
        <div class="col-sm-8">
            <input type="text" id="olt_ip" name="olt_ip" class="form-control" value="" title="Only valid IPv4 or FQDN addresses" required>
        </div>
    </div>
        
    <div class="form-group">
        <label class="control-label col-sm-2" for="telnet_port">Telnet TCP port</label>
        <div class="col-sm-8">
            <input type="text" id="telnet_port" name="telnet_port" class="form-control" value="2333" pattern="^[0-9]{1,5}$" title="example: 2333">
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-sm-2" for="olt_user">OLT telnet username</label>
        <div class="col-sm-8">
            <input type="text" id="olt_user" name="olt_user" class="form-control" value="" pattern="^\w{1,20}$" title="Maximum 20 characters">
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-sm-2" for="olt_password">OLT telnet password</label>
        <div class="col-sm-8">
            <input type="text" id="olt_password" name="olt_password" class="form-control" value="" pattern="^[a-zA-Z0-9!~%@#$&amp;()\\-`.+,/_]{1,20}$" title="Maximum 20 characters">
        </div>
    </div>
    

    
  
    
   
    
    <div class="form-group">
        <label class="control-label col-sm-2" for="olt_hardware_version">OLT hardware version</label>
        <div class="col-sm-8">
            <select name="olt_hardware_version" id="olt_hardware_version" class="form-control">
                                   
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
