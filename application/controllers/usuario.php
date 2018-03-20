<?php
class Usuario extends CI_Controller {
	
	public function registrar(){
		enmarcar($this, "usuario/registrar");
	}
	
	public function crearPost() {
		$this -> load -> model("usuario_model");
		$nombre= isset($_POST["nombre"])?$_POST["nombre"]:null;
		$ape1 = isset($_POST["apellidoUno"])?$_POST["apellidoUno"]:null;
		$ape2 = isset($_POST["apellidoDos"])?$_POST["apellidoDos"]:"";
		$alias = isset($_POST["alias"])?$_POST["alias"]:null;
		$email = isset($_POST["correo"])?$_POST["correo"]:null;
		$pwd = isset($_POST["pwd"])?$_POST["pwd"]:null;
		$fecha = isset($_POST["fecha"])?$_POST["fecha"]:null;
		
		
		//permitir que el almacenamento se amplíe a 255 caracteres
		if($pwd != null) {
			$pwd = password_hash($pwd, "PASSWORD_DEFAULT");
		}
		
		try {
			$debug = $this -> usuario_model -> create_usuario($nombre, $ape1, $ape2, $alias, $email, $pwd, $fecha);
			$datos['mensaje']['texto'] = "Empleado $debug creado correctamente";
			$datos['mensaje']['nivel'] = 'ok';
			$enmarcar($this,"usuario/mensaje",$datos);
		}
		catch (Exception $e) {
			$datos['mensaje']['texto'] = "Empleado \"$debug\" ya existente";
			$datos['mensaje']['nivel'] = 'error';
			$enmarcar($this,"usuario/mensaje",$datos);
		}
	}
}

?>