<script type="text/javascript">
	var xhr;
	var nombreOk=false;
	var apeUnoOk=false;
	var passOk=false;
	window.onload = function(){
		xhr = new XMLHttpRequest();
	}
	function accionAJAX() {
		if (xhr.readyState==4 && xhr.status==200) {
			document.getElementById("result").innerHTML = xhr.responseText;
		}
	}

function comprobarAlias(alias) {
	xhr.open("POST", "<?=base_url()?>usuario/comprobarDispAlias", true);
	xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
	xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xhr.send("alias="+alias);
	xhr.onreadystatechange = function(){
		if (xhr.readyState==4 && xhr.status==200) {
			document.getElementById("result").innerHTML =xhr.responseText;
			if(!xhr.responseText){
				idFormulario.idAlias.style.borderColor="blue";
				document.getElementById("aAlias").style.display="none";
			}
		}
	}
}

function comprobarCorreo(correo) {
	xhr.open("POST", "<?=base_url()?>usuario/comprobarDispCorreo", true);
	xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
	xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xhr.send("correo="+correo);
	console.log(correo)
	xhr.onreadystatechange = function(){
		if (xhr.readyState==4 && xhr.status==200) {
			document.getElementById("result").innerHTML =xhr.responseText;
			if(!xhr.responseText){
				idFormulario.idEmail.style.borderColor="blue";
		        	document.getElementById("aEmail").style.display="none";
			}
		}
	}
}

function peticionAJAX(nombre,ape1,ape2,alias,correo,pwd,fecha) {
	xhr.open("POST", "<?=base_url()?>usuario/crearPost", true);
	xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
	xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xhr.send("nombre="+nombre+"&apellido1="+ape1+"&apellido2="+ape2+"&alias="+alias+"&correo="+correo+"&pwd="+pwd+"&fecha="+fecha);
	xhr.onreadystatechange = function(){
		if (xhr.readyState==4 && xhr.status==200) {
			document.getElementById("result").innerHTML = xhr.responseText;
		}
	}
}

function validarCorreo() {
	var correo = document.getElementById("idEmail").value;
		if (correo!="") {
		expresion =/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
		    if (expresion.test(correo)) {
		    	if (comprobarCorreo(correo)) {
		    		console.log("disp correo:" +comprobarCorreo(correo));
		        	idFormulario.idEmail.style.borderColor="blue";
		        	document.getElementById("aEmail").style.display="none";
		        	
		        } else {
					idFormulario.idEmail.style.borderColor="red";
					document.getElementById("aEmail").style.display="initial";
				    return false;
				}
		        return true;
		    } else {
		        document.getElementById("aEmail").style.display="initial";
		        idFormulario.idEmail.style.borderColor="red";
		        return false;
		    }
		} else {
		    document.getElementById("aEmail").style.display="initial";
		    idFormulario.idEmail.style.borderColor="red";
		    return false;
		}
	}

