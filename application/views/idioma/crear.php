<div class="container ">
	<script>
		var xhr;
		function comprobarIdioma(){
			xhr = new XMLHttpRequest();
			var nombre = document.getElementById("idNombre").value;
			xhr.open("POST","<?=base_url()?>idioma/comprobarIdioma",true);
			xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
			xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xhr.send("nombre="+nombre);
			xhr.onreadystatechange=function(){
				//si no recibe nada es que esta disponible el nombre, sino envia algo(trato booleano)
				if (xhr.readyState==4 && xhr.status==200) {
					document.getElementById("result").innerHTML ="e: "+ xhr.responseText;
					if (xhr.responseText) {
						document.getElementById("enviar").disabled=true;
						idFormulario.idNombre.style.borderColor="red";
					} else {
						document.getElementById("enviar").disabled=false;
						idFormulario.idNombre.style.borderColor="green";
					}
				}
			}
		}
	</script>
	<form id="idFormulario" method="post" action="<?=base_url()?>/idioma/crearPost">
		<fieldset>
			<legend>Registrar  nuevo idioma</legend>
			<label for="idNombre">Nombre</label>
			<input class="form-control" type="text" id="idNombre" name="nombre" onfocusout="comprobarIdioma();" />
			<input type="submit" class="btn btn-default" name="enviar" id="enviar" value="Enviar" disabled="disabled"/>
		</fieldset>
	</form>
	<div id="result"></div>
</div>