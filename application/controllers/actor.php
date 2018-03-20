<?php
class actor extends CI_Controller {
	public function crear() {
		//TODO(Falta el model de los lenguajes
		/*$datos['body']['nacionalidades'] = $this->nacionalidad_model->getAll();
		enmarcar($this, "actor/crearGET", $datos);*/
		enmarcar($this, "actor/crearGET");
	}

	public function crearPost() {
		$this->load->model('actor_model');
		$nombre = isset($_POST['nombre'])?$_POST['nombre']:null;
		$apellido1 = isset($_POST['apellido1'])?$_POST['apellido1']:null;
		$apellido2 = isset($_POST['apellido2'])?$_POST['apellido2']:null;
		$fechaNacimiento = isset($_POST['fechaNacimiento'])?$_POST['fechaNacimiento']:null;
		$nacionalidad = isset($_POST['nacionalidad'])?$_POST['nacionalidad']:null;
		try {
			$debug = $this -> actor_model -> createActor($nombre, $apellido1, $apellido2, $fechaNacimiento, $nacionalidad);
			$datos['mensaje']['texto'] = "Actor creado correctamente";
			$datos['mensaje']['nivel'] = 'ok';
			$this->load->view("actor/mensaje",$datos);
		}
		catch (Exception $e) {
			$datos['mensaje']['texto'] = "Actor ya existente";
			$datos['mensaje']['nivel'] = 'error';
			$this->load->view("actor/mensaje",$datos);
		}
	}

	public function listar() {
		$this->listarPost();
	}
	
	public function listarPost($f='') {
		$filtro = isset($_POST['filtro'])?$_POST['filtro']:$f;
		$this->load->model('actor_model');
		$datos['body']['actores'] = $this->actor_model->getAll($filtro);
		$datos['filtro'] = $filtro;
		enmarcar($this, 'actor/listar',$datos);
	}
}
?>