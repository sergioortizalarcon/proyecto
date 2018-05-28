<?php

class Administrador_model extends CI_Model {

	public function getAll($filtro='') {
		// return R::find("usuarios","email like ?", [$filtro]);
		return R::findAll('usuarios','order by id asc');
	}

	public function getUsuario($filtro='') {
		return R::findOne("usuarios","email or alias like ?", [$filtro]);
	}

	public function getByID($id) {
		return R::load ( 'usuarios', $id );
	}

	public function editar_estado($id_user,$id_estado) {
		$usuario = $this->getByID($id_user);
		if ($usuario ->id!=0) {
			$comprobar_estado=R::load('estado',$id_estado);
			if($comprobar_estado ->id!= 0){
				$usuario ->estado = R::load('estado',$id_estado);
				R::store($usuario);
			}
			R::close();
		} else {
			throw new Exception("Error en la edición del estado de la cuenta al cargar el usuario por Id");
		}
			R::close();
	}


	public function editar_rol_usuario($id_user,$id_rol) {
		$usuario = $this->getByID($id_user);
		if ($usuario ->id!=0) {
			$comprobar_rol =R::load('roles',$id_rol);
			if($comprobar_rol ->id!= 0){
				$usuario ->roles = R::load('roles',$id_rol);
				R::store($usuario);
			}
			R::close();
		} else {
			throw new Exception("Error en la edición del rol al cargar el usuario por Id");
		}
			R::close();
	}


	public function obtener_rol_user($id_rol){
		$rol = R::findOne("roles","id=?",[$id_rol]);
		if ($rol != null) {
			return $rol['rol'];
		} else {
			throw new Exception("Se ha producido algún error");
		}
			R::close();
	}


	//Cambiar cuando se cree la tabla admins
	public function comprobar_emailAdm($email){
		$emailD = R::findOne("usuarios","email=?",[$email]);
		if ($emailD == null) {
			return true;
		} else {
			return false;
		}
	}
	
		/*
	public function borrar($id) {
		$us = R::load ( 'usuarios', $id );
		if ($us->id != 0) {
			R::trash ( $us );
		}
		R::close ();
	}
	
	public function update($id, $nombre) {
		$us = R::load ( 'usuarios', $id );
		
		$us->nombre = $nombre;
		
		R::store($us);
		R::close();
		
	}

	*/



}