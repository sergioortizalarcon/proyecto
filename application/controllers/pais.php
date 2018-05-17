<?php
class pais extends CI_Controller {
	public function comprobarPais() {
		$this->load->model ( "pais_model" );
		$nombre = isset ( $_POST ["nombre"] ) ? $_POST ["nombre"] : null;
		$disponible = $this->pais_model-> getPaisPorNombre ( $nombre );
		if ($disponible) {
			$datos ['mensaje'] ["texto"] = 'País disponible';
		} else {
			$datos ['mensaje'] ['texto'] = "País existente";
			$datos ['mensaje'] ['nivel'] = 'error';
			$this->load->view ( "idioma/mensaje", $datos );
		}
	}
	public function crear() {
		enmarcar ( $this, "pais/crear" );
	}
	public function crearPost() {
		$this->load->model ( "pais_model" );
		$nombre = isset ( $_POST ["nombre"] ) ? $_POST ["nombre"] : null;
		try {
			$registro = $this->pais_model->crear_pais ( $nombre );
			header ( "location: " . base_url () . "pais/crearOk?nombre=" . $nombre );
		} catch ( Exception $e ) {
			$datos ['mensaje'] ['texto'] = "El país ya existe";
			$datos ['mensaje'] ['nivel'] = 'error';
			$this->load->view ( "pais/mensaje", $datos );
		}
	}
	public function crearOk() {
		$nombre = isset ( $_GET ['nombre'] ) ? $_GET ['nombre'] : null;
		$datos ['mensaje'] ['texto'] = 'El país ' . $nombre . ' se ha añadido correctamente';
		$datos ['mensaje'] ['nivel'] = 'ok';
		
		$datos ['mensaje'] ['link'] ['listar'] = "pais";
		$datos ['mensaje'] ['link'] ['crear'] = "pais";
		enmarcar ( $this, "pais/mensaje", $datos );
	}
	public function listar() {
		$this->listarPost ();
	}
	public function listarPost($fil = '') {
		$this->load->model ( 'pais_model' );
		$filtro = isset ( $_POST ['filtro'] ) ? $_POST ['filtro'] : $fil;
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
		$nombre_anterior = isset ( $_POST ['nombreAnterior'] ) ? $_POST ['nombreAnterior'] : null;
		$nombre_nuevo = isset ( $_POST ['nombre'] ) ? $_POST ['nombre'] : null;
		try {
			$this->pais_model->editar ( $id_pais, $nombre_nuevo );
			
			$datos ['mensaje'] ['texto'] = "El país " . $nombre_anterior . " se ha actualizado a " . $nombre_nuevo;
			$datos ['mensaje'] ['nivel'] = 'ok';
			enmarcar ( $this, 'pais/mensaje', $datos );
		} catch ( Exception $e ) {
			$datos ['mensaje'] ['texto'] = "El nuevo nombre ya existe";
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
		$id_pais = isset ( $_POST ['id_pais'] ) ? $_POST ['id_pais'] : null;
		$this->pais_model->borrar ( $id_pais );
		header ( "location: " . base_url () . "pais/listar" );
		$this->listar ();
	}
}

?>