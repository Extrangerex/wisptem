<?php
session_start();
$action = $_GET["action"];
	$tab1 = "active";
	$tab2 = "";
	$tab3 = "";
	$tab4 = "";


if ($action == "tab1") {
	$tab1 = "active";
	$tab2 = "";
	$tab3 = "";
	$tab4 = "";

}
if ($action == "tab2") {
	$tab1 = "";
	$tab2 = "active";
	$tab3 = "";
	$tab4 = "";

}
if ($action == "tab3") {
	$tab1 = "";
	$tab2 = "";
	$tab3 = "active";
	$tab4 = "";

}
if ($action == "tab4") {
	$tab1 = "";
	$tab2 = "";
	$tab3 = "";
	$tab4 = "active";

}


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
$per_act=$_SESSION['chk_act'];

 if ($nivel == 1) {

$display = "yes";
} else {

$display= "none";
}
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
include ("Modal/md_singlesms.php");
include ("Modal/md_newclientes.php");
include("Modal/RepXSector.php");
include("Modal/RepXFecha.php");
include("Modal/historialpago.php");
include("Modal/md_abonarfactura.php");


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
    <link rel="stylesheet" href="../css/sweetalert.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
      <input type="hidden" name="idsession" id="idsession" value="<?php echo $nivel; ?>">
       <input type="hidden" name="pmact" id="pmact" value="<?php echo $per_act; ?>">

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
          <ul class="sidebar-menu" data-widget="tree">
            <li >
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
             
            
            <li class="treeview active">
              <a href="#"><i class="fa fa-user"></i> <span>Clientes</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="active"><a href="../pages/clientes.php"><i class="fa fa-user-plus"></i> <span>Clientes</span></a></li>
                <li><a href="../pages/activeconnections.php"><i class="fa fa-user-plus"></i> <span>Active Connections</span></a></li>
               
                
              </ul>
           
            <li class="treeview">
              <a href="#"><i class="fa fa-usd"></i> <span>Facturación</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                
                <li><a href="../pages/pagos.php"><i class="fa fa-credit-card"></i> <span>Registrar pagos</span></a></li>
                <li><a href="../pages/facturas.php"><i class="fa fa-file-pdf-o"></i> <span>Facturas</span></a></li>
              
                
              </ul>
            </li>
            <li><a href="../pages/almacen.php"><i class="fa fa-cubes"></i> <span >Almacen</span></a></li>
           
            
           
         
            
            
              <li class="treeview" style="display:<?php echo $display; ?>">
              <a href="#">
                <i class="fa fa-cogs"></i>
                <span >Ajustes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../pages/ajustes.php"><i class="fa fa-cog"></i><span >General</span></a></li>
               
                <li><a href=" ../pages/zonas.php"><i class="fa fa-globe"></i><span>Zona</span></a></li>
         
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
            <li class="active">Clientes</li>
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
            <section class="col-lg-12 ">
              <div class="box-solid box-header">
                 <button type="button" data-toggle="modal" data-target="#newcliente" class="btn btn-success" style="margin-left: 10px;"><i class="fa fa-plus"></i> Nuevo Cliente</button>
                
                <a href="./Reportes/reporteclientes.php" target="_blank" type="button" class="btn  btn-default">
                  <h8 class="fa fa-print"></h8> Reporte General
                </a>
                <span>
                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#RepXfec">
                  <h8 class="fa fa-print"></h8> Reporte X Fecha
                  </button>
                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#RepXsect">
                  <h8 class="fa fa-print"></h8> Reporte X Sector
                  </button>
                </span>
              </div>
            </section>
            <section  class="col-lg-12 ">
              
              <div class="box">
                <div class="box-header with-border">
                  <strong class="box-title "><i class="fa fa-users"></i> Clientes</strong>
                </div>
               
                <div class="box-body">
                  
                   <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="<?php echo $tab1; ?>"><a href="#tab_1" data-toggle="tab" aria-expanded="true" class="listactivo"><i class="fa fa-user"></i> Clientes activos</a></li>
        <li class="<?php echo $tab2; ?>"><a href="#tab_2" data-toggle="tab" aria-expanded="false" onclick="loadlist_s();" class="listsuspendido" ><i class="fa fa-power-off"></i> Clientes suspendidos</a></li>
        <li class="<?php echo $tab3; ?>"><a href="#tab_3" data-toggle="tab" aria-expanded="false" onclick="loadlist_p();" class="listsuspendido" ><i class="fa fa-money"></i> Pendientes de pago</a></li>
        <li class="<?php echo $tab4; ?>"><a href="#tab_4" data-toggle="tab" onclick="loadlist_r();" class="listretirado"><i class="fa fa-user-times"></i> Clientes retirados</a></li>
        
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <div class="box box-solid  box-inverse collapse" id="collapseactivo">
            <div class="box-header with-border">
              <h5 class="box-title">Filtro Avanzado</h5>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-lg-4 col-xs-6">
                  <div class="form-group input-group-sm">
                    <label>Seleccionar campo</label>
                    <select class="form-control select-filter-a" onchange="$('.txt-filtro-a').val('').focus();clientes.search( '' ).columns().search( '' ).draw();saveSettings();">
                      <option value="0">Id</option>
                      <option value="1">Nombre</option>
                      <option value="2">Mac/Sn</option>
                      <option value="3">Movil</option>
                      <option value="4">Telefono</option>
                      <option value="14">Usuario</option>
                      <option value="16">Plan</option>
                      <option value="17">Poste</option>
                      <option value="9">Proximo pago</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-4 col-xs-6">
                  <div class="form-group input-group-sm">
                    <label>Buscar</label>
                    <input class="form-control txt-filtro-a" type="text" autocomplete="off" autofocus="" onkeyup="filtro_a($('.select-filter-a').val(),this.value)">
                  </div>
                </div>
                
                <div class="col-lg-4 col-xs-6">
                  <div class="form-group input-group-sm">
                    <label style="color:#FFFFFF; width:100%">Buscar</label>
                    <button class="btn btn-success  " onclick="$('.txt-filtro-a').val('');clientes.search( '' ).columns().search( '' ).draw();saveSettings();saveSettings();">Resetear Filtro</button>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
          <table id="list-usuarios" class="table-hover table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" data-order="[[ 1, &quot;asc&quot; ]]">
            <thead align="center">
              <tr>
                <th class="all" data-orderable="false" style=" padding-right:0px !important"><input type="checkbox" style="font-size: 19px;" class="allsuspendido" onclick="selectallactivos();"></th>
                
                <th>Id</th>
                <th class="all">Nombre</th>
                
                <th>Mac/Sn</th>
                <th>Movil</th>
                
                <th>Poste</th>
                <th>Servicio</th>
                <th>Usuario</th>
                <th>IP</th>
                <th>Nodo</th>
                <th>Plan</th>
                <th>Monto</th>
                <th>Prox. Pago</th>
                <th class="all" data-orderable="false" style="min-width:46px !important;max-width:46px !important">Acción</th>
                
                
              </tr>
            </thead>
          </table>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
          <table id="list-usuarios-s" class="table-hover table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" data-order="[[ 1, &quot;asc&quot; ]]">
            <thead align="center">
              <tr>
                <th class="all" data-orderable="false" style=" padding-right:0px !important"><input type="checkbox" style="font-size: 19px;" class="allactivo" onclick="selectallsuspendidos();"></th>
                <th>Id</th>
                <th class="all">Nombre</th>
                
                <th>Mac/Sn</th>
                <th>Movil</th>
                
                <th>Poste</th>
                 <th>Servicio</th>
                <th>Usuario</th>
                <th>Nodo</th>
                <th>Plan</th>
                <th>Monto</th>
                <th>Prox. Pago</th>
                <th class="all" data-orderable="false" style="min-width:46px !important;max-width:46px !important">Acción</th>
              </tr>
              </thead>
            </table>
          </div>
           <div class="tab-pane" id="tab_3">
          <table id="list-usuarios-p" class="table-hover table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" data-order="[[ 1, &quot;asc&quot; ]]">
            <thead align="center">
              <tr>
                <th class="all" data-orderable="false" style=" padding-right:0px !important"><input type="checkbox" style="font-size: 19px;" class="allactivo" onclick="selectallsuspendidos();"></th>
                <th>Id</th>
                <th class="all">Nombre</th>
                
                <th>Mac/Sn</th>
                <th>Movil</th>
                
                <th>Poste</th>
                 <th>Servicio</th>
                <th>Usuario</th>
                <th>Nodo</th>
                <th>Plan</th>
                <th>Monto</th>
                <th>Prox. Pago</th>
                <th class="all" data-orderable="false" style="min-width:46px !important;max-width:46px !important">Acción</th>
              </tr>
              </thead>
            </table>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="tab_4">
            <table id="list-usuarios-r" class="table-hover table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead align="center">
                <tr>
                  <th>Id</th>
                  <th class="all">Nombre</th>
                  
                  <th>Mac/Sn</th>
                  <th>Movil</th>
                  
                  <th>Poste</th>
                  <th>Usuario</th>
                  <th>Nodo</th>
                  <th>Plan</th>
                  <th>Monto</th>
                  <th>Prox. Pago</th>
                  <th class="all" data-orderable="false" style="min-width:46px !important;max-width:46px !important">Acción</th>
                </tr>
              </thead>
            </table>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- nav-tabs-custom -->
    </div>
