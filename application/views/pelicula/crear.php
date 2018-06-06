<script>
	function carga() {
		var xhr;
		var keyPi = 'api_key=d6c1959156d6a00119e929d60865c6d3';
		idioma = 'language=es';
			var ver = document.getElementById('idInfo').value;
			//cambiar 
			var u2 = 'https://api.themoviedb.org/3/search/person';
			var u1 = 'https://api.themoviedb.org/3/search/movie';
			//&query=deadpool  <--Para buscar películas
				var data = "{}";
				var xhr = new XMLHttpRequest();
				xhr.open("GET",u2+'?'+keyPi+'&query='+ver+"&"+idioma);
				xhr.send(data);
				xhr.addEventListener("readystatechange", function () {
					if (this.readyState === this.DONE) {
						    valores = JSON.parse(this.responseText);
							mostrarInfo.innerHTML="<xmp><pre><code>"+this.responseText+"</code></pre><br/></xmp>";
							console.log(valores);
							mostrarInfo.innerHTML+=valores['page']+"<br>";
							mostrarInfo.innerHTML+= valores.results[0].popularity+"<br>";
							mostrarInfo.innerHTML+= valores.results[0].known_for[0].vote_average+"<br>";
							mostrarInfo.innerHTML+= valores.results[0].known_for[0].title+"<br>";
							console.log(valores.results);
					}
				});

				document.getElementById("mostrarInfo").innerHTML=xhr.responseText;
			}
</script>

<div class="container content-wrapper">
	<section class="content-header">
      <h1>
        <i class="fas fa-film"></i>&nbsp;&nbsp;Registrar nueva película
      </h1>
    </section>
	<section class="content">
		<div class="filtro">
			<form action="">
				<label for="idInfo">N: </label><input type="text" id="idInfo" placeholder="nombre peli"/><br/>
				<input type="button" value="cargar" onclick="carga();">
			</form>
		</div>
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