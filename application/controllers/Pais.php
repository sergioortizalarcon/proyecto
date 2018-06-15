<?php
class Pais extends CI_Controller {
	public function crear() {
		enmarcar ( $this, "pais/crear" );
	}
	public function crearPost() {
		$this->load->model ( "pais_model" );
		
		$nombre = isset ( $_POST ["nombre"] ) ? $_POST ["nombre"] : null;
		$activo = isset ( $_POST ['activo'] ) ? $_POST ['activo'] : 'Inactivo';
		
		try {
			$registro = $this->pais_model->crearPais ( $nombre, $activo );
			header ( "location:" . base_url () . "pais/crearOk" );
		} catch ( Exception $e ) {
			$datos ['mensaje'] ['texto'] = "El país ya existe";
			$datos ['mensaje'] ['nivel'] = 'error';
			$datos ['mensaje'] ['link'] ['listar'] = "pais";
			$datos ['mensaje'] ['link'] ['crear'] = "pais";
			enmarcar ( $this, "pais/mensaje", $datos );
		}
	}
	public function crearOK() {
		$datos ['mensaje'] ['texto'] = 'El país se ha añadido correctamente';
		$datos ['mensaje'] ['nivel'] = 'ok';
		$datos ['mensaje'] ['link'] ['listar'] = "pais";
		$datos ['mensaje'] ['link'] ['crear'] = "pais";
		enmarcar ( $this, "pais/mensaje", $datos );
	}
	public function listar() {
		$this->listarPost ();
	}
	public function listarPost() {
		$this->load->model ( 'pais_model' );
		$datos ['body'] ['paises'] = $this->pais_model->getTodos ();
		enmarcar ( $this, 'pais/listar', $datos );
	}
	public function editar() {
		$this->load->model ( 'pais_model' );
		$id_pais = $_POST ['id_pais'];
		$datos ['body'] ['paises'] = $this->pais_model->getPaisPorId ( $id_pais );
		enmarcar ( $this, 'pais/editar', $datos );
	}
	public function editarPost() {
		$this->load->model ( 'pais_model' );
		$nombre = isset ( $_POST ['nombre'] ) ? $_POST ['nombre'] : null;
		$id_pais = $_POST ['id_pais'];
		try {
			$this->pais_model->editar ( $id_pais, $nombre );
			header ( "location:" . base_url () . "pais/editarOk" );
		} catch ( Exception $e ) {
			$datos ['mensaje'] ['texto'] = "País ya existente";
			$datos ['mensaje'] ['nivel'] = 'error';
			$datos ['mensaje'] ['link'] ['listar'] = "pais";
			$datos ['mensaje'] ['link'] ['crear'] = "pais";
			enmarcar ( $this, "pais/mensaje", $datos );
		}
	}
	public function editarOK() {
		$datos ['mensaje'] ['texto'] = "País modificado correctamente";
		$datos ['mensaje'] ['nivel'] = 'ok';
		$datos ['mensaje'] ['link'] ['listar'] = "pais";
		$datos ['mensaje'] ['link'] ['crear'] = "pais";
		enmarcar ( $this, "pais/mensaje", $datos );
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
		
		$this->listarPost ();
	}
	public function activarPost() {
		$this->load->model ( 'pais_model' );
		$id_pais = $_POST ['id_pais'];
		$this->pais_model->activar ( $id_pais );
		
		$this->listarPost ();
	}
}

?>