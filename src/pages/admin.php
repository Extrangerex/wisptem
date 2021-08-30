<?php
session_start();
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado
include '../config/db.php';
include '../config/functions.php';
include 'is_logged.php';
require('../config/api_mt_include2.php');



$iduser    = $_SESSION['user_id'];
$nivel     = $_SESSION['nivel'];
$ids       = $_SESSION['user_id'];
$fnombre   = $_SESSION['firstname'];
$fapellido = $_SESSION['lastname'];
$fullname  = "$fnombre $fapellido";
$u_cargo   = $_SESSION['cargo'];
$u_ingreso = $_SESSION['fing'];
$fullname  = "$fnombre $fapellido";
if ($nivel == 1) {
$dash = "Administrador";
$display = "yes";
} else {
$dash = "Usuario";
$display= "none";
}
$id    = $_GET["id"];
$nivel = $_SESSION['nivel'];
if ($nivel != 1) {
$disabled = "disabled";
}
$sql      = "SELECT * FROM  users where user_id=$iduser";
$query    = mysqli_query($con, $sql);
$row      = mysqli_fetch_array($query);
$nombre   = $row['firstname'];
$apellido = $row['lastname'];
$cargo    = $row['cargo'];
$cell     = $row['cell'];
$nombres  = "$nombre $apellido";
$fsesion  = $row['fecha_sesion'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php
    echo NOMBRE_EMPRESA;
    ?></title>
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
    <link href="../css/smartolt.css" rel="stylesheet">
    <script src="../js/smartolt.js"></script>
    
    
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>
  
  <body class="hold-transition skin-blue sidebar-mini" >
    
    <div class="wrapper">
      <input type="hidden" name="idsession" id="idsession" value="<?php
      echo $nivel; ?>">
      <?php
      include('../includes/header.php');
      ?>
      
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
              <p><?php
                echo $fullname;
              ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->


          <ul class="sidebar-menu" data-widget="tree">
            <li class="active">
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
       <div id="resultadoAjax"></div>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          Dashboard- <?php
          echo $dash;
          ?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
        
        <!-- Main content -->
        <section class="content" id="admin" style="display: none;">
          <!-- Small boxes (Stat box) -->
          <div class="row">

           
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><small>Total: </small><?php
                  include('../includes/totalclientes.php');
                  ?><h4><small>UTP: </small><?php
                  include('../includes/totalclientesutp.php');
                  ?> <small>    Fibra: </small><?php
                  include('../includes/totalclientesfibra.php');
                  ?></small></h4></h3>
                   
                  
                  
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>

                <a href="clientes.php?action=tab1" class="small-box-footer" >
                  More info <i class="fa fa-arrow-circle-right"> <small>    Online: </small><small class="totalmkonline"></small></i>
                </a>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php
                  include('../includes/totalcortados.php');
                  ?></h3>
                  <p>Total cortados</p>
                  
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
                <a href="clientes.php?action=tab2" class="small-box-footer" >
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
             <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php
                  include('../includes/totalretirados.php');
                  ?></h3>
                  <p>Total retirados</p>
                  
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
                <a href="clientes.php?action=tab4" class="small-box-footer" >
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
             <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php
                  include('../includes/totalvencidos.php');
                  ?></h3>
                  <p>Facturas no pagadas</p>
                  
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
                <a href="clientes.php?action=tab3" class="small-box-footer" >
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>


         </div>
       
        

         

          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-6 connectedSortable">
              <div class="box box-solid bg-light-teal-gradient">
                <div class="box">
                  <div class="box-header with-border">
                    <h8 class="box-title"><i class="fa fa-bar-chart-o"></i> Consumo total de los clientes ultimos 7 dias</h8>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <div class="btn-group">
                        <select  name="nodo" class="btn btn-box-tool"   id="nodom" onchange="load_lastseven();">
                          
                          
                          
                          <?php
                          $sql       = "SELECT * FROM mikrotik";
                          $resultado = mysqli_query($con, $sql);
                          while ($res = mysqli_fetch_array($resultado)) {
                          
                          
                          echo "<option value=" . $res["idmikrotik"] . "><h8>" . $res["nodo"] . "</h8></option>";
                          }
                          mysqli_free_result($resultado);
                          ?>
                        </select>
                      </select>
                      
                    </div>
                    
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div id="loader2"></div>
                      <div id="lastseven"  style="width: 50%; height: 250px;"></div>
                      
                      <!-- /.chart-responsive -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4">
                      
                      
                      <!-- /.progress-group -->
                      
                      <!-- /.progress-group -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                
                
              </div>
            </div>


            <div class="box box-solid bg-light-teal-gradient">
              <div class="box">
                <div class="box-header with-border">
                  <h8 class="box-title"><i class="fa  fa-bar-chart"></i> Ingresos mensual</h8>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <div class="btn-group">
                      <select  name="ingre" class="btn btn-box-tool"   id="ingre" onchange="load_year();">
                        
                        
                        <?php
                        
                                    for($i=date("Y");$i>=2010;$i--)
                                    {
                                    echo "<option value='".$i."'>".$i."</option>";
                                    }
                                    
                        ?>
                        
                        
                      </select>
                      
                    </div>
                    
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-sm-12">
                        
                        <div id="loader11"></div>
                        <div class="ingresosmen"></div>
                        
                        
                        
                        
                        
                      </div>
                      
                      <!-- /.chart-responsive -->
                    </div>
                    <!-- /.col -->
                    
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                
                
              </div>
            </div>
            <div class="box box-solid bg-light-teal-gradient">
              <div class="box">
                <div class="box-header with-border">
                  <h8 class="box-title"><i class="fa  fa-bar-chart"></i> Top 10 paginas</h8>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-sm-12">
                        
                        
                        
                        
                        
                        
                        <div id="topserver" style="height: 370px; width: 100%;"></div>
                        
                      </div>
                      
                      <!-- /.chart-responsive -->
                    </div>
                    <!-- /.col -->
                    
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                
              </div>
            </div>

          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-6 connectedSortable">
           
            <div class="box box-solid bg-light-teal-gradient">
              
              <div class="box">
                <div class="box-header with-border">
                  <h8 class="box-title"><i class="fa fa-calendar-check-o"></i> Logs del sistema</h8>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-sm-12">
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="date" class="form-control pull-right"  value="<?php
                          echo date('Y-m-d');
                          ?>" id="fec" name="fec"   onchange="load();" >
                        </div>
                        
                        
                        
                        
                        
                        <div  class="table-wrapper-scroll-y"   >
                          
                          <div id="loader" ></div><!-- Carga los datos ajax -->
                          <div class='outer_div'></div><!-- Carga los datos ajax -->
                        </div>
                      </div>
                      
                      <!-- /.chart-responsive -->
                    </div>
                    <!-- /.col -->
                    
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                
                
              </div>
            </div>
            <div class="box box-solid bg-light-teal-gradient">
              <div class="box">
                <div class="box-header with-border">
                  <h8 class="box-title"><i class="fa  fa-bar-chart"></i>Clientes agregados</h8>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <div class="btn-group">
                      <select  name="cliag" class="btn btn-box-tool"   id="cliag" onchange="load_cliag();">
                        
                        
                        <?php
                        
                                    for($i=date("Y");$i>=2010;$i--)
                                    {
                                    echo "<option value='".$i."'>".$i."</option>";
                                    }
                                    
                        ?>
                        
                        
                      </select>
                      
                    </div>
                    
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-sm-12">
                        
                        <div id="loader12"></div>
                        <div class="cliagmen"></div>
                        
                        
                      </div>
                      
                      <!-- /.chart-responsive -->
                    </div>
                    <!-- /.col -->
                    
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                
                
              </div>
              
            </div>
            <div class="box box-solid bg-light-teal-gradient">
              <div class="box">
                <div class="box-header with-border">
                  <h8 class="box-title"><i class="fa  fa-bar-chart"></i> Clientes por sector</h8>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-sm-12">
                        
                        
                        
                        
                        
                        
                        <?php
                        include "../charts/zone.php";
                        ?>
                        
                      </div>
                      
                      <!-- /.chart-responsive -->
                    </div>
                    <!-- /.col -->
                    
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                
              </div>
            </div>
          </section>
          <!-- right col -->
          
          <section class="col-lg-6 connectedSortable">
            <div class="box box-solid bg-light-teal-gradient">
              <div class="box">
                <div class="box-header with-border">
                  <h8 class="box-title"><i class="fa fa-bar-chart-o"></i> Consumo Mikrotik en vivo</h8>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <div class="btn-group">
                      <select  name="nodo" class="btn btn-box-tool"   id="nodo" onchange="load_envivo();">
                        
                        <option value="">sel. un nodo</option>
                        
                        <?php
                        $sql= "SELECT * FROM mikrotik";
                        $resultado = mysqli_query($con, $sql);
                        while ($res = mysqli_fetch_array($resultado)) {
                        
                        
                        echo "<option value=" . $res["idmikrotik"] . "><h8>" . $res["nodo"] . "</h8></option>";
                        }
                        mysqli_close($con);
                        ?>
                      </select>
                    </select>
                    
                  </div>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div id="loader2"></div>
                    <div class="grafica"></div>
                    
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    
                    
                    <!-- /.progress-group -->
                    
                    <!-- /.progress-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              
              
            </div>
          </div>
          
        </section>
        
      </div>
      <!-- /.row (main row) -->
    </section>
    
    <!-- /.row (main row) -->
  </section>
  <section class="content" id="Usuarios" style="display: none;">
    <div class="row">
      <div class="col-md-6">
        <div  id="ajaxdiv"></div>
        <input type="hidden" id="userid" value="<?php
        echo $id;
        ?>">
      
        <!-- Profile Image -->
        <div class="box box-primary">
          <div class="box-body box-profile">
            <form action="{{ url('../images/fotos/') }}" method="post" style="display: none" id="avatarForm">
              {{ csrf_field() }}
              <input type="file" id="avatarInput" name="photo">
            </form>
            <img id="avatarImage" class="profile-user-img img-responsive img-circle" src="<?php
            echo getAvatarUrl($id);
            ?>" alt="User profile picture">
            <h3 class="profile-username text-center"><?php
            echo $nombres;
            ?></h3>
            <p class="text-muted text-center"> <?php
              echo $cargo;
            ?></p>
            <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                <b>Cell</b> <a class="pull-right"><?php
                  echo $cell;
                ?></a>
              </li>
              <li class="list-group-item">
                <b>Miembro desde</b> <a class="pull-right"><?php
                  echo $u_ingreso;
                ?></a>
              </li>
              <li class="list-group-item">
                <b>Last log:</b> <a class="pull-right"><?php
                  echo $fsesion;
                ?></a>
              </li>
            </ul>
            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
        
      </div>
      <!-- /.col -->
      
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
include 'pie.php';
mysqli_close($con);
?>


</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="../assets/plugins/jQueryUI/jquery-ui.min.js"></script>
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="../bower_components/raphael/raphael.min.js"></script>
<script src="../bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="../bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="../js/push.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script type = "text/javascript" src = "https://www.gstatic.com/charts/loader.js">
</script>
</body>
</html>
<script>
var fec=$('input[name="fec"]'); //our date input has the name "date"
var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
fec.datepicker({
format: 'yyyy-mm-dd',
container: container,
todayHighlight: true,
autoclose: true,
})
var id = $("#idsession").val();
if (id === "1") {
$('#li-online').show();
$('#admin').show();
$('#Usuarios').hide();
}else{
$('#li-online').hide();
$('#admin').hide();
$('#Usuarios').show();
}
$(document).ready(function(){
load();
total_onlinemk();
total_unconf();
uptime();

setInterval(function () {
load();
Push.Permission.request();
cargar_session();
cargar_notify();
cargar_listaonline();
total_onlinemk();
},10000);
});
function total_onlinemk(){
$.ajax({
url:'./serverside/totalmkonline.php',
success:function(data){
$(".totalmkonline").html(data).fadeIn('slow');
}
})
}
function total_unconf(){
$.ajax({
url:'./serverside/totalonuunconf.php',
beforeSend: function(objeto){
$('.totalunconf').html('<img src="../images/loader2.gif">');
},

success:function(data){
$(".totalunconf").html(data).fadeIn('slow');
}
})
}
function uptime(){
$.ajax({
url:'./serverside/uptime.php',
beforeSend: function(objeto){
$('#uptime').html('<img src="../images/loader2.gif">');
},
success:function(data){
$("#uptime").html(data).fadeIn('slow');
}
})
}

function load(page){
var fec= $("#fec").val();
$("#loader").fadeIn('slow');
$.ajax({
url:'./Ajax/logs.php?fec='+fec,
success:function(data){
$(".outer_div").html(data).fadeIn('slow');
$('#loader').html('');
}
})
}
$(document).ready(function(){
load_envivo();
load_year();
load_cliag();
});
load_envivo= function(){
var nodo= $("#nodo").val();
if (nodo != ""){
$("#loader2").fadeIn('slow');
$.ajax({
url:'./serverside/grafica.php?id='+fec,
beforeSend: function(objeto){
$('#loader2').html('<img src="../images/loader.gif"> Cargando...');
},
success:function(data){
$(".grafica").html(data).fadeIn('slow');
$('#loader2').html('');
}
})
}
}
load_year= function(){
var ingre= $("#ingre").val();
$("#loader11").fadeIn('slow');
$.ajax({
url:'./serverside/ingresos.php?id='+ingre,
beforeSend: function(objeto){
$('#loader11').html('<img src="../images/loader.gif"> Cargando...');
},
success:function(data){
$(".ingresosmen").html(data).fadeIn('slow');
$('#loader11').html('');
}
})
}
load_cliag= function(){
var cliag= $("#cliag").val();
$("#loader12").fadeIn('slow');
$.ajax({
url:'./serverside/cliag.php?id='+cliag,
beforeSend: function(objeto){
$('#loader12').html('<img src="../images/loader.gif"> Cargando...');
},
success:function(data){
$(".cliagmen").html(data).fadeIn('slow');
$('#loader12').html('');
}
})
}
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
var id = $("#idsession").val();
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
$(document).ready(function(){
load_lastseven();
});
load_lastseven = function(){
$('#lastseven').empty();
var dataLength = 0;
var data = [];
var dataLength = 0;
var nodo= $("#nodom").val();
$.getJSON("Ajax/lista_trafico.php?action=mikrotik&idmk="+nodo, function (result) {
dataLength = result.length;
for (var i = 0; i < dataLength; i++) {
var   d = parseInt(result[i].descarga);
var   s = parseInt(result[i].subida);
var fecha = result[i].fecha;
data.push({ y: fecha,  a: d, b: s});
};
config = {
data: data,
xkey: 'y',
ykeys: ['a', 'b'],
labels: ['bajada', 'subida'],
fillOpacity: 0.6,
hideHover: 'auto',
behaveLikeLine: true,
resize: true,
pointFillColors:['#ffffff'],
pointStrokeColors: ['black'],
lineColors:['gray','red'],
xLabelAngle: 60,
yLabelFormat:function (y) {
return formatBytes(y)}
};
config.element = 'lastseven';
config.stacked = true;
Morris.Bar(config);
});
}
function formatBytes(bytes,decimals) {
if(bytes == 0) return '0 Bytes';
var k = 1024,
dm = decimals <= 0 ? 0 : decimals || 2,
sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
i = Math.floor(Math.log(bytes) / Math.log(k));
return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}
$(function () {
$('#topserver').empty();
var dataLength = 0;
var datos = [];
$.getJSON("Ajax/lista_trafico.php?action=topserveradmin", function (results) {
dataLength = results.length;
for (var i = 0; i < dataLength; i++) {
var   dns = results[i].dns;
var   cuenta = parseInt(results[i].cuenta);
datos.push({ y: cuenta, label: dns});
}
var chart = new CanvasJS.Chart("topserver", {
animationEnabled: true,
data: [{
type: "pie",
startAngle: 240,
yValueFormatString: "##0.00\"%\"",
indexLabel: "{label} {y}",
dataPoints: datos
}]
});
chart.render();
});
})
</script>
<style type="text/css">
.table-wrapper-scroll-y {
display: block;
max-height: 200px;
overflow-y: auto;
-ms-overflow-style: -ms-autohiding-scrollbar;
}
</style>