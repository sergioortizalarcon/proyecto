<?php
class Empleado extends CI_Controller {
	public function crear() {
		$this->load->model('ciudad_model');
		$datos['ciudades'] = $this->ciudad_model->getAll();
		
		$this->load->model('lp_model');
		$datos['lps'] = $this->lp_model->getAll();
		
		enmarcar($this, 'empleado/crearGET',$datos);
	}
	
	public function crearPost() {
		$this->load->model('empleado_model');
		
		$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
		$ape1= isset($_POST['ape1']) ? $_POST['ape1'] : null;
		$ape2 = isset($_POST['ape2']) ? $_POST['ape2'] : null;
		$pwd = isset($_POST['pwd']) ? $_POST['pwd'] : null;
		$tlf = isset($_POST['tlf']) ? $_POST['tlf'] : null;
		$idCiudad = isset($_POST['idCiudad']) ? $_POST['idCiudad'] : null;
		$idLPs = isset($_POST['idLP']) ? $_POST['idLP'] : [];
		
		try {
			$this -> empleado_model -> create_empleado($nombre, $ape1, $ape2, $pwd, $tlf, $idCiudad, $idLPs);
			$datos['mensaje']['texto'] = "Empleado $nombre creado correctamente";
			$datos['mensaje']['nivel'] = 'ok';
		}
		catch (Exception $e) {
			$datos['mensaje']['texto'] = "Empleado \"$nombre\" ya existente";
			$datos['mensaje']['nivel'] = 'error';
		}
		$this->load->view('empleado/mostrar_mensaje',$datos);
	}
	
	public function listar() {
		$this->listarPost();
	}
	
	public function listarPost($f='') {
		$filtro = isset($_POST['filtro'])?$_POST['filtro']:$f;
		$this->load->model('empleado_model');
		$datos['empleados'] = $this->empleado_model->getAll($filtro);
		$datos['filtro'] = $filtro;
		enmarcar($this, 'empleado/listar',$datos);
	}
	
}