<?php
class profesion extends CI_Controller {
	public function comprobarprofesion() {
		$this->load->model ( "profesion_model" );
		$nombre = isset ( $_POST ["nombre"] ) ? $_POST ["nombre"] : null;
		$disponible = $this->profesion_model-> getprofesionPorNombre ( $nombre );
		if ($disponible) {
			$datos ['mensaje'] ["texto"] = 'género disponible';
		} else {
			$datos ['mensaje'] ['texto'] = "género existente";
			$datos ['mensaje'] ['nivel'] = 'error';
			$this->load->view ( "idioma/mensaje", $datos );
		}
	}
	
	public function crear() {
		enmarcar ( $this, "profesion/crear" );
	}
	
	public function crearPost() {
		$this->load->model ( "profesion_model" );
		$nombre = isset ( $_POST ["nombre"] ) ? $_POST ["nombre"] : null;
		$activo = isset($_POST['activo'])?$_POST['activo']:false;
		try {
		    $registro = $this->profesion_model->crear_profesion ( $nombre,$activo );
			header ( "location: " . base_url () . "profesion/crearOk?nombre=" . $nombre );
		} catch ( Exception $e ) {
			$datos ['mensaje'] ['texto'] = "El género ya existe";
			$datos ['mensaje'] ['nivel'] = 'error';
			$this->load->view ( "profesion/mensaje", $datos );
		}
	}
	
	public function crearOk() {
		$nombre = isset ( $_GET ['nombre'] ) ? $_GET ['nombre'] : null;
		$datos ['mensaje'] ['texto'] = 'El género ' . $nombre . ' se ha añadido correctamente';
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
		$this->load->model ( 'profesion_model' );
		$id_profesion = isset ( $_POST ['id_profesion'] ) ? $_POST ['id_profesion'] : null;
		try {
			$datos ['body'] ['profesiones'] = $this->profesion_model->getprofesionPorId ( $id_profesion );
			enmarcar ( $this, 'profesion/editar', $datos );
		} catch ( Exception $e ) {
			$datos ['mensaje'] ['texto'] = "Error";
			$datos ['mensaje'] ['nivel'] = "error";
			enmarcar ( $this, 'profesion/mensaje', $datos );
		}
	}
	
	public function editarPost() {
		$this->load->model ( 'profesion_model' );
		$id_profesion = isset ( $_POST ['id_profesion'] ) ? $_POST ['id_profesion'] : null;
		$nombre_anterior = isset ( $_POST ['nombreAnterior'] ) ? $_POST ['nombreAnterior'] : null;
		$nombre_nuevo = isset ( $_POST ['nombre'] ) ? $_POST ['nombre'] : null;
		try {
			$this->profesion_model->editar ( $id_profesion, $nombre_nuevo );
				
			$datos ['mensaje'] ['texto'] = "El género " . $nombre_anterior . " se ha actualizado a " . $nombre_nuevo;
			$datos ['mensaje'] ['nivel'] = 'ok';
			enmarcar ( $this, 'profesion/mensaje', $datos );
		} catch ( Exception $e ) {
			$datos ['mensaje'] ['texto'] = "El nuevo nombre ya existe";
			$datos ['mensaje'] ['nivel'] = 'error';
			$this->load->view ( "profesion/mensaje", $datos );
		}
	}
	
	public function borrarPost() {
		$this->load->model ( 'profesion_model' );
		$id_profesion = $_POST ['id_profesion'];
		$this->profesion_model->borrar ( $id_profesion );
		$this->listar ();
	}
	
	public function activarPost() {
	    $this->load->model ( 'profesion_model' );
	    $id_profesion = $_POST ['id_profesion'];
	    $this->profesion_model->activar ( $id_profesion );
	    
	    $this->listarPost();
	}
}

?>