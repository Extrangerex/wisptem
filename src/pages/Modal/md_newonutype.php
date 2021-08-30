<?php
if (isset($con))
{
?>
<div class="modal fade" id="newonutype" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h8 class="modal-title"><i class="fa fa-user-secret"></i> Nuevo Onu Type</h8>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post"  name="gdonu" id="gdonu" class="form-horizontal">
                    <div class="row form-group">
                        <div id="resultados_ajax"></div>
                    </div>
                    <div class="form-group pon_type_wrapper">
                        <label class="control-label col-sm-2 radio-inline" for="pon_type">PON type</label>
                        <div class="col-sm-8">
                            <label class="radio-inline"><input type="radio" id="gpon" name="pon_type" value="gpon" checked>GPON</label>
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
                                <option value="4">4</option>
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
                        <div class="col-sm-8">
                            <input type="checkbox" name="catv" value="" id="catv">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2 radio-inline" for="capability">Capability</label>
                        <div class="col-sm-8">
                            <label class="radio-inline"><input type="radio" id="bridge" name="capability" value="Bridging">Bridging</label>
                            <label class="radio-inline"><input type="radio" id="bridgeRouter" name="capability" value="Bridging/Routing" checked="checked">Bridging/Routing</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2 radio-inline" for="image">ONU type image</label>
                        <div class="col-sm-8">
                            <input type="file" name="onu_type_image" id="onu_type_image" accept="image/*">
                            <div><span class="help-block">Maximum image size is 400 x 90 px</span></div>
                        </div>
                    </div>
                    
                    
                </div>
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