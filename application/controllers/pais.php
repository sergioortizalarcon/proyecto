<?php
class pais extends CI_Controller {
	public function crear() {
		enmarcar ( $this, "pais/crear" );
	}
	public function crearPost() {
		$this->load->model ( "pais_model" );
		$nombre = isset ( $_POST ["nombre"] ) ? $_POST ["nombre"] : null;
		$this->pais_model->crear_pais ( $nombre );
	}
	public function listar() {
		$this->load->model ( 'pais_model' );
		$datos ['body'] ['paises'] = $this->pais_model->getTodos ();
		enmarcar($this, 'pais/listar',$datos);
	}
}

?>