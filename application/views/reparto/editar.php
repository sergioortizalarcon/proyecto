<script type="text/javascript">
function serialize(form){if(!form||form.nodeName!=="FORM"){return }var i,j,q=[];for(i=form.elements.length-1;i>=0;i=i-1){if(form.elements[i].name===""){continue}switch(form.elements[i].nodeName){case"INPUT":switch(form.elements[i].type){case"text":case"hidden":case"password":case"button":case"reset":case"submit":case"color":case"date":case"datetime-local":case"email":case"month":case"number":case"range":case"search":case"tel":case"time":case"url":case"week":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"checkbox":case"radio":if(form.elements[i].checked){q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value))}break;case"file":break}break;case"TEXTAREA":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"SELECT":switch(form.elements[i].type){case"select-one":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break;case"select-multiple":for(j=form.elements[i].options.length-1;j>=0;j=j-1){if(form.elements[i].options[j].selected){q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].options[j].value))}}break}break;case"BUTTON":switch(form.elements[i].type){case"reset":case"submit":case"button":q.push(form.elements[i].name+"="+encodeURIComponent(form.elements[i].value));break}break}}return q.join("&")};
</script>
<script type="text/javascript">
var correcto = true;
var nombreCorrecto = false;
var apellido1Correcto = false;
var apellido2Correcto = true;
var fechaCorrecto = false;

var nombre="";
var apellido1="";
var apellido2="";

function mayuscula(palabra, id) {
	var palabrasSeparadas = palabra.split(" ");
	var palabraNueva="";
	if (palabrasSeparadas.length>1) {
		for (i=0;i<palabrasSeparadas.length; i++) {
			var primeraLetra = palabrasSeparadas[i].substr(0,1);
			palabra = palabrasSeparadas[i].slice(1);
			palabraNueva += primeraLetra.toUpperCase() + palabra + " ";
		}
	} else {
		var primeraLetra = palabrasSeparadas[0].substr(0,1);
		palabra = palabrasSeparadas[0].slice(1);
		palabraNueva = primeraLetra.toUpperCase() + palabra + " ";
	}
	if (id == "idNombre") {
		idFormulario.idNombre.value=palabraNueva;
	} else if(id == "idApellido1") {
		idFormulario.idApellido1.value=palabraNueva;
	}else { 
		idFormulario.idApellido2.value=palabraNueva;
	}
}

function validarNombre() {
	nombre = idFormulario.idNombre.value.trim();

	if (nombre != "") {
		var expReg = /^[a-zA-Z ñÑáéíóúÁÉÍÓÚ.-çÇ0-9]{2,30}$/;
		if (expReg.test(nombre)){
			nombreCorrecto = true;
			correcto=true;
			idFormulario.idNombre.style.borderColor="blue";
			document.getElementById("aNombre").style.display="none";
		} else {
			idFormulario.idNombre.style.borderColor="red";
			document.getElementById("aNombre").style.display="initial";
			if (correcto == true) {
				document.getElementById('idNombre').focus();
				correcto=false;
			}
			nombreCorrecto = false;
		}
	}
}

function validarApellido1() {
	apellido1 = idFormulario.idApellido1.value.trim();
	
	if (apellido1 != "") {
		var expReg = /^[a-zA-Z ñÑáéíóúÁÉÍÓÚ.-çÇ0-9]{2,30}$/;
		if (expReg.test(apellido1)){
			apellido1Correcto = true;
			correcto=true;
			idFormulario.idApellido1.style.borderColor="blue";
			document.getElementById("aApellido1").style.display="none";
		} else {
			idFormulario.idApellido1.style.borderColor="red";
			document.getElementById("aApellido1").style.display="initial";
			if (correcto == true) {
				document.getElementById('idApellido1').focus();
				correcto=false;
			}
			apellido1Correcto = false;
		}
	} else {
		idFormulario.idApellido1.style.borderColor="red";
		document.getElementById("aApellido1").style.display="initial";
		if (correcto == true) {
			document.getElementById('idApellido1').focus();
			correcto=false;
		}
		apellido1Correcto = false;
	}
}

function validarApellido2() {
	apellido2 = idFormulario.idApellido2.value.trim();
	if (apellido2 != "") {
		var expReg = /^[a-zA-Z ñÑáéíóúÁÉÍÓÚ.-çÇ0-9]{2,30}$/;
		if (expReg.test(apellido2)){
			apellido2Correcto = true;
			correcto=true;
			idFormulario.idApellido2.style.borderColor="blue";
			document.getElementById("aApellido2").style.display="none";
		} else {
			idFormulario.idApellido2.style.borderColor="red";
			document.getElementById("aApellido2").style.display="initial";
			if (correcto == true) {
				document.getElementById('idApellido2').focus();
				correcto=false;
			}
			apellido2Correcto = false;
		}
	}
}

