	<script type="text/javascript">
function serialize(form){if(!form||form.nodeName!=="FORM"){return }var i,j,q=[];for(i=form.elements.length-1;i>=0;i=i-1){if(form.elements[i].name===""){continue}switch(form.elements[i].nodeName){case"INPUT":switch(form.elements[i].type){case"text":case"hidden":case"password":case"button":case"reset":case"submit":case"color":case"date":case"datetime-local":case"email":case"month":case"number":case"range":case"search":case"tel":case"time":case"url":case"week":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"checkbox":case"radio":if(form.elements[i].checked){q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value))}break;case"file":break}break;case"TEXTAREA":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"SELECT":switch(form.elements[i].type){case"select-one":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"select-multiple":for(j=form.elements[i].options.length-1;j>=0;j=j-1){if(form.elements[i].options[j].selected){q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].options[j].value))}}break}break;case"BUTTON":switch(form.elements[i].type){case"reset":case"submit":case"button":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break}break}}return q.join("&")};
</script>
	<script>

		var xhr;
		var keyPi = 'api_key=d6c1959156d6a00119e929d60865c6d3';
		idioma = 'language=es';

		Element.prototype.remove = function() {
    this.parentElement.removeChild(this);
}
NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
    for(var i = this.length - 1; i >= 0; i--) {
        if(this[i] && this[i].parentElement) {
            this[i].parentElement.removeChild(this[i]);
        }
    }
}
		function carga() {
			//Si guarda cambiar submit por function con ajax q vaya subiendo los datos al terminar de cargar cada form completo
			var pagina = document.getElementById("idInfo").value;
			var uri = 'https://api.themoviedb.org/3/discover/movie';
			var data = "{}";
			xhr = new XMLHttpRequest();
			xhr.open('GET',uri+'?'+keyPi+"&"+idioma+'&page='+pagina);
			xhr.send(data);
			xhr.onreadystatechange=function(){
				if (xhr.readyState==this.DONE) {
					valores = JSON.parse(this.responseText);
					var raiz_pelis = "http://image.tmdb.org/t/p/w185";
					mostrar = document.getElementById("mostrarInfo");
					vendetta = valores.results;
					console.log(valores.results);
					var claves = ['id','title','original_title','poster_path','popularity','release_date','adult','overview','genre_ids'];
					for (var i = 0; i < vendetta.length; i++) {
						v = vendetta[i];
						var nombre="idFormi"+i;
						var formi = document.createElement("form");
						formi.setAttribute('name','idFormi');
						formi.setAttribute('id',nombre);
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
								} else if(key == 'overview') {
									var textarea = document.createElement("textarea");
									textarea.setAttribute('name',key);
									textarea.setAttribute("id",key+v['id']);
									textarea.setAttribute('rows','6');
									textarea.setAttribute('cols','100');
									var t = document.createTextNode(v[key]);
									textarea.appendChild(t);
									formi.appendChild(textarea);
								} else {
									var valor = v[key];
									if (key == 'adult') {
										if (valor == 'false') {
											valor = "No";
										} else {
											valor = "Sí";
										}
									}
									var input = document.createElement('input');
									input.setAttribute('type','text');
									input.setAttribute('id',key+v['id'])
									input.setAttribute('name',key);
									input.setAttribute('size','70');
									input.setAttribute('value',valor);
									formi.appendChild(input);
								}
							}
						}
						document.body.appendChild(formi);
						inferno(nombre);
					}
				}
				var list = document.getElementsByName("idFormi");
			    for (var i = 0; i < list.length; i++) {
					list.remove();
				}
			}
		}
		
		function inferno(nombre) {
			var datosSerializados = serialize(document.getElementById(nombre));
			xhr.open("POST", "<?=base_url()?>pelicula/crearPostdb?" + datosSerializados, true);
			xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xhr.send(datosSerializados);
		}
	</script>
<!--
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
		if (anio.length == 4 && anio >= 1888 && anio <= anioActual) {
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
-->
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
				<select multiple class="form-control" id="idReparto" name="reparto[]"
				data-toogle="tooltip" data-placement="left" title="Selecciona la persona" size="5">
					<?php foreach($repartos as $reparto):?>
						<option value="<?=$reparto -> id?>" <?=($reparto -> id == "1")?"selected='selected'":" "?>"><?= $reparto->nombre ?> <?= $reparto->apellido1?></option>
					<?php endforeach; ?>
				</select>
			</div>
			
			<input type="hidden" value="Activo" name="estado" />

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
						<option value="<?=$genero -> id?>" <?=($genero -> id == "1")?"selected='selected'":" "?>"><?= $genero->nombre?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="form-group">
				<label for="idSinopsis">Sinopsis:</label>
				<textarea class="form-control" name="sinopsis" id="idSinopsis" placeholder="Sinopsis..."></textarea>
			</div>

			<div class="form-group">
				<label for="idFotoPoster">Cartel:</label>
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