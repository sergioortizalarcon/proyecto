<?php
class actor extends CI_Controller {
	public function crear() {
		$this->load->model('pais_model');
		$datos['body']['paises'] = $this->pais_model->getTodos();
		enmarcar($this, "actor/crearGET", $datos);
	}

	public function crearPost() {
		$this->load->model('actor_model');
		$nombre = isset($_POST['nombre'])?$_POST['nombre']:null;
		$apellido1 = isset($_POST['apellido1'])?$_POST['apellido1']:null;
		$apellido2 = isset($_POST['apellido2'])?$_POST['apellido2']:null;
		$fechaNacimiento = isset($_POST['fechaNacimiento'])?$_POST['fechaNacimiento']:null;
		$id_pais = isset($_POST['pais'])?$_POST['pais']:null;
		
		try {
			$debug = $this -> actor_model -> createActor($nombre, $apellido1, $apellido2, $fechaNacimiento, $id_pais);
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
	
	public function editar() {
		$this->load->model ( 'actor_model' );
		$this->load->model('pais_model');
		$id_actor = $_POST ['id_actor'];
		$datos ['body']['actores'] = $this->actor_model->getActorPorId ( $id_actor );
		$datos['body']['paises'] = $this->pais_model->getTodos();
		enmarcar ( $this, 'actor/editar', $datos);
	}
	
	public function editarPost() {
		$this->load->model ( 'actor_model' );
		
		$nombre = isset($_POST['nombre'])?$_POST['nombre']:null;
		$apellido1 = isset($_POST['apellido1'])?$_POST['apellido1']:null;
		$apellido2 = isset($_POST['apellido2'])?$_POST['apellido2']:null;
		$fechaNacimiento = isset($_POST['fechaNacimiento'])?$_POST['fechaNacimiento']:null;
		$pais = isset($_POST['pais'])?$_POST['pais']:null;
		$id_actor = $_POST ['id_actor'];
	
		$this->actor_model->editar ( $id_actor, $nombre, $apellido1, $apellido2, $fechaNacimiento, $pais );
	}
	
	public function borrar() {
		$datos ['body'] ['accion'] = 'borrar';
		$datos ['body'] ['filtro'] = '';
		$this->filtrar ( $datos );
	}
	
	public function borrarPost() {
		$this->load->model ( 'actor_model' );
		$id_actor = $_POST ['id_actor'];
		$this->actor_model->borrar ( $id_actor );
		
		$this->listarPost();
	}
}
?>