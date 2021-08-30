<?php
session_start();
include '../config/db.php';
include 'is_logged.php';

require('../config/api_mt_include2.php');
$iduser = $_SESSION['user_id'];
$nivel=$_SESSION['nivel'];
$ids=$_SESSION['user_id'];
$fnombre=$_SESSION['firstname'];
$fapellido=$_SESSION['lastname'];
$fullname = "$fnombre $fapellido";
$u_cargo=$_SESSION['cargo'];
$u_ingreso=$_SESSION['fing'];
$fullname = "$fnombre $fapellido";
if ($nivel != 1){
$disabled = "disabled";
}

$id = $_GET["id"];
$nivel=$_SESSION['nivel'];
if ($nivel != 1){
$disabled = "disabled";
}
$sql="SELECT * FROM  users where user_id=$id";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);
$nombre=$row['firstname'];
$apellido=$row['lastname'];
$cargo=$row['cargo'];
$cell=$row['cell'];
$nombres = "$nombre $apellido";
function getAvatarUrl($id)
{
global $con;
$query = mysqli_query($con,"select *from users where user_id=$id");
$row = mysqli_fetch_array($query);
$foto = $row['foto'];
if (isset($foto)){
return $foto;
}else{
return '../images/avatar2.png';
}
}
include ("Modal/md_plan.php");
include ("Modal/md_editplan.php");



$cmd = "select * from sms_gateway where id=1";
$response = mysqli_query($con,$cmd);
$gate = mysqli_fetch_array($response);


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <title><?php echo NOMBRE_EMPRESA; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../dist/css/ji.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
     <link rel="stylesheet" href="../css/sweetalert.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

  
  <body class="hold-transition skin-blue sidebar-mini">
   
    <div class="wrapper">
       <input type="hidden" name="idsession" id="idsession" value="<?php echo $nivel; ?>">
       <?php include ('../includes/header.php'); ?>
   
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img   src="<?php echo getAvatarUrl($ids); ?>" class="profile-user-img img-responsive img-circle" alt="User profile picture" >
        </div>
        <div class="pull-left info">
          <p><?php echo $fullname; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php include ('../includes/menu_administrador.php'); ?>
    </section>
    <!-- /.sidebar -->
  </aside>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Administrador</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Planes</li>
      </ol>
    </section>

    <!-- Main content -->
      <div class="content">
       
    <div class="col-sm-6">
         <div class="panel box box-primary">
                    <strong class="card-title text-light"><i class="fa fa-mobile"></i> Gateway</strong>
                </div>

        <div class="card-body">
            <form id="frmgateway"  method="post">

                    <div style="background: #fdfdfd;
                            padding: 10px;
                            border-radius: 5px;
                            " class="text-center">
                        <img src="http://i.imgur.com/af3MYi1.png">
                        </div>
                      

                                     <div class="row form-group">
                                        <div id="ajax1"> </div>
                                         <div class="col col-sm-3">
                                            <label for="correo" class=" form-control-label">Api Key</label>
                                        </div>
                                         <div class="col-6 col-sm-9">
                                                <input type="text" id="api" name="api" class="form-control" value="<?php echo $gate['api']; ?>" required >
                                        </div>
                                     </div>

                                     <div class="row form-group">
                                         <div class="col col-sm-3">
                                            <label for="password" class=" form-control-label">Numero Whatsapp</label>
                                        </div>
                                         <div class="col-6 col-sm-9">
                                                <input type="number" id="number" name="numero"  class="form-control" value="<?php echo $gate['numero']; ?>" required >
                                        </div>
                                     </div>

                                   

                              




                        <div style="text-align:center">
                        <button type="reset" class="btn btn-success btn-sm" ><i class="fa fa-refresh"></i> Refresh</button>
                        <button type="submit" class="btn btn-sm btn-primary btdevice" id="btngateway"><i class="fa fa-floppy-o"></i> Guardar</button>
                        </div>
               </form>
                    </div>

                                

    

     </div>   


     <div class="col-sm-6">
          <div class="panel box box-primary">
                    <strong class="card-title text-light"><i class="fa fa-mobile"></i> Plantilla Mensaje</strong>
                </div>
        <div class="card-body">
            <form id="frmsmsaviso"  method="post" >  
                         <div class="row form-group">
                            <div id="ajax2"> </div>
                                  <div class="col col-sm-3">
                                      <label for="api" class=" form-control-label">seleccionar Plantilla</label>
                                 </div>
                                 <div class="col-6 col-sm-6">
                                   <select  id="id-plantilla" name="id-plantilla" class="form-control"  >
                                    <option value="">Seleccione una opcion</option>
                                    <option value="1">Mensaje Factura Generada</option>
                                    <option value="2">Mensaje de Aviso de pago/vencimiento</option>


                                   </select>
                                 </div>
                         </div>
                          <div class="row form-group">
                                         
                                         <div class="col-6 col-sm-12">
                                               <textarea id="smsaviso"  required name="smsaviso" class="form-control" style="height:100px" onkeyup="maximo();"> </textarea>
                                        </div>
                        </div>
                            <div class="counter" style="text-align:center; width:100%"></div>

                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-sm btn-primary" id="btnsmsaviso"><i class="fa fa-floppy-o"></i> Guardar cambios</button>
                                </div>

        </div>
        </form>

     </div>   
   </div>
 </section>
     </div> <!-- .content -->
  <!-- /.content-wrapper -->
   <?php include 'pie.php'; ?>


  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="../assets/plugins/jQueryUI/jquery-ui.min.js"></script>
 
    <!-- jQuery UI 1.11.4 -->
    <script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- Sparkline -->
    <script src="../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- jvectormap  -->
    <script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll -->
    <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- Morris.js charts -->
    <script src="../../bower_components/raphael/raphael.min.js"></script>
    <script src="../../bower_components/morris.js/morris.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../dist/js/jitechwisp.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <script src="../bower_components/morris.js/morris.min.js"></script>
    <!-- DataTables -->
    <script src="../js/datatables.min.js"></script>
    <script src="../js/dataTables.select.min.js"></script>
    <script src="../js/bootstrap-notify.min.js"></script>
    <!-- PLUGINS -->
    <script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script type="text/javascript" src="../plugins/flot/jquery.flot.min.js"></script>
    <script type="text/javascript" src="../plugins/flot/jquery.flot.time.min.js"></script>
    <script type="text/javascript" src="../plugins/flot/jquery.flot.symbol.min.js"></script>
    <script src="../js/bootstrap-tabdrop.js"></script>
    <script src="../js/sweetalert.min.js"></script>
    <script src="../plugins/select2/select2.full.min.js"></script>
    <script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="../js/jquery.iframe-transport.js"></script>
    <script src="../js/jquery.uploadfile.min.js"></script>
    <script src="../js/tactil.js"></script>
    <script src="../js/push.min.js"></script>
    <script src="../js/jquery.webui-popover.min.js"></script>
    <script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="../plugins/datepicker/locales/bootstrap-datepicker.es.min.js"></script>
    <script src="../js/raphael-min.js"></script>
    <script src="../plugins/morris/morris.min.js"></script>
    <script src="../plugins/input-mask/jquery.inputmask.js"></script>
    <script src="../plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="../plugins/ckeditor/ckeditor.js"></script>
