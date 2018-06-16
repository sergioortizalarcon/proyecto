<div class="container" id="vistaAdmin">
	<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">Menú administración</li>
            <li class="treeview">
              <a href="<?= base_url()?>">
                &nbsp;&nbsp;&nbsp;<i class="fas fa-database"></i>&nbsp;
                <span>Dashboard</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?=base_url()?>Pelicula/listar">
                &nbsp;&nbsp;&nbsp;<i class="fas fa-film"></i>&nbsp;
                <span>Películas</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?=base_url()?>Reparto/listar" >
                &nbsp;&nbsp;&nbsp;<i class="fas fa-address-card"></i>&nbsp;
                <span>Reparto</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?=base_url()?>Profesion/listar" >
                &nbsp;&nbsp;&nbsp;<i class="fas fa-people-carry"></i>&nbsp;
                <span>Profesiones</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?= base_url()?>Pais/listar" >
                &nbsp;&nbsp;&nbsp;<i class="fas fa-globe"></i>&nbsp;
                <span>Países</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?= base_url()?>genero/listar">
                &nbsp;&nbsp;&nbsp;<i class="far fa-folder-open"></i>&nbsp;
                <span>Géneros</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?= base_url()?>Idioma/listar">
                &nbsp;&nbsp;&nbsp;<i class="fas fa-language"></i>&nbsp;
                <span>Idiomas</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?= base_url()?>Administrador/listar">
                &nbsp;&nbsp;&nbsp;<i class="fa fa-users"></i>&nbsp;
                <span>Usuarios</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?=base_url()?>Administrador/vista_usuario" >&nbsp;&nbsp;&nbsp;<i class="fas fa-door-open"></i>&nbsp;
                <span>Vista usuario</span>
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
</div>