<script type="text/javascript">
	var xhr;
	window.onload = function(){
		xhr = new XMLHttpRequest();
		console.log(xhr);
	}

	function peticionAJAX() {
		var nombre = document.getElementById("idNombre").value;
		xhr.open("POST", "<?=base_url()?>idioma/comprobarIdioma", true);
		xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
		xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xhr.send("nombre="+nombre);
		xhr.onreadystatechange = function(){
			//si no recibe nada es que esta disponible el nombre, sino envia algo(trato booleano)
			if (xhr.readyState==4 && xhr.status==200) {
				if (xhr.responseText) {
					document.getElementById("editar").disabled=true;
					idFormulario.idNombre.style.borderColor="red";
				} else {
					document.getElementById("editar").disabled=false;
					idFormulario.idNombre.style.borderColor="blue";
				}
			}
		}
	}


function validar(){
	var nombre = document.getElementById("idNombre").value;
	var nombreAnterior = document.getElementById("idNombreAnterior").value;

	function validarNombre() {

		var distintos = true;

		if (nombre.toLowerCase()==nombreAnterior.toLowerCase()) {
			distintos=false;
		}
		
		if(nombre!="" && distintos ) {
			expresion = /^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ]{3,20}$/;
			if (expresion.test(nombre)) {
				var m = nombre.charAt(0);
				nombre= m.toUpperCase()+nombre.substring(1,nombre.length);
				document.getElementById("idNombre").value=nombre;
				idFormulario.idNombre.style.borderColor="blue";
				document.getElementById("aNombre").style.display="none";
				return true;
			} else {
				idFormulario.idNombre.style.borderColor="red";
				document.getElementById("aNombre").style.display="initial";
				return false;
			}
		} else {
			idFormulario.idNombre.style.borderColor="red";
			document.getElementById("aNombre").style.display="initial";
			return false;
		}
	}

	validarNombre();

	if (validarNombre()) {
		peticionAJAX();
	}else{
		document.getElementById('editar').disabled=true;
	}
}

function cancelarRegistro(){
	var cancelarRegistro = confirm("¿Realmente quieres cancelar el registro?");

	if (cancelarRegistro) {
		window.location.href = "<?=base_url()?>";
	}
}

</script>
<div class="container content-wrapper">
	<section class="content-header">
      <h1>
        <i class="fas fa-language"></i>&nbsp;&nbsp;Edición de idiomas
      </h1>
    </section>
	<section class="content">
	<form id="idFormulario" method="post"
		action="<?=base_url()?>idioma/editarPost">
		<fieldset>
			<legend>Editar Idioma</legend>
			<div class="form-group">
				<label for="idNombreAnterior">Nombre anterior</label> <input
					class="form-control" type="text" id="idNombreAnterior"	name="nombreAnterior" readonly="readonly"
					<?= ($body["idioma"]->nombre)?"value=".$body["idioma"]->nombre:"" ?>>
			</div>

			<div class="form-group">
				<label for="idNombre">Nuevo nombre</label><span class="obligatorio">*</span>
				<input class="form-control" type="text" id="idNombre" name="nombre"
					onkeyup="validar();"> <input class="form-control" type="hidden"
					id="idId" name="id_pais" <?= "value=".$body["idioma"]->id?>> <span
					class="avisos" id="aNombre"> Debes escribir un nombre
					válido(caracteres no númericos, espacios o símbolos) mayor de dos
					caracteres. </span>
			</div>

			<div class="form-group">
				<div class="nav navbar-form navbar-right">
					<input type="button" class="btn btn-default" id="idCancelar" name ="cancelar" value="Cancelar cambio" onclick="cancelarRegistro();"/>
					<input type="submit" class="btn btn-default" name="editar" id="editar" value="Editar" disabled="disabled" />
				</div>
			</div>
		</fieldset>
	</form>
</section>
</div>