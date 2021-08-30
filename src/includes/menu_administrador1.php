
<?php
session_start();

$nivel=$_SESSION['nivel'];
if ($nivel == 1){
    $urlper = "../pages/usuarios.php";
    $urlplan="../pages/planes.php";
    $urlmik = "../pages/mikrotik.php";
    $urlajuste = "../pages/ajustes.php";
    $urlzona = "../pages/zonas.php";
    $urlserver = "../pages/sms-server.php";
    $urlalmacen = "../pages/almacen.php";
    $urlfinan = "../pages/financiamiento.php";
     $urlplantillas = "../pages/plantillas.php";
      $urlbackup = "../pages/backup.php";

   

}
else{
    
$urlper = "#";
    $urlplan="#";
    $urlmik = "#";
     $urlajuste = "#";
     $urlzona = "#";
      $urlserver = "#";
      $urlalmacen = "#";
      $urlfinan = "#";


}
?>
<ul class="sidebar-menu" data-widget="tree">
  <li class="tactive">
    <a href="../pages/admin.php">
      <i class="fa fa-dashboard"></i> <span data-idioma="MENU:inicio">Inicio</span>
    </a>
  </li>
  <li class="treeview">
    <a href="#">
      <i class="fa fa-briefcase"></i>
      <span data-idioma="MENU:sistema">Sistema</span>
      <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
       
                            
      <li><a href="#" id="linktemporal" style="display:none">tmp</a></li>
      <li><a href="<?php echo $urlmik; ?>"><i class="fa fa-sitemap"></i> <span data-idioma="SUBMENU:router">Routers Mikrotik</span></a></li>
      <li><a href="<?php echo $urlplan; ?>"><i class="fa fa-bars"></i> <span data-idioma="SUBMENU:planes">Planes Internet</span></a></li>

      <li><a href="<?php echo $urlper; ?>"><i class="fa fa-users"></i> <span data-idioma="SUBMENU:personal">Gestión de personal</span></a></li>
    </ul>
  </li>
  
  <li class="treeview">
    <a href="#"><i class="fa fa-user"></i> <span data-idioma="MENU:clientes">Clientes</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
      <li><a href="../pages/clientes.php"><i class="fa fa-user-plus"></i> <span data-idioma="SUBMENU:usuarios">Clientes</span></a></li>
            <li><a href="../pages/activeconnections.php"><i class="fa fa-user-plus"></i> <span data-idioma="SUBMENU:usuarios">Active Connections</span></a></li>
      <li><a href="#mapa/"><i class="fa fa-street-view"></i> <span data-idioma="SUBMENU:mapa">Mapa Clientes</span></a></li>
      <li><a href="#instalaciones/"><i class="fa fa-calendar"></i> <span data-idioma="SUBMENU:instalaciones">Instalaciones</span></a></li>
      <li><a href="../pages/anuncios.php"><i class="fa fa-commenting-o"></i> <span data-idioma="SUBMENU:anuncios">Anuncios</span></a></li>
     
     
    </ul>
  </li>
  <li class="treeview">
    <a href="#"><i class="fa fa-usd"></i> <span data-idioma="MENU:facturacion">Facturación</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">

                     
      <li><a href="../pages/pagos.php"><i class="fa fa-credit-card"></i> <span data-idioma="SUBMENU:pagos">Registrar pagos</span></a></li>
      <li><a href="../pages/facturas.php"><i class="fa fa-file-pdf-o"></i> <span data-idioma="SUBMENU:facturas">Facturas</span></a></li>
    
    </ul>
  </li>
  <li><a href="<?php echo $urlalmacen; ?>"><i class="fa fa-cubes"></i> <span data-idioma="MENU:almacen">Almacen</span></a></li>
   <li><a href="<?php echo $urlfinan; ?>"><i class="fa fa-dollar"></i> <span data-idioma="MENU:almacen">Financiamiento</span></a></li>

  <li><a href="../pages/averias.php"><i class="fa fa-ticket"></i> <span data-idioma="MENU:soporte">Averias</span></a></li>
  <li><a href="../pages/sms.php"><i class="fa fa-whatsapp"></i> <span data-idioma="MENU:sms">SMS</span></a></li>

  
  
  
  <li class="treeview">
    <a href="#">
      <i class="fa fa-cogs"></i>
      <span data-idioma="MENU:ajustes">Ajustes</span>
      <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
      <li><a href="<?php echo $urlajuste; ?>"><i class="fa fa-cog"></i><span data-idioma="SUBMENU:general">General</span></a></li>
      <li><a href="<?php echo $urlserver; ?>"><i class="fa fa-whatsapp"></i><span data-idioma="SUBMENU:servermail">Servidor Sms</span></a></li>
      <li><a href=" <?php echo $urlzona; ?>"><i class="fa fa-globe"></i><span data-idioma="SUBMENU:facturacion">Zona</span></a></li>
        <li><a href=" <?php echo $urlplantillas; ?>"><i class="fa fa-whatsapp"></i> <span data-idioma="MENU:sms">Plantillas anuncios</span></a></li>
         <li><a href=" <?php echo $urlbackup; ?>"><i class="fa fa-hdd-o"></i> <span data-idioma="MENU:sms">Backups</span></a></li>
      

    </ul>
  </li>
  
</ul>
</ul>


