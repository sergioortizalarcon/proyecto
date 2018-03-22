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
		$disponible = $this->idioma_model-> getIdiomaPorNombre ( $nombre );
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
		$datos ['mensaje'] ['link'] = "idioma/listar";
		enmarcar ( $this, "idioma/mensaje", $datos );
	}
	
	/*			REGISTRO		*/


	/*			EDITADO Y BORRADO		*/

	public function editarGet(){
		$this -> load ->model("idioma_model");
		$id_idioma = isset($_POST['idIdioma'])?$_POST['idIdioma']:null;
		try {
			$datos["body"]["idioma"] =  $this -> idioma_model -> getIdiomaPorId ( $id_idioma );
			enmarcar($this,"idioma/editar",$datos);
		} catch (Exception $e) {
			$datos ['mensaje'] ['texto'] = "El idioma no existe o no se ha podido recuperar. Intentelo de nuevo.";
			$datos ['mensaje'] ['nivel'] = 'error';
			enmarcar($this,"idioma/mensaje",$datos);
		}

	}

	public function editarPost () {
		$this -> load -> model("idioma_model");
		$idId = isset($_POST['idId'])?$_POST['idId']:null;
		$viejo_nombre = isset($_POST['nombreAnterior'])?$_POST['nombreAnterior']:null;
		$nuevo_nombre = isset($_POST['idNombre'])?$_POST['idNombre']:null;

	}
	try {
		$this -> idioma_model -> editar_idioma($idId,$nuevo_nombre);
		header ( "location: " . base_url () . "idioma/editarPRGOK?nuevo_nombre=".$nuevo_nombre."&viejo_nombre=".$viejo_nombre );
	} catch (Exception $e) {
			header ( "location: " . base_url () . "idioma/editarPRGERROR");
		}	
	}

	public function editarPRGOK {
		$nuevo_nombre = isset($_GET['nuevo_nombre'])?$_GET['nuevo_nombre']:null;
		$viejo_nombre = isset($_GET['viejo_nombre'])?$_GET['viejo_nombre']:null;
		$datos ['mensaje'] ['texto'] = "El idioma ".$viejo_nombre." se ha actualizado a ".$nuevo_nombre." correctamente";
		$datos ['mensaje'] ['nivel'] = 'ok';
		$datos ['mensaje'] ['link'] = "idioma/listar";
		enmarcar ( $this, "idioma/mensaje", $datos );
	}

	public function editarPRGERROR {
		$datos ['mensaje'] ['texto'] = "El idioma  no se ha podido actualizar, intentelo de nuevo.";
		$datos ['mensaje'] ['nivel'] = 'error';
		$datos ['mensaje'] ['link'] = "idioma/listar";
		enmarcar ( $this, "idioma/mensaje", $datos );
	}

*/

	/*			EDITADO Y BORRADO		*/



	/*			LISTADO			*/
	
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