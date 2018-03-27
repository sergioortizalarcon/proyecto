<?php

class Administrador_model extends CI_Model {

	public function getAll($filtro='') {
		return R::find("usuarios","email like ?", ["%".$filtro."%"]);
	}

	public function getByID($id) {
		return R::load ( 'usuarios', $id );
	}


	public function editar_rol_usuario($id_user,$id_rol) {
		$usuario = $this->getByID($id_user);
		if ($usuario -> id != 0) {
			//editar rol
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