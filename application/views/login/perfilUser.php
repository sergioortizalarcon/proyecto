 <script>
function validarCorreo() {
	var correo = document.getElementById("idEmail").value.trim();
	if (correo!="") {
		expresion =/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,4})$/i;
		if (expresion.test(correo)) {
			  idFormulario.idEmail.style.borderColor="blue";
			  document.getElementById("aEmail").style.display="none";
			  return true;
			} else {
				idFormulario.idEmail.style.borderColor="red";
				document.getElementById("aEmail").style.display="initial";
				return false;
			}
	} else {
		document.getElementById("aEmail").style.display="initial";
		idFormulario.idEmail.style.borderColor="red";
		return false;
	}
}

function validarNombre() {
	var nombre = document.getElementById("idNombre").value.trim();
    if(nombre!="") {
    expresion = /^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ]{3,20}$/;
		if (expresion.test(nombre)) {
	        var m = nombre.charAt(0);
	        nombre= m.toUpperCase()+nombre.substring(1,nombre.length);
	        idFormulario.idNombre.style.borderColor="blue";
	        document.getElementById("aNombre").style.display="none";
	        idFormulario.idNombre.value=nombre;
	        return true;
		} else {
		    idFormulario.idNombre.style.borderColor="red";
		    document.getElementById("aNombre").style.display="initial";
		    return false;
		}
    } else {
        document.getElementById("aNombre").style.display="initial";
        idFormulario.idNombre.style.borderColor="red";
        return false;
    }
}

    function validarApeUno(){
		var ape1 = document.getElementById("idApe1").value.trim();
		if(ape1!="") {
			expresion = /^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ]{3,20}$/;
			if (expresion.test(ape1)) {
				var m1 = ape1.charAt(0);
				ape1= m1.toUpperCase()+ape1.substring(1,ape1.length);
				idFormulario.idApe1.style.borderColor="blue";
				document.getElementById("aApellido").style.display="none";
			    apeUnoOk=true;
				return true;
			} else {
				idFormulario.idApe1.style.borderColor="red";
				document.getElementById("aApellido").style.display="initial";
				return false;
			}
		} else {
			document.getElementById("aApellido").style.display="initial";
			idFormulario.idApe1.style.borderColor="green";
			return false;
		}
  }



function validarApeDos() {
	var ape2 = document.getElementById("idApe2").value.trim();
	if (ape2!=""){
		expresion = /^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ]{0,15}$/;
		if (expresion.test(ape2)) {
			m2 = ape2.charAt(0);
			ape2= ape2.toUpperCase()+ape2.substring(1,ape2.length);
			idFormulario.idApe2.style.borderColor="blue";
			document.getElementById("aApellidoDos").style.display="none";
		} else {
			document.getElementById("aApellidoDos").style.display="initial";
			idFormulario.idApe2.style.borderColor="red";
			return false;
		}
	}
	return true;
}



  function validarPass() {
  var pwd = document.getElementById("idPwd").value.trim();
    if (pwd!="") {
    expresion = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{5,15}$/;
      if (expresion.test(pwd)) {
          idFormulario.idPwd.style.borderColor="blue";
          document.getElementById("aPwd").style.display="none";
            return true;
      } else {
          document.getElementById("aPwd").style.display="initial";
          idFormulario.idPwd.style.borderColor="red";
          return false;
      }
    } else {
        document.getElementById("aPwd").style.display="initial";
        idFormulario.idPwd.style.borderColor="red";
        return true;
    }
  }

  function confirmarPass() {
    var pwd = document.getElementById("idPwd").value;
    var pwdDos = document.getElementById("idPwdD").value;
    if(pwd != '' && pwdDos !='') {
    	if (pwd.trim() == pwdDos.trim()) {
			document.getElementById("aPwdD").style.display="none";
			idFormulario.idPwdD.style.borderColor="blue";
			return true;
          } else {
            document.getElementById("aPwdD").style.display="initial";
            idFormulario.idPwdD.style.borderColor="red";
            return false;
          }
      } else {
      	return true;
      }
  }

