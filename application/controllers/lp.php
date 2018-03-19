<?php
class lp extends CI_Controller {
	public function crear() {
		enmarcar($this, 'lp/crearGET');
	}
	
	public function crearPost() {
		$this->load->model('lp_model');
		
		$nombre_lp = isset($_POST['lp']) ? $_POST['lp'] : null;
		
		try {
			$this -> lp_model -> create_lp($nombre_lp);
			$datos['mensaje']['texto'] = "Lenguaje $nombre_lp creado correctamente";
			$datos['mensaje']['nivel'] = 'ok';
		}
		catch (Exception $e) {
			$datos['mensaje']['texto'] = "Lenguaje $nombre_lp duplicado";
			$datos['mensaje']['nivel'] = 'error';
		}
		$this->load->view('lp/mostrar_mensaje',$datos);
	}

	public function listar() {
		$this->listarPost();
	}
	
	public function listarPost($f='') {
		$filtro = isset($_POST['filtro'])?$_POST['filtro']:$f;
		$this->load->model('lp_model');
		$datos['lps'] = $this->lp_model->getAll($filtro);
		$datos['filtro'] = $filtro;
		enmarcar($this, 'lp/listar',$datos);
	}
	
	public function borrar() {
		$id = $_POST['idLP'];
		$filtro=$_POST['filtro'];
		
		$this->load->model('lp_model');
		$this->lp_model->borrar($id);
		
		$this->listarPost($filtro);
	}

	public function editar() {
		$idLP = $_POST['idLP'];
		$filtro = $_POST['filtro'];
		
		$this->load->model('lp_model');
		$datos['lp'] = $this->lp_model-> getByID($idLP);
		$datos['filtro'] = $filtro;
		
		enmarcar($this, 'lp/editar',$datos);
	}
	
	public function editarPost() {
		$nombre = $_POST['nombre'];
		$id = $_POST['idLP'];
		$filtro = $_POST['filtro'];
		
		$this->load->model('lp_model');
		$this->lp_model->update($id, $nombre);
		
		// enmarcar($this, 'lp/listarPost/'.$filtro); //TODO
		$this->listarPost($filtro);
	}
}

	
?>