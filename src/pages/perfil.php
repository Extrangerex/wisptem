<?php
date_default_timezone_set("America/Santo_Domingo");
session_start();
include '../config/db.php';
include 'is_logged.php';
include '../config/functions.php';
//include ("Modal/md_sms.php");
//include ("Modal/md_resendsms.php");
//include ("Modal/md_newclientes.php");
//include ("Modal/md_editcliente.php");

require('../config/api_mt_include2.php');
$id = $_GET["id"];
$nivel=$_SESSION['nivel'];
$ids=$_SESSION['user_id'];
$fnombre=$_SESSION['firstname'];
$fapellido=$_SESSION['lastname'];
$fullname = "$fnombre $fapellido";
$u_cargo=$_SESSION['cargo'];
$u_ingreso=$_SESSION['fing'];
$per_act=$_SESSION['chk_act'];
$per_fec=$_SESSION['chk_fec'];
$per_plan=$_SESSION['chk_plan'];
$per_mac=$_SESSION['chk_mac'];

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

$sql="SELECT * FROM  clientesp where id=$id";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);
$nombre=$row['nombres'];
$cell=$row['cell'];
$cell2=$row['cell2'];
$direccion=$row['direcion'];
$comentario=$row['comentario'];
$categoria=$row['categoria'];
$pago=$row['pago_total'];
$fechainicial=$row['fecha_inicial'];
$fechafinal=$row['fecha_final'];
$dias=$row['dias_p'];
$idservicio = $row['id_servicio'];
$apellido= $row['apellido'];
$disable=$row['disable'];
$password=$row['password'];
$documento= $row['documento'];
$usuario=  $row['usuario'];
$plan=  $row['plan'];
$mac=  $row['mac'];
$poste= $row['poste'];
$sector=$row['sector'];
$pagoinstalacion=$row['pago_instalacion'];
$remoteaddress=$row['remoteaddress'];
$empleado=$row['id_empleado'];
$nodo=$row['id_mk'];
$corteauto=$row['corte_auto'];
$anuncio=$row['anuncio'];
$router=$row['router'];
$servicio=$row['id_servicio'];
$router=$row['id_router'];
$idpago=$row['id_pago'];
$mora=$row['mora'];
$cuota = 0;
$plazo = 0;
if ($idservicio==1) {
  $portremote = 8080;
  }
  if ($idservicio==2) {
    $portremote = 80;
  }
