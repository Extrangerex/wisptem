<?php
session_start();
include '../config/db.php';
include 'is_logged.php';

include ("Modal/md_usuario.php");
include ("Modal/md_editusuario.php");

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
    <!-- jvectormap -->
    <link rel="stylesheet" href="../bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../dist/css/ji.css">
    <link rel="stylesheet" href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css">
    <link rel="stylesheet" href="../plugins/datatables/extensions/Buttons/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="../plugins/datatables/extensions/Buttons/css/buttons.bootstrap.min.css">
    <link rel="stylesheet" href="../bower_components/morris.js/morris.css">
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    
    <link rel="stylesheet" href="../css/animate.css">
      <link rel="stylesheet" href="../css/bootstrap-toggle.min.css">
    <link rel="stylesheet" href="../css/tabdrop.css">
    <link rel="stylesheet" href="../css/switchery.min.css">
    <link rel="stylesheet" href="../css/sweetalert.css">
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="../css/uploadfile.css">
    <link rel="stylesheet" href="../css/query.webui-popover.min.css">
    <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
 
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="../bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css">
    
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

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
            <li >
              <a href="../pages/admin.php">
                <i class="fa fa-dashboard"></i> <span>Inicio</span>
              </a>
            </li>

            <li class="treeview active" style="display:<?php echo $display; ?>">
              <a href="#">
                <i class="fa fa-briefcase"></i>
                <span >Sistema</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                
                <li><a href="../pages/mikrotik.php"><i class="fa fa-sitemap"></i> <span>Routers Mikrotik</span></a></li>
                <li><a href="../pages/planes.php"><i class="fa fa-bars"></i> <span >Planes Internet</span></a></li>
                <li class="active"><a href="../pages/usuarios.php"><i class="fa fa-users"></i> <span>Gestión de personal</span></a></li>
              </ul>
            </li>
             </li>
             
            
            <li class="treeview">
              <a href="#"><i class="fa fa-user"></i> <span>Clientes</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="../pages/clientes.php"><i class="fa fa-user-plus"></i> <span>Clientes</span></a></li>
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
        <li class="active">Empleados</li>
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
         
          <div class="panel box box-primary">
           <div class="box-header with-border">
            <strong class="box-title "><i class="fa fa-users"></i> Gestion de Personales</strong>
          </div>
          <div class="box-body">
            
            
            
            <div id="loader"></div>
            <div class="box-body" >
              <div class="usuario" ></div>
            </div>
            
            
            
            
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
},1000);
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
$(document).ready(function(){
load();

});
function load(page){
$("#loader").fadeIn('slow');
$.ajax({
url:'./Ajax/buscar/buscar_usuario.php',
beforeSend: function(objeto){
$('#loader').html('<img src="../../images/ajax-loader.gif"> Cargando...');
},
success:function(data){
$(".usuario").html(data).fadeIn('slow');
$('#loader').html('');
}
})
}

eliminar_usuario=function(e){
swal({
title: "Estas seguro?",
text: "Si elimina un Usuario con instalaciones vinculadas va perder las facturas,los cobros,etc que están asociados a este usuario!",
type: "warning",
showCancelButton: true,
confirmButtonColor: "#DD6B55",
confirmButtonText: "Si, Eliminar!",
closeOnConfirm: true },
function(){
msgbox("loader","procesando...",0);
$.post( "Ajax/buscar/buscar_usuario.php", {id: e})
.done(function( datas ) {
$('.notydiv').remove();
msgbox("success","El usuario ha sido eliminado correctamente",3);
load();
});
});
}


function obtener_datos(id){

var nombre = $("#nombre"+id).val();
var apellido = $("#apellido"+id).val();
var cargo = $("#cargo"+id).val();
var cel = $("#cel"+id).val();
var usuario = $("#usuario"+id).val();
var correo = $("#correo"+id).val();
var niv = $("#niv"+id).val();
var est = $("#est"+id).val();
var chk_act = $("#chk_act"+id).val();
var chk_fec = $("#chk_fec"+id).val();
var chk_plan = $("#chk_plan"+id).val();
var chk_mac = $("#chk_mac"+id).val();




$("#mod_nombre").val(nombre);

$("#mod_apellido").val(apellido);
$("#mod_cargo").val(cargo);
$("#mod_usuario").val(usuario);

$("#mod_correo").val(correo);
$("#mod_cell").val(cel);
$("#mod_nivel").val(niv);

$("#mod_estado").val(est);
$("#mchk_act").prop('checked',chk_act );

$("#mchk_fec").prop('checked',chk_fec );

$("#mchk_plan").prop('checked',chk_plan );



$("#mchk_mac").prop('checked',chk_mac );
  




$("#mod_id").val(id);

}

</script>