function validate_fecha(fecha){
    var patron=new RegExp("^(19|20)+([0-9]{2})([/])([0-9]{1,2})([/])([0-9]{1,2})$");

    if(fecha.search(patron)==0){
        var values=fecha.split("/");
        function isValidDate(day,month,year){
        var dteDate;
        //En javascript mes empieza en la posicion 0 y termina en la 11 por esta razon, tenemos que restar 1 al mes
        month=month-1;
        dteDate=new Date(year,month,day);
        return ( (day==dteDate.getDate()) && (month==dteDate.getMonth()) && (year==dteDate.getFullYear()) );
    }

        if(isValidDate(values[2],values[1],values[0])) {
            return true;
        }
    }
    return false;
}

function calcularEdad() {
  fecha = document.getElementById("idFecha").value;
  if(fecha!=""){
      if(validate_fecha(fecha)==true) {
          // Si la fecha es correcta, calculamos la edad
          var values=fecha.split("/");
          var dia = values[2];
          var mes = values[1];
          var ano = values[0];
          // cogemos los valores actuales
          var fecha_hoy = new Date();
          var ahora_ano = fecha_hoy.getYear();
          var ahora_mes = fecha_hoy.getMonth()+1;
          var ahora_dia = fecha_hoy.getDate();

          // realizamos el calculo
          var edad = (ahora_ano + 1900) - ano;
          if ( ahora_mes < mes ) {
              edad--;
          }
          if ((mes == ahora_mes) && (ahora_dia < dia)) {
              edad--;
          }
          if (edad > 1900) {
              edad -= 1900;
          }

          // calculamos los meses
          var meses=0;
          if(ahora_mes>mes)
              meses=ahora_mes-mes;
          if(ahora_mes<mes)
              meses=12-(mes-ahora_mes);
          if(ahora_mes==mes && dia>ahora_dia)
              meses=11;

          // calculamos los dias
          var dias=0;
          if(ahora_dia>dia)
              dias=ahora_dia-dia;
          if(ahora_dia<dia) {
              ultimoDiaMes=new Date(ahora_ano, ahora_mes, 0);
              dias=ultimoDiaMes.getDate()-(dia-ahora_dia);
          }

          //debug  borrar más adelante
          document.getElementById("result").innerHTML="Tienes "+edad+" años, "+meses+" meses y "+dias+" días";
          if (edad<13) {
            document.getElementById("aFecha").style.display="initial";
        return false;
          } else {
            document.getElementById("result").innerHTML="";
            document.getElementById("aFecha").style.display="none";
            return true;
          }
      } else {
          document.getElementById("result").innerHTML="La fecha "+fecha+" es incorrecta";
          return false;
      }
  } else {
    document.getElementById("aFecha").style.display="initial";
    document.getElementById("result").innerHTML="";
    return false;
  }
}


function comprobar_pwd() {
  var pwd = document.getElementById("pass_antigua").value.trim();
    if (pwd!="") {
    expresion = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{5,15}$/;
		if (expresion.test(pwd)) {
		  idFormulario.pass_antigua.style.borderColor="blue";
		  document.getElementById("anteriorPwd").style.display="none";
		    return true;
		} else {
		  document.getElementById("anteriorPwd").style.display="initial";
		  idFormulario.pass_antigua.style.borderColor="red";
		  return false;
		}
    } else {
        document.getElementById("anteriorPwd").style.display="initial";
        idFormulario.pass_antigua.style.borderColor="red";
        return false;
    }
  }

