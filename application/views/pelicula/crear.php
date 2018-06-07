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

<script type="text/javascript">
function serialize(form){if(!form||form.nodeName!=="FORM"){return }var i,j,q=[];for(i=form.elements.length-1;i>=0;i=i-1){if(form.elements[i].name===""){continue}switch(form.elements[i].nodeName){case"INPUT":switch(form.elements[i].type){case"text":case"hidden":case"password":case"button":case"reset":case"submit":case"color":case"date":case"datetime-local":case"email":case"month":case"number":case"range":case"search":case"tel":case"time":case"url":case"week":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"checkbox":case"radio":if(form.elements[i].checked){q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value))}break;case"file":break}break;case"TEXTAREA":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"SELECT":switch(form.elements[i].type){case"select-one":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"select-multiple":for(j=form.elements[i].options.length-1;j>=0;j=j-1){if(form.elements[i].options[j].selected){q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].options[j].value))}}break}break;case"BUTTON":switch(form.elements[i].type){case"reset":case"submit":case"button":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break}break}}return q.join("&")};
</script>
<script type="text/javascript">
var correcto = true;
var tituloCorrecto = false;
var anioCorrecto = false;
var duracionCorrecto = false;
var productoraCorrecto = false;

var titulo="";
var anio = "";
var duracion = "";
var productora = "";

function validarTitulo() {
	titulo = idFormulario.idTitulo.value.trim();
	if (titulo != "") {

		var expReg = /^[a-zA-Z ñÑáéíóúÁÉÍÓÚ0-9]{2,40}$/;
		if (expReg.test(titulo)){
			tituloCorrecto = true;
			correcto=true;
			idFormulario.idTitulo.style.borderColor="blue";
			document.getElementById("aTitulo").style.display="none";
		} else {
			idFormulario.idTitulo.style.borderColor="red";
			document.getElementById("aTitulo").style.display="initial";
			if (correcto == true) {
				document.getElementById('aTitulo').focus();
				correcto=false;
			}
			tituloCorrecto = false;
		}
	} else {
		if (correcto == true) {
			document.getElementById('aTitulo').focus();
			correcto=false;
		}
		document.getElementById("aTitulo").style.display="initial";
        idFormulario.idTitulo.style.borderColor="red";
        tituloCorrecto = false;
	}
}

function validarAnio() {
	var anio = idFormulario.idAnio.value;
	var fechaSis = new Date();
	var anioActual = fechaSis.getFullYear();
	if (anio != "") {
		if (anio.length == 4 && anio > 1888 && anio <= anioActual) {
			anioCorrecto = true;
			correcto=true;
			idFormulario.idAnio.style.borderColor="blue";
			document.getElementById("aAnio").style.display="none";
		} else {
			idFormulario.idAnio.style.borderColor="red";
			document.getElementById("aAnio").style.display="initial";
			if (correcto == true) {
				document.getElementById('aAnio').focus();
				correcto=false;
			}
			anioCorrecto = false;
		}
	} else {
		if (correcto == true) {
			document.getElementById('aAnio').focus();
			correcto=false;
		}
		document.getElementById("aAnio").style.display="initial";
        idFormulario.idAnio.style.borderColor="red";
        anioCorrecto = false;
	}
}

function validarDuracion() {
	var duracion = idFormulario.idDuracion.value.trim();
	var ExpReg = /^[0-9]{2,3}$/;

	if (duracion != "") {
		if (ExpReg.test(duracion)) {
			duracionCorrecto = true;
			correcto=true;
			idFormulario.idDuracion.style.borderColor="blue";
			document.getElementById("aDuracion").style.display="none";
		} else {
			idFormulario.idDuracion.style.borderColor="red";
			document.getElementById("aDuracion").style.display="initial";
			if (correcto == true) {
				document.getElementById('aDuracion').focus();
				correcto=false;
			}
			duracionCorrecto = false;
		}
	} else {
		if (correcto == true) {
			document.getElementById('aDuracion').focus();
			correcto=false;
		}
		document.getElementById("aDuracion").style.display="initial";
        idFormulario.idDuracion.style.borderColor="red";
        duracionCorrecto = false;
	}	
}

function validarProductora() {
	productora = idFormulario.idProductora.value.trim();
	if (productora != "") {

		var expReg = /^[a-zA-Z ñÑáéíóúÁÉÍÓÚ/d]{2,40}$/;
		if (expReg.test(productora)){
			productoraCorrecto = true;
			correcto=true;
			idFormulario.idProductora.style.borderColor="blue";
			document.getElementById("aProductora").style.display="none";
		} else {
			idFormulario.idProductora.style.borderColor="red";
			document.getElementById("aProductora").style.display="initial";
			if (correcto == true) {
				document.getElementById('aProductora').focus();
				correcto=false;
			}
			productoraCorrecto = false;
		}
	} else {
		if (correcto == true) {
			document.getElementById('aProductora').focus();
			correcto=false;
		}
		document.getElementById("aProductora").style.display="initial";
        idFormulario.idProductora.style.borderColor="red";
        productoraCorrecto = false;
	}
}

function permitirEnvio() {
	if (tituloCorrecto && anioCorrecto && duracionCorrecto && productoraCorrecto) {
		idFormulario.idRegistro.disabled=false;
	}
}

