<script type="text/javascript">
function serialize(form){if(!form||form.nodeName!=="FORM"){return }var i,j,q=[];for(i=form.elements.length-1;i>=0;i=i-1){if(form.elements[i].name===""){continue}switch(form.elements[i].nodeName){case"INPUT":switch(form.elements[i].type){case"text":case"hidden":case"password":case"button":case"reset":case"submit":case"color":case"date":case"datetime-local":case"email":case"month":case"number":case"range":case"search":case"tel":case"time":case"url":case"week":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"checkbox":case"radio":if(form.elements[i].checked){q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value))}break;case"file":break}break;case"TEXTAREA":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"SELECT":switch(form.elements[i].type){case"select-one":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"select-multiple":for(j=form.elements[i].options.length-1;j>=0;j=j-1){if(form.elements[i].options[j].selected){q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].options[j].value))}}break}break;case"BUTTON":switch(form.elements[i].type){case"reset":case"submit":case"button":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break}break}}return q.join("&")};
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

function validarTituloOriginal() {
	tituloOriginal = idFormulario.idTituloOriginal.value.trim();
	if (tituloOriginal != "") {

		var expReg = /^[a-zA-Z ñÑáéíóúÁÉÍÓÚ0-9]{2,40}$/;
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
		if (idFormulario.idRepartosElegidos.value == "") {
			if (confirm("¿Quieres guardar el formulario sin reparto?(Se pueden añadir después)")) {
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

function anadirGenero(value,id) {
	document.getElementById("idGenerosElegidos").innerHTML += "<option onclick='borrarGenero("+value+","+id+");' selected id='"+id+"' value='"+value+"' selected>"+id+"</option>";
	var seleccionado = document.getElementById("idGenerosTodos");
	seleccionado.remove(seleccionado.selectedIndex);
}

function borrarGenero(value,id) {
	document.getElementById("idGenerosTodos").innerHTML += "<option onclick='anadirGenero(this."+value+",this."+id+");' id='"+id+"' value='"+value+"'>"+id+"</option>";
	var seleccionado = document.getElementById("idGenerosElegidos");
	seleccionado.remove(seleccionado.selectedIndex);
}

function anadirReparto(value,id) {
	document.getElementById("idRepartosElegidos").innerHTML += "<option onclick='borrarReparto("+value+","+id+");' selected id='"+id+"' value='"+value+"' selected>"+id+"</option>";
	var seleccionado = document.getElementById("idRepartosTodos");
	seleccionado.remove(seleccionado.selectedIndex);
}

function borrarReparto(value,id) {
	document.getElementById("idRepartosTodos").innerHTML += "<option onclick='anadirReparto(this."+value+",this."+id+");' id='"+id+"' value='"+value+"'>"+id+"</option>";
	var seleccionado = document.getElementById("idRepartosElegidos");
	seleccionado.remove(seleccionado.selectedIndex);
}
</script>

<div class="container content-wrapper">
	<section class="content-header">
      <h1>
        <i class="fas fa-film"></i>&nbsp;&nbsp;Editar película
      </h1>
    </section>
	<section class="content">

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
				<input class="form-control" type="text" id="idTitulo" name="titulo" value="<?= $body['peliculas']->titulo ?>"
				 onkeyup="validarTitulo();"  data-toogle="tooltip" data-placement="left" title="Escribe un título"/>
				<span class="avisos" id="aTitulo">
					Debes escribir un nombre válido(3 a 40 caracteres).
				</span>
			</div>
			
			<div class="form-group">
				<label for="idTituloOriginal">Titulo original: </label><span class="obligatorio">*</span>
				<input class="form-control" type="text" id="idTituloOriginal" name="tituloOriginal" value="<?= $body['peliculas']->tituloOriginal ?>"
				 onkeyup="validarTituloOriginal();"  data-toogle="tooltip" data-placement="left" title="Escribe un título""/>
				<span class="avisos" id="aTituloOriginal">
					Debes escribir un nombre válido(3 a 40 caracteres).
				</span>
			</div>
				
			<div class="form-group">
				<label for="idFecha">Fecha de lanzamiento:</label><span class="obligatorio">*</span>
				<input class="form-control" type="text" id="idFecha" name="fechaLanzamiento"
				onchange="validarFecha();" value="<?= $body['peliculas']->fechaLanzamiento ?>" />
				<span class="avisos" id="aFecha">
					Debes introducir una fecha anterior al día actual.
				</span>
			</div>

			<div class="form-group">
				<label for="idLenguage">Lenguage:</label><span class="obligatorio">*</span>
				<input class="form-control" type="text" name="lenguage" id="idLenguage"
				onkeyup="validarLenguage();" value="<?= $body['peliculas']->original_language ?>"/>
				<span class="avisos" id="aLenguage">
					Debes introducir un código de lenguage correcto.
				</span>
			</div>

			<div class="row">
                <div class="form-group col-md-6">
                    <label for="idRepartosTodos">Repartos todos:</label>
                    <select class="form-control" id="idRepartosTodos" name="reparto[]" multiple size="5">
                        <?php foreach($body['repartos'] as $reparto): ?>
                        	<option onclick="anadirReparto(this.value, this.id);" id="<?= $reparto->nombre ?> <?= $reparto->apellido1 ?> <?= $reparto->apellido2 ?>" value="<?= $reparto->id ?>" >
                        		<?= $reparto->nombre ?>&nbsp<?= $reparto->apellido1 ?>&nbsp<?= $reparto->apellido2 ?>
                        	</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="idRepartosElegidos">Repartos elegidos:</label>
                    <select class="form-control" id="idRepartosElegidos" name="reparto[]" multiple size="5">
                        <?php foreach ($body['peliculas']->sharedRepartosList as $rep): ?>
                        	<option selected id="<?= $rep->nombre ?> <?= $rep->apellido1 ?> <?= $rep->apellido2 ?>" value="<?= $rep->id ?>" onclick="borrarReparto(this.value, this.id)">
                            	<?= $rep->nombre ?> <?= $rep->apellido1 ?> <?= $rep->apellido2 ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

			<div class="form-group">
				<label for="idPopularidad">Popularidad: </label><span class="obligatorio">*</span>
				<input class="form-control" type="number" id="idPopularidad" name="popularity" value="<?= $body['peliculas']->popularidad?>" />
			</div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="idGenerosTodos">Géneros todos:</label>
                    <select class="form-control" id="idGenerosTodos" name="genero[]" multiple size="5">
                        <?php foreach($body['generos'] as $genero): ?>
                        	<option onclick="anadirGenero(this.value, this.id);" id="<?= $genero->nombre ?>" value="<?= $genero->id ?>" >
                        		<?= $genero->nombre ?>
                        	</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="idGenerosElegidos">Géneros elegidos:</label>
                    <select class="form-control" id="idGenerosElegidos" name="genero[]" multiple size="5">
                        <?php foreach ($body['peliculas']->sharedGenerosList as $gen): ?>
                        	<option selected id="<?= $gen->nombre ?>" value="<?= $gen->id ?>" onclick="borrarGenero(this.value, this.id)">
                            	<?= $gen->nombre ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

			<div class="form-group">
				<label for="idSinopsis">Sinopsis:</label>
				<textarea class="form-control" name="sinopsis" id="idSinopsis"><?= $body['peliculas']->sinopsis ?></textarea>
			</div>

			<div class="form-group">
				<label for="idFotoPoster">Cartel:</label>
				<input type="file" class="form-control" id="idFotoPoster" name="fotoPoster" data-toogle="tooltip" />
    			<span class="avisos" id="aFotoPoster">
    				Debes introducir una foto con formato y tamaño correcto.
    			</span><br/>
    			<div id="list">
					<img class="thumb" src="<?= $body["peliculas"]->ruta_cartel?>" style="width:210px; height:320px;"/>
				</div>
			</div>
			
			<input type="hidden" name="id_pelicula" value="<?= $body['peliculas']->id ?>" />
			<input type="hidden" name="fotoFija" value="<?= $body['peliculas']->foto_poster ?>" />

			<div class="nav navbar-form navbar-right">
				<input type="button" class="btn btn-default" id="idCancelar" name="cancelar" value="Cancelar registro" onclick="cancelarRegistro();" />
				<input type="button" class="btn btn-default" id="idRegistro" name="registrarPelicula" value="Registrar película" onclick="validar();" />
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