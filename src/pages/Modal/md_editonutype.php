    <?php
        if (isset($con))
        {
?>
<div class="modal fade" id="newonutype" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h8 class="modal-title"><i class="fa fa-user-secret"></i> Nuevo Plan</h8>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                            <form action="https://jivideogames.smartolt.com/onu_types/add/" class="form-horizontal" id="onu-type-add" enctype="multipart/form-data" method="post" accept-charset="utf-8">

    <div class="form-group pon_type_wrapper">
        <label class="control-label col-sm-2 radio-inline" for="pon_type">PON type</label>
        <div class="col-sm-8">
            <label class="radio-inline"><input type="radio" id="gpon" name="pon_type" value="gpon" checked="checked">GPON</label>
            <label class="radio-inline"><input type="radio" id="epon" name="pon_type" value="epon">EPON</label>
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-sm-2" for="name">ONU type</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="name" name="name" value="">
        </div>
    </div>


    <div class="form-group">
        <label class="control-label col-sm-2" for="network_ports">Ethernet ports</label>
        <div class="col-sm-8">
            <select name="network_ports" class="form-control" id="network_ports">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4" selected="selected">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
</select>
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-sm-2" for="wifi_ports">WiFi SSIDs</label>
        <div class="col-sm-8">
            <select name="wifi_ports" class="form-control" id="wifi_ports">
<option value="0">0</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
</select>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2" for="voip_ports">VoIP ports</label>
        <div class="col-sm-8">
            <select name="voip_ports" id="voip_ports" class="form-control">
<option value="0">0</option>
<option value="1">1</option>
<option value="2">2</option>
</select>
        </div>
    </div>

    <div class="form-group catv_wrapper">
        <label class="control-label col-sm-2 radio-inline" for="catv">CATV</label>
        <div class="col-sm-8 checkbox control-checkbox">
            <input type="checkbox" name="catv" value="true" id="catv">
        </div>
    </div>
    
            <div class="form-group">
            <label class="control-label col-sm-2 radio-inline" for="allow_custom_templates">Allow custom profiles</label>
            <div class="col-sm-8 checkbox control-checkbox">
                <input type="checkbox" name="allow_custom_templates" value="true" checked="checked" id="allow_custom_templates">
            </div>
        </div>
        
    <div class="form-group">
        <label class="control-label col-sm-2 radio-inline" for="capability">Capability</label>
        <div class="col-sm-8">
            <label class="radio-inline"><input type="radio" id="bridge" name="capability" value="Bridging">Bridging</label>
            <label class="radio-inline"><input type="radio" id="bridgeRouter" name="capability" value="Bridging/Routing" checked="checked">Bridging/Routing</label>
        </div>
    </div>
    
     <div class="row">
        <div class="collapse-group">
            <div class="collapse in" aria-expanded="true" style="">
                <div class="form-group">
                    <label class="control-label col-sm-2 radio-inline" for="image"></label>
                    <div class="col-sm-8">
                        <img class="img-responsive img-rounded image_upload_preview" src="" style="display: none">
                    </div>
                </div>
    
                <div class="form-group">
                    <label class="control-label col-sm-2 radio-inline" for="image">ONU type image</label>
                    <div class="col-sm-8">
                        <input type="file" name="onu_type_image" id="onu_type_image" accept="image/*">
                        <div><span class="help-block">Maximum image size is 400 x 90 px</span></div>
                    </div>
                </div>
    
                <div class="form-group">
                    <label class="control-label col-sm-2" for="network_ports_prefix">Ethernet ports prefix</label>
                    <div class="col-sm-8">
                        <select name="network_ports_prefix" id="network_ports_prefix" class="form-control">
<option value="eth_0/">eth_0/</option>
<option value="eth_1/">eth_1/</option>
</select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="wifi_ports_prefix">WiFi SSIDs prefix</label>
                    <div class="col-sm-8">
                        <select name="wifi_ports_prefix" id="wifi_ports_prefix" class="form-control">
<option value="wifi_0/">wifi_0/</option>
<option value="wifi_1/">wifi_1/</option>
</select>
                    </div>
                </div>
        
                <div class="form-group">
                    <label class="control-label col-sm-2" for="voip_ports_prefix">VoIP ports prefix</label>
                    <div class="col-sm-8">
                        <select name="voip_ports_prefix" id="voip_ports_prefix" class="form-control">
<option value="pots_0/">pots_0/</option>
<option value="pots_1/">pots_1/</option>
</select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="control-label col-sm-2"></div>
                <div class="col-sm-8">
                    <p class="pull-right"><a class="btn btn-link" href="#">Advanced »</a></p>
                </div>
            </div>
        </div>
      </div>
    
    <div class="form-actions">
        <div class="col-sm-2"></div>
        <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-file glyphicon glyphicon-white"></i> Save</button>
        <a href="https://jivideogames.smartolt.com/onu_types/listing" class="btn btn-link">Cancel</a>
    </div>

    </form>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
