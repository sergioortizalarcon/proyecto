<div class="container content-wrapper">
	<section class="content-header">
      <h1>
        <i class="fas fa-film"></i>&nbsp;&nbsp;Registrar nueva película
      </h1>
    </section>
	<section class="content">
	<form id="idFormulario">
		<fieldset>
			<legend>Datos</legend>
			<label for="idTitulo">Titulo: </label>
			<input class="form-control" type="text" id="idTitulo" name="titulo" placeholder="título de la película.." />
				
			<label for="idFecha">Año</label>
			<input class="form-control" type="text" id="idFecha" name="fecha" placeholder="pincha para elegir fecha de estreno..." />

			<div class="form-group">
				   	<label for="nUsuario">Duración:</label><br>
				   	<input type="text" class="form-control" id="nUsuario" placeholder="nombre" name="nUsuario" data-toogle="tooltip" data-placement="left" title="Nick o correo electrónico"/>
			</div>

			<div class="form-group">
				<label for="idPais">Selecciona país</label><span class="obligatorio">*</span>
				<select class="form-control" name="pais" id="idPais"
				data-toogle="tooltip" data-placement="left" title="Selecciona tu país">
				<?php foreach ($paises as $pais): ?>
					<option value="<?=$pais->id?>" <?=($pais->nombre == "España") ? "selected='selected'" : " "?> >
						<?=$pais->nombre?></option>
				<?php endforeach;?>
				</select>
			</div>

			<div class="form-group">
				<label for="idReparto">Reparto:</label><br>
				<input type="text" class="form-control" id="idReparto" placeholder="nombre" name="idReparto" data-toogle="tooltip" data-placement="left" title="reparto de la pelicula"/>
			</div>

			<div class="form-group">
				<label for="nUsuario">Productora/<strong></strong>:</label><br>
				<input type="text" class="form-control" id="nUsuario" placeholder="nombre" name="nUsuario" data-toogle="tooltip" data-placement="left" title="#"/>
			</div>

			<div class="form-group">
				<label for="nUsuario">Géneros:</label><br>
				<!-- Form con filtro para buscar los géneros a añadir?¿ -->""
			</div>

			<div class="form-group">
				<label for="nUsuario">Sinopsis:</label><br>
				<input type="text" class="form-control" id="nUsuario" placeholder="nombre" name="nUsuario" data-toogle="tooltip" data-placement="left" title="Nick o correo electrónico"/>
			</div>

			<div class="form-group">
				<label for="nUsuario">Portada:</label><br>
				<input type="file" class="form-control" id="nUsuario" placeholder="nombre" name="nUsuario" data-toogle="tooltip" data-placement="left" title="Nick o correo electrónico"/>
			</div>

			<input type="button" class="btn btn-default" onclick="comprobar()" value="Enviar"/>
		</fieldset>
	</form>
	</section>
</div>