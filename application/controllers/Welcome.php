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
				/*$var = $this->pelicula_model->getUltimas();
				$datos['peliculas'] = count($var);*/
				$datos['body']['peliculas'] = $this->pelicula_model->getUltimas();
				enmarcar($this, 'welcome_message', $datos);
			} else {
				$this->load->model("pelicula_model");
				/*$var = $this->pelicula_model->getUltimas();
				$datos['peliculas'] = count($var);*/
				$datos['body']['peliculas'] = $this->pelicula_model->getUltimas();
				enmarcar($this, 'templates_admin/dashboard',$datos);
			}
			
		} else {
			$this->load->model("pelicula_model");
			/*$var = $this->pelicula_model->getUltimas();
			$datos['peliculas'] = count($var);*/
			$datos['body']['peliculas'] = $this->pelicula_model->getUltimas();
			enmarcar($this, 'welcome_message', $datos);
		}
	}
}