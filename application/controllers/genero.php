<?php
class genero extends CI_Controller {
	public function comprobargenero() {
		$this->load->model ( "genero_model" );
		$nombre = isset ( $_POST ["nombre"] ) ? $_POST ["nombre"] : null;
		$disponible = $this->genero_model-> getgeneroPorNombre ( $nombre );
		if ($disponible) {
			$datos ['mensaje'] ["texto"] = 'género disponible';
		} else {
			$datos ['mensaje'] ['texto'] = "género existente";
			$datos ['mensaje'] ['nivel'] = 'error';
			$this->load->view ( "idioma/mensaje", $datos );
		}
	}
	public function crear() {
		enmarcar ( $this, "genero/crear" );
	}
	public function crearPost() {
		$this->load->model ( "genero_model" );
		$nombre = isset ( $_POST ["nombre"] ) ? $_POST ["nombre"] : null;
		try {
			$registro = $this->genero_model->crear_genero ( $nombre );
			header ( "location: " . base_url () . "genero/crearOk?nombre=" . $nombre );
		} catch ( Exception $e ) {
			$datos ['mensaje'] ['texto'] = "El género ya existe";
			$datos ['mensaje'] ['nivel'] = 'error';
			$this->load->view ( "genero/mensaje", $datos );
		}
	}
	public function crearOk() {
		$nombre = isset ( $_GET ['nombre'] ) ? $_GET ['nombre'] : null;
		$datos ['mensaje'] ['texto'] = 'El género ' . $nombre . ' se ha añadido correctamente';
		$datos ['mensaje'] ['nivel'] = 'ok';

		$datos ['mensaje'] ['link'] ['listar'] = "genero";
		$datos ['mensaje'] ['link'] ['crear'] = "genero";
		enmarcar ( $this, "genero/mensaje", $datos );
	}
	public function listar() {
		$this->listarPost ();
	}
	public function listarPost($fil = '') {
		$this->load->model ( 'genero_model' );
		$filtro = isset ( $_POST ['filtro'] ) ? $_POST ['filtro'] : $fil;
		$datos ['body'] ['generos'] = $this->genero_model->getTodos ( $filtro );
		$datos ['filtro'] = $filtro;
		enmarcar ( $this, 'genero/listar', $datos );
	}
	public function editar() {
		$this->load->model ( 'genero_model' );
		$id_genero = isset ( $_POST ['id_genero'] ) ? $_POST ['id_genero'] : null;
		try {
			$datos ['body'] ['generos'] = $this->genero_model->getgeneroPorId ( $id_genero );
			enmarcar ( $this, 'genero/editar', $datos );
		} catch ( Exception $e ) {
			$datos ['mensaje'] ['texto'] = "Error";
			$datos ['mensaje'] ['nivel'] = "error";
			enmarcar ( $this, 'genero/mensaje', $datos );
		}
	}
	public function editarPost() {
		$this->load->model ( 'genero_model' );
		$id_genero = isset ( $_POST ['id_genero'] ) ? $_POST ['id_genero'] : null;
		$nombre_anterior = isset ( $_POST ['nombreAnterior'] ) ? $_POST ['nombreAnterior'] : null;
		$nombre_nuevo = isset ( $_POST ['nombre'] ) ? $_POST ['nombre'] : null;
		try {
			$this->genero_model->editar ( $id_genero, $nombre_nuevo );
				
			$datos ['mensaje'] ['texto'] = "El género " . $nombre_anterior . " se ha actualizado a " . $nombre_nuevo;
			$datos ['mensaje'] ['nivel'] = 'ok';
			enmarcar ( $this, 'genero/mensaje', $datos );
		} catch ( Exception $e ) {
			$datos ['mensaje'] ['texto'] = "El nuevo nombre ya existe";
			$datos ['mensaje'] ['nivel'] = 'error';
			$this->load->view ( "genero/mensaje", $datos );
		}
	}
	public function borrar() {
		$datos ['body'] ['accion'] = 'borrar';
		$datos ['body'] ['filtro'] = '';
		$this->filtrar ( $datos );
	}
	public function borrarPost() {
		$this->load->model ( 'genero_model' );
		$id_genero = isset ( $_POST ['id_genero'] ) ? $_POST ['id_genero'] : null;
		$this->genero_model->borrar ( $id_genero );
		header ( "location: " . base_url () . "genero/listar" );
		$this->listar ();
	}
}

?>