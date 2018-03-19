<?php
class usuario extends CI_Controller {
	
	public function registrar(){
		enmarcar($this, "usuario/registrar");
	}
	
	public function crearPost() {
		$nombre= isset($_POST["nombre"])?$_POST["nombre"]:null;
		$ape1 = isset($_POST["ape1"])?$_POST["ape1"]:null;
		$ape2 = isset($_POST["ape2"])?$_POST["ape2"]:"";
		$alias = isset($_POST["alias"])?$_POST["alias"]:null;
		$email = isset($_POST["correo"])?$_POST["correo"]:null;
		$pwd = isset($_POST["pwd"])?$_POST["pwd"]:null;
		$fecha = isset($_POST["fecha"])?$_POST["fecha"]:null;

		try {
			$this -> load -> model("usuario_model");
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