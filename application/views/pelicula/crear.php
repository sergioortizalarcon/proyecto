	<script type="text/javascript">
function serialize(form){if(!form||form.nodeName!=="FORM"){return }var i,j,q=[];for(i=form.elements.length-1;i>=0;i=i-1){if(form.elements[i].name===""){continue}switch(form.elements[i].nodeName){case"INPUT":switch(form.elements[i].type){case"text":case"hidden":case"password":case"button":case"reset":case"submit":case"color":case"date":case"datetime-local":case"email":case"month":case"number":case"range":case"search":case"tel":case"time":case"url":case"week":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"checkbox":case"radio":if(form.elements[i].checked){q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value))}break;case"file":break}break;case"TEXTAREA":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"SELECT":switch(form.elements[i].type){case"select-one":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"select-multiple":for(j=form.elements[i].options.length-1;j>=0;j=j-1){if(form.elements[i].options[j].selected){q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].options[j].value))}}break}break;case"BUTTON":switch(form.elements[i].type){case"reset":case"submit":case"button":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break}break}}return q.join("&")};
</script>
	<script>

		var xhr;
		var keyPi = 'api_key=d6c1959156d6a00119e929d60865c6d3';
		idioma = 'language=es&include_adult=true';

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
					mostrar = document.getElementById("mostrarInfo");
					vendetta = valores.results;
					console.log(valores.results);
					var claves = ['id','title','original_title','poster_path','popularity','release_date','adult','original_language','overview','genre_ids'];
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
										if (valor == false) {
											valor = "No";
										} else if(valor == true) {
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
						var input2 = document.createElement('input');
									input2.setAttribute('type','text');
									input2.setAttribute('id','media_votos_totales'+i);
									input2.setAttribute('name','media_votos_totales');
									input2.setAttribute('size','70');
									input2.setAttribute('value',0);
									formi.appendChild(input2);
						var input3 = document.createElement('input');
									input3.setAttribute('type','text');
									input3.setAttribute('id','votos_totales'+i);
									input3.setAttribute('name','votos_totales');
									input3.setAttribute('size','70');
									input3.setAttribute('value',0);
									formi.appendChild(input3);
						var input31 = document.createElement('input');
									input31.setAttribute('type','text');
									input31.setAttribute('id','suma_total_votos'+i);
									input31.setAttribute('name','suma_total_votos');
									input31.setAttribute('size','70');
									input31.setAttribute('value',0);
									formi.appendChild(input31);
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

<script type="text/javascript">
var correcto = true;
var tituloCorrecto = false;
var tituloOriginalCorrecto = false;
var fechaCorrecto = false;
var lenguageCorrecto = false;

var titulo="";
var titulooriginal="";
var lenguage="";

function validarTitulo() {
	titulo = idFormulario.idTitulo.value.trim();
	if (titulo != "") {

		var expReg = /^[a-zA-Z-: ñÑáéíóúÁÉÍÓÚ0-9]{2,40}$/;
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

function validarTituloOriginal() {
	tituloOriginal = idFormulario.idTituloOriginal.value.trim();
	if (tituloOriginal != "") {

		var expReg = /^[a-zA-Z-: ñÑáéíóúÁÉÍÓÚ0-9]{2,40}$/;
		if (expReg.test(tituloOriginal)){
			tituloOriginalCorrecto = true;
			correcto=true;
			idFormulario.idTituloOriginal.style.borderColor="blue";
			document.getElementById("aTituloOriginal").style.display="none";
			tituloOriginalCorrecto = true;
		} else {
			idFormulario.idTituloOriginal.style.borderColor="red";
			document.getElementById("aTituloOriginal").style.display="initial";
			if (correcto == true) {
				document.getElementById('aTituloOriginal').focus();
				correcto=false;
			}
			tituloOriginalCorrecto = false;
		}
	} else {
		if (correcto == true) {
			document.getElementById('aTituloOriginal').focus();
			correcto=false;
		}
		document.getElementById("aTituloOriginal").style.display="initial";
        idFormulario.idTituloOriginal.style.borderColor="red";
        tituloOriginalCorrecto = false;
	}
}

function validarFecha(){
    var patron=new RegExp("^(19|20)+([0-9]{2})([/])([0-9]{1,2})([/])([0-9]{1,2})$");
    var fecha = idFormulario.idFecha.value.trim();
	var fechaSeparada = fecha.split("/");
    var anio = parseInt(fechaSeparada[0]);
    var mes = parseInt(fechaSeparada[1]);
	var dia = parseInt(fechaSeparada[2]);
	mes = mes-1;

    var fechaSis = new Date();
	
	idFormulario.idFecha.value=fechaSeparada[0] + "/" + fechaSeparada[1] + "/" + fechaSeparada[2];
	if (anio > fechaSis.getFullYear()) {
		idFormulario.idFecha.style.borderColor="red";
		document.getElementById("aFecha").style.display="initial";
		if (correcto == true) {
			document.getElementById('aFecha').focus();
			correcto=false;
		}
		fechaCorrecto = false;
	} else if(anio == fechaSis.getFullYear() && mes > fechaSis.getMonth()) {
		idFormulario.idFecha.style.borderColor="red";
		document.getElementById("aFecha").style.display="initial";
		if (correcto == true) {
			document.getElementById('aFecha').focus();
			correcto=false;
		}
		fechaCorrecto = false;
	} else if (anio == fechaSis.getFullYear() && mes == fechaSis.getMonth() && dia > fechaSis.getDate()) {
		idFormulario.idFecha.style.borderColor="red";
		document.getElementById("aFecha").style.display="initial";
		if (correcto == true) {
			document.getElementById('aFecha').focus();
			correcto=false;
		}
		fechaCorrecto = false;
	} else {
		fechaCorrecto = true;
		correcto=true;
		idFormulario.idFecha.style.borderColor="blue";
		document.getElementById("aFecha").style.display="none";
	}
}

function validarLenguage() {
	lenguage = idFormulario.idLenguage.value.trim();
	lenguage = lenguage.toLowerCase();
	if (lenguage != "") {

		var expReg = /^[a-z]{2}$/;
		if (expReg.test(lenguage)){
			lenguageCorrecto = true;
			correcto=true;
			idFormulario.idLenguage.style.borderColor="blue";
			document.getElementById("aLenguage").style.display="none";
		} else {
			idFormulario.idLenguage.style.borderColor="red";
			document.getElementById("aLenguage").style.display="initial";
			if (correcto == true) {
				document.getElementById('aLenguage').focus();
				correcto=false;
			}
			lenguageCorrecto = false;
		}
	} else {
		if (correcto == true) {
			document.getElementById('aLenguage').focus();
			correcto=false;
		}
		document.getElementById("aLenguage").style.display="initial";
        idFormulario.idLenguage.style.borderColor="red";
        lenguageCorrecto = false;
	}
}

function permitirEnvio() {
	if (tituloCorrecto && tituloOriginalCorrecto && fechaCorrecto && lenguageCorrecto) {
		idFormulario.idRegistro.disabled=false;
	}
}

function validar() {
	if (tituloCorrecto && tituloOriginalCorrecto && fechaCorrecto && lenguageCorrecto) {
		titulo = idFormulario.idTitulo.value.trim();
		idFormulario.idTitulo.value = titulo;
		tituloOriginal = idFormulario.idTituloOriginal.value.trim();
		idFormulario.idTituloOriginal.value = tituloOriginal;
		lenguage = idFormulario.idLenguage.value.trim();
		lenguage = lenguage.toLowerCase();
		idFormulario.idLenguage.value = lenguage;
		if (idFormulario.idRepartoDirector.value == "" || idFormulario.idRepartoActor.value == "") {
			if (confirm("¿Quieres guardar el formulario sin actores o director?(Se pueden añadir después)")) {
				idFormulario.submit();
			}
		} else {
			idFormulario.submit();
		}
	} else {
		validarTitulo();
		validarTituloOriginal();
		validarFecha();
		validarLenguage();
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
				<label for="idAdulto">¿Adulto? </label>
				<input type="checkbox" id="idAdulto" value="Si" name="adulto" />
			</div>
			
			<div class="form-group">
				<label for="idTitulo">Titulo: </label><span class="obligatorio">*</span>
				<input class="form-control" type="text" id="idTitulo" name="titulo" placeholder="Título de la película.."
				 onkeyup="validarTitulo();"  data-toogle="tooltip" data-placement="left" title="Escribe un título""/>
				<span class="avisos" id="aTitulo">
					Debes escribir un nombre válido(3 a 40 caracteres).
				</span>
			</div>
			
			<div class="form-group">
				<label for="idTituloOriginal">Titulo original: </label><span class="obligatorio">*</span>
				<input class="form-control" type="text" id="idTituloOriginal" name="tituloOriginal" placeholder="Título de la película.."
				 onkeyup="validarTituloOriginal();"  data-toogle="tooltip" data-placement="left" title="Escribe un título""/>
				<span class="avisos" id="aTituloOriginal">
					Debes escribir un nombre válido(3 a 40 caracteres).
				</span>
			</div>
				
			<div class="form-group">
				<label for="idFecha">Fecha de lanzamiento:</label><span class="obligatorio">*</span>
				<input class="form-control" type="text" id="idFecha" name="fechaLanzamiento"
				onchange="validarFecha();" placeholder="Pincha para elegir año de estreno..." />
				<span class="avisos" id="aFecha">
					Debes introducir una fecha anterior al día actual.
				</span>
			</div>

			<div class="form-group">
				<label for="idLenguage">Lenguage:</label><span class="obligatorio">*</span>
				<input class="form-control" type="text" name="lenguage" id="idLenguage"
				onkeyup="validarLenguage();" placeholder="Lenguage..." />
				<span class="avisos" id="aLenguage">
					Debes introducir un código de lenguage correcto.
				</span>
			</div>

			<div class="form-group">
				<label for="idRepartoDirector">Director/es:</label><span class="obligatorio">*</span>
				<select multiple class="form-control" id="idRepartoDirector" name="repartoDirector[]"
				data-toogle="tooltip" data-placement="left" title="Selecciona la persona" size="5">
					<?php foreach($repartos as $reparto):?>
						<?php foreach ($reparto->sharedProfesionesList as $prof): ?>
							<?php if($prof->nombre == 'Director'):?>
								<option value="<?=$reparto -> id?>" <?=($reparto -> id == "1")?"selected='selected'":" "?>><?= $reparto->nombre ?> <?= $reparto->apellido1?></option>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endforeach; ?>
				</select>
			</div>
			
			<div class="form-group">
				<label for="idRepartoActor">Actor/es:</label><span class="obligatorio">*</span>
				<select multiple class="form-control" id="idRepartoActor" name="repartoActor[]"
				data-toogle="tooltip" data-placement="left" title="Selecciona la persona" size="5">
					<?php foreach($repartos as $reparto):?>
						<?php foreach ($reparto->sharedProfesionesList as $prof): ?>
							<?php if($prof->nombre == 'Actor'):?>
								<option value="<?=$reparto -> id?>" <?=($reparto -> id == "1")?"selected='selected'":" "?>><?= $reparto->nombre ?> <?= $reparto->apellido1?></option>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endforeach; ?>
				</select>
			</div>
			
			<input type="hidden" value="Activo" name="estado" />

			<div class="form-group">
				<label for="idPopularidad">Popularidad: </label><span class="obligatorio">*</span>
				<input class="form-control" type="number" id="idPopularidad" name="popularity" placeholder="Popularidad..." />
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
				<label for="idFoto">Foto:</label>
				<input type="file" class="form-control" id="idFoto" name="fotoPoster"/>
				<span class="avisos" id="idFoto">
					Debes introducir una foto con formato y tamaño correcto.
				</span><br/>
				<div id="list">
					
				</div>
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