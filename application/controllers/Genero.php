<?php
class Genero extends CI_Controller {
	public function crear() {
		enmarcar ( $this, "genero/crear" );
	}
	public function crearPost() {
		$this->load->model ( "genero_model" );
		
		$nombre = isset ( $_POST ["nombre"] ) ? $_POST ["nombre"] : null;
		$estado = isset ( $_POST ['estado'] ) ? $_POST ['estado'] : 'Inactivo';
		
		try {
			$registro = $this->genero_model->crearGenero ( $nombre, $estado );
			header ( "location:" . base_url () . "genero/crearOk" );
		} catch ( Exception $e ) {
			$datos ['mensaje'] ['texto'] = "El género ya existe";
			$datos ['mensaje'] ['nivel'] = 'error';
			$datos ['mensaje'] ['link'] ['listar'] = "genero";
			$datos ['mensaje'] ['link'] ['crear'] = "genero";
			enmarcar ( $this, "genero/mensaje", $datos );
		}
	}
	public function crearOK() {
		$datos ['mensaje'] ['texto'] = 'El genero se ha añadido correctamente';
		$datos ['mensaje'] ['nivel'] = 'ok';
		$datos ['mensaje'] ['link'] ['listar'] = "genero";
		$datos ['mensaje'] ['link'] ['crear'] = "genero";
		enmarcar ( $this, "genero/mensaje", $datos );
	}
	public function listar() {
		$this->listarPost ();
	}
	public function listarPost() {
		$this->load->model ( 'genero_model' );
		$datos ['body'] ['generos'] = $this->genero_model->getTodos ();
		enmarcar ( $this, 'genero/listar', $datos );
	}
	public function editar() {
		$this->load->model ( 'genero_model' );
		$id_genero = $_POST ['id_genero'];
		$datos ['body'] ['generos'] = $this->genero_model->getGeneroPorId ( $id_genero );
		enmarcar ( $this, 'genero/editar', $datos );
	}
	public function editarPost() {
		$this->load->model ( 'genero_model' );
		$nombre = isset ( $_POST ['nombre'] ) ? $_POST ['nombre'] : null;
		$id_genero = $_POST ['id_genero'];
		try {
			$this->genero_model->editar ( $id_genero, $nombre );
			header ( "location:" . base_url () . "genero/editarOk" );
		} catch ( Exception $e ) {
			$datos ['mensaje'] ['texto'] = "Género ya existente";
			$datos ['mensaje'] ['nivel'] = 'error';
			$datos ['mensaje'] ['link'] ['listar'] = "genero";
			$datos ['mensaje'] ['link'] ['crear'] = "genero";
			enmarcar ( $this, "genero/mensaje", $datos );
		}
	}
	public function editarOK() {
		$datos ['mensaje'] ['texto'] = "Género modificado correctamente";
		$datos ['mensaje'] ['nivel'] = 'ok';
		$datos ['mensaje'] ['link'] ['listar'] = "genero";
		$datos ['mensaje'] ['link'] ['crear'] = "genero";
		enmarcar ( $this, "genero/mensaje", $datos );
	}
	public function borrar() {
		$datos ['body'] ['accion'] = 'borrar';
		$datos ['body'] ['filtro'] = '';
		$this->filtrar ( $datos );
	}
	public function borrarPost() {
		$this->load->model ( 'genero_model' );
		$id_genero = $_POST ['id_genero'];
		$this->genero_model->borrar ( $id_genero );
		
		$this->listarPost ();
	}
	public function activarPost() {
		$this->load->model ( 'genero_model' );
		$id_genero = $_POST ['id_genero'];
		$this->genero_model->activar ( $id_genero );
		
		$this->listar ();
	}
}

?>