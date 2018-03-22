<?php
class pais extends CI_Controller {
	public function crear() {
		enmarcar ( $this, "pais/crear" );
	}
	public function crearPost() {
		$this->load->model ( "pais_model" );
		$nombre = isset ( $_POST ["nombre"] ) ? $_POST ["nombre"] : null;
		try {
			$debug = $this->pais_model->crear_pais ( $nombre );
			$datos ['mensaje'] ['texto'] = 'País añadido correctamente';
			$datos ['mensaje'] ['nivel'] = 'ok';
			$this->load->view ( "pais/mensaje", $datos );
		} catch ( Exception $e ) {
			$datos ['mensaje'] ['texto'] = "El país ya existe";
			$datos ['mensaje'] ['nivel'] = 'error';
			$this->load->view ( "pais/mensaje", $datos );
		}
	}
	public function listar() {
		$this->listarPost ();
	}
	public function listarPost($fil = '') {
		$filtro = isset ( $_POST ['filtro'] ) ? $_POST ['filtro'] : $fil;
		$this->load->model ( 'pais_model' );
		$datos ['body'] ['paises'] = $this->pais_model->getTodos ( $filtro );
		$datos ['filtro'] = $filtro;
		enmarcar ( $this, 'pais/listar', $datos );
	}
	public function editar() {
		$this->load->model ( 'pais_model' );
		$id_pais = isset ( $_POST ['id_pais'] ) ? $_POST ['id_pais'] : null;
		try {
			$datos ['body'] ['paises'] = $this->pais_model->getPaisPorId ( $id_pais );
			enmarcar ( $this, 'pais/editar', $datos );
		} catch ( Exception $e ) {
			$datos ['mensaje'] ['texto'] = "Error";
			$datos ['mensaje'] ['nivel'] = "error";
			enmarcar ( $this, 'pais/mensaje', $datos );
		}
	}
	public function editarPost() {
		$this->load->model ( 'pais_model' );
		$id_pais = isset ( $_POST ['id_pais'] ) ? $_POST ['id_pais'] : null;
		$nombre = isset ( $_POST ['nombre'] ) ? $_POST ['nombre'] : null;
		
		try {
			$this->pais_model->editar ( $id_pais, $nombre );
			
			$datos ['mensaje'] ['texto'] = "País " . $nombre . " añadido";
			$datos ['mensaje'] ['nivel'] = 'ok';
			enmarcar ( $this, 'pais/mensaje', $datos );
		} catch ( Exception $e ) {
			$datos ['mensaje'] ['texto'] = "El país ya existe";
			$datos ['mensaje'] ['nivel'] = 'error';
			$this->load->view ( "pais/mensaje", $datos );
		}
	}
	public function borrar() {
		$datos ['body'] ['accion'] = 'borrar';
		$datos ['body'] ['filtro'] = '';
		$this->filtrar ( $datos );
	}
	public function borrarPost() {
		$this->load->model ( 'pais_model' );
		$id_pais = $_POST ['id_pais'];
		$this->pais_model->borrar ( $id_pais );
		
		$this->listar ();
	}
}

?>