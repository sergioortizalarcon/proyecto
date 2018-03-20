<?php

class Director extends CI_Controller {
	public function crear(){
		//TODO(Falta el model de los lenguajes
		/*$datos['body']['nacionalidades'] = $this->nacionalidad_model->getAll();
		 enmarcar($this, "director/crearGET", $datos);*/
        enmarcar($this, 'director/crear');
    }

    public function crearPost() {
    	$this->load->model('director_model');
    	$nombre = isset($_POST['nombre'])?$_POST['nombre']:null;
    	$apellido1 = isset($_POST['apellido1'])?$_POST['apellido1']:null;
    	$apellido2 = isset($_POST['apellido2'])?$_POST['apellido2']:null;
    	$fechaNacimiento = isset($_POST['fechaNacimiento'])?$_POST['fechaNacimiento']:null;
    	$nacionalidad = isset($_POST['nacionalidad'])?$_POST['nacionalidad']:null;
        
        try {
        	$debug = $this -> director_model -> createDirector($nombre, $apellido1, $apellido2, $fechaNacimiento, $nacionalidad);
        	$datos['mensaje']['texto'] = "Director creado correctamente";
        	$datos['mensaje']['nivel'] = 'ok';
        	$this->load->view("Director/mensaje",$datos);
        }
        catch (Exception $e) {
        	$datos['mensaje']['texto'] = "Director ya existente";
        	$datos['mensaje']['nivel'] = 'error';
        	$this->load->view("director/mensaje",$datos);
        }
    }

    public function listar() {
    	$this->listarPost();
    }
    
    public function listarPost($f='') {
    	$filtro = isset($_POST['filtro'])?$_POST['filtro']:$f;
    	$this->load->model('director_model');
    	$datos['body']['directores'] = $this->director_model->getAll($filtro);
    	$datos['filtro'] = $filtro;
    	enmarcar($this, 'director/listar',$datos);
    }
}
?>