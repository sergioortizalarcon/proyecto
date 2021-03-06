<script type="text/javascript">
var correcto = true;
var nombreCorrecto = false;
var apellido1Correcto = false;
var apellido2Correcto = false;
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

		var expReg = /^[a-zA-Z ñÑáéíóúÁÉÍÓÚ]{2,30}$/;
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
	} else {
		if (correcto == true) {
			document.getElementById('idNombre').focus();
			correcto=false;
		}
		document.getElementById("aNombre").style.display="initial";
        idFormulario.idNombre.style.borderColor="red";
        nombreCorrecto = false;
	}
}

function validarApellido1() {
	apellido1 = idFormulario.idApellido1.value.trim();
	if (apellido1 != "") {
		
		var expReg = /^[a-zA-Z ñÑáéíóúÁÉÍÓÚ]{2,30}$/;
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
		if (correcto == true) {
			document.getElementById('idApellido1').focus();
			correcto=false;
		}
		document.getElementById("aApellido1").style.display="initial";
        idFormulario.idApellido1.style.borderColor="red";
        apellido1Correcto = false;
	}
}

function validarApellido2() {
	apellido2 = idFormulario.idApellido2.value.trim();
	if (apellido2 != "") {
		
		var expReg = /^[a-zA-Z ñÑáéíóúÁÉÍÓÚ]{2,30}$/;
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
	} else {
		document.getElementById("aApellido2").style.display="none";
        apellido2Correcto = true;
	}
}

function validarFecha() {
	var fecha = idFormulario.idFecha.value;
	idFormulario.idFecha.style.borderColor="red";
	
	if (fecha == "") {
		document.getElementById("aFecha").style.display="initial";
		fechaCorrecto = false;
	} else {
		var fechaSis = new Date();
		var anio = fechaSis.getFullYear();
		var mes = fechaSis.getMonth()+1;
		var dia = fechaSis.getDate();
		mes = "0"+mes;
		fechaSistema = anio + "-" + mes + "-" + dia

		if (fechaSistema <= fecha) {
			idFormulario.idFecha.style.borderColor="red";
			document.getElementById("aFecha").style.display="initial";
			fechaCorrecto = false;
		} else {
			fechaCorrecto = true;
	        idFormulario.idFecha.style.borderColor="blue";
			document.getElementById("aFecha").style.display="none";
		}
	}
}

function permitirEnvio() {
	if (nombreCorrecto && apellido1Correcto && apellido2Correcto && fechaCorrecto) {
		idFormulario.idRegistro.disabled=false;
	}
}

function validar() {
	if (nombreCorrecto && apellido1Correcto && apellido2Correcto && fechaCorrecto) {
		nombre = nombre.trim();
		idFormulario.idNombre.value = nombre;
		apellido1 = apellido1.trim();
		idFormulario.idApellido1.value = apellido1;
		apellido2 = apellido2.trim();
		idFormulario.idApellido2.value = apellido2;
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
		window.location.href = "<?=base_url()?>actor/listar";
	}
}
</script>

<div class="container content-wrapper">
	<section class="content-header">
      <h1>
        <i class="fas fa-user-tie"></i>&nbsp;&nbsp;Registro de directores
      </h1>
    </section>
	<section class="content">
<div id="creator">
	<form id="idFormulario" onchange="permitirEnvio();" name="idFormulario" action="<?= base_url()?>director/crearPost" method="post" enctype="multipart/form-data">
		<fieldset>
			<legend>Crear nuevo director</legend>
			<small style="float:right;"> (<span class="obligatorio">*</span> Campos obligatorios)</small>
			
			<div class="form-group">
				<label for="idNombre">Nombre</label><span class="obligatorio">*</span>
				<input class="form-control" type="text" id="idNombre" name="nombre" onkeyup="validarNombre();" onchange="mayuscula(this.value, this.id);"
				placeholder="Nombre..." data-toogle="tooltip" data-placement="left" title="Escribe un nombre" />
				<span class="avisos" id="aNombre">
					Debes escribir un nombre válido(3 a 20 caracteres no númericos o simbolos).
				</span>
			</div>
			
			<div class="form-group">
				<label for="idApellido1">Primer apellido</label><span class="obligatorio">*</span>
				<input class="form-control" type="text" id="idApellido1" name="apellido1" onkeyup="validarApellido1();" onchange="mayuscula(this.value, this.id);"
				placeholder="Apellido..." data-toogle="tooltip" data-placement="left" title="Escribe un apellido" />
				<span class="avisos" id="aApellido1">
					Debes escribir un apellido válido(3 a 20 caracteres no númericos o simbolos).
				</span>
			</div>
			
			<div class="form-group">
				<label for="idApellido2">Segundo apellido</label>
				<input class="form-control" type="text" id="idApellido2" name="apellido2" onkeyup="validarApellido2();" onchange="mayuscula(this.value, this.id);"
				placeholder="Apellido..." data-toogle="tooltip" data-placement="left" title="Escribe un apellido" />
				<span class="avisos" id="aApellido2">
					Debes escribir un apellido válido(3 a 20 caracteres no númericos o simbolos).
				</span>
			</div>
			
			<div class="form-group">
				<label for="idFecha">Fecha de nacimiento</label><span class="obligatorio">*</span>
				<input class="form-control" placeholder="Fecha de nacimiento..." type="text" id="idFecha" name="fechaNacimiento" onchange="validarFecha();" />
				<span class="avisos" id="aFecha">
					Debes introducir una fecha válida(Anterior al día actual).
				</span>
			</div>
			
			<div class="form-group">
				<label for="idPais">Pais de nacimiento</label><span class="obligatorio">*</span>
				<select class="form-control" id="idPais" name="pais">
					<?php foreach($body['paises'] as $pais):?>
						<option value="<?=$pais -> id?>" <?=($pais -> nombre == "España")?"selected='selected'":" "?>"><?= $pais->nombre?></option>
					<?php endforeach; ?>
				</select>
			</div>
			
			<div class="form-group">
				<label for="idBiografia">Biografía:</label>
				<textarea class="form-control" name="biografia" id="idBiografia" placeholder="Biografía..."></textarea>
			</div>
				
			<div class="form-group">
				<label for="idFoto">Foto:</label>
				<input type="file" class="form-control" id="idFoto" name="foto" />
				<span class="avisos" id="idFoto">
					Debes introducir una foto con formato y tamaño correcto.
				</span><br/>
				<div id="list">
					
				</div>
			</div>
			
			<div class="nav navbar-form navbar-right">
				<input type="button" class="btn btn-default" id="idCancelar" name="cancelar" value="Cancelar registro" onclick="cancelarRegistro();"/>
				<input type="button" class="btn btn-default" id="idRegistro" name="registrarse" disabled="true" value="Registrarse" onclick="validar();"
				 />
			</div>
			
		</fieldset>
	</form>
	<br/>
</div>
</section>
</div>
<div id="result"></div>
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