function validar() {
  if (comprobar_pwd()) {
	validarApeDos();
	if (validarNombre() && validarApeUno() && validarApeDos() && validarCorreo() &&confirmarPass() && validarPass() && calcularEdad() ) {
		enviarRegistro();
		function enviarRegistro(){
			var pwd = document.getElementById("idPwd").value.trim();
			var pwd_antigua = document.getElementById("pass_antigua").value.trim();
			pcripto = sha256(pwd);
			pccripto_antigua = sha256(pwd_antigua);
			idFormulario.hash_passwrd.value=pcripto;
			idFormulario.ant_hash_passwrd.value=pccripto_antigua;
			idFormulario.submit();
		}
	} else {
	    var error =  document.getElementsByTagName("input");
		for (var i = 1; i < error.length; i++) {
			if (error[i].style.borderColor!="blue") {
			    error[i].focus();
			    break;
			}
		}
	}
  } else {
  	alert("Debes introducir tu anterior contraseña para continuar");
  }
}

//Funciones para borrar cuenta.

function confirmacion() {
	var confirmarBorrado = confirm("¿Realmente quieres cancelar el registo?");
	if (confirmarBorrado) {
		borradoUser();
		function borradoUser(){
			var pwd = document.getElementById("pwdConf").value.trim();
			if (verf_password(pwd)) {
				var pccripto_antigua = sha256(pwd);
				formBorrado.hash_pwd.value=pccripto_antigua;
				formBorrado.submit();
			}
		}
	}
}


</script>

  <script>
  $( function() {
    $( "#tabsV" ).tabs({
      beforeLoad: function( event, ui ) {
        ui.jqXHR.fail(function() {
          ui.panel.html(
            "Couldn't load this tab. We'll try to fix this as soon as possible. " +
            "If this wouldn't be a demo." );
        });
      }
    });
  } );
  </script>

<script>
	$(document).ready(function(){
	  	var content="";
	      var request = $.ajax({
	        type: "POST",
	        url: '<?=base_url()?>administrador/datos_user',
	        beforeSend:$('#cargando').css('display:initial'),
	        data: {idUser:'<?=$_SESSION["idUser"]?>'},
	        dataType: 'text',
	        success: function( data ) {
	         var content = JSON.parse(data);
	         $('#tabs-1 span.alias').text(content.info['alias']);//'info'-> nombre del array enviado desde PHP
	         $('.idUsuario').val(content.info['id']);

	         $('#tabs-1 span.nombre').text(content.info['nombre']);
	         $('#idNombre').val(content.info['nombre']);

	         $('#tabs-1 span.ap1').text(content.info['apellido_uno']);
	         $('#idApe1').val(content.info['apellido_uno']);

	         $('#tabs-1 span.ap2').text(content.info['apellido_dos']);
	         $('#idApe2').val(content.info['apellido_dos']);

	         $('#tabs-1 span.email').text(content.info['email']);
	         $('#idEmail').val(content.info['email']);

	         $('#tabs-1 span.fecha').text(content.info['fecha_nacimiento']);
	         $('#idFecha').val(content.info['fecha_nacimiento']);

	         $('#tabs-1 span.pais').text(content.info['pais']);
	         $('#idPais select').val(content.info['pais']);
	        },
	        error:function(jqXHR,estado,error){
	          alert(error)
	          console.log(estado)
	        },
	        complete:function (jqXHR,estado) {
	        	$('#cargando').css('display','none');
	          console.log(estado)
	        }
	    });
	});

</script>

<style>

.ui-tabs{
	background: none;
}
</style>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Mi Perfil</h1>
	</section>
<section class="content">
	<div id="tabsV">
