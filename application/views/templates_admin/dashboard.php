<style>
  a.dash_info{
    color:white;
  }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fas fa-database"></i> Dashboard
        <small>Control panel</small>
      </h1>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                <a class="dash_info" href="<?=base_url()?>Pelicula/crear">
                  <h3><?php echo isset($peliculas)?$peliculas:"0" ?></h3>
                  <p>Agregar nueva película</p>
                <div class="icon">
                  <i class="fas fa-film"></i>
                </div>
                </a>
                </div>
                <a href="<?=base_url()?>Pelicula/listar" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
              </div>

            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-orange">
                <div class="inner">
                  <a class="dash_info" href="<?=base_url()?>Reparto/crear">
                  <h3><?php echo isset($reparto)?$reparto:"0"?></h3>
                  <p>Agregar a reparto</p>
                  <div class="icon">
                    <i class="fas fa-address-card"></i>
                  </div>
                  </a>
                </div>
                <a href="<?=base_url()?>Reparto/listar" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                <a class="dash_info" href="<?=base_url()?>Administrador/listar">
                  <h3><?php echo isset($usuarios)?$usuarios:"0"?></h3>
                  <p>Gestionar usuarios</p>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
              </a>
                </div>
                <a href="<?=base_url()?>Administrador/listar" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <a class="dash_info" href="<?=base_url()?>Pelicula/crear">
                  <h3><?php echo isset($profesion)?$profesion:"0"?></h3>
                  <p>Agregar nueva profesión</p>
                <div class="icon">
                  <i class="fas fa-people-carry"></i>
                </div>
              </a>
                </div>
                <a href="#" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-blue">
                <div class="inner">
                  <a class="dash_info" href="<?=base_url()?>Pais/crear">
                  <h3><?php echo isset($pais)?$pais:"0" ?></h3>
                  <p>Agregar nuevo país</p>
                  <div class="icon">
                    <i class="fas fa-globe"></i>
                  </div>
                  </a>
                </div>
                <a  href="<?=base_url()?>Pais/listar" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-gray">
                <div class="inner">
                  <a class="dash_info" href="<?=base_url()?>Genero/crear">
                  <h3><?php echo isset($genero)?$genero:"0" ?></h3>
                  <p>Agregar nuevo género</p>
                  <div class="icon">
                    <i class="far fa-folder-open"></i>
                  </div>
                  </a>
                </div>
                <a  href="<?=base_url()?>Genero/listar" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <a class="dash_info" href="<?= base_url()?>Idioma/crear">
                  <h3><?php echo isset($idioma)?$idioma:"0" ?></h3>
                  <p>Agregar nuevo idioma</p>
                <div class="icon">
                  <i class="fas fa-language"></i>
                </div>
              </a>
                </div>
                <a href="<?= base_url()?>Idioma/listar" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div>
    </section>
</div>