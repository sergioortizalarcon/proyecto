<div class="container">
	<form id="idFormulario">
		<fieldset>
			<legend>Agregar nueva película</legend>
			
			<div class="form-group">
    			<label for="idTitulo">Titulo: </label>
    			<input class="form-control" type="text" placeholder="título" id="idTitulo" name="titulo" />
			</div>
			
			<div class="form-group">
    			<label for="idFecha">Año</label>
    			<input class="form-control" type="month" id="idFecha" name="fechaEstreno" />
			</div>

			<div class="form-group">
				<label for="idDuracion">Duración:</label><br>
				<input type="text" class="form-control" id="idDuracion" placeholder="duración" name="duracion" data-toogle="tooltip" data-placement="left" title="Nick o correo electrónico"/>
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
				<label for="idDirector">Director:</label><br>
				<input type="text" class="form-control" id="idDirector" placeholder="nombre" name="director" data-toogle="tooltip" data-placement="left" title="Director de la pelicula"/>
			</div>

			<div class="form-group">
				<label for="idReparto">Reparto:</label><br>
				<input type="text" class="form-control" id="idReparto" placeholder="nombre" name="idReparto" data-toogle="tooltip" data-placement="left" title="Reparto de la pelicula"/>
			</div>

			<div class="form-group">
				<label for="idProductora">Productora/<strong></strong>:</label><br>
				<input type="text" class="form-control" id="idProductora" placeholder="nombre" name="productora" data-toogle="tooltip" data-placement="left" title="Productora de la película"/>
			</div>

			<div class="form-group">
				<label for="idGenero">Géneros:</label><br>
				<!-- Form con filtro para buscar los géneros a añadir?¿ ""-->
				<select class="form-control" name="genero" id="idGenero"
				data-toogle="tooltip" data-placement="left" title="Selecciona los géneros">
				<?php foreach ($generos as $genero): ?>
					<option value="<?=$genero->id?>">
						<?=$genero->nombre?></option>
				<?php endforeach;?>
				</select>
			</div>

			<div class="form-group">
				<label for="idSinopsis">Sinopsis:</label><br>
				<input type="text" class="form-control" id="idSinopsis" placeholder="sinopsis" name="sinopsis" data-toogle="tooltip" data-placement="left" title="Sinopsis de la película"/>
			</div>

			<div class="form-group">
				<label for="nUsuario">Portada:</label><br>
				<input type="file" class="form-control" id="nUsuario" placeholder="nombre" name="nUsuario" data-toogle="tooltip" data-placement="left" title="Nick o correo electrónico"/>
			</div>

			<input type="button" class="btn btn-default" onclick="comprobar()" value="Enviar"/>
		</fieldset>
	</form>
</div>