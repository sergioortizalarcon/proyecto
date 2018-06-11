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
              <a href="<?=base_url()?>pelicula/listar">
                &nbsp;&nbsp;&nbsp;<i class="fas fa-film"></i>&nbsp;
                <span>Películas</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?=base_url()?>actor/listar" >
                &nbsp;&nbsp;&nbsp;<i class="fas fa-address-card"></i>&nbsp;
                <span>Cast Películas</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?=base_url()?>director/listar">
                &nbsp;&nbsp;&nbsp;<i class="fas fa-user-tie"></i>&nbsp;
                <span>Directores</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?= base_url()?>pais/listar" >
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
              <a href="<?= base_url()?>idioma/listar">
                &nbsp;&nbsp;&nbsp;<i class="fas fa-language"></i>&nbsp;
                <span>Idiomas</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?= base_url()?>administrador/listar">
                &nbsp;&nbsp;&nbsp;<i class="fa fa-users"></i>&nbsp;
                <span>Usuarios</span>
              </a>
            </li>
            <li class="treeview">
              <a href="#" >&nbsp;&nbsp;&nbsp;<i class="fas fa-door-open"></i>&nbsp;
                <span>Vista usuario</span>
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
</div>