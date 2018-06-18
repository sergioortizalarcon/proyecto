<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function comprobarRol(){
		session_start();
		if(isset($_SESSION['rol']) && $_SESSION['rol']=='administrador'){
			return true;
		} else {
			return false;
		}
	}

	/*public function index() {
		if ($this->comprobarRol()) {
			if(isset($_SESSION['vista_user']) && $_SESSION['vista_user']=='permiso'){
				enmarcar($this, 'welcome_message');
			} else {
				$this->load->model("pelicula_model");
				$var = $this->pelicula_model->getAll();
				$datos['peliculas'] = count($var);
				enmarcar($this, 'templates_admin/dashboard',$datos);
			}
	} else {
			enmarcar($this, 'welcome_message');
		}
	}*/
	
	public function index() {
		
		if ($this->comprobarRol()) {
			if(isset($_SESSION['vista_user']) && $_SESSION['vista_user']=='permiso'){
				$this->load->model("pelicula_model");
				$datos['body']['peliculas'] = $this->pelicula_model->getUltimas();
				enmarcar($this, 'welcome_message', $datos);
			} else {
				$this->load->model("pelicula_model");
				$this->load->model("reparto_model");
				$this->load->model("administrador_model");
				$this->load->model("pais_model");
				$this->load->model("genero_model");
				$this->load->model("idioma_model");
				$this->load->model("profesion_model");

				$var = $this->pelicula_model->getUltimas();
				$treparto = $this->reparto_model->getAll();
				$tuser = $this->administrador_model->getAll();
				$tpais = $this->pais_model->getTodos();
				$tgenero = $this->genero_model->getTodos();
				$tidioma = $this->idioma_model->getTodos();
				$tprofesion = $this->profesion_model->getAll();

				$datos['peliculas'] = count($var);
				$datos['reparto'] = count($treparto);
				$datos['usuarios'] = count($tuser);
				$datos['pais'] = count($tpais);
				$datos['genero'] = count($tgenero);
				$datos['idioma'] = count($tidioma);
				$datos['profesion'] = count($tprofesion);
				enmarcar($this, 'templates_admin/dashboard',$datos);
			}
			
		} else {
			$this->load->model("pelicula_model");
			$datos['body']['peliculas'] = $this->pelicula_model->getUltimas();
			enmarcar($this, 'welcome_message', $datos);
		}
	}
}