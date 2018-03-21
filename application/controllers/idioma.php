<?php
class idioma extends CI_Controller {
	public function crear() {
		enmarcar ( $this, "idioma/crear" );
	}

	public function comprobarIdioma() {
		$this->load->model ( "idioma_model" );
		$nombre = isset( $_POST ["nombre"] ) ? $_POST ["nombre"] : null;
		$disponible = $this-> idioma_model ->buscar_idioma($nombre);
		//Si no esta disponible enviar algo, sino nada.
		if ($disponible) {
			$datos['mensaje']["texto"] = 'Idioma disponible';
		} else {	
			$datos['mensaje']['texto'] = "Idioma existente";
			$datos['mensaje']['nivel'] = 'error';
			$this -> load -> view("idioma/mensaje",$datos);
		}
	}

	public function crearPost() {
		$this->load->model ( "idioma_model" );
		$nombre = isset ( $_POST ["nombre"] ) ? $_POST ["nombre"] : null;
		
		try {
			$registro = $this->idioma_model->crear_idioma($nombre);
			$datos ['mensaje'] ['texto'] = 'Idioma añadido correctamente';
			$datos ['mensaje'] ['nivel'] = 'ok';
			enmarcar($this,"idioma/mensaje", $datos );
		} catch ( Exception $e ) {
			$datos ['mensaje'] ['texto'] = "El idioma ya existe";
			$datos ['mensaje'] ['nivel'] = 'error';
			enmarcar($this,"idioma/mensaje", $datos );
		}
	}
	public function listar() {
		$this->load->model ( 'pais_model' );
		$datos ['body'] ['paises'] = $this->pais_model->getTodos ();
		enmarcar ( $this, 'pais/listar', $datos );
	}
}

?>