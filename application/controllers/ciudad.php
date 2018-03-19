<?php
class ciudad extends CI_Controller {
	public function crear() {
		enmarcar($this, 'ciudad/crearGET');
	}
	
	public function crearPost() {
		$this->load->model('ciudad_model');
		$nombre_ciudad = isset($_POST['ciudad'])?$_POST['ciudad']:null;
		try {
			$this -> ciudad_model -> create_ciudad($nombre_ciudad);
			header('Location:'.base_url().'ciudad/crearPOSTok?ciudad='.$nombre_ciudad);
		}
		catch (Exception $e) {
			header('Location:'.base_url().'ciudad/crearPOSTerror?ciudad='.$nombre_ciudad);
		}
	}
	
	public function crearPOSTok() {
		$datos['body']['ciudad'] = $_GET['ciudad'];
		enmarcar($this, 'ciudad/crearPOSTok', $datos);
	}
	
	public function crearPOSTerror() {
		$datos['body']['ciudad'] = $_GET['ciudad'];
		enmarcar($this, 'ciudad/crearPOSTerror', $datos);
	}

	public function listar() {
		$this->load->model('ciudad_model');
		$datos['body']['ciudades'] = $this->ciudad_model->getAll();
		enmarcar($this, 'ciudad/listar',$datos);
	}
}
?>