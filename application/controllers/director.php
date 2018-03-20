<?php

class Director extends CI_Controller
{

    public function crear()
    {
        enmarcar($this, 'director/crear');
    }

    public function crearOK()
    {
        enmarcar($this, 'director/crearOK');
    }

    public function crearERROR()
    {
        enmarcar($this, 'director/crearERROR');
    }

    public function crearPost()
    {
        $nombre = isset($_POST['nombre'])?$_POST['nombre']:null;
        $apellido1 = isset($_POST['apellido1'])?$_POST['apellido1']:null;
        $apellido2 = isset($_POST['apellido2'])?$_POST['apellido2']:null;
        $fechaNacimiento = isset($_POST['fechaNacimiento'])?$_POST['fechaNacimiento']:null;
        $nacionalidad = isset($_POST['nacionalidad'])?$_POST['nacionalidad']:null;
        
        $this->load->model('director_model');
        
        try {
        	$this -> director_model -> createDirector($nombre, $apellido1, $apellido2, $fechaNacimiento, $nacionalidad);
        	header('Location:'.base_url().'director/crearPOSTok?director='.$nombre_actor);
        }
        catch (Exception $e) {
        	header('Location:'.base_url().'director/crearPOSTerror?director='.$nombre_actor);
        }
        
        
        /*$status = $this->director_model->createDirector($nombre);
        $status = $this->director_model->createDirector($apellido1);
        $status = $this->director_model->createDirector($apellido2);
        $status = $this->director_model->createDirector($fechaNacimiento);
        $status = $this->director_model->createDirector($nacionalidad);
        
        if ($status >= 0) {
            header('Location:' . base_url() . 'director/crearOK');
        } else {
            header('Location:' . base_url() . 'director/crearERROR');
        }*/
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