function validarAlias() {
	var alias = document.getElementById("idAlias").value;
		if(alias!="") {
			expresion = /^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑçÇ\d]{0,4}[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑçÇ]{1,4}[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑçÇ\d]{1,6}$/;
			if (expresion.test(alias)) {
				if (comprobarAlias(alias)) {
					idFormulario.idAlias.style.borderColor="blue";
					document.getElementById("aAlias").style.display="none";
		        	
				} else {
					idFormulario.idAlias.style.borderColor="red";
					document.getElementById("aAlias").style.display="initial";
				    return false;
				}
				return true;
			} else {
				idFormulario.idAlias.style.borderColor="red";
				document.getElementById("aAlias").style.display="initial";
			    return false;
			}
		} else 	{
			idFormulario.idAlias.style.borderColor="red";
			document.getElementById("aAlias").style.display="initial";
			return false;
		}
}

    function validarNombre() {
    	var nombre = document.getElementById("idNombre").value;
        if(nombre!="") {
            expresion = /^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ]{3,20}$/;
			if (expresion.test(nombre)) {
				//Separo la primera letra para hacerla mayor, y la guardo en la variable nombre.
				var m = nombre.charAt(0);
				nombre= m.toUpperCase()+nombre.substring(1,nombre.length);
				idFormulario.idNombre.style.borderColor="blue";
				document.getElementById("aNombre").style.display="none";
		        	nombreOk=true;
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
    	var ape1 = document.getElementById("idApe1").value;
        if(ape1!="") {
        expresion = /^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ]{3,20}$/;
			if (expresion.test(ape1)) {
				var m1 = ape1.charAt(0);
				ape1= m1.toUpperCase()+ape1.substring(1,ape1.length);
				idFormulario.idApe1.style.borderColor="blue";
				document.getElementById("aApellido").style.display="none";
		        	//activar_registro();
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
		var ape2 = document.getElementById("idApe2").value;
		if (ape2!=""){
			c = ape2.split(" ");
			ap="";
		    //no limita a dos palabras
			expresion = /^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ]{0,20}$/;//(\s[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ]{3-20}){1,2}$/;
			for (var i = 0; i < c.length; i++) {
				if (expresion.test(c[i])) {
					m2 = c[i].charAt(0);
					ap += m2.toUpperCase()+c[i].substring(1,c[i].length)+" ";
					idFormulario.idApe2.style.borderColor="blue";
					document.getElementById("aApellidoDos").style.display="none";
				} else {
					document.getElementById("aApellidoDos").style.display="initial";
					idFormulario.idApe2.style.borderColor="red";
					return false;
				}
			}
			//devuelve el valor correcto quitando el ultimo espacio para que no pete al volver a darle.
			ape2 = ap.substring(0,ap.length-1);
		} else {
			ape2 = " ";
		}
		return true;
	}

	

   var pwd="";         
	function validarPass() {
	pwd = document.getElementById("idPwd").value;
		if (pwd!="") {
		expresion = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,15}$/;
			if (expresion.test(pwd)) {
			    idFormulario.idPwd.style.borderColor="blue";
			    document.getElementById("aPwd").style.display="none";
			    if( confirmarPass()){
			    	return true;
			    } else {
			   	document.getElementById("aPwdD").style.display="initial";
			    idFormulario.idPwd.style.borderColor="red";
			    return false;
			    }
			} else {
			    document.getElementById("aPwd").style.display="initial";
			    idFormulario.idPwd.style.borderColor="red";
			    return false;
			}
		} else {
		    document.getElementById("aPwd").style.display="initial";
		    idFormulario.idPwd.style.borderColor="green";
		    return false;
		}
	}

	function confirmarPass() {
		var pwdDos = document.getElementById("idPwdD").value;
		if (pwdDos!="") {
		expresion = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,15}$/;
		    if (expresion.test(pwdDos)) {
		        idFormulario.idPwdD.style.borderColor="blue";
		        document.getElementById("aPwdD").style.display="none";
		    	if (pwd == pwdDos) {

		    		//encripta la contraseña
		    		pcripto = sha256(pwd);
		        	//activar_registro();
		        	passOk=true;
		        	return true;
		    	} else {
		    		document.getElementById("aPwdD").style.display="initial";
		        	idFormulario.idPwdD.style.borderColor="red";
		        	return false;
		    	}
		    } else {
		        document.getElementById("aPwdD").style.display="initial";
		        idFormulario.idPwdD.style.borderColor="red";
		        return false;
		    }
		} else {
		    document.getElementById("aPwdD").style.display="initial";
		    idFormulario.idPwdD.style.borderColor="green";
		    return false;
		}
	}

	

	

	function validate_fecha(fecha){
    var patron=new RegExp("^(19|20)+([0-9]{2})([-])([0-9]{1,2})([-])([0-9]{1,2})$");
 
    if(fecha.search(patron)==0){
        var values=fecha.split("-");
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
 
/**
 * Esta función calcula la edad de una persona y los meses
 * La fecha la tiene que tener el formato yyyy-mm-dd que es
 * metodo que por defecto lo devuelve el <input type="date">
 */
function calcularEdad() {
	fecha = document.getElementById("idFecha").value;
    if(validate_fecha(fecha)==true) {
        // Si la fecha es correcta, calculamos la edad
        var values=fecha.split("-");
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
        if (edad<13) {
        	document.getElementById("aFecha").style.display="initial";
        } else {
        	document.getElementById("aFecha").style.display="none";
        }
        document.getElementById("result").innerHTML="Tienes "+edad+" años, "+meses+" meses y "+dias+" días";
        return true;
    } else {
        document.getElementById("result").innerHTML="La fecha "+fecha+" es incorrecta";
        return false;
    }
}
/*
function activarRegistro(){
	totalin = document.getElementsByTagName("input");
	console.log(totalin.length);
		
	var contador=0;
	console.log(contador);

	for (var i = 0; i < totalin.length; i++) {
		console.log(totalin[i]);
		if (totalin[i].style.borderColor!="blue") {
			console.log(totalin[i].style.borderColor);
			contador++;
		}
	}

	if (contador>0) {
		document.getElementById("registrarse").disabled = true;
	}
}
*/


/*
function activar_registro(){
	if ( nombreOk &&	apeUnoOk && passOk){
	document.getElementById("registrarse").disabled=false;
} else {
	document.getElementById("registrarse").disabled=true;
}
}*/

</script>
<div class="container ">
<form id="idFormulario" action="<?= base_url()?>usuario/crearPost" method="post" >
<fieldset>
<legend>Crear nuevo usuario</legend>

<small style="float:right;"> (<span class="obligatorio">*</span> Campos obligatorios)</small>

<div class="form-group">
<label for="idNombre">Nombre</label><span class="obligatorio">*</span>
<input class="form-control" type="text" id="idNombre" name="nombre" onfocusout="validarNombre();" />
<span class="avisos" id="aNombre">
	Debes escribir un nombre válido(3 a 20 caracteres no númericos o simbolos).
</span>
</div>

<div class="form-group">
<label for="idApe1">Primer apellido</label><span class="obligatorio">*</span>
<input class="form-control" type="text" id="idApe1" name="apellido1" onfocusout="validarApeUno();" />
<span class="avisos" id="aApellido">
	Debes escribir un apellido válido(3 a 20 caracteres no númericos o simbolos).
</span>
</div>

<div class="form-group">	
<label for="idApe2">Segundo apellido</label>
<input class="form-control" type="text" id="idApe2" name="apellido2" onfocusout="validarApeDos();" />
<span class="avisos" id="aApellidoDos">
	Debes escribir dos apellido como máximo y entre 3 a 20 caracteres no númericos o simbolos.
</span>
</div>

<div class="form-group">
<label for="idAlias">Alias</label><span class="obligatorio">*</span>
<input class="form-control" type="text" id="idAlias" name="alias" onfocusout="validarAlias();"/>
<span class="avisos" id="aAlias">
	Debes tener un alias válido (máximo 14 caracteres, alfa numéricos)
</span>
</div>

<div class="form-group">
<label for="idEmail">Email</label><span class="obligatorio">*</span>
<input class="form-control" type="text" id="idEmail" name="correo" onfocusout="validarCorreo();" />
<span class="avisos" id="aEmail">
	Debes escribir un correo válido.
</span>
</div>

<div class="form-group">	
<label for="idPwd">Contraseña</label><span class="obligatorio">*</span>
<input class="form-control" type="password" id="idPwd" name="pwd" />
<span class="avisos" id="aPwd">
	Entre 8 y 15 caracteres. La contraseña ha de incluir al menos tres de los siguientes elementos: números, mayúsculas, minúsculas o alguno de estos símbolos ($, @, !, %,*, &amp;).
</span>
</div>

<div class="form-group">	
<label for="idPwdD">Repetir Contraseña</label><span class="obligatorio">*</span>
<input class="form-control" type="password" id="idPwdD" name="pwdD" onfocusout="validarPass();" />
<span class="avisos" id="aPwdD">
	Debe coincidir con la contraseña introducida en el recuadro anterior.
</span>
</div>

<div class="form-group">
<label for="idFecha">Fecha de nacimiento</label><span class="obligatorio">*</span>
<input class="form-control" type="date" id="idFecha" name="fecha" onfocusout="calcularEdad();" />
<span class="avisos" id="aFecha">
	Debes ser mayor de 13 años. 
</div>

<div class="form-group">
<input type="submit" class="btn btn-default" id="registrarse" value="Registrarse" />
</div>
</fieldset>
	</form>

<div id="result"></div>

<script>
	document.getElementById("idNombre").value="pepe";
document.getElementById("idApe1").value="perez";
document.getElementById("idApe2").value="perales";
document.getElementById("idAlias").value="menancio3";
document.getElementById("idEmail").value="un.yaparte@gmail.com";
//23aA$@$!%*?&
document.getElementById("idPwd").value="23aA$@$!%*?&";
document.getElementById("idPwdD").value="23aA$@$!%*?&";
document.getElementById("idFecha").value="2002-10-25";
</script>
</div>