</div>
</section>
</div>
<!-- ./wrapper -->
</div>
<?php include 'pie.php';
mysqli_close($con);
 ?>
 
<!-- jQuery 3 -->
    <script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <script src="../assets/plugins/jQueryUI/jquery-ui.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
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
    <script src="../js/bootstrap-toggle.min.js"></script>
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
  <script src="../js/push.min.js"></script>
  <script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
  <script src="../js/jquery.iframe-transport.js"></script>
  <script src="../js/jquery.uploadfile.min.js"></script>
  <script src="../js/tactil.js"></script>
  <script src="../js/jquery.webui-popover.min.js"></script>
  <script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
  <script src="../plugins/datepicker/locales/bootstrap-datepicker.es.min.js"></script>
  <script src="../js/raphael-min.js"></script>
  <script src="../plugins/morris/morris.min.js"></script>
  <script src="../plugins/input-mask/jquery.inputmask.js"></script>
  <script src="../plugins/input-mask/jquery.inputmask.extensions.js"></script>
  <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <script src="../plugins/ckeditor/ckeditor.js"></script>
  <!-- Select2 -->
  <script src="../bower_components/select2/dist/js/select2.full.min.js"></script>
  <!-- InputMask -->
  <script src="../plugins/input-mask/jquery.inputmask.js"></script>
  <script src="../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="../plugins/input-mask/jquery.inputmask.extensions.js"></script>
  <!-- date-range-picker -->
  <script src="../bower_components/moment/min/moment.min.js"></script>
  <script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- bootstrap datepicker -->
  <script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- bootstrap color picker -->
  <script src="../bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
  <!-- bootstrap time picker -->
  <script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
  <!-- iCheck 1.0.1 -->
  <script src="../plugins/iCheck/icheck.min.js"></script>
<script src="../assets/js/canvasjs.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
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
},15000);
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
	var fechafinal=$('input[name="fechafinal"]'); //our date input has the name "date"
