<?php
class usuario extends CI_Controller {
	
	public function registrar(){
		$this -> load -> model("pais_model");
		$datos["paises"] = $this -> pais_model -> getTodos();
		enmarcar($this, "usuario/registrar",$datos);
	}

	/*1.- COMPROBACIONES PARA REGISTRARSE  */
	public function comprobarDispAlias() {
		$this -> load -> model("usuario_model");
		$alias = isset($_POST["alias"])?$_POST["alias"]:null;
		$comprobacion = $this -> usuario_model -> comprobar_alias($alias);
		if ($comprobacion) {
			$datos['mensaje']['texto'] = "Alias disponible";
			$datos['mensaje']['nivel'] = 'ok';
			} else {
			$datos['mensaje']['texto'] = "Alias existente";
			$datos['mensaje']['nivel'] = 'error';
			$this->load->view("usuario/mensaje",$datos);
			}
	}

	public function comprobarDispCorreo() {
		$this -> load -> model("usuario_model");
		$correo = isset($_POST["correo"])?$_POST["correo"]:null;
		$comprobacion = $this -> usuario_model -> comprobar_email($correo);
		if ($comprobacion) {
			//editar -> si no existe no devuelve nada por lo q si es correcto no devuelve nada y se evalua eso
			$datos['mensaje']['texto'] = "Mail ok";
			$datos['mensaje']['nivel'] = 'ok';
			} else {
			$datos['mensaje']['texto'] = "Mail en uso";
			$datos['mensaje']['nivel'] = 'error';
			$this->load->view("usuario/mensaje",$datos);
			}
	}

	/* 1.- */

	/* 2.- REGISTRO Y REDIRECCION */
	public function crearPost() {
		$this -> load -> model("usuario_model");
		$nombre= isset($_POST["nombre"])?$_POST["nombre"]:null;
		$ape1 = isset($_POST["apellido1"])?$_POST["apellido1"]:null;
		$ape2 = isset($_POST["apellido2"])?$_POST["apellido2"]:"";
		$alias = isset($_POST["alias"])?$_POST["alias"]:null;
		$email = isset($_POST["correo"])?$_POST["correo"]:null;
		$pwd = isset($_POST["pwd"])?$_POST["pwd"]:null;
		$fecha = isset($_POST["fecha"])?$_POST["fecha"]:null;
		$idPais = isset($_POST["pais"])?$_POST["pais"]:null;

		try {
			$comprobacion = $this -> usuario_model -> comprobar_usuario($alias, $email);
			if ($comprobacion) {
				$this -> usuario_model -> create_usuario($nombre, $ape1, $ape2, $alias, $email, $pwd, $fecha,$idPais);
				header('Location:'.base_url().'usuario/crearOk');
			} else {
				header('Location:'.base_url().'usuario/crearError');
			}
		}
		catch (Exception $e) {
			$datos['mensaje']['texto'] = "Error al crear nuevo usuario.";
			$datos['mensaje']['nivel'] = 'error';
			$this->load->view("usuario/mensaje",$datos);
		}
	}

	public function crearOk() {
		$datos['mensaje']['texto'] = "Usuario creado correctamente";
		$datos['mensaje']['nivel'] = 'ok';
		enmarcar($this, 'usuario/mensaje', $datos);
	}
	
	public function crearError() {
		$datos['mensaje']['texto'] = "El correo o alias ya existe, intentalo de nuevo.";
		$datos['mensaje']['nivel'] = 'error';
		enmarcar($this, 'usuario/mensaje', $datos);
	}

	/*	2.- 	*/


	public function listar($f='') {
		$this->load->model('usuario_model');
		$filtro = isset($_POST['filtro'])?$_POST['filtro']:$f;
		
		$datos['usuarios'] = $this->usuario_model->getAll($filtro);
		$datos['filtro'] = $filtro;
		enmarcar($this, 'usuario/listar',$datos);
	}




	/* LOGIN USUARIO */

	public function loginGet(){
		enmarcar($this,"usuario/login");
	}


}


?>