</body>
</html>
<script>
var id = $("#idsession").val();
if (id === "1") {
$('#li-online').show();
}else{
$('#li-online').hide();
}
$(document).ready(function(){


setInterval(function () {

Push.Permission.request();
cargar_session();
cargar_notify();

cargar_listaonline();
},10000);
});


function cargar_session () {
$.ajax({
url:'serverside/online.php',
type:'POST',
success:function (data) {
$('#numonline').html(data);

}
});
}
function cargar_notify () {

$.ajax({
url:'serverside/onlinedata.php',
type:'POST',
success:function (datos) {
$('#resultadoAjax').html(datos);


}
});
}
function cargar_listaonline () {

$.ajax({
url:'serverside/lista_onlinedata.php',
type:'POST',
success:function (datos) {
$('.lista_online').html(datos);


}
});
}

</script>

<style type="text/css">
.table-wrapper-scroll-y {
display: block;
max-height: 200px;
overflow-y: auto;
-ms-overflow-style: -ms-autohiding-scrollbar;
}
</style>
<script>

$('#id-plantilla').on('change',function(){
var id = $(this).val();
if(id){
$.ajax({
type:'POST',
url:'Ajax/ajaxDataplantilla.php',
data:'id='+id,
success:function(html){
$('#smsaviso').html(html);
}
});
}
});



   function maximo(){
if($("#smsaviso").val().length>=160){
$('#smsaviso').val($("#smsaviso").val().substring(0,160));
 }
$('.counter').html('Caracteres <b>'+$("#smsaviso").val().length+'/160</b>');
}

$('.counter').html('Caracteres <b>'+$("#smsaviso").val().length+'/160</b>');


$( "#frmgateway" ).submit(function( event ) {
  $('#btngateway').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "Ajax/smsgateway.php",
            data: parametros,
             beforeSend: function(objeto){
             msgbox("loader","procesando...",0);
            },
            success: function(datos){
              
            $("#ajax1").html(datos);
            $('#btngateway').attr("disabled", false);
           
          }
    });
  event.preventDefault();
})

$( "#frmsmsaviso" ).submit(function( event ) {
  $('#btnsmsaviso').attr("disabled", true);
  
 var parametros = $(this).serialize();
     $.ajax({
            type: "POST",
            url: "Ajax/smsplantilla.php",
            data: parametros,
             beforeSend: function(objeto){
             msgbox("loader","procesando...",0);
            },
            success: function(datos){
              
            $("#ajax2").html(datos);
            $('#btnsmsaviso').attr("disabled", false);
           
          }
    });
  event.preventDefault();
})


 

</script>