<ul>
    <li><a href="#tabs-1">Resumen</a></li>
    <li><a href="#tabs-2">Editar Perfil</a></li>
    <li><a href="#tabs-3">Acción de usuario</a></li>
  </ul>
  <div id="tabs-1">
    <h2 class="datos_user" style="text-align: center">Datos personales</h2>
      <h4 class="datos_user">Alias</h4>
      &nbsp;&nbsp;<i class="fas fa-arrow-right perfil-arrow">&nbsp;&nbsp;</i><span class="alias formato-datos"></span>
      <h4 class="datos_user">Nombre </h4>
      &nbsp;&nbsp;<i class="fas fa-arrow-right perfil-arrow">&nbsp;&nbsp;</i> <span class="nombre formato-datos"></span>
      <h4 class="datos_user">Primer Apellido</h4>
      &nbsp;&nbsp;<i class="fas fa-arrow-right perfil-arrow">&nbsp;&nbsp;</i> <span class="ap1 formato-datos"></span>
      <h4 class="datos_user">Segundo Apellido</h4>
      &nbsp;&nbsp;<i class="fas fa-arrow-right perfil-arrow">&nbsp;&nbsp;</i> <span class="ap2 formato-datos"></span>
      <h4 class="datos_user">Correo electrnónico</h4>
      &nbsp;&nbsp;<i class="fas fa-arrow-right perfil-arrow">&nbsp;&nbsp;</i> <span class="email formato-datos"></span>
      <h4 class="datos_user">Fecha de nacimiento</h4>
      &nbsp;&nbsp;<i class="fas fa-arrow-right perfil-arrow">&nbsp;&nbsp;</i> <span class="fecha formato-datos"></span>
      <h4 class="datos_user">País</h4>
      &nbsp;&nbsp;<i class="fas fa-arrow-right perfil-arrow">&nbsp;&nbsp;</i> <span class="pais formato-datos"></span>
	<div id="cargando"><img src="<?=base_url()?>assets/img/ajax-loader.gif" alt="cargando..."/></div>
  </div>
<div id="tabs-2">
	<form id="idFormulario" name="idFormulario" action="<?=base_url()?>usuario/editarPost" method="post">
		<legend>Editar detos de perfil</legend>

			<div class="form-group">
			<label for="idNombre">Nombre</label><span class="obligatorio">*</span>
			<input class="form-control nombre-user" type="text" id="idNombre" name="nombre"
			placeholder="Nombre..." data-toogle="tooltip" data-placement="left" title="Escribe un nombre" />
			<span class="avisos" id="aNombre">
				Debes escribir un nombre válido(3 a 20 caracteres no númericos o simbolos).
			</span>
			</div>

			<div class="form-group">
			<label for="idApe1">Primer apellido</label><span class="obligatorio">*</span>
			<input class="form-control" type="text" id="idApe1" name="apellido1"
			placeholder="Apellido..." data-toogle="tooltip" data-placement="left" title="Escribe un apellido" />
			<span class="avisos" id="aApellido">
				Debes escribir un apellido válido( 3 a 20 caracteres no númericos o simbolos).
			</span>
			</div>

			<div class="form-group">
			<label for="idApe2">Segundo apellido</label>
			<input class="form-control" type="text" id="idApe2" name="apellido2"
			placeholder="apellido..." data-toogle="tooltip" data-placement="left" title="Escribe un apellido(opcional)" />
			<span class="avisos" id="aApellidoDos">
				Puedes escribir tres apellido como máximo( 3 a 10 caracteres no númericos o simbolos).
			</span>
			</div>

			<div class="form-group">
			<label for="idEmail">Email</label><span class="obligatorio">*</span>
			<input class="form-control" type="text" id="idEmail" name="correo"
			placeholder="email@email.com" data-toogle="tooltip" data-placement="left" title="introduce un correo electrónico válido"/>
			<span class="avisos" id="aEmail">
				Debes escribir un correo válido.
			</span>
			</div>
			<div class="avisos" id="mailAviso"></div>


			<div class="form-group">
			<label for="idPwd"> Nueva Contraseña</label><span class="obligatorio">*</span>
			<input class="form-control" type="password" id="idPwd"
			data-toogle="tooltip" data-placement="left" title="contraseña"/>
			<input class="form-control" type="hidden" id="hash_passwrd" name="hash_passwrd" />
			<span class="avisos" id="aPwd">
				Entre 5 y 15 caracteres. La contraseña ha de incluir al menos tres de los siguientes elementos: números, mayúsculas, minúsculas o alguno de estos símbolos ($, @, !, %,*, &amp;).
			</span>
			</div>

			<div class="form-group">
			<label for="idPwdD">Repetir Contraseña</label><span class="obligatorio">*</span>
			<input class="form-control" type="password" id="idPwdD"
			data-toogle="tooltip" data-placement="left" title="repite la contraseña"/>
			<span class="avisos" id="aPwdD">
				Debe coincidir con la contraseña introducida en el recuadro anterior.
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
			<br/>
			<div class="input-group">
			<label for="idFecha">Fecha de nacimiento</label><span class="obligatorio">*</span>&nbsp;&nbsp;
			<input  type="text" id="idFecha" name="fecha" onchange="calcularEdad();" />
			<span class="avisos" id="aFecha">
				Debes ser mayor de 13 años.
			</span>
			<div id="result"></div>
			</div>
			<hr/>
			<div class="form-group">
				<p>Debes introducir tu antigua contraseña si quieres seguir adelante.</p>
			<label for="pass_antigua">Antigua ontraseña</label><span class="obligatorio">*</span>
			<input class="form-control" type="password" id="pass_antigua"
			data-toogle="tooltip" data-placement="left" title="contraseña" onchange="comprobar_pwd()"/>
			<input class="form-control" type="hidden" id="ant_hash_passwrd" name="ant_hash_passwrd" />
			<span class="avisos" id="anteriorPwd">
				Entre 5 y 15 caracteres. La contraseña ha de incluir al menos tres de los siguientes elementos: números, mayúsculas, minúsculas o alguno de estos símbolos ($, @, !, %,*, &amp;).
			</span>
			</div>

			<div class="form-group">
			<input type="button" class="btn btn-default" value="Borrar esta" onclick="validar();"
			 />
			 <input type="hidden" id="idUsuario" class="idUsuario" name="idUsuario">
			</div>
			</form>
