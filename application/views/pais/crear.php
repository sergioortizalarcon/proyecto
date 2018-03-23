<div class="container ">
	<script>
		var xhr;
		function comprobarPais(){
			xhr = new XMLHttpRequest();
			var nombre = document.getElementById("idNombre").value;
			xhr.open("POST","<?=base_url()?>pais/comprobarPais",true);
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
		    var n = document.getElementById("idNombre").value;
		    var nombre=n.trim();

		    function validarNombre() {
		        if(nombre!="") {
		            expresion = /^([a-z]|[A-Z]|[á-ú]|[Á-Ú]|[à-ù]|[À-Ù]|[ñÑ]|\s){1,20}$/;
					if (expresion.test(nombre)) {
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
				comprobarPais(nombre);
			} else {
				document.getElementById("enviar").disabled=true;
			}
		}
	</script>
	<form id="idFormulario" method="post" action="<?=base_url()?>pais/crearPost">
		<fieldset>
			<legend>Añadir nuevo país</legend>
			<div class="form-group">
			<label for="idNombre">Nombre</label><span class="obligatorio">*</span>
			<input class="form-control" type="text" id="idNombre" name="nombre" onkeyup="validar();"/>
			<span class="avisos" id="aNombre">
				Debes escribir un nombre válido(caracteres no númericos, espacios o símbolos).
			</span>
			</div>
			<div class="form-group">
			<input type="submit" class="btn btn-default" name="enviar" id="enviar" value="Enviar" disabled="disabled"/>
			</div>
		</fieldset>
	</form>
</div>