if ($idpago==2) {
$query_pago = mysqli_query($con,"select * from tipo_pago where id=$idpago");
$pag = mysqli_fetch_array($query_pago);
$tpago = $pag['descripcion'];
$query_plazo = mysqli_query($con,"select * from financiamiento where id_cliente=$id");
$rows = mysqli_fetch_array($query_plazo);
$plazo = $rows['plazo'];
$cuota = $rows['monto'] / $plazo;
}
$total = $pago + $cuota + $mora;
$sql="SELECT * FROM  mikrotik where idmikrotik=$nodo";
$quer = mysqli_query($con, $sql);
$rows = mysqli_fetch_array($quer);
$nombre_nodo = $rows['nodo'];
$nombres ="$nombre $apellido";
if ($disable=='no'){$estado="Activo";$class="badge badge-success";$classbtn="badge badge-danger"; $texto="Suspender"; $iclass="fa fa-times";}
else {$estado="Cortado";$class="badge badge-danger"; $classbtn="badge badge-success"; $texto="Activar"; $iclass="fa fa-check-square-o";}
//$res = User_state($usuario,$nodo);
if ($res==1){$esta="Online";$classe="badge badge-success"; }
else {$esta="Offline";$classe="badge badge-danger"; }
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
    <input type="hidden" name="idsession" id="idsession" value="<?php echo $nivel; ?>">
    <div class="wrapper">
      <input type="hidden" name="permact" id="permact" value="<?php echo $per_act; ?>">
      <input type="hidden" id="permact" value="<?php echo $per_act; ?>">
       <input type="hidden" id="permfec" value="<?php echo $per_fec; ?>">
         <input type="hidden" id="permplan" value="<?php echo $per_plan; ?>">
         <input type="hidden" id="permac" value="<?php echo $per_mac; ?>">

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
        <!-- Main content -->
        <section class="content">
          <div class="col-sm-12">
            
            <div id="resultadoAjax"></div>
          </div>
          <div class="col-lg-12">
            <div class="box box-default">
              <div class="box-header with-border">
                
                <div class="col-xs-8" style="padding-left: 10px;">
                  <h5 class="box-title" style="text-transform: uppercase;"><b><i class="fa fa-user"></i> <?php echo $nombres; ?> <h8><b>(#<?php echo $id; ?>)</b></h8></b></h5>
                </div>
              </div>
              <div class="box">
                <div class="box-body">
                  <div class="col-md-12">
                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                      <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-info"></i> Datos</a></li>
                        <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-tachometer"></i> Plan de Internet</a></li>
                        <li><a href="#tab_3" data-toggle="tab"><i class="fa fa-dollar"></i> Facturas</a></li>
                        <li><a href="#tab_4"  onclick="paginas_visitadas();" data-toggle="tab"><i class="fa fa-history"></i> Paginas Visitadas</a></li>
                        <li><a href="#tab_5" onclick="load_trafico();" data-toggle="tab"><i class="fa fa-bar-chart-o"></i> Trafico</a></li>
                        
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                          <div class="col-md-8">
                            <div class="box box-default">
                              
                              <div class="panel box box-primary" >
                                <div class="box-header with-border">
                                  <strong class="box-title">Información Principal</strong>
                                </div>
                              </div>
                              <div class="box-body box-block">
                                <form action="" method="post" class="form-horizontal" id="frmPrincipal">
                                  <input type="hidden" name="usua" id="usua" value="<pppoe-<?php echo $usuario; ?>>">
                                  <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                                  <div class="row form-group">
                                    <div class="col col-sm-2"><label for="input-small" class=" form-control-label">Estado</label></div>
                                    <div class="col col-sm-3">
                                      <label ><span class="<?php echo $class; ?>"><?php echo $estado; ?></span></label>
                                      
                                      <a href="#" onclick="<?php echo $texto; ?>('<?php echo $id; ?>');" class='<?php echo $classbtn; ?>' id="btn-suspender" name="btn-suspender" title='Suspender el servicio'  ><i class="<?php echo $iclass; ?> "></i> <?php echo $texto; ?></a>
                                    </div>
                                    <div class="col col-sm-2"><label for="input-small" class=" form-control-label">Nodo</label></div>
                                    <div class="col col-sm-3">
                                      <label ><span ><?php echo $nombre_nodo; ?></span></label>
                                    </div>
                                    
                                  </div>
                                  
                                  <div class="row form-group">
                                    <div class="col col-sm-2"><label for="input-small" class=" form-control-label">Fecha de Ingreso</label></div>
                                    <div class="col col-sm-3">
                                      <label ><span ><?php echo $fechainicial; ?></span></label>
                                    </div>
                                    <div class="col col-sm-2"><label for="input-small" class=" form-control-label">Tipo de servicio</label></div>
                                    <div class="col col-sm-3">
                                      <select   name="servicio" class="input-sm form-control"   id="servicio" <?php echo $readonly; ?>>
                                        <option value=""></option>
                                        <?php
                                        $sql="select * from tipo_servicio";
                                        $resultado2=mysqli_query($con,$sql);
                                        while ($res=mysqli_fetch_array($resultado2)){
                                        
                                        
                                        echo "<option value='".$res['id']."' ";
                                          
                                          if ($res['id'] == $servicio)
                                          echo " SELECTED ";
                                          
                                          echo ">";
                                          echo $res['nombre'];
                                          
                                        echo "</option>";
                                        
                                        
                                        }
                                        mysqli_free_result($resultado2);
                                        
                                        
                                        ?>
                                        
                                        
                                      </select>
                                    </div>
                                  </div>
                                  <div class="row form-group">
                                    <div class="col col-sm-2"><label for="input-small" class=" form-control-label">Nombre</label></div>
                                    <div class="col col-sm-3">
                                      <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>"  class="input-sm form-control-sm form-control">
                                    </div>
                                    <div class="col col-sm-1"><label for="input-small" class=" form-control-label">Apellido</label></div>
                                    <div class="col col-sm-4">
                                      <input type="text" id="apellido" name="apellido" value="<?php echo $apellido; ?>"  class="input-sm form-control-sm form-control">
                                    </div>
                                  </div>
                                  <div class="row form-group">
                                    <div class="col col-sm-2"><label for="input-small" class=" form-control-label">Nº Cédula/Pasaporte</label></div>
                                    <div class="col col-sm-3">
                                      <input type="text" id="documento" name="documento" value="<?php echo $documento; ?>"  class="input-sm form-control-sm form-control">
                                    </div>
                                    <div class="col col-sm-1"><label for="input-small" class=" form-control-label">Nº Movil</label></div>
                                    <div class="col col-sm-2">
                                      <input type="text" id="cell" name="cell" value="<?php echo $cell; ?>"  class="input-sm form-control-sm form-control">
                                    </div>
                                    <div class="col col-sm-1"><label for="input-small" class=" form-control-label">Nº Tel</label></div>
                                    <div class="col col-sm-2">
                                      <input type="text" id="cell2" name="cell2" value="<?php echo $cell2; ?>"  class="input-sm form-control-sm form-control">
                                    </div>
                                  </div>
                                  <div class="row form-group">
                                    <div class="col col-sm-2"><label for="input-small" class=" form-control-label">Proximo Pago</label></div>
                                    <div class="col col-sm-3">
                                      <input  class="input-sm form-control-sm form-control" required name="fechafinal" id="fechafinal" value="<?php echo $fechafinal; ?>" ></span>
                                    </div>
                                    <div class="col col-sm-1"><label for="input-small" class=" form-control-label">Tecnico: </label></div>
                                    <div class="col col-sm-4">
                                      
                                      <select   name="empleado" class="input-sm form-control"   id="empleado" <?php echo $disabled; ?>>
                                        <option value=""></option>
                                        <?php
                                        $sql="select * from users order by firstname asc";
                                        $resultado2=mysqli_query($con,$sql);
                                        while ($res=mysqli_fetch_array($resultado2)){
                                        
                                        
                                        echo "<option value='".$res['user_id']."' ";
                                          
                                          if ($res['user_id'] == $empleado)
                                          echo " SELECTED ";
                                          
                                          echo ">";
                                          echo $res['firstname'];
                                          echo " ";
                                          echo $res['lastname'];
                                        echo "</option>";
                                        
                                        
                                        }
                                        mysqli_free_result($resultado2);
                                        
                                        
                                        ?>
                                        
                                        
                                      </select>
                                    </div>
                                  </div>
                                  <div class="row form-group">
                                    
                                    <div class="col col-sm-2"><label for="input-small" class=" form-control-label">Router pertenece a:</label></div>
                                    <div class="col col-sm-3">
                                      
                                      <select    name="router" class="input-sm form-control"   id="router">
                                        <option value=""></option>
                                        <?php
                                        $sql="select * from router";
                                        $resultado2=mysqli_query($con,$sql);
                                        while ($res=mysqli_fetch_array($resultado2)){
                                        
                                        
                                        echo "<option value='".$res['id']."' ";
                                          
                                          if ($res['id'] == $router)
                                          echo " SELECTED ";
                                          
                                          echo ">";
                                          echo $res['descripcion'];
                                        echo "</option>";
                                        
                                        
                                        }
                                        mysqli_free_result($resultado2);
                                        
                                        
                                        ?>
                                        
                                        
                                      </select>
                                    </div>
                                    <div class="col col-sm-1"><label for="input-small" class=" form-control-label">Sector</label></div>
                                    <div class="col col-sm-3">
                                      
                                      <select   name="sector" class="input-sm form-control"   id="sector">
                                        <option value=""></option>
                                        <?php
                                        $sql="select * from sector order by nombre asc";
                                        $resultado2=mysqli_query($con,$sql);
                                        while ($res=mysqli_fetch_array($resultado2)){
                                        
                                        
                                        echo "<option value='".$res['abreviacion']."' ";
                                          
                                          if ($res['abreviacion'] == $sector)
                                          echo " SELECTED ";
                                          
                                          echo ">";
                                          echo $res['nombre'];
                                        echo "</option>";
                                        
                                        
                                        }
                                        mysqli_free_result($resultado2);
                                        
                                        
                                        ?>
                                        
                                        
                                      </select>
                                    </div>
                                    <div class="col col-sm-1"><label for="input-small" class=" form-control-label">Nº Poste</label></div>
                                    <div class="col col-sm-2">
                                      <input type="text" id="poste" name="poste" value="<?php echo $poste; ?>"  class="input-sm form-control-sm form-control">
                                      
                                    </div>
                                  </div>
                                  <div class="row form-group">
                                    <div class="col col-sm-2"><label for="input-small" class=" form-control-label">Dirección</label></div>
                                    <div class="col col-sm-9">
                                      <a href="javascript:void(0)" onclick="getmapa('')"><i class="fa fa-home"></i></a>
                                      <input type="text" id="direccion" name="direccion" value="<?php echo $direccion; ?>"  class="input-sm form-control-sm form-control">
                                    </div>
                                    
                                  </div>
                                  <div class="row form-group">
                                    <div class="col col-sm-2"><label for="input-small" class=" form-control-label">Pago Instalacion</label></div>
                                    <div class="col col-sm-3">
                                      <input type="number" id="pago_instalacion" <?php echo $disabled; ?> name="pago_instalacion" value="<?php echo $pagoinstalacion; ?>"  class="input-sm form-control-sm form-control">
                                    </div>
                                    <div class="col col-sm-2"><label for="input-small" class=" form-control-label">Modo de pago</label></div>
                                    <div class="col col-sm-2">
                                      <input type="text" id="tpago" name="tpago" value="<?php echo $tpago; ?>"  <?php echo $disabled; ?>  class="input-sm form-control-sm form-control" readonly>
                                    </div>
                                    <div class="col col-sm-1"><label for="input-small" class=" form-control-label">Mensualidad</label></div>
                                    <div class="col col-sm-2">
                                      <input type="number" <?php echo $disabled; ?> id="pago_total" name="pago_total" value="<?php echo $pago; ?>"  class="input-sm form-control-sm form-control">
                                    </div>
                                  </div>
                                  <div class="row form-group" id="best">
                                    <div class="col col-sm-2"><label for="input-small" class=" form-control-label">Plazo (meses) </label></div>
                                    <div class="col col-sm-1">
                                      <input type="number" <?php echo $disabled; ?> id="plazo" name="plazo" value="<?php echo $plazo; ?>"  class="input-sm form-control-sm form-control">
                                    </div>
                                    <div class="col col-sm-1"><label for="input-small" class=" form-control-label">Cuota </label></div>
                                    <div class="col col-sm-1">
                                      <input type="number" id="cuota" name="cuota" <?php echo $disabled; ?> value="<?php echo $cuota; ?>"  class="input-sm form-control-sm form-control">
                                    </div>
                                    <div class="col col-sm-1"><label for="input-small" class=" form-control-label">Mora: </label></div>
                                    <div class="col col-sm-1">
                                      <input type="number" id="mora" name="mora" <?php echo $disabled; ?> value="<?php echo $mora; ?>"  class="input-sm form-control-sm form-control" >
                                    </div>
                                    <div class="col col-sm-2"><label for="input-small" class=" form-control-label">Total a pagar: </label></div>
                                    <div class="col col-sm-2">
                                      <input type="number" id="cuota" name="cuota" value="<?php echo $total; ?>"  class="input-sm form-control-sm form-control" readonly>
                                    </div>
                                  </div>
                                  
                                  
                                  <div class="row form-group">
                                    <div class="col col-sm-2"><label for="input-small" class=" form-control-label">Lat</label></div>
                                    <div class="col col-sm-3">
                                      <input type="text" id="lat" name="lat" value="<?php echo $lat; ?>"  class="input-sm form-control-sm form-control">
                                    </div>
                                    <div class="col col-sm-2"><label for="input-small" class=" form-control-label">Long</label></div>
                                    <div class="col col-sm-3">
                                      <input type="text" id="long" name="long" value="<?php echo $long; ?>"  class="input-sm form-control-sm form-control">
                                    </div>
                                  </div>
                                  
                                  
                                  
                                  <div class="row form-group">
                                    <div class="col col-sm-2"><label for="input-small" class=" form-control-label">Observación</label></div>
                                    <div class="col col-sm-6">
                                      
                                      <input type="text" id="comentario" name="comentario" value="<?php echo $comentario; ?>"  class="input-sm form-control-sm form-control">
                                    </div>
                                  </div>
                                  <div class="row form-group">
                                  	  <div class="col col-sm-2"><label for="input-small" class=" form-control-label">Corte auto</label></div>
                                  	  <div class="col col-sm-4">
                                  	 <input type="checkbox"  data-toggle="toggle" data-style="ios" data-size="mini"  <?php echo $disabled; ?> id="corteauto"  name="corteauto" value="yes"  <?php if (!(strcmp($corteauto,"yes"))) {echo "checked=\"checked\"";} ?>>
									</div>
										
									</div>
									 <div class="row form-group">
                                  	  <div class="col col-sm-2"><label for="input-small" class=" form-control-label">Anuncio</label></div>
                                  	  <div class="col col-sm-4">
                                  	 <input type="checkbox"  data-toggle="toggle" data-style="ios" data-size="mini" id="anuncio"  <?php echo $disabled; ?> name="anuncio" value="yes" <?php if (!(strcmp($anuncio,"yes"))) {echo "checked=\"checked\"";} ?>>
									</div>
										
									</div>
                                  
                                  
                                  
                                </div>
                                <div class="box-footer">
                                  <span class="pull-left">
                                    <a href="javascript:window.history.back();"><i class="glyphicon glyphicon-menu-left"></i> Volver atrás</a>
                                    
                                  </span>
                                  <span class="pull-right">
                                    <button  class="btn btn-success btn-sm" id="btn-actualizar" >
                                    <i class="fa fa-refresh"></i> Actualizar
                                    </button>
                                  </span>
                                </div>
                              </div>
                            </form>
                          </div>
                          <div class="col-md-4">
                            <div class="box box-default">
                              
                              <div class="panel box box-primary" >
                                <div class="box-header with-border">
                                  <strong class="box-title">Otros datos</strong>
                                </div>
                              </div>
                              <div class="box-body box-block">
                                <form action="" method="post" class="form-horizontal" id="otrodatofrm">
                                  <input type="hidden" name="nodo_mk" id="nodo_mk"  value="<?php echo $nodo; ?>">
                                  <input type="hidden" name="ip_cli" id="ip_cli" value="<?php echo $remoteaddress; ?>">
                                  <input type="hidden" name="user" id="user" value="<?php echo $usuario; ?>">
                                  <div class="row form-group">
                                    <div class="col col-sm-2"><label for="input-small" class=" form-control-label">Active</label></div>
                                    <div class="col col-sm-2">
                                      <div id="estad"></div>
                                      
                                    </div>
                                    <div class="col col-sm-2"><label for="input-small" class=" form-control-label">Last log</label></div>
                                    <div class="col col-sm-4">
                                      <label ><?php  echo Last_log($usuario,$nodo);?></label>
                                    </div>
                                  </div>
                                  <div class="row form-group">
                                    
                                    <div class="col col-sm-4"><label for="input-small" class=" form-control-label">Ultimo pago</label></div>
                                    <div class="col col-sm-4">
                                      <div class="ultimo_pago"></div>
                                    </div>
                                    
                                  </div>
                                  
                                  
                                  <div class="row form-group">
                                    <div id="loadping"></div>
                                    <div class="box-body text-light" >
                                      
                                      
                                      <div id="ping"></div>
                                      
                                    </div>
                                    
                                  </div>
                                  
                                </div>
                                <div class="box-footer with-border">
                                  <button  class="btn btn-primary btn-sm" id="btn-ping">
                                  <i class="fa fa-dot-circle-o"></i> Hacer ping
                                  </button>
								   <a  class="btn btn-success btn-sm" href="http://<?php echo $remoteaddress;?>:<?php echo $portremote;?>" target="_blank">
                                  <i class="fa fa-dot-circle-o"></i> Entrar al router
                                  </a>
                                </div>
								
                                 
                              
                              </div>
                            </form>
                          </div>
                          
                          
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                          <div class="col-md-12">
                            <div  class="box box-default">
                              <div class="panel box box-primary" >
                                <div class="box-header with-border">
                                  <strong class="box-title">Servicios de internet</strong>
                                </div>
                              </div>
                              <div class="box-body box-block">
                                <form action="" method="post" class="form-horizontal" id="frmPlan">
                                  <input type="hidden" name="mod_id" id="mod_id" value="<?php echo $id; ?>">
                                  <div class="row form-group" style="margin-bottom:20px">
                                    <div class="col col-sm-3"><label for="input-small" class=" form-control-label">Nodo</label></div>
                                    <div class="col col-sm-3">
                                      <select   name="nodo" class="input-sm form-control"   id="nodo" style="width:100%; font-size:13px">
                                        <option value=""></option>
                                        <?php
                                        $sql="select * from mikrotik";
                                        $resultado2=mysqli_query($con,$sql);
                                        while ($res=mysqli_fetch_array($resultado2)){
                                        
                                        
                                        echo "<option value='".$res['idmikrotik']."' ";
                                          
                                          if ($res['idmikrotik'] == $nodo)
                                          echo " SELECTED ";
                                          
                                          echo ">";
                                          echo $res['nodo'];
                                        echo "</option>";
                                        
                                        
                                        }
                                        mysqli_free_result($resultado2);
                                        
                                        
                                        ?>
                                        
                                        
                                      </select>
                                    </div>
                                  </div>
                                  <div class="row form-group" style="margin-bottom:20px">
                                    <div class="col col-sm-3"><label for="input-small" class=" form-control-label">Plan de internet</label></div>
                                    <div class="col col-sm-3">
                                      <select   name="plan" class="input-sm form-control"   id="plan" style="width:100%; font-size:13px" onChange="mostrar();">
                                        <option value=""></option>
                                        <?php
                                        $sql="select * from planes";
                                        $resultado2=mysqli_query($con,$sql);
                                        while ($res=mysqli_fetch_array($resultado2)){
                                        
                                        
                                        echo "<option value='".$res['plan']."' ";
                                          
                                          if ($res['plan'] == $plan)
                                          echo " SELECTED ";
                                          
                                          echo ">";
                                          echo $res['nombre'];
                                        echo "</option>";
                                        
                                        
                                        }
                                        mysqli_free_result($resultado2);
                                        
                                        
                                        ?>
                                        
                                        
                                      </select>
                                    </div>
                                  </div>
                                  <div class="row form-group">
                                    <div class="col col-sm-3"><label for="input-small" class=" form-control-label">Usuario</label></div>
                                    <div class="input-group col col-sm-2">
                                      <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                      <input type="text"  class="form-control" id="usuario" name="usuario"  value="<?php echo $usuario; ?>" required="">
                                    </div>
                                    
                                  </div>
                                  <div class="row form-group">
                                    <div class="col col-sm-3"><label for="input-small" class=" form-control-label">Password</label></div>
                                    <div class="input-group col col-sm-2">
                                      <div class="input-group-addon"><i class="fa fa-key"></i></div>
                                      <input type="password"  class="form-control" id="password" name="password"  value="<?php echo $password; ?>" required="">
                                    </div>
                                    
                                  </div>
                                  <div class="row form-group">
                                    <div class="col col-sm-3"><label for="input-small" class=" form-control-label">Remote address</label>
                                    <button type="button"  class="hover"><i class="fa fa-search"></i></button>
                                  </div>
                                  <div class="input-group col col-sm-2">
                                    
                                    <input type="text"  class="form-control" id="remoteaddress" name="remoteaddress"  value="<?php echo $remoteaddress; ?>" required="">
                                  </div>
                                  
                                </div>
                                <div class="row form-group">
                                  <div class="col col-sm-3"><label for="input-small" class=" form-control-label">Mac address</label>
                                  	 <a type="button"  id="buscarmac" onclick="buscarMac();"><i class="fa fa-refresh"></i></a>
                                  	 <div id="loaderF"></div>
                                  </div>
                                  <div class="input-group col col-sm-2">
                                    
                                    <input type="text"  class="form-control" id="mac" name="mac"  value="<?php echo $mac; ?>" >
                                  </div>
                                  
                                </div>
                                <div class="row form-group">
                                  <div class="col col-sm-3"><label for="input-small" class=" form-control-label">Pago mensual</label></div>
                                  <div class="input-group col col-sm-2">
                                    <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                                    <input type="text"  class="form-control" id="monto" name="monto"  value="<?php echo $pago; ?>" required="">
                                  </div>
                                  
                                </div>
                                
                              </div>
                              <div class="box-footer">
                                <span class="pull-left">
                                  <a href="javascript:window.history.back();"><i class="fa fa-backward"></i> Volver a los clientes</a>
                                  
                                </span>
                                <span class="pull-right">
                                  <button  class="btn btn-success btn-sm" id="btn-actualizarP"  >
                                  <i class="fa fa-refresh"></i> Actualizar
                                  </button>
                                </span>
                                
                              </div>
                            </form>
                          </div>
                        </div>
                        
                      </div>
                      <!-- /.tab-pane -->
                      <div class="tab-pane" id="tab_3">
                        <div class="box-body">
                          
                          <div class="row form-group">
                            
                            
                            
                            <div class="box-body" >
                              
                              <div id="loaderF"></div>
                              <div class="facturas" ></div>
                            </div>
                            
                          </div>
                        </div>
                        
                      </div>
                      <div class="tab-pane" id="tab_4">
                        
                        <div class="box box-body">
                          <div class="col col-sm-2">
                            
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input  class="input-sm form-control-sm form-control" value="<?php echo date('Y-m-d'); ?>" name="fechalog" id="fechalog"></span>
                            </div>
                            <!-- /.input group -->
                            
                          </div>
                        </div>
                        
                        <table id="list-pages" class="table-hover table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" data-order="[[ 1, &quot;asc&quot; ]]">
                          <thead align="center">
                            <tr>
                              
                              
                           
                              <th>IP Destino</th>
                              <th>Fecha & Hora</th>
                              
                              
                              
                              
                              
                              
                            </tr>
                          </thead>
                        </table>
                      </div>
                      <div class="tab-pane" id="tab_5">
                        <div class="box box-body">

                          <div class="col col-sm-2">
                            <label>Desde</label>
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input  class="input-sm form-control-sm form-control" value="<?php echo date('Y-m-d'); ?>" name="start" id="start"></span>
                            </div>
                            <!-- /.input group -->
                            
                          </div>
                          <div class="col col-sm-2">
                            <label>al</label>
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input  class="input-sm form-control-sm form-control" value="<?php echo date('Y-m-d'); ?>" name="end" id="end"></span>
                            </div>
                            <!-- /.input group -->
                            
                          </div>
                        </div>
                         <section class="col-lg-6 connectedSortable">
                        <div class="box box-default">
                          <div class="box-header with-border">
                            <h3 class="box-title">Trafico</h3>
                            
                          </div>

                          <div class="box-body chart-responsive">
                            <div id="graf" style="width: 50%; height: 300px;"></div>

                          </div>
                          </section>
                          <!-- /.box-body -->
                       <section class="col-lg-6 connectedSortable">
                         <div class="box box-default">
                          <div class="box-header with-border">
                            <h3 class="box-title">Top 10 paginas visitadas </h3>
                            
                          </div>

                          <div class="box-body chart-responsive">
                            <div id="topserver" style="height: 370px; width: 100%;"></div>

                          </div>

                         </section>                  
                      </div>
                      <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                  </div>
                  <!-- nav-tabs-custom -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
    <?php include 'pie.php'; ?>
    <!-- Control Sidebar -->
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
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
$(document).ready(function(){
   var id= $("#idsession").val();
   if (id != 1){
  document.getElementById("monto").readOnly = true;
}
  var q= $("#permfec").val();

if (q != 1){
  document.getElementById("fechafinal").readOnly = true;
}else{
var fechafinal=$('input[name="fechafinal"]'); //our date input has the name "date"
var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
fechafinal.datepicker({
format: 'yyyy-mm-dd',
container: container,
todayHighlight: true,
autoclose: true,
})
}
 var p= $("#permplan").val();

if (p != 1){
   document.getElementById("plan").disabled = true;
}

var m= $("#permac").val();

if (m != 1){
 
 
     $('#buscarmac').hide();

   document.getElementById("mac").readOnly = true;
}
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
var inter = $("#usua").val();
var q= $("#ip_cli").val();
var id= $("#id").val();
var idm= $("#nodo_mk").val();
var use = $("#user").val();

function buscarMac () {
$.ajax({
url:'serverside/buscarmac.php?id='+idm+'&usuario='+use,
type:'POST',
beforeSend: function(objeto){
$('#loaderF').html('<img src="../images/update.gif"> ');
},
success:function (data) {
document.getElementById("mac").value = data;
$('#loaderF').html('');
}
});
}



$("#loaderF").fadeIn('slow');
$.ajax({
type: "POST",
url:'./Ajax/buscar/buscar_facturasC.php?id='+id,
beforeSend: function(objeto){
$('#loaderF').html('<img src="../images/loader.gif"> Cargando...');
},
success:function(data){
$(".facturas").html(data).fadeIn('slow');
$('#loaderF').html('');
}
})
$.ajax({
type: "POST",
url:'serverside/get_status.php?id='+idm+'&usuario='+use,
success:function(data){
$("#estad").html(data);
}
})
$.ajax({
type: "POST",
url:'serverside/ultimopago.php?id='+id,
success:function(data){
$(".ultimo_pago").html(data);
}
})
$( "#otrodatofrm" ).submit(function( event ) {
$('#btn-ping').attr("disabled", true);
var parametros = $(this).serialize();
$.ajax({
type: "POST",
url: "serverside/ping.php",
data: parametros,
beforeSend: function(objeto){
$('#loadping').html('<img src="../images/loader.gif"> Haciendo ping...');
$('#btn-actualizar').attr("disabled", true);
$('#ping').attr("hidden", true);
},
success: function(datos){
$("#ping").html(datos);
$('#btn-actualizar').attr("disabled", false);
$('#btn-ping').attr("disabled", false);
$('#ping').attr("hidden", false);
$('#loadping').html('');
}
});
event.preventDefault();
})
$(document).ready(function(){
var start=$('input[name="start"]'); //our date input has the name "date"
var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
start.datepicker({
format: 'yyyy-mm-dd',
container: container,
todayHighlight: true,
autoclose: true,
})
var end=$('input[name="end"]'); //our date input has the name "date"
var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
end.datepicker({
format: 'yyyy-mm-dd',
container: container,
todayHighlight: true,
autoclose: true,
})

var fechalog=$('input[name="fechalog"]'); //our date input has the name "date"
var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
fechalog.datepicker({
format: 'yyyy-mm-dd',
container: container,
todayHighlight: true,
autoclose: true,
})
})
$(document).ready(function(){
$('.hover').popover({
title:'Ip disponible',
content:fetchData,
html:true,
container: 'body',
placement:'right'
});
function fetchData(){
var fetch_data = '';
var idm= $("#nodo_mk").val();
$.ajax({
url:"serverside/remoteaddress.php?id="+idm,
async:false,
success:function(data){
fetch_data = data;
}
});
return fetch_data;
}
});
function mostrar(){
$("#plan option:selected").each(function () {
plan = $(this).val();
$.post("serverside/pagototal2.php", { p: plan }, function(data){
document.getElementById("monto").value = data;
});
});
}
$(document).ready(function(){
load();
});
function load(page){
$("#frmPrincipal").submit(function( event ) {
$('#btn-actualizar').attr("disabled", true);
document.getElementById("empleado").disabled = false;
document.getElementById("pago_total").disabled = false;

var parametro = $(this).serialize();

$.ajax({
type: "POST",
url: "Ajax/update/actualizarInformacionA.php",
data: parametro,
success: function(datos){
$('.notydiv').remove();
$("#resultadoAjax").html(datos);
document.getElementById("empleado").disabled = true;
document.getElementById("pago_total").disabled = true;
$('#btn-actualizar').attr("disabled", false);
location.reload();
}
});
event.preventDefault();

})
}
$( "#frmPlan" ).submit(function( event ) {
$('#btn-actualizarP').attr("disabled", true);
document.getElementById("plan").disabled = false;
var parametros = $(this).serialize();
$.ajax({
type: "POST",
url: "Ajax/update/actualizarPlan.php",
data: parametros,
success: function(datos){
$('.notydiv').remove();
$("#resultadoAjax").html(datos);
$('#btn-actualizarP').attr("disabled", false);
document.getElementById("plan").disabled = true;
location.reload();
}
});
event.preventDefault();
})
function Suspender(id)
{
  var q= $("#permact").val();


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
location.reload();
updatelist();
updatelist_s();

});
});
}
}
function Activar(id)
{
 var q= $("#permact").val();

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
location.reload();
updatelist_s();
updatelist();

});
});
}
}
paginas_visitadas=function(){
var q= $("#ip_cli").val();
if ( ! $.fn.DataTable.isDataTable( '#list-pages' ) ) {
paginas = $('#list-pages').DataTable( {
responsive: true,
"language": {
"url": "Ajax/Spanish.json"
},
"ajax": "Ajax/lista_paginasv.php?ip="+q,
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
{ mData: 'ipdestino' },
{ mData: 'fecha' }
],
"dom": 'Bfrtip',
lengthMenu: [[20, 35, 50,100, -1], [ '20 Registros', '35 Registros', '50 Registros', '100 Registros', 'Mostrar todos' ] ],
buttons: ['pageLength','colvis',
{extend: 'collection', text: '<i class="fa fa-floppy-o"></i> <span class="caret"></span>',
buttons: [{extend: 'print', title:'Lista clientes activos', text: '<i class="fa fa-print"></i> Imprimir', },
{extend: 'csvHtml5', title:'Lista clientes activos', text: '<i class="fa fa-file-excel-o"></i> Exportar a EXCEL', },
{extend: 'pdfHtml5', title:'Lista clientes activos', text: '<i class="fa fa-file-pdf-o"></i> Exportar a PDF', } ] },
],
} );
}
}
</script>
<script>
$(function () {
//Initialize Select2 Elements
$('.select2').select2()
//Datemask dd/mm/yyyy
$('#fechaI').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
//Money Euro
$('[data-mask]').inputmask()
//Date range picker
$('#reservation').daterangepicker()
//Date range picker with time picker
$('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'Y-m-d h:mm A' })
//Date range as a button
$('#daterange-btn').daterangepicker(
{
ranges   : {
'Today'       : [moment(), moment()],
'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
'Last 30 Days': [moment().subtract(29, 'days'), moment()],
'This Month'  : [moment().startOf('month'), moment().endOf('month')],
'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
},
startDate: moment().subtract(29, 'days'),
endDate  : moment()
},
function (start, end) {
$('#daterange-btn span').html(start.format('Y-m-d') + ' - ' + end.format('Y-m-d'))
}
)
//Date picker
$('#fechaI').datepicker({
autoclose: true
})
//iCheck for checkbox and radio inputs
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
checkboxClass: 'icheckbox_minimal-blue',
radioClass   : 'iradio_minimal-blue'
})
//Red color scheme for iCheck
$('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
checkboxClass: 'icheckbox_minimal-red',
radioClass   : 'iradio_minimal-red'
})
//Flat red color scheme for iCheck
$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
checkboxClass: 'icheckbox_flat-green',
radioClass   : 'iradio_flat-green'
})
//Colorpicker
$('.my-colorpicker1').colorpicker()
//color picker with addon
$('.my-colorpicker2').colorpicker()
//Timepicker
$('.timepicker').timepicker({
showInputs: false
})
})

load_trafico = function(){
  $('#graf').empty();
    var dataLength = 0;
    var id = <?php echo $id; ?>;
                var data = [];
                var dataLength = 0;
           
                $.getJSON("Ajax/lista_trafico.php?action=clientehoy&id="+id, function (result) {
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
                      labels: ['Bajada', 'Subida'],
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
                config.element = 'graf';
                config.stacked = true;
                Morris.Bar(config);

                   
                });

   
}






$(function () {
  $('#topserver').empty();

              
                var dataLength = 0;
                var datos = [];

                 $.getJSON("Ajax/lista_trafico.php?action=topserver&ip="+$('#remoteaddress').val(), function (results) {
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

function formatBytes(bytes,decimals) {
   if(bytes == 0) return '0 Bytes';
   var k = 1024,
       dm = decimals <= 0 ? 0 : decimals || 2,
       sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
       i = Math.floor(Math.log(bytes) / Math.log(k));
   return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}










</script>

<style>
  .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 10px; }
  .toggle.ios .toggle-handle { border-radius: 10px; }
</style>