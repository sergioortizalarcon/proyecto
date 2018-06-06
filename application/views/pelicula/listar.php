<?php if ( isset($_SESSION['rol']) && ($_SESSION['rol'] == "administrador")):?>
  <div class="content-wrapper">
<?php else: ?>
  <div class="container content-wrapper">
<?php endif;?>
    <section class="content-header">
      <h1>
        <i class="fas fa-film"></i> Gestión de Películas
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
              <div class="form-group">
                <a class="btn btn-primary" href="<?= base_url()?>pelicula/crear">
                  <i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar más...</a>
            </div>
          </div>
      </div>
      <?php if(isset($body['peliculas'])):?>
        <div class="table-responsive">
        <table id="evd" class="table table-striped">
          <thead>
          <tr>
            <th>Nombre película</th>
            <th>Fecha de estreno</th>
            <th>Nacionalidad</th>
          </tr>
          </thead>
          <tbody>
          <?php foreach ($body['peliculas'] as $pelicula): ?>
            <tr>
              <td><?= $pelicula->nombre ?></td>
              <td><?= $pelicula->fecha_nacimiento ?></td>
              <td><?= $pelicula->nacionalidad ?></td>
              <td>
                <form id="idFormedit" action="<?=base_url()?>director/editar" method="post">
                  <input type="hidden" name="id_pais" value="<?= $director -> id?>">
                  <button class="btn btn-info btn-sm" onclick="function f() {document.getElementById('idFormEdit').submit();}">
                    <i class="fas fa-edit"></i>
                  </button>
                </form>
              </td>
              <td>
                <form id="idFormRemove" action="<?=base_url()?>director/borrarPost" method="post">
                  <input type="hidden" name="id_director" value="<?= $director -> id?>">
                  <input type="hidden" name="v" value="listarTodos">
                  <button class="btn btn-warning btn-sm" onclick="function f() {document.getElementById('idFormRemove').submit();}">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
          <?php endforeach;?>
          </tbody>
          <tfoot>
          <tr>
                <th>Nombre película</th>
            <th>Fecha de estreno</th>
            <th>Nacionalidad</th>
          </tr>
              </tfoot>
      </table>
    </div>
    <?php else:?>
      <div class="container" style="width:90%;">
        <h2 class="alert alert-info" style="font-size: x-large;">¡ATENCIÓN!</h2>
        <div class="well">
           <div class="alert alert-warning">
          <strong>¡ADVERTENCIA!</strong> No hay películas en la base de datos, o no se han podido cargar
        </div>
        </div>
      </div>
    <?php endif; ?>
  </section>
</div>