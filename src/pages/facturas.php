<?php
session_start();
include '../config/db.php';
include 'is_logged.php';

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
 if ($nivel == 1) {

$display = "yes";
} else {

$display= "none";
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

include("Modal/facturasxsector.php");
include("Modal/Cuadrediario.php");
include("Modal/Cuadremensual.php");
include("Modal/CuadrediarioCobrador.php");
include("Modal/CuadremensualCobrador.php");
include("Modal/CuadrediaroBanco.php");
include("Modal/CuadremensualBanco.php");
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
             
            
            <li class="treeview">
              <a href="#"><i class="fa fa-user"></i> <span>Clientes</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="../pages/clientes.php"><i class="fa fa-user-plus"></i> <span>Clientes</span></a></li>
                <li><a href="../pages/activeconnections.php"><i class="fa fa-user-plus"></i> <span>Active Connections</span></a></li>
               
            
                
              </ul>
           
            <li class="treeview active">
              <a href="#"><i class="fa fa-usd"></i> <span>Facturación</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                
                <li><a href="../pages/pagos.php"><i class="fa fa-credit-card"></i> <span>Registrar pagos</span></a></li>
                <li class="active"><a href="../pages/facturas.php"><i class="fa fa-file-pdf-o"></i> <span>Facturas</span></a></li>
               
                
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
        <li class="active">Facturas</li>
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
         
      
     <div class="box box-default">
            
            <div class="panel box box-primary" >
              <div class="box-header with-border">
                <strong class="box-title "><i class="fa fa-list"></i> Facturas</strong>
              </div>
            </div>
            
            <div class="box-body"  >
              <div class="box-body">
                <button type="button" class=" btn-default" data-toggle="modal" data-target="#FactXsector">
                <span class="fa fa-print"></span> Factura Por Sector
                </button>
                <button type="button" class=" btn-default" data-toggle="modal" data-target="#CuadreDiario">
                <span class="fa fa-print"></span> Cuadre Diario
                </button>
                <button type="button" class=" btn-default" data-toggle="modal" data-target="#CuadreMensual">
                <span class="fa fa-print"></span> Cuadre Mensual
                </button>
                <button type="button" class=" btn-default" data-toggle="modal" data-target="#CuadreDiarioC">
                <span class="fa fa-print"></span> Cuadre Diario X Cobrador
                </button>
                <button type="button" class=" btn-default" data-toggle="modal" data-target="#CuadreMensualC">
                <span class="fa fa-print"></span> Cuadre Mensual X Cobrador
                </button>
                <button type="button" class=" btn-default" data-toggle="modal" data-target="#CuadreDiarioB">
                <span class="fa fa-print"></span> Cuadre Diario x Banco
                </button>
                
                <button type="button" class=" btn-default" data-toggle="modal" data-target="#CuadreMensualB">
                <span class="fa fa-print"></span> Cuadre Mensual x Banco
                </button>
              </div>
              
              <table id="list-facturas" class="table-hover table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" data-order="[[ 1, &quot;asc&quot; ]]">
                <thead>
                  <tr>
                    
                    <th>NO FACTURA</th>
                    <th>FECHA </th>
                    <th>ID CLIENTE</th>
                    <th>NOMBRE</th>
                    <th>PAGO</th>
                    <th>COBRADOR</th>
                    
                    
                    <th class="all" data-orderable="false" style="min-width:46px !important;max-width:46px !important">Acción</th>
                    
                    
                  </tr>
                </thead>
              </table>
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
    var fecha=$('input[name="fecha"]'); //our date input has the name "date"
var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
fecha.datepicker({
format: 'yyyy-mm-dd',
container: container,
todayHighlight: true,
autoclose: true,
})
var fi=$('input[name="fi"]'); //our date input has the name "date"
var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
fi.datepicker({
format: 'yyyy-mm-dd',
container: container,
todayHighlight: true,
autoclose: true,
})
var ff=$('input[name="ff"]'); //our date input has the name "date"
var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
ff.datepicker({
format: 'yyyy-mm-dd',
container: container,
todayHighlight: true,
autoclose: true,
})
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
        $(function() {
        facturas = $('#list-facturas').DataTable( {
        responsive: true,
        "language": {
        "url": "Ajax/Spanish.json"
        },
        "ajax": "Ajax/listafacturas.php",
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
        
        { mData: 'numero_factura'},{ mData: 'fecha_factura'},{ mData: 'id_cliente'},
        { mData: 'nombrecli' },{ mData: 'total_venta' }, { data: 'nombrecobrador' },
        {
        "mData": null,
        "bSortable": false,
        "mRender": function (o) {
        return '<a class="btn btn-sm btn-default " target="_blank"  href=Reportes/factura2.php?id=' + o.id_cliente + '&nf=' + o.numero_factura + '&ff=' + o.fecha_factura + '><i class="fa fa-download"></i></a>'
       
        +'<a class="btn btn-sm btn-default" id="btneliminar" name="btneliminar"  href=#  onclick=eliminar_factura(' + o.numero_factura + ','+ o.id_cliente + ');><i class="fa fa-trash-o"></i></a>';
        }
        }
        ],
        
        "dom": 'Bfrtip',
        lengthMenu: [[20, 35, 50,100, -1], [ '20 Registros', '35 Registros', '50 Registros', '100 Registros', 'Mostrar todos' ] ],
        buttons: ['pageLength','colvis',
        {extend: 'collection', text: '<i class="fa fa-floppy-o"></i> <span class="caret"></span>',
        buttons: [{extend: 'print', title:'Lista facturas', text: '<i class="fa fa-print"></i> Imprimir', },
        {extend: 'csvHtml5', title:'Lista facturas', text: '<i class="fa fa-file-excel-o"></i> Exportar a EXCEL', },
        {extend: 'pdfHtml5', title:'Lista facturas', text: '<i class="fa fa-file-pdf-o"></i> Exportar a PDF', } ] },
        ],
        "fnDrawCallback": function( oSettings ) {
        $('input.allfacturas').prop('checked', false);
        },
        "initComplete": function() {
        $('#list-facturas_wrapper .dt-buttons').after('<div class="btn-group dt-btns"></div>' );
        //-------->Boton refrescar
        
        
       
     
        
        },
        
        } );
        
        } );
            eliminar_factura=function(e,d){
               var q= $("#q").val();
               var id_session = $("#idsession").val();
                 if (id_session != 1){

                  msgbox("danger","No tienes permisos para eliminar facturas, Pongase en contacto con el administrador",3);

                 }
                 else{


                swal({ title: "¿Esta seguro que desea Eliminar esta factura ?",
                text: "No olvide de restablecer la fecha de pago al mes anterior.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si, Eliminar!",
                closeOnConfirm: true },
                function(){
                msgbox("loader","procesando...",0);
                $.post( "Eliminar/eliminar_facturas.php", {idf: e, idc:d})
                .done(function( datas ) {
                $('.notydiv').remove();
                msgbox("success","Fctura Eliminada correctamente",3);
               
                updatelist();
              
                
                });
                });
                }
            }
        
  
         updatelist=function(){
            facturas.ajax.reload();
            
            }
        
        </script>