</div>
<div id="tabs-3">
<p style="color: red;font-weight: 600;">** Antes de continuar debes tener en cuenta que una vez desactives tu cuenta no  podrás volver a hacer uso de ella.</p>
<form id="formBorrado" name="formBorrado" action="<?=base_url()?>administrador/cancelarCuenta" method="post">
	<fieldset>
		<legend>
			DESACTIVACIÓN DE CUENTA
		</legend>
	<div class="form-group">
		<h5>Introduce tu contraseña para continuar</h5>
		<label for="hash_pwd">Contraseña actual:</label><span class="obligatorio">*</span>
		<input class="form-control" type="password" id="pwdConf"
		data-toogle="tooltip" data-placement="left" title="contraseña"/>
		<input class="form-control" type="hidden" id="hash_pwd" name="hash_pwd" />
		<span class="avisos" id="con_pas">
			la contraseña debe tener un formato válido.
		</span>
	</div>
	<div class="form-group">
		<input type="button" class="btn btn-default" id="registrarse" name ="registrarse" value="Registrarse" onclick="confirmacion();"
		 />
		 <input type="hidden" id="idUsu" class="idUsuario" name="idUsu">
	</div>
	</fieldset>
</form>
</div>
</section>
</div>
<script>
	function verf_password(confm) {
    if (confm!="") {
    	expresion = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{5,15}$/;
		if (expresion.test(confm)) {
			idFormulario.idPwd.style.borderColor="blue";
			document.getElementById("con_pas").style.display="none";
			return true;
		} else {
			document.getElementById("con_pas").style.display="initial";
			idFormulario.idPwd.style.borderColor="red";
			return false;
		}
    } else {
		document.getElementById("con_pas").style.display="initial";
		idFormulario.idPwd.style.borderColor="red";
		return false;
    }
}
</script>

