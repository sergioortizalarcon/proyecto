<?php
class actor extends CI_Controller {
	public function crear() {
		enmarcar($this, "actor/crearGET");
	}

	public function crearPost() {
		$this->load->model('actor_model');
		$nombre_actor = isset($_POST['nombre'])?$_POST['nombre']:null;
		$apellido1_actor = isset($_POST['apellido1'])?$_POST['apellido1']:null;
		$apellido2_actor = isset($_POST['apellido2'])?$_POST['apellido2']:null;
		$fechaNac_actor = isset($_POST['fechaNacimiento'])?$_POST['fechaNac']:null;
		$nacionalidad_actor = isset($_POST['nacionalidad'])?$_POST['nacionalidad']:null;
		try {
			$this -> actor_model -> create_actor($nombre_actor, $apellido1_actor, $apellido2_actor, $fechaNac_actor, $nacionalidad_actor);
			header('Location:'.base_url().'actor/crearPOSTok?actor='.$nombre_actor);
		}
		catch (Exception $e) {
			header('Location:'.base_url().'actor/crearPOSTerror?actor='.$nombre_actor);
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