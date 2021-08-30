   <header class="main-header">
        <!-- Logo -->
        <a href="admin.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>JI</b></span>
          <!-- logo for regular state and mobile devices -->
         <span class="logo-lg"><img src="../images/encabezado.png"></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">4</span>
                </a>
                <ul class="dropdown-menu">
                  
                  
                  
                </ul>
              </li>
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      
                      
                      
                      
                    </ul>
                  </li>
                  
                </ul>
              </li>
              <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown tasks-menu" id="li-online">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-users"></i>
                  <span  class="label label-success"><div id="numonline"></div></span>
                </a>
                <ul class="dropdown-menu">
                  
                  <li>
                    <!-- inner menu: contains the actual data -->
                  
                    <div class="lista_online"></div>
                  
               
              </li>
              
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo getAvatarUrl($ids); ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $fullname; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo getAvatarUrl($ids); ?>" class="img-circle" alt="User Image">
                <p>
                  <?php echo $fullname; ?> -<?php echo $u_cargo; ?>
                  <small>Member since <?php echo $u_ingreso; ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="perfilusuario.php?id=<?php echo $_SESSION['user_id']; ?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>