function validarFecha() {
	var patron=new RegExp("^(19|20)+([0-9]{2})([/])([0-9]{1,2})([/])([0-9]{1,2})$");
	var fecha = idFormulario.idFecha.value;
	var fechaSeparada = fecha.split("/");

	var anio = fechaSeparada[0];
	var mes = fechaSeparada[1];
	var dia = fechaSeparada[2];

	var fechaSis = new Date();
	var anioHoy = fechaSis.getFullYear();
	var mesHoy = fechaSis.getMonth()+1;
	var diaHoy = fechaSis.getDate();
	mesHoy = "0"+mesHoy;
	
	if (anio >= anioHoy && mes >= mesHoy && dia > diaHoy) {
		idFormulario.idFecha.style.borderColor="red";
		document.getElementById("aFecha").style.display="initial";
		fechaCorrecto = false;
	} else {
		fechaCorrecto = true;
        idFormulario.idFecha.style.borderColor="blue";
		document.getElementById("aFecha").style.display="none";
	}
}

function permitirEnvio() {
	if (nombreCorrecto && apellido1Correcto && apellido2Correcto && fechaCorrecto) {
		idFormulario.idEditar.disabled=false;
	} else {
		idFormulario.idEditar.disabled=false;
	}
}

function validar() {
	if (nombreCorrecto && apellido1Correcto && apellido2Correcto && fechaCorrecto) {
		nombre = idFormulario.idNombre.value.trim();
		idFormulario.idNombre.value = nombre;
		apellido1 = apellido1.trim();
		apellido1 = idFormulario.idApellido1.value.trim();
		apellido2 = apellido2.trim();
		apellido2 = idFormulario.idApellido2.value.trim();
		var seleccionados = document.forms["idFormulario"].idProfesionesElegidas;
		var cantidad = seleccionados.length;
		for (i=0;i<cantidad; i++) {
			seleccionados[i].selected = true;
		}
		idFormulario.submit();
	} else {
		validarNombre();
		validarApellido1();
		validarApellido2();
		validarFecha();
	}
}

function cancelarRegistro(){
	var cancelarRegistro = confirm("¿Realmente quieres cancelar el registro?");

	if (cancelarRegistro) {
		window.location.href = "<?=base_url()?>";
	}
}

function anadirRegistro(value,id) {
	document.getElementById("idProfesionesElegidas").innerHTML += "<option onclick='borrarRegistro("+value+","+id+");' selected id='"+id+"' value='"+value+"' selected>"+id+"</option>";
	var seleccionado = document.getElementById("idProfesionesTodas");
	seleccionado.remove(seleccionado.selectedIndex);
}

function borrarRegistro(value,id) {
	document.getElementById("idProfesionesTodas").innerHTML += "<option onclick='anadirRegistro(this."+value+",this."+id+");' id='"+id+"' value='"+value+"'>"+id+"</option>";
	var seleccionado = document.getElementById("idProfesionesElegidas");
	seleccionado.remove(seleccionado.selectedIndex);
}
</script>

