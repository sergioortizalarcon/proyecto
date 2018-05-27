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

	public function editar_rol_usuario($id_user,$id_rol) {
		$usuario = $this->getByID($id_user);
		if ($usuario -> id != 0) {
			$usuario ->roles = R::load('roles',$id_rol);
			R::store($usuario);
		} else {
			throw new Exception("Se ha producido un error al cargar el usuario por su Id");
		}
			R::close();
	}

	public function obtener_rol_user($id_rol){
		$rol = R::findOne("roles","id=?",[$id_rol]);
		if ($rol != null) {
			return $rol['rol'];
		} else {
			R::close();
			throw new Exception("Se ha producido algún error");
		}
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