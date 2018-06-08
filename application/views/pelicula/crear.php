	<script type="text/javascript">
function serialize(form){if(!form||form.nodeName!=="FORM"){return }var i,j,q=[];for(i=form.elements.length-1;i>=0;i=i-1){if(form.elements[i].name===""){continue}switch(form.elements[i].nodeName){case"INPUT":switch(form.elements[i].type){case"text":case"hidden":case"password":case"button":case"reset":case"submit":case"color":case"date":case"datetime-local":case"email":case"month":case"number":case"range":case"search":case"tel":case"time":case"url":case"week":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"checkbox":case"radio":if(form.elements[i].checked){q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value))}break;case"file":break}break;case"TEXTAREA":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"SELECT":switch(form.elements[i].type){case"select-one":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"select-multiple":for(j=form.elements[i].options.length-1;j>=0;j=j-1){if(form.elements[i].options[j].selected){q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].options[j].value))}}break}break;case"BUTTON":switch(form.elements[i].type){case"reset":case"submit":case"button":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break}break}}return q.join("&")};
</script>
	<script>
		var xhr;
		var keyPi = 'api_key=d6c1959156d6a00119e929d60865c6d3';
		idioma = 'language=es';
		function carga() {
			//Si guarda cambiar submit por function con ajax q vaya subiendo los datos al terminar de cargar cada form completo
			var uri = 'https://api.themoviedb.org/3/discover/movie';
			var data = "{}";
			xhr = new XMLHttpRequest();
			xhr.open('GET',uri+'?'+keyPi+"&"+idioma+'&page=1');
			xhr.send(data);
			xhr.onreadystatechange=function(){
				if (xhr.readyState==this.DONE) {
					valores = JSON.parse(this.responseText);
				
					console.log(valores)
					
					var raiz_pelis = "http://image.tmdb.org/t/p/w185";
					mostrar = document.getElementById("mostrarInfo");
					vendetta = valores.results;

					var claves = ['id','title','original_title','poster_path','popularity','release_date','adult','overview','genre_ids'];
					var salto = document.createElement('br');
					var boton = document.createElement('input');
					boton.setAttribute('type','submit');
					boton.setAttribute('value','enviar');
					for (var i = 0; i < vendetta.length; i++) {
						v = vendetta[i];
						var formi = document.createElement("form");
						formi.setAttribute('name','idFormulario');
						formi.setAttribute('id','idFormulario');
						formi.setAttribute('action',"<?=base_url()?>pelicula/crearPost");
						formi.setAttribute('method','post');
						for(var key in v) {
							if(claves.includes(key)){
								if (key == 'genre_ids') {
									var sel = document.createElement("select");
									sel.setAttribute('name','genre[]');
									sel.setAttribute("id","genre"+v['id']);
									sel.setAttribute('multiple','multiple');
									formi.appendChild(sel);
									for (var r = 0; r < v[key].length; r++) {
										var option = document.createElement("option");
										option.setAttribute("selected","selected");
										var t = document.createTextNode(v[key][r]);
										option.appendChild(t);
										sel.appendChild(option);
									}
									formi.appendChild(salto);
								} else if(key == 'overview') {
									var textarea = document.createElement("textarea");
									textarea.setAttribute('name',key);
									textarea.setAttribute("id",key+v['id']);
									textarea.setAttribute('rows','6');
									textarea.setAttribute('cols','100');
									var t = document.createTextNode(v[key]);
									textarea.appendChild(t);
									formi.appendChild(textarea);
									formi.appendChild(salto);
								} else {
									var input = document.createElement('input');
									input.setAttribute('type','text');
									input.setAttribute('id',key+v['id'])
									input.setAttribute('name',key);
									input.setAttribute('size','70');
									input.setAttribute('value',v[key]);
									formi.appendChild(input);
									formi.appendChild(salto);
								}
							formi.appendChild(salto);
							formi.appendChild(salto);
							formi.appendChild(boton);
							}
						}
						document.body.appendChild(formi);
						document.getElementById('idFormulario').submit();
					}
				}
			}
			}
		
		function inferno() {
			var datosSerializados = serialize(document.getElementById("idFormulario"));
			xhr.open("GET", "<?=base_url()?>pelicula/crearPost?" + datosSerializados, true);
			xhr.send();
		}

/*
EJEMPLO DE RELACION MUCHOS A MUCHOS
		foreach ($ids_lp as $id_lp) {
			$empleado->sharedLpList[] = R::load('lp',$id_lp);
		}
		R::store($ciudad);
		R::close();
*/
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
	<form id="idFormularioy">
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