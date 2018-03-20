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
        $nombre = $_POST['nombre'];
        $apellido1 = $_POST['apellido1'];
        $apellido1 = $_POST['apellido2'];
        $fechaNacimiento = $_POST['fechaNacimiento'];
        $this->load->model('director_model');
        $status = $this->director_model->crear($nombre);
        $status = $this->director_model->crear($apellido1);
        $status = $this->director_model->crear($apellido2);
        $status = $this->director_model->crear($fechaNacimiento);
        if ($status >= 0) {
            header('Location:' . base_url() . 'director/crearOK');
        } else {
            header('Location:' . base_url() . 'director/crearERROR');
        }
    }

    public function listar()
    {
        $this->load->model('director_model');
        $datos['body']['directores'] = $this->director_model->getTodos();
        enmarcar($this, 'director/listar', $datos);
    }
}
?>