var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
fechafinal.datepicker({
format: 'yyyy-mm-dd',
container: container,
todayHighlight: true,
autoclose: true,
})
var fechainicial=$('input[name="fechainicial"]'); //our date input has the name "date"
var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
fechainicial.datepicker({
format: 'yyyy-mm-dd',
container: container,
todayHighlight: true,
autoclose: true,
})
var fecha=$('input[name="fecha"]'); //our date input has the name "date"
var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
fecha.datepicker({
format: 'yyyy-mm-dd',
container: container,
todayHighlight: true,
autoclose: true,
})
//--->funciones
var updatelist;
var updatelist_s;
var updatelist_r;
var newuser;
var tblcol;
var infoperfil;
var clientes;
var clientes_s;
var clientes_r;
var clientes_p;
var newusermk;
var loadlist_r;
var loadlist_s,state_user,delete_user,utility_user;
function mostrar_npago(){
var pago = $("#tpago").val();
if (pago === "1") {
$('#cuota').attr("hidden", true);
}else{
$('#cuota').attr("hidden", false);
}
}
$(document).ready(function(){




$('#nodo').on('change',function(){
var nodo = $(this).val();
if(nodo){
$.ajax({
type:'POST',
url:'Ajax/ajaxData.php',
data:'id_mk='+nodo,
success:function(html){
$('#remoteaddress').html(html);
}
});
}else{
$('#remoteaddress').html('<option value="">Seleccione un nodo primero</option>');
}
});
});
eliminar_cliente=function(e,d){
var q= $("#q").val();
var id_session = $("#idsession").val();
if (id_session != 1){
msgbox("danger","No tienes permisos para eliminar clientes, Pongase en contacto con el administrador",3);
}
else{
swal({ title: "¿Esta seguro que desea Eliminar a este cliente ?",
text: "Al eliminar el cliente, será borrado del mikrotik y del sistema.",
type: "warning",
showCancelButton: true,
confirmButtonColor: "#DD6B55",
confirmButtonText: "Si, Eliminar!",
closeOnConfirm: true },
function(){
msgbox("loader","procesando...",0);
$.post( "Eliminar/eliminar.php", {id: e, action: 'clientesp' })
.done(function( datas ) {
$('.notydiv').remove();
msgbox("success","Cliente Eliminado correctamente",3);
if(d=="activo"){
updatelist();
}else if(d=="suspendido"){
updatelist_s();
}else{
updatelist_r();
}
});
});
}
}
retirar_cliente=function(e,d){
var q= $("#q").val();
var id_session = $("#idsession").val();
if (id_session != 1){
msgbox("danger","No tienes permisos para retirar clientes, Pongase en contacto con el administrador",3);
}
else{
swal({ title: "¿Esta seguro que desea retirar a este cliente ?",
text: "Al retirar el cliente, será borrado del mikrotik pero los datos se quedaran en el sistema.",
type: "warning",
showCancelButton: true,
confirmButtonColor: "#DD6B55",
confirmButtonText: "Si, Retirar!",
closeOnConfirm: true },
function(){
msgbox("loader","procesando...",0);
$.post( "Eliminar/retirar.php", {id: e, action: 'clientesp' })
.done(function( datas ) {
$('.notydiv').remove();
msgbox("success","Cliente retirado correctamente",3);
if(d=="activo"){
updatelist();
updatelist_r();
}else if(d=="suspendido"){
updatelist_s();
updatelist_r();
}
});
});
}
}
function maximo(){
if($("#mensaje").val().length>=160){
$('#mensaje').val($("#mensaje").val().substring(0,160));
}
$('.counter').html('Caracteres <b>'+$("#mensaje").val().length+'/160</b>');
}
$('.counter').html('Caracteres <b>'+$("#mensaje").val().length+'/160</b>');
function send_sms(id){
var nombre = $("#nombre"+id).val();
var cell = $("#cell"+id).val();
$("#cliente").val(nombre);
$("#numero").val(cell);
$("#idcli").val(id);
}
function mostrar(){
// var plan = $("#plan").val();
var fi = $("#fechainicial").val();
var ff = $("#fechafinal").val();
$("#plan option:selected").each(function () {
plan = $(this).val();
$.post("serverside/pagototal.php", { p: plan, fi: fi, ff: ff }, function(data){
document.getElementById("pago_total").value = data;
});
});
}
$( "#gdsms" ).submit(function( event ) {
$('#btnenviar').attr("disabled", true);
var parametros = $(this).serialize();
$.ajax({
type: "POST",
url: "./Ajax/crear/single_sms.php",
data: parametros,
beforeSend: function(objeto){
$('#resultados_ajax').html('<img src="../../../images/loader.gif"> Cargando...');
},
success: function(datos){
$("#resultados_ajax").html(datos);
$('#btnenviar').attr("disabled", false);
load();
}
});
event.preventDefault();
})
$( "#gduser" ).submit(function( event ) {
$('#btnsave').attr("disabled", true);
var parametros = $(this).serialize();
$.ajax({
type: "POST",
url: "./Ajax/crear/nuevo_cliente.php",
data: parametros,
beforeSend: function(objeto){
msgbox("loader","Guardando...",0);
},
success: function(datos){

$("#ajax").html(datos);
$('#btnsave').attr("disabled", false);

updatelist();

}
});
updatelist();
 
event.preventDefault();
})
resetform=function(){
$('#gduser')[0].reset();
}

