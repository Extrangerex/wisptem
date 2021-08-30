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
 if ($nivel == 1) {

$display = "yes";
} else {

$display= "none";
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
include ("Modal/md_newonutype.php");
//include ("Modal/md_editonutype.php");
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
          <ul class="sidebar-menu" data-widget="tree">
            <li>
              <a href="../pages/admin.php">
                <i class="fa fa-dashboard"></i> <span>Inicio</span>
              </a>
            </li>
            <li class="treeview" style="display:<?php echo $display; ?>">
              <a href="#">
                <i class="fa fa-briefcase"></i>
                <span >Sistema</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                
                <li><a href="../pages/mikrotik.php"><i class="fa fa-sitemap"></i> <span>Routers Mikrotik</span></a></li>
                <li><a href="../pages/planes.php"><i class="fa fa-bars"></i> <span >Planes Internet</span></a></li>
                <li><a href="../pages/usuarios.php"><i class="fa fa-users"></i> <span>Gestión de personal</span></a></li>
              </ul>
            </li>
             </li>
             </li>
              <li class="treeview active">
              <a href="#"><i class="fa fa-server"></i> <span>JIG OLT</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="../pages/unconfigured.php"><i class="fa fa-wifi"></i> <span>Unconfigured</span></a></li>
                <li><a href="../pages/activeconnections.php"><i class="fa fa-wifi"></i> <span>Configured</span></a></li>
                <li class="active"><a href="../pages/onutype.php"><i class="fa fa-wifi"></i> <span>Onu Types</span></a></li>
                <li><a href="../pages/instalaciones.php"><i class="fa fa-server"></i> <span>OLTs</span></a></li>
              
                
                
              </ul>
            </li>
            
            <li class="treeview">
              <a href="#"><i class="fa fa-user"></i> <span>Clientes</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="../pages/clientes.php"><i class="fa fa-user-plus"></i> <span>Clientes</span></a></li>
                <li><a href="../pages/activeconnections.php"><i class="fa fa-user-plus"></i> <span>Active Connections</span></a></li>
                <li><a href="#mapa/"><i class="fa fa-street-view"></i> <span>Mapa Clientes</span></a></li>
                <li><a href="../pages/instalaciones.php"><i class="fa fa-calendar"></i> <span>Instalaciones</span></a></li>
                <li><a href="../pages/anuncios.php"><i class="fa fa-commenting-o"></i> <span>Anuncios</span></a></li>
                
                
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-usd"></i> <span>Facturación</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                
                <li ><a href="../pages/pagos.php"><i class="fa fa-credit-card"></i> <span>Registrar pagos</span></a></li>
                <li><a href="../pages/facturas.php"><i class="fa fa-file-pdf-o"></i> <span>Facturas</span></a></li>
              
                
              </ul>
            </li>
            <li><a href="../pages/almacen.php"><i class="fa fa-cubes"></i> <span >Almacen</span></a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-shopping-bag"></i> <span >Tienda</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                
                <li><a href="../pages/productos.php"><i class="fa fa-cart-plus"></i> <span >Agregar Productos</span></a></li>
                <li><a href="../pages/ventas.php"><i class="fa fa-dollar"></i> <span>Ventas</span></a></li>
                
              </ul>
            </li>
            <li><a href="../pages/financiamiento.php"><i class="fa fa-dollar"></i> <span>Financiamiento</span></a></li>
            <li><a href="../pages/averias.php"><i class="fa fa-ticket"></i> <span>Averias</span></a></li>
            <li><a href="../pages/sms.php"><i class="fa fa-whatsapp"></i> <span >SMS</span></a></li>
            
            
            
            <li class="treeview" style="display:<?php echo $display; ?>">
              <a href="#">
                <i class="fa fa-cogs"></i>
                <span >Ajustes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../pages/ajustes.php"><i class="fa fa-cog"></i><span >General</span></a></li>
                <li><a href="../pages/sms-server.php"><i class="fa fa-whatsapp"></i><span>Servidor Sms</span></a></li>
                <li><a href=" ../pages/zonas.php"><i class="fa fa-globe"></i><span>Zona</span></a></li>
                <li><a href=" ../pages/plantillas.php"><i class="fa fa-whatsapp"></i> <span>Plantillas anuncios</span></a></li>
                <li><a href=" ../pages/backup.php"><i class="fa fa-hdd-o"></i> <span>Backups</span></a></li>
                
              </ul>
           
          </ul>
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
            <li>Onu Type</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div id="resultadoAjax"></div>
            
            <!-- ./col -->
          </div>
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
              <div class="box">
                
                <div class="panel box box-primary" >
                  <div class="box-header with-border">
                    
                    <strong class="box-title "><h4>Onu Type</h4></strong>
                  </div>
                
                <div class="box-default"  >
                  <div class="box-body">
                    <button type="button" data-toggle="modal" data-target="#newonutype" class="btn btn-success" style="margin-left: 10px;"><i class="fa fa-plus"></i> Add ONU Type</button>
                        <table class="table table-striped" id="onulist">
    <thead>
      <tr>
      <th class="col-md-1">PON type</th>
      <th class="col-md-2">ONU type </th>
      <th class="col-md-2">Ethernet ports</th>
      <th class="col-md-1">WiFi</th>
      <th class="col-md-2">VoIP ports</th>
      <th class="col-md-1">CATV</th>
          
            <th class="col-md-2">Capability</th>

      <th class="col-md-1 text-center">Action</th>
    </tr>

      
      
     
    </thead>
   
  </table>
                    <!-- /.tab-content -->
                  </div>
                  
                </div>
                
              </section>
              
              
              
              
              
              
              
            </div>
            <!-- /.row (main row) -->
          </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include 'pie.php'; ?>
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
        immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
      </div>
      <!-- ./wrapper -->
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
      
var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
var onulist;

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
  <script>

  $(function() {
onulist = $('#onulist').DataTable( {
"ajax": 'Ajax/onutypelist.php',
 
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : false,


"aoColumns": [

{ mData: 'pon_type'},
{ mData: 'onu_type' },
{ mData: 'ether_port' },
{ mData: 'wifi_port'},
{ mData: 'voip_port'},
{ mData: 'catv'},
{ mData: 'capability'},
{
"mData": null,
"mRender": function (o) {
return '<a class="btn btn-lg btn-default" id="btneliminar" name="btneliminar"  href=#  onclick=eliminar_onu(' + o.id + ');><i class="fa fa-trash-o"></i></a>';

}
}


],

} );
} );

$( "#gdonu" ).submit(function( event ) {
$('#btnsave').attr("disabled", true);

var parametros = $(this).serialize();
$.ajax({
type: "POST",
url: "Ajax/crear/nuevo_onu.php",
data: parametros,
beforeSend: function(objeto){
msgbox("loader","Guardando ...",3);
},
success: function(datos){

$("#resultados_ajax").html(datos);
$("#gdonu")[0].reset();
$('#btnsave').attr("disabled", false);
updatelist();
}
});
event.preventDefault();
})
$( "#updateonu" ).submit(function( event ) {
$('#btnupdate').attr("disabled", true);

var parametros = $(this).serialize();
$.ajax({
type: "POST",
url: "Ajax/update/update_plan.php",
data: parametros,
beforeSend: function(objeto){
msgbox("loader","Actualizando ...",3);
},
success: function(datos){

$("#resultados_ajax2").html(datos);
$('#btnupdate').attr("disabled", false);
updatelist();

}
});
event.preventDefault();
})
eliminar_onu=function(e,d){

swal({
title: "Estas seguro?",
text: "Si elimina una onu con clientes va perder la configuracion que está asociada a este plan!",
type: "warning",
showCancelButton: true,
confirmButtonColor: "#DD6B55",
confirmButtonText: "Si, Eliminar!",
closeOnConfirm: true },
function(){
msgbox("loader","procesando...",0);
$.post( "Ajax/buscar/buscar_plan.php", {id: e})
.done(function( datas ) {
$('.notydiv').remove();
msgbox("success","Onu Eliminada correctamente",3);

updatelist();

});
});

}
updatelist=function(){


}

  </script>
 