function validar() {
	if (tituloCorrecto && anioCorrecto && duracionCorrecto && productoraCorrecto) {
		titulo = idFormulario.idTitulo.value.trim();
		idFormulario.idTitulo.value = titulo;
		productora = idFormulario.idProductora.value.trim();
		idFormulario.idProductora.value = productora;
		if (idFormulario.idReparto.value == "") {
			if (confirm("¿Quieres guardar el formulario sin reparto?(Se pueden añadir después)")) {
				idFormulario.submit();
			}
		} else {
			idFormulario.submit();
		}
	} else {
		validarTitulo();
		validarAnio();
		validarDuracion();
		validarProductora();
	}
}

function cancelarRegistro(){
	var cancelarRegistro = confirm("¿Realmente quieres cancelar el registro?");

	if (cancelarRegistro) {
		window.location.href = "<?=base_url()?>pelicula/listar";
	}
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
	<form id="idFormulario" onchange="permitirEnvio();" name="idFormulario" action="<?= base_url()?>pelicula/crearPost" method="post" enctype="multipart/form-data">
		<fieldset>
			<legend>Datos</legend>
			<small style="float:right;"> (<span class="obligatorio">*</span> Campos obligatorios)</small>
			
			<div class="form-group">
				<label for="idTitulo">Titulo: </label><span class="obligatorio">*</span>
				<input class="form-control" type="text" id="idTitulo" name="titulo" placeholder="Título de la película.."
				 onkeyup="validarTitulo();"  data-toogle="tooltip" data-placement="left" title="Escribe un título""/>
				<span class="avisos" id="aTitulo">
					Debes escribir un nombre válido(3 a 40 caracteres).
				</span>
			</div>	
				
			<div class="form-group">
				<label for="idAnio">Año del estreno:</label><span class="obligatorio">*</span>
				<input class="form-control" type="number" id="idAnio" name="anioEstreno"
				onchange="validarAnio();" placeholder="Pincha para elegir año de estreno..." />
				<span class="avisos" id="aAnio">
					Debes introducir una año entre 1888 y el actual.
				</span>
			</div>

			<div class="form-group">
				<label for="idDuracion">Duración (en minutos):</label><span class="obligatorio">*</span>
				<input type="text" class="form-control" id="idDuracion" placeholder="Duración..."
				onKeyUp="validarDuracion();" name="duracion" data-toogle="tooltip" data-placement="left" title="Nick o correo electrónico"/>
				<span class="avisos" id="aDuracion">
					Debes introducir una duración válida en minutos.
				</span>
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
				<label for="idReparto">Reparto:</label><span class="obligatorio">*</span>
				<input type="text" class="form-control" id="idReparto" placeholder="Reparto..." name="idReparto" data-toogle="tooltip" data-placement="left" title="reparto de la pelicula"/>
			</div>

			<div class="form-group">
				<label for="idProductora">Productora:</label><span class="obligatorio">*</span>
				<input type="text" class="form-control" id="idProductora" placeholder="Productora..."
				onKeyUp="validarProductora();" name="productora" data-toogle="tooltip" data-placement="left" title="#"/>
				<span class="avisos" id="aProductora">
					Debes escribir un nombre válido(3 a 20 caracteres).
				</span>
			</div>

			<div class="form-group">
				<label for="idGenero">Género</label><span class="obligatorio">*</span>
				<select multiple class="form-control" id="idGenero" name="genero[]"
				data-toogle="tooltip" data-placement="left" title="Selecciona el género" size="5">
					<?php foreach($generos as $genero):?>
						<option value="<?=$genero -> nombre?>"><?= $genero->nombre?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="form-group">
				<label for="idSinopsis">Sinopsis:</label>
				<textarea class="form-control" name="sinopsis" id="idSinopsis" placeholder="Sinopsis..."></textarea>
			</div>

			<div class="form-group">
				<label for="idFotoPoster">Portada:</label>
				<input type="file" class="form-control" id="idFotoPoster" name="fotoPoster" data-toogle="tooltip" />
    			<span class="avisos" id="aFotoPoster">
    				Debes introducir una foto con formato y tamaño correcto.
    			</span><br/>
    			<div id="list"></div>
			</div>

			<div class="nav navbar-form navbar-right">
				<input type="button" class="btn btn-default" id="idCancelar" name="cancelar" value="Cancelar registro" onclick="cancelarRegistro();" />
				<input type="button" class="btn btn-default" id="idRegistro" name="registrarPelicula" disabled="true" value="Registrar película" onclick="validar();" />
			</div>
		</fieldset>
	</form>
	</section>
</div>
<script>
	function archivo(evt) {
      	var files = evt.target.files; // FileList object
                 
      	// Obtenemos la imagen del campo "file".
    	for (var i = 0, f; f = files[i]; i++) {
    	//Solo admitimos imágenes.
        	if (!f.type.match('image.*')) {
            	continue;
            }
                     
            var reader = new FileReader();
                     
            reader.onload = (function(theFile) {
                return function(e) {
                  	// Insertamos la imagen
                 	document.getElementById("list").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                };
        	})(f);
                     
            reader.readAsDataURL(f);
      	}
  	}
             
  	document.getElementById('idFotoPoster').addEventListener('change', archivo, false);
</script>