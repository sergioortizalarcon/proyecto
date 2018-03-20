<?php

class usuario_model extends CI_Model {

	public function comprobar_alias($alias){
		$aliasD = R::findOne("usuarios","alias=?",[$alias]);
		if ($aliasD == null) {
			return true;
		} else {
			return false;
		}
	}

	public function comprobar_email($email){
		$emailD = R::findOne("usuarios","email=?",[$email]);
		if ($emailD == null) {
			return true;
		} else {
			return false;
		}
	}

	public function comprobar_usuario($alias, $email){
		$c1 = R::findOne("usuarios","alias=?",[$alias]);
		$c2 = R::findOne("usuarios","email=?",[$email]);
		if ($c1 == null && $c2 == null) {
			return true;
		} else {
			return false;
		}
	}

	public function create_usuario($nombre, $ape1, $ape2, $alias, $email, $pwd, $fecha) {

		$comprobNombre = R::findOne("usuarios","alias=?",[$alias]);
		$comprobNEmail = R::findOne("usuarios","email=?",[$email]);
		if ($comprobNombre == null && $comprobNEmail == null) {
			$usuario = R:: dispense("usuarios");
			$usuario -> nombre = $nombre;
			$usuario -> apellido_uno = $ape1;
			$usuario -> apellido_dos = $ape2;
			$usuario -> alias = $alias;
			$usuario -> email = $email;
			$usuario -> password = $pwd;
			$usuario -> fecha_nacimiento = $fecha;

			R::store($usuario);
			R::close();
		} else {
			R::close();
			throw new Exception("Error Processing Request", 1);
		}
	}
}


?>