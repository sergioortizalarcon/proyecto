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

	public function index() {
		if ($this->comprobarRol()) {
			if(isset($_SESSION['vista_user']) && $_SESSION['vista_user']=='permiso'){
				enmarcar($this, 'welcome_message');
			} else {
				enmarcar($this, 'templates_admin/dashboard');
			}
	} else {
			enmarcar($this, 'welcome_message');
		}
	}
}