<?php

class Administrador extends CI_Controller {

	public function editarGet(){
		$this->load->model('administrador_model');
		$this->load->model('usuario_model');
		$idUser = isset($_POST['idUser'])?$_POST['idUser']:null;
		if ($idUser) {
			$datos['usuario'] = $this->administrador_model->getByID($idUser);
			$datos['roles'] = $this->usuario_model->listar_roles();
			enmarcar($this,"administrador/editar_rol",$datos);
		}
	}


	public function editarRolPost() {
		$this->load->model('administrador_model');
		$id_user = isset($_POST['idUser'])?$_POST['idUser']:null;
		$id_rol = isset($_POST['idRol'])?$_POST['idRol']:null;
		if ($id_user && $id_rol) {
			try {
				$this -> administrador_model -> editar_rol_usuario($id_user,$id_rol);
			} catch (Exception $e) {
				
			}
		}
	}

	public function listar($f='') {
		$this->load->model('administrador_model');
		$this->load->model('usuario_model');
		$filtro = isset($_POST['filtro'])?$_POST['filtro']:$f;

		$datos['roles'] = $this->usuario_model->listar_roles();

		$datos['usuarios'] = $this->administrador_model->getAll($filtro);
		$datos['filtro'] = $filtro;
		enmarcar($this, 'usuario/listar',$datos);
	}
}