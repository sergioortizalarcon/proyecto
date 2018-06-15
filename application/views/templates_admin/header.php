<div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="<?=base_url()?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"> <b>A</b>dmin </span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"> <b>Watch</b> vision </span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <i class="fas fa-bars"></i>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url(); ?>assets/a_style/dist/img/avatar.png" class="user-image" alt="User Image"/>
                  <span><b>Administrador del sistema</b></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo base_url(); ?>assets/a_style/dist/img/avatar.png" class="img-circle" alt="User Image" />
                    <p>
                      <?=$_COOKIE["usuario"]?>
                      <small><?= $_SESSION['rol'] ?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?=base_url()?>usuario/perfilUsuario" class="btn btn-default btn-flat">
                        <i class="far fa-user-circle"></i>&nbsp;&nbsp;Acceder a perfil</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?=base_url()?>login/loginOut" class="btn btn-default btn-flat">
                      <i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;Salir</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>