<style>
.sinp {
    width: 100%;
    height: 140px;
    border: 1px solid black;
    overflow: auto;
}
</style>
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
        <?php if(isset($body) && ($body['peliculas'] != null)):?>
        <div class="table-responsive">
        <table id="efectoTabla" class="display">
           <thead>
                <tr>
                    <th>Id Tmdb</th>
                    <th>Cartel</th>
                    <th>Título película</th>
                    <th>Título original</th>
                    <th>Fecha de estreno</th>
                    <th>Popularidad</th>
                    <th>Adulto</th>
                    <th>Nacionalidad</th>
                    <th>Productora</th>
                    <th>Sinopsis</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($body['peliculas'] as $pelicula): ?>
                    <?php if($pelicula -> activo != 'false'):?>
                        <tr>
                            <td><?=$pelicula->id_tmdb?></td>
                            <?php if($pelicula->ruta_cartel != 'null'): ?>
                            <td><img src="http://image.tmdb.org/t/p/w92<?= $pelicula->ruta_cartel ?>"></td>
                            <?php else: ?>
                            <td><img src="<?=base_url()?>/assets/img/images/image_notfound.png" width='96' height="138"></td>
                            <?php endif;?>
                            <td><?= $pelicula->titulo ?></td>
                            <td><?= $pelicula->titulo_original ?></td>
                            <td><?= $pelicula->fecha_lanzamiento ?></td>
                            <td><?= $pelicula->popularidad ?></td>
                            <td><?= $pelicula->adulto ?></td>
                            <td><?= $pelicula->pais ?></td>
                            <td><?= $pelicula->productora ?></td>
                            <td><div class="sinp"><?= $pelicula->sinopsis ?></div></td>
                            <td>
                                <form class="listado" id="idFormEdit<?= $pelicula->id ?>" action="<?=base_url()?>pelicula/editar" method="post">
                                    <input type="hidden" name="id_pelicula" value="<?= $pelicula -> id?>">
                                    <button class="btn btn-info btn-sm" onclick="function f() {document.getElementById('Borrar<?= $pelicula->id ?>').submit();}">
                                    <i class="fas fa-edit"></i>
                                    </button>
                                </form>
                                <form class="listado" id="idFormRemove<?= $pelicula->id ?>" action="<?=base_url()?>pelicula/borrarPost" method="post">
                                    <input type="hidden" name="id_pelicula" value="<?= $pelicula -> id?>">
                                    <input type="hidden" name="v" value="listarTodos">
                                    <button class="btn btn-warning btn-sm" onclick="function f() {document.getElementById('Editar<?= $pelicula->id ?>').submit();}">
                                    <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php else: ?>
                        <tr id="<?= $reparto->id ?>"onclick="mostrarFicha(this.id);" >
                             <td><img src="<?=base_url()?><?= $pelicula->rutaFoto ?>" height="60" width="50"></td>
                            <td><?= $pelicula->titulo ?></td>
                            <td><?= $pelicula->anioEstreno ?></td>
                            <td><?= $pelicula->pais ?></td>
                            <td><?= $pelicula->productora ?></td>
                            <td>
                                Inactivo
                                <form class="listado" id="idFormActive<?= $pelicula->id ?>" action="<?=base_url()?>pelicula/activarPost" method="post">
                                    <input type="hidden" name="id_pelicula" value="<?= $pelicula -> id?>">
                                    <input type="hidden" name="v" value="listarTodos">
                                    <button class="btn btn-warning btn-sm" onclick="function f() {document.getElementById('Activar<?= $pelicula->id ?>').submit();}">
                                        <i class="fas fa-plus-circle"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endif;?>
                <?php endforeach;?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Id Tmdb</th>
                    <th>Cartel</th>
                    <th>Título película</th>
                    <th>Título original</th>
                    <th>Fecha de estreno</th>
                    <th>Popularidad</th>
                    <th>Adulto</th>
                    <th>Nacionalidad</th>
                    <th>Productora</th>
                    <th>Sinopsis</th>
                    <th>Acciones</th>
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
<script type="text/javascript">
	function mostrarFicha(id) {
		window.location="<?= base_url() ?>pelicula/abrirFicha?id_pelicula="+id;
	}
</script>