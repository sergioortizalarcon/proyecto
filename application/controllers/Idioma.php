<?php
class Idioma extends CI_Controller {
	public function crear() {
		enmarcar ( $this, "idioma/crear" );
	}
	public function crearPost() {
		$this->load->model ( "idioma_model" );
		
		$nombre = isset ( $_POST ["nombre"] ) ? $_POST ["nombre"] : null;
		$activo = isset ( $_POST ['activo'] ) ? $_POST ['activo'] : 'Inactivo';
		
		try {
			$registro = $this->idioma_model->crearIdioma ( $nombre, $activo );
			header ( "location:" . base_url () . "idioma/crearOk" );
		} catch ( Exception $e ) {
			$datos ['mensaje'] ['texto'] = "El idioma ya existe";
			$datos ['mensaje'] ['nivel'] = 'error';
			$datos ['mensaje'] ['link'] ['listar'] = "idioma";
			$datos ['mensaje'] ['link'] ['crear'] = "idioma";
			enmarcar ( $this, "idioma/mensaje", $datos );
		}
	}
	public function crearOK() {
		$datos ['mensaje'] ['texto'] = 'El idioma se ha añadido correctamente';
		$datos ['mensaje'] ['nivel'] = 'ok';
		$datos ['mensaje'] ['link'] ['listar'] = "idioma";
		$datos ['mensaje'] ['link'] ['crear'] = "idioma";
		enmarcar ( $this, "idioma/mensaje", $datos );
	}
	public function listar() {
		$this->listarPost ();
	}
	public function listarPost() {
		$this->load->model ( 'idioma_model' );
		$datos ['body'] ['idiomas'] = $this->idioma_model->getTodos ();
		enmarcar ( $this, 'idioma/listar', $datos );
	}
	public function editar() {
		$this->load->model ( 'idioma_model' );
		$id_idioma = $_POST ['id_idioma'];
		$datos ['body'] ['idiomas'] = $this->idioma_model->getIdiomaPorId ( $id_idioma );
		enmarcar ( $this, 'idioma/editar', $datos );
	}
	public function editarPost() {
		$this->load->model ( 'idioma_model' );
		$nombre = isset ( $_POST ['nombre'] ) ? $_POST ['nombre'] : null;
		$id_idioma = $_POST ['id_idioma'];
		try {
			$this->idioma_model->editar ( $id_idioma, $nombre );
			header ( "location:" . base_url () . "idioma/editarOk" );
		} catch ( Exception $e ) {
			$datos ['mensaje'] ['texto'] = "Idioma ya existente";
			$datos ['mensaje'] ['nivel'] = 'error';
			$datos ['mensaje'] ['link'] ['listar'] = "idioma";
			$datos ['mensaje'] ['link'] ['crear'] = "idioma";
			enmarcar ( $this, "idioma/mensaje", $datos );
		}
	}
	public function editarOK() {
		$datos ['mensaje'] ['texto'] = "Idioma modificado correctamente";
		$datos ['mensaje'] ['nivel'] = 'ok';
		$datos ['mensaje'] ['link'] ['listar'] = "idioma";
		$datos ['mensaje'] ['link'] ['crear'] = "idioma";
		enmarcar ( $this, "idioma/mensaje", $datos );
	}
	public function borrar() {
		$datos ['body'] ['accion'] = 'borrar';
		$datos ['body'] ['filtro'] = '';
		$this->filtrar ( $datos );
	}
	public function borrarPost() {
		$this->load->model ( 'idioma_model' );
		$id_idioma = $_POST ['id_idioma'];
		$this->idioma_model->borrar ( $id_idioma );
		
		$this->listarPost ();
	}
	public function activarPost() {
		$this->load->model ( 'idioma_model' );
		$id_idioma = $_POST ['id_idioma'];
		$this->idioma_model->activar ( $id_idioma );
		
		$this->listar ();
	}
	
}

?>