<?php
class idioma extends CI_Controller {
	
	/* REGISTRO DE IDIOMAS */
	public function crear() {
		enmarcar ( $this, "idioma/crear" );
	}
	
	// COMPRUEBA SI EL IDIOMA ESTA EN LA BBDD ANTES DE PERMITIR REGISTRAR
	public function comprobarIdioma() {
		$this->load->model ( "idioma_model" );
		$nombre = isset ( $_POST ["nombre"] ) ? $_POST ["nombre"] : null;
		$disponible = $this->idioma_model->buscar_idioma ( $nombre );
		// Si no esta disponible enviar algo, sino nada.
		if ($disponible) {
			$datos ['mensaje'] ["texto"] = 'Idioma disponible';
		} else {
			$datos ['mensaje'] ['texto'] = "Idioma existente";
			$datos ['mensaje'] ['nivel'] = 'error';
			$this->load->view ( "idioma/mensaje", $datos );
		}
	}
	public function crearPost() {
		$this->load->model ( "idioma_model" );
		$nombre = isset ( $_POST ["nombre"] ) ? $_POST ["nombre"] : null;
		
		try {
			$registro = $this->idioma_model->crear_idioma ( $nombre );
			header ( "location: " . base_url () . "idioma/crearOk" );
		} catch ( Exception $e ) {
			$datos ['mensaje'] ['texto'] = "El país ya existe";
			$datos ['mensaje'] ['nivel'] = 'error';
			$this->load->view ( "idioma/mensaje", $datos );
		}
	}
	public function crearOk() {
		$datos ['mensaje'] ['texto'] = 'País añadido correctamente';
		$datos ['mensaje'] ['nivel'] = 'ok';
		$datos ['mensaje'] ['link'] = "usuario/listar";
		enmarcar ( $this, "idioma/mensaje", $datos );
	}
	
	/*			REGISTRO		*/
	
	public function listar() {
		$this ->listarPost();
	}
	
	
	public function listarPost($f="") {
		$this -> load->model('idioma_model');
		$filtro = isset($_POST['filtro'])?$_POST['filtro']:$f;
		$datos ['body'] ['idiomas'] = $this->idioma_model->getTodos ($filtro);
		$datos['filtro'] = $filtro;
		enmarcar ( $this, 'idioma/listar', $datos );
	}
}

?>