<div class="container content-wrapper">
	<section class="content-header">
      <h1>
        <i class="fas fa-address-card"></i>
        &nbsp;&nbsp;Editar datos del Famoso
      </h1>
    </section>
	<section class="content">
		<div id="creator">
			<form id="idFormulario" onchange="permitirEnvio();" name="idFormulario" action="<?= base_url()?>reparto/editarPost" method="post" enctype="multipart/form-data">
				<fieldset>
					<legend><?= $body['repartos']->nombre ?> <?= $body['repartos']->apellido1 ?> <?= $body['repartos']->apellido2 ?></legend>
					
					<div class="form-group">
						<label for="idNombre">Nombre</label>
						<input class="form-control" type="text" id="idNombre" name="nombre" onkeyup="validarNombre();" onchange="mayuscula(this.value, this.id);"
						value="<?= $body['repartos']->nombre ?>" data-toogle="tooltip" data-placement="left" title="Escribe un nombre" />
						<span class="avisos" id="aNombre">
							Debes escribir un nombre válido(3 a 20 caracteres no númericos o simbolos).
						</span>
					</div>
					
					<div class="form-group">
						<label for="idApellido1">Primer apellido</label>
						<input class="form-control" type="text" id="idApellido1" name="apellido1" onkeyup="validarApellido1();" onchange="mayuscula(this.value, this.id);"
						value="<?= $body['repartos']->apellido1 ?>" data-toogle="tooltip" data-placement="left" title="Escribe un apellido" />
						<span class="avisos" id="aApellido1">
							Debes escribir un apellido válido(3 a 20 caracteres no númericos o simbolos).
						</span>
					</div>
					
					<div class="form-group">
						<label for="idApellido2">Segundo apellido</label>
						<input class="form-control" type="text" id="idApellido2" name="apellido2" onkeyup="validarApellido2();" onchange="mayuscula(this.value, this.id);" 
						value="<?= $body['repartos']->apellido2 ?>" data-toogle="tooltip" data-placement="left" title="Escribe un apellido" />
						<span class="avisos" id="aApellido2">
							Debes escribir un apellido válido(3 a 20 caracteres no númericos o simbolos).
						</span>
					</div>
					
					<input type="hidden" name="id_reparto" value="<?= $body['repartos']->id ?>" />
					<input type="hidden" name="fotoFija" value="<?= $body['repartos']->ruta_foto ?>" />
					<input type="hidden" name="estado" value="<?= $body['repartos']->estado ?>" />
					
					<div class="form-group">
						<label for="idFecha">Fecha de nacimiento</label><span class="obligatorio">*</span>
						<input class="form-control" value="<?= $body['repartos']->fechaNacimiento ?>" type="text" id="idFecha" name="fechaNacimiento" onchange="validarFecha();" />
						<span class="avisos" id="aFecha">
							Debes introducir una fecha válida(Anterior al día actual).
						</span>
					</div>
					
					<div class="form-group">
						<label for="idPais">Pais de nacimiento</label><span class="obligatorio">*</span>
						<select class="form-control" id="idPais" name="pais">
							<?php foreach($body['paises'] as $pais):?>
								<option value="<?=$pais -> id?>" <?= ($pais -> nombre == $body['repartos']->paises['nombre'] )?"selected='selected'":" "?>>
									<?= $pais->nombre ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
					
					<div class="row">
    					<div class="form-group col-md-6">
        					<label for="idProfesionesTodas">Profesiones todas:</label><span class="obligatorio">*</span>
        					<select class="form-control" id="idProfesionesTodas" name="profesion[]" multiple size="5">
        						<?php foreach($body['profesiones'] as $profesion): ?>
    								<option onclick="anadirRegistro(this.value, this.id);" id="<?= $profesion->nombre ?>" value="<?= $profesion->id ?>" >
    									<?= $profesion->nombre ?>
    								</option>
    							<?php endforeach; ?>
        					</select>
    					</div>
    					<div class="form-group col-md-6">
        					<label for="idProfesionesElegidas">Profesiones seleccionadas:</label><span class="obligatorio">*</span>
        					<select class="form-control" id="idProfesionesElegidas" name="profesion[]" multiple size="5">
    							<?php foreach ($body['repartos']->sharedProfesionesList as $prof): ?>
        							<option selected id="<?= $prof->nombre ?>" value="<?= $prof->id ?>" onclick="borrarRegistro(this.value, this.id)">
        							     <?= $prof->nombre ?>
                                	</option>
                            	<?php endforeach; ?>
        					</select>
    					</div>
					</div>
					
					<div class="form-group">
						<label for="idBiografia">Biografía:</label>
						<textarea class="form-control" name="biografia" id="idBiografia"><?= $body['repartos']->biografia ?></textarea>
					</div>
						
					<div class="form-group">
						<label for="idFoto">Foto:</label>
						<input type="file" class="form-control" id="idFoto" name="foto"/>
						<span class="avisos" id="idFoto">
							Debes introducir una foto con formato y tamaño correcto.
						</span><br/>
						<div id="list">
							<img class="thumb" src="<?= $body["repartos"]->rutaFoto ?>" style="width:210px; height:320px;"/>
						</div>
					</div>	
					
					<div class="nav navbar-form navbar-right">
						<input type="button" class="btn btn-default" id="idCancelar" name ="cancelar" value="Cancelar cambio" onclick="cancelarCambio();"/>
						<input type="button" class="btn btn-default" id="idEditar" name ="editar" value="Editar" onclick="validar();"/>
					</div>
					
				</fieldset>
			</form>
			<br/>
		</div>
		<div id="result"></div>
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
             
  	document.getElementById('idFoto').addEventListener('change', archivo, false);
</script>