$(function() {
clientes = $('#list-usuarios').DataTable( {
responsive: true,
"url": "Ajax/Spanish.json",
"ajax": 'Ajax/listaclientes.php?action=no',
"deferRender": true,
"stateSave": false,
"oLanguage": {
"sProcessing":     "Procesando...",
"sLengthMenu":     "Mostrar _MENU_ registros",
"sZeroRecords":    "No se encontraron resultados",
"sEmptyTable":     "Ningún dato disponible en esta tabla",
"sInfo":           "Mostrando registros del _START_ al _END_ de _TOTAL_ registros",
"sInfoEmpty":      "Mostrando registros del 0 al 0 de 0 registros",
"sInfoFiltered":   "(filtrado de _MAX_ registros)",
"sInfoPostFix":    "",
"sSearch":         "",
"sUrl":            "",
"sInfoThousands":  ",",
"sLoadingRecords": "Cargando...",
"oPaginate": {
"sFirst":    "Primero",
"sLast":     "Último",
"sNext":     "<i  class='fa fa-arrow-right'></i>",
"sPrevious": "<i class='fa fa-arrow-left'></i>",
},
"oAria": {
"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
"sSortDescending": ": Activar para ordenar la columna de manera descendente"
}
},
"aoColumns": [
{ mData: 'id','render': function (t) {
return '<input type="checkbox" style="font-size: 19px;" name="slactivo[]" value="'+t+'">';
} ,sClass: 'dt-center'},
{ mData: 'id',sType: 'numeric',"mRender": function (e) {
return '<a    href=perfil.php?id=' + e + '><i class="fa fa-edit"></i> '+e+'</a>';
}
},
{ mData: 'nomcli'},
{ mData: 'mac' },{ mData: 'cell' ,sType: 'text' },{ mData: 'poste' },{ mData: 'servicio' },
{ mData: 'usuario' },{ mData: 'remoteaddress' },{ mData: 'nodo' }, { mData: 'plan' },
{ mData: 'pago_total' }, { mData: 'fecha_final' },
{
"mData": null,
"bSortable": false,
"mRender": function (o) {
return  '<input type="hidden" value='+o.nomcli+' id=nombre'+o.id+'><input type="hidden" value='+o.cell+' id="cell'+o.id+'">'
+'<a class="btn btn-sm btn-default" title="Cobrar" id="btncobrar"  target=_blank  onclick=Cobrar(' + o.id + ',"'+o.fecha_final+'");><i class="fa fa-dollar"></i></a>'
+'<a class="btn btn-sm btn-default" title="Abonar factura" data-toggle="modal" data-target="#AbonarFac"  onclick=abonar_pago(' + o.id +');><i class="fa fa-font"></i></a>'

+ '<a class="btn btn-sm btn-default" title="Suspender el servicio" id="btnsuspender" name="btnsuspender"  href=#  onclick=Suspender(' + o.id + ');><i class="fa fa-times"></i></a>'
+ '<a class="btn btn-sm btn-default" id="btnanuncio" name="btnanuncio" title="enviar anuncio" href=#  onclick=Anuncio(' + o.id + ');><i class="fa fa-bullhorn"></i></a>'
+'<a class="btn btn-sm btn-default " title="Descargar factura" target="_blank"  href=Reportes/cobro.php?id=' + o.id + '><i class="fa fa-file-pdf-o"></i></a>'

+'<a class="btn btn-sm btn-default "  title="Historial de pago" data-toggle="modal" data-target="#HistorialP" onclick=ver_historial(' + o.id + ')><i class="fa fa-history"></i></a>'
+'<a class="btn btn-sm btn-default" id="btneliminar" name="btneliminar"  href=#  onclick=eliminar_cliente(' + o.id + ',"activo");><i class="fa fa-trash-o"></i></a>'
+'<a class="btn btn-sm btn-default" title="Retirar cliente" id="btnretirar" name="btnretirar" onclick=retirar_cliente(' + o.id + ',"activo");><i class="fa fa-user-times"></i></a>';
}
}
],
"dom": 'Bfrtip',
lengthMenu: [[20, 35, 50,100, -1], [ '20 Registros', '35 Registros', '50 Registros', '100 Registros', 'Mostrar todos' ] ],
buttons: ['pageLength','colvis',
{extend: 'collection', text: '<i class="fa fa-floppy-o"></i> <span class="caret"></span>',
buttons: [{extend: 'print', title:'Lista clientes activos', text: '<i class="fa fa-print"></i> Imprimir', },
{extend: 'csvHtml5', title:'Lista clientes activos', text: '<i class="fa fa-file-excel-o"></i> Exportar a EXCEL', },
{extend: 'pdfHtml5', title:'Lista clientes activos', text: '<i class="fa fa-file-pdf-o"></i> Exportar a PDF', } ] },
],
"fnDrawCallback": function( oSettings ) {
$('input.allsuspendido').prop('checked', false);
},
"initComplete": function() {
$('#list-usuarios_wrapper .dt-buttons').after('<div class="btn-group dt-btns"></div>' );
//-------->Boton refrescar
//-------->Button Nuevo
$('#list-usuarios_wrapper .dt-btns').append('<span><button type="button" data-toggle="modal" data-target="#newcliente" class="btn btn-default" style="margin-left: 10px;"><i class="fa fa-plus"></i> Nuevo Cliente</button></span>');
//------->SUPENDER MASIVO
$('#list-usuarios_wrapper .dt-btns').append('<button type="button" class="btn btn-default" onClick="suspendemasivo();"><i class="fa fa-exchange fa-rotate-90"></i> Suspender</button>');
//------->Anuncio masivo
$('#list-usuarios_wrapper .dt-btns').append('<button type="button" class="btn btn-default" onClick="anunciomasivo();"><i class="fa fa-bullhorn"></i> Enviar anuncio</button>');
//-------->Filtro avanzado
$('#list-usuarios_wrapper .dt-btns').append('<button type="button" class="btn   btn-default" data-toggle="collapse" href="#collapseactivo" aria-expanded="false" aria-controls="ccollapseactivo" onclick="clientes.search( \'\' ).columns().search( \'\' ).draw();saveSettings();"><i class="fa fa-search"></i> Filtro</button>');
},
} );
} );
//  LIST-USUARIOS SUSPENDIDOS
loadlist_s=function(){
if ( ! $.fn.DataTable.isDataTable( '#list-usuarios-s' ) ) {
clientes_s = $('#list-usuarios-s').DataTable( {
responsive: true,
"language": {
"url": "Ajax/Spanish.json"
},
"ajax": "Ajax/listaclientes.php?action=yes",
"deferRender": true,
"stateSave": true,
"oLanguage": {
"sProcessing":     "Procesando...",
"sLengthMenu":     "Mostrar _MENU_ registros",
"sZeroRecords":    "No se encontraron resultados",
"sEmptyTable":     "Ningún dato disponible en esta tabla",
"sInfo":           "Mostrando registros del _START_ al _END_ de _TOTAL_ registros",
"sInfoEmpty":      "Mostrando registros del 0 al 0 de 0 registros",
"sInfoFiltered":   "(filtrado de _MAX_ registros)",
"sInfoPostFix":    "",
"sSearch":         "",
"sUrl":            "",
"sInfoThousands":  ",",
"sLoadingRecords": "Cargando...",
"oPaginate": {
"sFirst":    "Primero",
"sLast":     "Último",
"sNext":     ">>",
"sPrevious": "<<"
},
"oAria": {
"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
"sSortDescending": ": Activar para ordenar la columna de manera descendente"
}
},
"aoColumns": [
{ mData: 'id','render': function (t) {
return '<input type="checkbox" style="font-size: 19px;" name="slsuspendido[]" value="'+t+'">';
} ,sClass: 'dt-center'},
{ mData: 'id',sType: 'numeric',"mRender": function (e) {
return '<a    href=perfil.php?id=' + e + '><i class="fa fa-edit"></i> '+e+'</a>';
}
},
{ mData: 'nomcli'},
{ mData: 'mac' },{ mData: 'cell' },{ mData: 'poste' },{ mData: 'servicio' },
{ mData: 'usuario' },{ mData: 'nodo' }, { mData: 'plan' },
{ mData: 'pago_total' }, { mData: 'fecha_final' },
{
"mData": null,
"bSortable": false,
"mRender": function (o) {
return '<input type="hidden" value='+o.nomcli+' id=nombre'+o.id+'><input type="hidden" value='+o.cell+' id="cell'+o.id+'">'
+'<a class="btn btn-sm btn-default" title="Cobrar" id="btncobrar"  target=_blank  onclick=Cobrar(' + o.id + ',"'+o.fecha_final+'");><i class="fa fa-dollar"></i></a>'
+'<a class="btn btn-sm btn-default" title="Abonar factura" data-toggle="modal" data-target="#AbonarFac"  onclick=abonar_pago(' + o.id +');><i class="fa fa-font"></i></a>'
+ '<a class="btn btn-sm btn-default" id="btnsuspender" name="btnsuspender"  href=#  onclick=Activar(' + o.id + ',"suspendido");><i class="fa fa-check-square-o"></i></a>'
+'<a class="btn btn-sm btn-default "  title="Descargar factura" target="_blank"  href=Reportes/cobro.php?id=' + o.id + '><i class="fa fa-file-pdf-o"></i></a>'
+'<a class="btn btn-sm btn-default "  title="Historial de pago" data-toggle="modal" data-target="#HistorialP" onclick=ver_historial(' + o.id + ')><i class="fa fa-history"></i></a>'
+'<a class="btn btn-sm btn-default" id="btneliminar" name="btneliminar"  href=#  onclick=eliminar_cliente(' + o.id + ',"suspendido");><i class="fa fa-trash-o"></i></a>'
+'<a class="btn btn-sm btn-default" title="Retirar cliente" id="btnretirar" name="btnretirar" onclick=retirar_cliente(' + o.id + ',"suspendido");><i class="fa fa-user-times"></i></a>';
}
}
],
"dom": 'Bfrtip',
lengthMenu: [[20, 35, 50,100, -1], [ '20 Registros', '35 Registros', '50 Registros', '100 Registros', 'Mostrar todos' ] ],
buttons: ['pageLength','colvis',
{extend: 'collection', text: '<i class="fa fa-floppy-o"></i> <span class="caret"></span>',
buttons: [{extend: 'print', title:'Lista de los clientes suspendidos', text: '<i class="fa fa-print"></i> Imprimir', },
{extend: 'csvHtml5', title:'Lista clientes activos', text: '<i class="fa fa-file-excel-o"></i> Exportar a EXCEL', },
{extend: 'pdfHtml5', title:'Lista clientes activos', text: '<i class="fa fa-file-pdf-o"></i> Exportar a PDF', } ] },
],
"fnDrawCallback": function( oSettings ) {
$('input.allactivo').prop('checked', false);
},
"initComplete": function() {
$('#list-usuarios-s_wrapper .dt-buttons').after('<div class="btn-group dt-btns"></div>' );
//-------->Boton refrescar
//-------->Button Nuevo
$('#list-usuarios-s_wrapper .dt-btns').append('<span><button type="button" data-toggle="modal" data-target="#newcliente" class="btn btn-default" style="margin-left: 10px;"><i class="fa fa-plus"></i> Nuevo Cliente</button></span>');
//------->Activar MASIVO
$('#list-usuarios-s_wrapper .dt-btns').append('<button type="button" class="btn btn-default" onClick="activamasivo();"><i class="fa fa-exchange fa-rotate-90"></i> Activar</button>');
//-------->Filtro avanzado
},
} );
}
}
// LIST USUARIOS Pendientes de pago
loadlist_p=function(){
if ( ! $.fn.DataTable.isDataTable( '#list-usuarios-p' ) ) {
clientes_p = $('#list-usuarios-p').DataTable( {
responsive: true,
"language": {
"url": "Ajax/Spanish.json"
},
"ajax": "Ajax/listapendientespago.php",
"deferRender": true,
"stateSave": true,
"oLanguage": {
"sProcessing":     "Procesando...",
"sLengthMenu":     "Mostrar _MENU_ registros",
"sZeroRecords":    "No se encontraron resultados",
"sEmptyTable":     "Ningún dato disponible en esta tabla",
"sInfo":           "Mostrando registros del _START_ al _END_ de _TOTAL_ registros",
"sInfoEmpty":      "Mostrando registros del 0 al 0 de 0 registros",
"sInfoFiltered":   "(filtrado de _MAX_ registros)",
"sInfoPostFix":    "",
"sSearch":         "",
"sUrl":            "",
"sInfoThousands":  ",",
"sLoadingRecords": "Cargando...",
"oPaginate": {
"sFirst":    "Primero",
"sLast":     "Último",
"sNext":     ">>",
"sPrevious": "<<"
},
"oAria": {
"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
"sSortDescending": ": Activar para ordenar la columna de manera descendente"
}
},
"aoColumns": [
{ mData: 'id','render': function (t) {
return '<input type="checkbox" style="font-size: 19px;" name="slsuspendido[]" value="'+t+'">';
} ,sClass: 'dt-center'},
{ mData: 'id',sType: 'numeric',"mRender": function (e) {
return '<a    href=perfil.php?id=' + e + '><i class="fa fa-edit"></i> '+e+'</a>';
}
},
{ mData: 'nomcli'},
{ mData: 'mac' },{ mData: 'cell' },{ mData: 'poste' },{ mData: 'servicio' },
{ mData: 'usuario' },{ mData: 'nodo' }, { mData: 'plan' },
{ mData: 'pago_total' }, { mData: 'fecha_final' },
{
"mData": null,
"bSortable": false,
"mRender": function (o) {
return '<input type="hidden" value='+o.nomcli+' id=nombre'+o.id+'><input type="hidden" value='+o.cell+' id="cell'+o.id+'">'
+'<a class="btn btn-sm btn-default" title="Cobrar" id="btncobrar"  target=_blank  onclick=Cobrar(' + o.id + ',"'+o.fecha_final+'");><i class="fa fa-dollar"></i></a>'
+ '<a class="btn btn-sm btn-default" id="btnsuspender" name="btnsuspender"  href=#  onclick=Activar(' + o.id + ',"suspendido");><i class="fa fa-check-square-o"></i></a>'
+'<a class="btn btn-sm btn-default "  title="Descargar factura" target="_blank"  href=Reportes/cobro.php?id=' + o.id + '><i class="fa fa-file-pdf-o"></i></a>'
+'<a class="btn btn-sm btn-default "  title="Historial de pago" data-toggle="modal" data-target="#HistorialP" onclick=ver_historial(' + o.id + ')><i class="fa fa-history"></i></a>'
+'<a class="btn btn-sm btn-default" id="btneliminar" name="btneliminar"  href=#  onclick=eliminar_cliente(' + o.id + ',"suspendido");><i class="fa fa-trash-o"></i></a>'
+'<a class="btn btn-sm btn-default" title="Retirar cliente" id="btnretirar" name="btnretirar" onclick=retirar_cliente(' + o.id + ',"suspendido");><i class="fa fa-user-times"></i></a>';
}
}
],
"dom": 'Bfrtip',
lengthMenu: [[20, 35, 50,100, -1], [ '20 Registros', '35 Registros', '50 Registros', '100 Registros', 'Mostrar todos' ] ],
buttons: ['pageLength','colvis',
{extend: 'collection', text: '<i class="fa fa-floppy-o"></i> <span class="caret"></span>',
buttons: [{extend: 'print', title:'Lista de los clientes suspendidos', text: '<i class="fa fa-print"></i> Imprimir', },
{extend: 'csvHtml5', title:'Lista clientes activos', text: '<i class="fa fa-file-excel-o"></i> Exportar a EXCEL', },
{extend: 'pdfHtml5', title:'Lista clientes activos', text: '<i class="fa fa-file-pdf-o"></i> Exportar a PDF', } ] },
],
"fnDrawCallback": function( oSettings ) {
$('input.allactivo').prop('checked', false);
},
"initComplete": function() {
$('#list-usuarios-p_wrapper .dt-buttons').after('<div class="btn-group dt-btns"></div>' );
//-------->Boton refrescar
//-------->Button Nuevo
$('#list-usuarios-p_wrapper .dt-btns').append('<span><button type="button" data-toggle="modal" data-target="#newcliente" class="btn btn-default" style="margin-left: 10px;"><i class="fa fa-plus"></i> Nuevo Cliente</button></span>');
//------->Activar MASIVO
$('#list-usuarios-p_wrapper .dt-btns').append('<button type="button" class="btn btn-default" onClick="activamasivo();"><i class="fa fa-exchange fa-rotate-90"></i> Activar</button>');
//-------->Filtro avanzado
},
} );
}
}
// LIST USUARIOS RETIRADOS
loadlist_r=function(){
if ( ! $.fn.DataTable.isDataTable( '#list-usuarios-r' ) ) {
clientes_r = $('#list-usuarios-r').DataTable( {
responsive: true,
"language": {
"url": "Ajax/Spanish.json"
},
"ajax": "Ajax/listaclientes.php?action=retirado",
"deferRender": true,
"stateSave": true,
"oLanguage": {
"sProcessing":     "Procesando...",
"sLengthMenu":     "Mostrar _MENU_ registros",
"sZeroRecords":    "No se encontraron resultados",
"sEmptyTable":     "Ningún dato disponible en esta tabla",
"sInfo":           "Mostrando registros del _START_ al _END_ de _TOTAL_ registros",
"sInfoEmpty":      "Mostrando registros del 0 al 0 de 0 registros",
"sInfoFiltered":   "(filtrado de _MAX_ registros)",
"sInfoPostFix":    "",
"sSearch":         "",
"sUrl":            "",
"sInfoThousands":  ",",
"sLoadingRecords": "Cargando...",
"oPaginate": {
"sFirst":    "Primero",
"sLast":     "Último",
"sNext":     ">>",
"sPrevious": "<<"
},
"oAria": {
"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
"sSortDescending": ": Activar para ordenar la columna de manera descendente"
}
},
"aoColumns": [
{ mData: 'id',sType: 'numeric',"mRender": function (e) {
return '<a    href=perfil.php?id=' + e + '><i class="fa fa-edit"></i> ' +e+'</a>';
}
},
{ mData: 'nomcli'},
{ mData: 'mac' },{ mData: 'cell' },{ mData: 'poste' },
{ mData: 'usuario' },{ mData: 'nodo' }, { mData: 'plan' },
{ mData: 'pago_total' }, { mData: 'fecha_final' },
{
"mData": null,
"bSortable": false,
"mRender": function (o) {
return '<input type="hidden" value='+o.nomcli+' id=nombre'+o.id+'><input type="hidden" value='+o.cell+' id="cell'+o.id+'">'
+'<a class="btn btn-sm btn-default" title="Activar de nuevo" id="btnact" name="btnact"  href=#  onclick=Activar(' + o.id + ',"retirado");><i class="fa fa-check-square-o"></i></a>'
+'<a class="btn btn-sm btn-default "  title="Historial de pago" data-toggle="modal" data-target="#HistorialP" onclick=ver_historial(' + o.id + ')><i class="fa fa-history"></i></a>'
+'<a class="btn btn-sm btn-default" id="btneliminar" name="btneliminar"  href=#  onclick=eliminar_cliente(' + o.id + ');><i class="fa fa-trash-o"></i></a>'
}
}
],
"dom": 'Bfrtip',
lengthMenu: [[20, 35, 50,100, -1], [ '20 Registros', '35 Registros', '50 Registros', '100 Registros', 'Mostrar todos' ] ],
buttons: ['pageLength','colvis',
{extend: 'collection', text: '<i class="fa fa-floppy-o"></i> <span class="caret"></span>',
buttons: [{extend: 'print', title:'Lista de los clientes retirados', text: '<i class="fa fa-print"></i> Imprimir', },
{extend: 'csvHtml5', title:'Lista clientes activos', text: '<i class="fa fa-file-excel-o"></i> Exportar a EXCEL', },
{extend: 'pdfHtml5', title:'Lista clientes activos', text: '<i class="fa fa-file-pdf-o"></i> Exportar a PDF', } ] },
],
} );
}
}
updatelist=function(){
clientes.ajax.reload();
}
updatelist_s=function(){
clientes_s.ajax.reload();
}
updatelist_r=function(){
clientes_r.ajax.reload();
}
function selectallactivos(){
if ($('input.allsuspendido').is(':checked')) {
$('input[name^="slactivo"]').each(function() {
$(this).prop('checked', true);
});
}else{
$('input[name^="slactivo"]').each(function() {
$(this).prop('checked', false);
});
}
}
function selectallsuspendidos(){
if ($('input.allactivo').is(':checked')) {
$('input[name^="slsuspendido"]').each(function() {
$(this).prop('checked', true);
});
}else{
$('input[name^="slsuspendido"]').each(function() {
$(this).prop('checked', false);
});
}
}
function filtro_a(columna,texto) {
if(texto==""){
clientes.search( '' ).columns().search( '' ).draw();
}else{
columna=parseInt(columna) + 1;
data.columns(columna).search(texto).draw();
}
saveSettings();
}
function Suspender(id)
{
  var q= $("#pmact").val();

if (q != 1){
msgbox("danger","No tienes permisos para suspender clientes, Pongase en contacto con el administrador",3);
}
else{
swal({ title: "¿Esta seguro que desea Suspender a este cliente ?",
text: "Al suspender el cliente no podrá navegar.",
type: "warning",
showCancelButton: true,
confirmButtonColor: "#DD6B55",
confirmButtonText: "Si, Suspender!",
closeOnConfirm: true },
function(){
msgbox("loader","procesando...",0);
$.post( "Ajax/suspender.php", { id: id })
.done(function( datas ) {
$('.notydiv').remove();
msgbox("success","Cliente Suspendido correctamente",3);
updatelist();
updatelist_s();
});
});
}
}
function Anuncio(id)
{
swal({ title: "¿Esta seguro que desea Enviar el anuncio de pago a este cliente ?",
text: "Al enviar el anuncio a este cliente podrá navegar.",
type: "warning",
showCancelButton: true,
confirmButtonColor: "#DD6B55",
confirmButtonText: "Si, Enviar anuncio!",
closeOnConfirm: true },
function(){
msgbox("loader","procesando...",0);
$.post( "Ajax/anuncio.php", { id: id })
.done(function( datas ) {
$('.notydiv').remove();
msgbox("success","Anuncio enviado correctamente",3);
updatelist();
updatelist_s();
});
});
}
function suspendemasivo()
{
	  var q= $("#pmact").val();

if (q != 1){
msgbox("danger","No tienes permisos para suspender clientes, Pongase en contacto con el administrador",3);
}
else{
var idssupender = [];
$('input[name^="slactivo"]:checked').each(function() {
var val = $(this).val();
idssupender.push(val);
});
var jObject={};
for(i in idssupender)
{
jObject[i] = idssupender[i];
}
jObject= JSON.stringify(jObject);
swal({ title: "¿Esta seguro que desea Suspender "+$('input[name^="slactivo"]:checked').length+" clientes seleccionados ?",
text: "Al suspender, estos clientes no podrán navegar.",
type: "warning",
showCancelButton: true,
confirmButtonColor: "#DD6B55",
confirmButtonText: "Si, Suspender!",
closeOnConfirm: true },
function(){
msgbox("loader","procesando...",0);
$.post( "Ajax/suspendermasivo.php", { jObject:  jObject })
.done(function( datas ) {
$('.notydiv').remove();
msgbox("success","Clientes Suspendidos correctamente",3);
updatelist();
updatelist_s();
});
});
}
}
function anunciomasivo()
{
var idssupender = [];
$('input[name^="slactivo"]:checked').each(function() {
var val = $(this).val();
idssupender.push(val);
});
var jObject={};
for(i in idssupender)
{
jObject[i] = idssupender[i];
}
jObject= JSON.stringify(jObject);
swal({ title: "¿Esta seguro que desea enviar anuncio de pago a estos "+$('input[name^="slactivo"]:checked').length+" clientes seleccionados ?",
text: "Al enviar el anuncio, estos clientes podrán navegar.",
type: "warning",
showCancelButton: true,
confirmButtonColor: "#DD6B55",
confirmButtonText: "Si, Enviar anuncio!",
closeOnConfirm: true },
function(){
msgbox("loader","procesando...",0);
$.post( "Ajax/anunciomasivo.php", { jObject:  jObject })
.done(function( datas ) {
$('.notydiv').remove();
msgbox("success","Anuncio enviado correctamente",3);
updatelist();
updatelist_s();
});
});
}
function activamasivo()
{
	 var q= $("#pmact").val();
	 if (q != 1){
msgbox("danger","No tienes permisos para activar clientes, Pongase en contacto con el administrador",3);
}
else{
var ids = [];
$('input[name^="slsuspendido"]:checked').each(function() {
var val = $(this).val();
ids.push(val);
});
var jObject={};
for(i in ids)
{
jObject[i] = ids[i];
}
jObject= JSON.stringify(jObject);
swal({ title: "¿Esta seguro que desea activar "+$('input[name^="slsuspendido"]:checked').length+" clientes seleccionados ?",
text: "Activar clientes.",
type: "warning",
showCancelButton: true,
confirmButtonColor: "#DD6B55",
confirmButtonText: "Si, Activar!",
closeOnConfirm: true },
function(){
msgbox("loader","procesando...",0);
$.post( "Ajax/activarmasivo.php", { jObject:  jObject })
.done(function( datas ) {
$('.notydiv').remove();
msgbox("success","Clientes activados correctamente",3);
updatelist();
updatelist_s();
});
});
}
}
function Activar(id,d)
{
 var q= $("#pmact").val();

if (q != 1){
msgbox("danger","No tienes permisos para activar clientes, Pongase en contacto con el administrador",3);
}
else{
swal({ title: "¿Esta seguro que desea  activar a este cliente ?",
type: "warning",
showCancelButton: true,
confirmButtonColor: "#DD6B55",
confirmButtonText: "Si, Activar!",
closeOnConfirm: true },
function(){
msgbox("loader","procesando...",0);
$.post( "Ajax/activar.php", { id: id })
.done(function( datas ) {
$('.notydiv').remove();
msgbox("success","El cliente ha sido activado correctamente",3);
if(d=="suspendido"){
updatelist_s();
updatelist();
}else if(d=="retirado"){
updatelist_r();
updatelist();
}
updatelist_r();
updatelist();
});
});
}
}
function Cobrar(id,f)
{

swal({ title: "¿Esta seguro que desea  cobrar a este cliente ?",
type: "warning",
showCancelButton: true,
confirmButtonColor: "#DD6B55",
confirmButtonText: "Si, Cobrar!",
closeOnConfirm: true },
function(){
  window.open("Reportes/factura.php?id="+id+"&ff="+f , "ventana1" , "width=800,height=700,scrollbars=yes");
msgbox("loader","procesando...",0);
$.post( "Ajax/insertar_factura.php", { id: id })
.done(function( datas ) {


$('.notydiv').remove();
msgbox("success","El pago ha sido ingresado correctamente",3);

updatelist();
});
});
}
function filtro_a(columna,texto) {
if(texto==""){
clientes.search( '' ).columns().search( '' ).draw();
}else{
columna=parseInt(columna) + 1;
clientes.columns(columna).search(texto).draw();
}
saveSettings();
}
function loadSettings() {
$('.select-filter-a option[value="' + localStorage.columna + '"]').prop('selected',true);
$('.txt-filtro-a').val(localStorage.caja);
}
function saveSettings() {
localStorage.columna = $('.select-filter-a').val();
localStorage.caja = $('.txt-filtro-a').val();
}
  function ver_historial(id) {
            $('#btnImprimir').attr("disabled", true);

      $.ajax({

                type: "POST",
                url: "./Ajax/historial.php",
                data: {id: id},
                beforeSend: function(objeto){
                    $("#resultados_ajax3").html("Mensaje: Cargando...");
                },
                success: function(datos){
                    $("#resultados_ajax3").html(datos);
                    $('#btnImprimir').attr("disabled", false);

                }



      });


        }
         function abonar_pago(id) {
            $('#btnImprimir').attr("disabled", true);

      $.ajax({

                type: "POST",
                url: "./Ajax/abonarfactura.php",
                data: {id: id},
                beforeSend: function(objeto){
                    $("#resultados_ajax4").html("Mensaje: Cargando...");
                },
                success: function(datos){
                    $("#resultados_ajax4").html(datos);
                    $('#btnImprimir').attr("disabled", false);


                }



      });


        }
                  $( "#abono" ).submit(function( event ) {
$('#gd-abono').attr("disabled", true);
var parametros = $(this).serialize();
var id = $("#idf").val();
var ff = $("#ff").val();
var mc = $("#montoc").val();
var mr = $("#montor").val();

$.ajax({
type: "POST",
url: "./Ajax/insertar_abono.php",
data: parametros,
beforeSend: function(objeto){
msgbox("loader","Guardando abno...",0);
},
success: function(datos){
msgbox("success","El pago ha sido ingresado correctamente",3);



$('#gd-abono').attr("disabled", false);

$('#AbonarFac').modal('toggle'); 
$('.notydiv').remove();

updatelist();
window.open("Reportes/facturaabono.php?id="+id+"&ff="+ff+"&mc="+mc , "ventana1" , "width=800,height=700,scrollbars=yes");

}
});
updatelist();
 
event.preventDefault();

})


</script>