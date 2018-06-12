<script>
		var xhr;
		function comprobarprofesion(){
			xhr = new XMLHttpRequest();
			var nombre = document.getElementById("idNombre").value;
			xhr.open("POST","<?=base_url()?>profesion/comprobarprofesion",true);
			xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
			xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xhr.send("nombre="+nombre);
			xhr.onreadystatechange=function(){
				//si no recibe nada es que esta disponible el nombre, sino envia algo(trato booleano)
				if (xhr.readyState==4 && xhr.status==200) {
					if (xhr.responseText) {
						document.getElementById("enviar").disabled=true;
						idFormulario.idNombre.style.borderColor="red";
					} else {
						document.getElementById("enviar").disabled=false;
						idFormulario.idNombre.style.borderColor="blue";
					}
				}
			}
		}
		
		function validar(){
			var nombre = document.getElementById("idNombre").value;

			function validarNombre() {
				if(nombre!="") {
					var expReg = /^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ ]{3,30}$/;
					if (expReg.test(nombre)) {
						var m = nombre.charAt(0);
						nombre= m.toUpperCase()+nombre.substring(1,nombre.length);
						
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
			
			if ( validarNombre()) {
				comprobarprofesion(nombre);
				document.getElementById("idNombre").value = nombre;
			} else {
				document.getElementById("enviar").disabled=true;
			}
		}
		function enviarFormulario() {
			var nombre = document.getElementById("idNombre").value.trim();
			document.getElementById("idNombre").value = nombre;
			idFormulario.submit();
		}
	</script>
<div class="container content-wrapper">
	<section class="content-header">
      <h1>
        <i class="far fa-folder-open"></i>&nbsp;&nbsp;Registro de Profesiones
      </h1>
    </section>
	<section class="content">
	<form id="idFormulario" method="post" action="<?=base_url()?>profesion/crearPost">
		<fieldset>
			<legend>Nueva profesión</legend>
			<div class="form-group">
				<label for="idNombre">Nombre</label><span class="obligatorio">*</span>
				<input class="form-control" type="text" id="idNombre" name="nombre" onkeyup="validar();"/>
				<span class="avisos" id="aNombre">
					Debes escribir una profesión válida(Caracteres no númericos, o símbolos).
				</span>
			</div>
			<input type="hidden" value="Activo" name="estado" />
			<div class="form-group">
				<input type="button" class="btn btn-default" name="enviar" id="enviar" onclick="enviarFormulario();" value="Enviar" disabled="disabled"/>
			</div>
		</fieldset>
	</form>
</section>
</div>