<?php
class Profesion extends CI_Controller {
	public function comprobarRol(){
		if (session_status () == PHP_SESSION_NONE) {session_start ();}
		if (isset ( $_SESSION ['rol'] ) && ($_SESSION['rol'] == 'administrador')) {
			return true;
		} else {
			return false;
		}
	}
	
	public function acceso_denegado(){
		header ("location:".base_url());
	}
	
	public function comprobarprofesion() {
		$this->load->model ( "profesion_model" );
		$nombre = isset ( $_POST ["nombre"] ) ? $_POST ["nombre"] : null;
		$disponible = $this->profesion_model-> getprofesionPorNombre ( $nombre );
		if ($disponible) {
			$datos ['mensaje'] ["texto"] = 'profesión disponible';
		} else {
			$datos ['mensaje'] ['texto'] = "profesión existente";
			$datos ['mensaje'] ['nivel'] = 'error';
			$this->load->view ( "profesion/mensaje", $datos );
		}
	}
	
	public function crear() {
		if ($this -> comprobarRol()) {
			enmarcar ( $this, "profesion/crear" );
		} else {
			$this->acceso_denegado();
		}
	}
	
	public function crearPost() {
		$this->load->model ( "profesion_model" );
		$nombre = isset ( $_POST ["nombre"] ) ? $_POST ["nombre"] : null;
		$estado= isset($_POST['estado'])?$_POST['estado']:false;
		try {
		    $registro = $this->profesion_model->crear_profesion ( $nombre,$estado );
			header ( "location: " . base_url () . "profesion/crearOk?nombre=" . $nombre );
		} catch ( Exception $e ) {
			$datos ['mensaje'] ['texto'] = "La profesión ya existe";
			$datos ['mensaje'] ['nivel'] = 'error';
			$this->load->view ( "profesion/mensaje", $datos );
		}
	}
	
	public function crearOk() {
		$nombre = isset ( $_GET ['nombre'] ) ? $_GET ['nombre'] : null;
		$datos ['mensaje'] ['texto'] = 'La profesion ' . $nombre . ' se ha añadido correctamente';
		$datos ['mensaje'] ['nivel'] = 'ok';

		$datos ['mensaje'] ['link'] ['listar'] = "profesion";
		$datos ['mensaje'] ['link'] ['crear'] = "profesion";
		enmarcar ( $this, "profesion/mensaje", $datos );
	}
	
	public function listar() {
		$this->listarPost ();
	}
	
	public function listarPost() {
		$this->load->model ( 'profesion_model' );
		$datos ['body'] ['profesiones'] = $this->profesion_model->getAll();
		enmarcar ( $this, 'profesion/listar', $datos );
	}
	
	public function editar() {
		if ($this->comprobarRol()) {
			$this->load->model ( 'profesion_model' );
			$id_profesion = isset ( $_POST ['id_profesion'] ) ? $_POST ['id_profesion'] : null;
			$datos ['body'] ['profesiones'] = $this->profesion_model->getprofesionPorId ( $id_profesion );
			enmarcar ( $this, 'profesion/editar', $datos );
		} else {
			$this->acceso_denegado();
		}
	}
	
	public function editarPost() {
		$this->load->model ( 'profesion_model' );
		$id_profesion = isset ( $_POST ['id_profesion'] ) ? $_POST ['id_profesion'] : null;
		$nombre_anterior = isset ( $_POST ['nombreAnterior'] ) ? $_POST ['nombreAnterior'] : null;
		$nombre_nuevo = isset ( $_POST ['nombre'] ) ? $_POST ['nombre'] : null;
		try {
			$this->profesion_model->editar ( $id_profesion, $nombre_nuevo );
				
			$datos ['mensaje'] ['texto'] = "La profesión " . $nombre_anterior . " se ha actualizado a " . $nombre_nuevo;
			$datos ['mensaje'] ['nivel'] = 'ok';
			$datos ['mensaje'] ['link'] ['listar'] = "profesion";
			$datos ['mensaje'] ['link'] ['crear'] = "profesion";
			enmarcar ( $this, 'profesion/mensaje', $datos );
		} catch ( Exception $e ) {
			$datos ['mensaje'] ['texto'] = "El nuevo nombre ya existe";
			$datos ['mensaje'] ['nivel'] = 'error';
			$this->load->view ( "profesion/mensaje", $datos );
		}
	}
	
	public function borrarPost() {
		if ($this->comprobarRol()) {
			$this->load->model ( 'profesion_model' );
			$id_profesion = $_POST ['id_profesion'];
			$this->profesion_model->borrar ( $id_profesion );
			$this->listar();
		} else {
			$this->acceso_denegado();
		}
	} 
	
	public function activarPost() {
		if ($this->comprobarRol()) {
		    $this->load->model ( 'profesion_model' );
		    $id_profesion = $_POST ['id_profesion'];
		    $this->profesion_model->activar ( $id_profesion );
		    $this->listar();
		} else {
			$this->acceso_denegado();
		}
	}
}

?>