<?php
session_start();
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
include '../config/db.php';
include 'is_logged.php';
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
$fsesion=$row['fecha_sesion'];
$idusu=$row['user_id'];

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
    <link rel="stylesheet" href="../css/tabdrop.css">
    <link rel="stylesheet" href="../css/switchery.min.css">
    <link rel="stylesheet" href="../css/sweetalert.css">
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
   
    <link rel="stylesheet" href="../css/query.webui-popover.min.css">
    <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    
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
     <input type="hidden" id="idusuario" value="<?php echo $idusu; ?>">

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
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">
            <div id="ajaxdiv"></div>
            <input type="hidden" id="userid" value="<?php echo $id; ?>">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
               <form action="{{ url('../images/fotos/') }}" method="post" style="display: none" id="avatarForm">
                            {{ csrf_field() }}
                            <input type="file" id="avatarInput" name="photo">
                          </form>
              <img id="avatarImage" class="profile-user-img img-responsive img-circle" src="<?php echo getAvatarUrl($id); ?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $nombres; ?></h3>

              <p class="text-muted text-center"> <?php echo $cargo; ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Cell</b> <a class="pull-right"><?php echo $cell; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Miembro desde</b> <a class="pull-right"><?php echo $u_ingreso; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Last log:</b> <a class="pull-right"><?php echo $fsesion; ?></a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
            
              <li><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">

                 <div id="lista_actividad"></div>
            
              </div>
           
            

              <div class="tab-pane" id="settings">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
<!-- /.content-wrapper -->
<footer class="main-footer">
<div class="pull-right hidden-xs">
<b>Version</b> 2.4.0
</div>
<strong>Copyright &copy; 2017-2019 <a href="https://www.facebook.com/rasta4ever09" target="_blank">JI TECHNO SOLUTIONS</a>.</strong> All rights
reserved.
</footer>
<!-- Control Sidebar -->

<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- jQuery 3 -->
<script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>

<script src="../bower_components/jquery/dist/jquery.min.js"></script>
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

<script src="../js/tactil.js"></script>
<script src="../js/jquery.webui-popover.min.js"></script>
<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="../plugins/datepicker/locales/bootstrap-datepicker.es.min.js"></script>
<script src="../js/raphael-min.js"></script>
<script src="../js/push.min.js"></script>
<script src="../plugins/morris/morris.min.js"></script>
<script src="../plugins/input-mask/jquery.inputmask.js"></script>
<script src="../plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="../plugins/ckeditor/ckeditor.js"></script>
</body>
</html>
<script>
$(document).ready(function(){
actividades();
});
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


$(function () {
var $avatarImage, $avatarInput, $avatarForm;
$avatarImage = $('#avatarImage');
$avatarInput = $('#avatarInput');
$avatarForm = $('#avatarForm');
$avatarImage.on('click', function () {
$avatarInput.click();
});
$avatarInput.on('change', function () {
 upload_image();
 window.location.reload(true);
});
});

        function upload_image(){

                var id = $("#userid").val();
                
                var inputFileImage = document.getElementById("avatarInput");
                var file = inputFileImage.files[0];
                if( (typeof file === "object") && (file !== null) )
                {
                   msgbox("loader","actualizando...",0); 
                    var data = new FormData();
                    data.append('avatarInput',file);
                    
                    
                    $.ajax({
                        url: "Ajax/imagenperfil_ajax.php?id="+id,        
                        type: "POST",            
                        data: data,              
                        contentType: false,      
                        cache: false,            
                        processData:false,       
                        success: function(data)   
                        {
                            $("#avatarImage").html(data);
                             $("#avatarImage").ajax.reload();

                            
                        }
                    }); 
                }
                
                
            }
            function actividades () {
              var id = $('#idusuario').val();

$.ajax({
url:'serverside/lista_actividades.php',
type:'POST',
data: {id: id},
success:function (datos) {
$('#lista_actividad').html(datos);


}
});
}

</script>
