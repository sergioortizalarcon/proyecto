<?php

class Director extends CI_Controller {
	public function crear(){
		$this->load->model('pais_model');
		$datos['body']['paises'] = $this->pais_model->getTodos();
		enmarcar($this, "director/crear", $datos);
    }

    public function crearPost() {
    	$this->load->model('director_model');
    	$nombre = isset($_POST['nombre'])?$_POST['nombre']:null;
    	$apellido1 = isset($_POST['apellido1'])?$_POST['apellido1']:null;
    	$apellido2 = isset($_POST['apellido2'])?$_POST['apellido2']:null;
    	$fechaNacimiento = isset($_POST['fechaNacimiento'])?$_POST['fechaNacimiento']:null;
    	$id_pais = isset($_POST['pais'])?$_POST['pais']:null;
        
        try {
        	$debug = $this -> director_model -> createDirector($nombre, $apellido1, $apellido2, $fechaNacimiento, $id_pais);
        	header ("location:".base_url ()."director/crearOk");
        }
        catch (Exception $e) {
        	$datos['mensaje']['texto'] = "Director ya existente";
        	$datos['mensaje']['nivel'] = 'error';
        	$datos['mensaje']['link'] = "director/crear";
        	enmarcar($this,"director/mensaje",$datos);
        }
    }

	public function crearOK() {
		$datos['mensaje']['texto'] = "Director creado correctamente";
		$datos['mensaje']['nivel'] = 'ok';
		$datos['mensaje'] ['link'] = "director/listar";
		enmarcar($this, "director/mensaje",$datos);
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
    
    public function editar() {
    	$this->load->model ( 'director_model' );
    	$this->load->model('pais_model');
    	$id_director = $_POST ['id_director'];
    	$datos ['body'] ['directores'] = $this->director_model->getDirectorPorId ( $id_director );
    	$datos['body']['paises'] = $this->pais_model->getTodos();
    	enmarcar ( $this, 'director/editar', $datos );
    }
    
    public function editarPost() {
    	$this->load->model ( 'director_model' );
    	
    	$nombre = isset($_POST['nombre'])?$_POST['nombre']:null;
    	$apellido1 = isset($_POST['apellido1'])?$_POST['apellido1']:null;
    	$apellido2 = isset($_POST['apellido2'])?$_POST['apellido2']:null;
    	$fechaNacimiento = isset($_POST['fechaNacimiento'])?$_POST['fechaNacimiento']:null;
    	$id_pais = isset($_POST['pais'])?$_POST['pais']:null;
    	$id_director = $_POST ['id_director'];
    
    	try {
    		$this->director_model->editar ( $id_director, $nombre, $apellido1, $apellido2, $fechaNacimiento, $id_pais );
    		header ("location:".base_url ()."director/editarOk");
    	}
    	catch (Exception $e) {
    		$datos['mensaje']['texto'] = "Dirctor ya existente";
    		$datos['mensaje']['nivel'] = 'error';
    		$datos['mensaje']['link'] = "director/crear";
    		enmarcar($this,"director/mensaje",$datos);
    	}
    }
    
    public function editarOK() {
    	$datos['mensaje']['texto'] = "Director creado correctamente";
    	$datos['mensaje']['nivel'] = 'ok';
    	$datos['mensaje'] ['link'] = "director/listar";
    	enmarcar($this, "director/mensaje",$datos);
    }
    
    public function borrar() {
    	$datos ['body'] ['accion'] = 'borrar';
    	$datos ['body'] ['filtro'] = '';
    	$this->filtrar ( $datos );
    }
    public function borrarPost() {
    	$this->load->model ( 'director_model' );
    	$id_director = $_POST ['id_director'];
    	$this->director_model->borrar ( $id_director );
    	
    	$this->listarPost();
    }
}
?>