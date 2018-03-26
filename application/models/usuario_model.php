<?php

class usuario_model extends CI_Model {

	public function comprobar_login($usuario,$pwd) {
		$identidicar = R::findOne("usuarios", "alias like ? or email like ? and password like ?",[$usuario,$usuario,$pwd]);
		/*
		$identidicar = [];
		$mail = $this -> comprobar_email($usuario);
		$nick = $this -> comprobar_alias($usuario);
		if (!$mail) {
			$identidicar = R:: find("usuarios","email like ? and password like ? ",[$usuario,$pwd]);
		} else if (!$nick) {
			$identidicar = R:: find("usuarios","alias like ? and password like ? ",[$usuario,$pwd]);
		} else {
			return false;
		}
*/
		if($identidicar != null) {
			R::close();
			return $identidicar;
		} else {
			R::close();
			return false;
			throw new Exception("usuario o password erroneas.");
		}
	}

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
		$c1 = $this -> comprobar_alias($alias);
		$c2 = $this -> comprobar_email($email);
		if ($c1 && $c2) {
			return true;
		} else {
			return false;
		}
	}

	public function registro_roles($id_rol=""){
		$comprobar_registro = R::load('roles',$id_rol);
		if ($comprobar_registro->id==0) {
			$roles_registrados = ['Básico','Editor','Administrador'];
			foreach ( $roles_registrados as $registro ) {
				$nuevo = R::dispense('roles');
				$nuevo -> rol  = $registro;
				R::store($nuevo);
			}
			//R::close();
		}

		return R::load('roles',$id_rol);
	}

	public function listar_roles(){
		return R:: findAll('roles');
	}

	public function create_usuario($nombre, $ape1, $ape2, $alias, $email, $pwd, $fecha,$idPais) {
		//id del rol basico q se crea arriba
		$rol_basico = 3;
		//obtiene el valor devuelto por function
		$rol = $this -> registro_roles($rol_basico);

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
			//esto guarda el valor
			//$usuario -> rol = $rol->rol;
			$rol -> xownUsuarioList[] = $usuario;
			$pais = R::load("paises",$idPais);
			$pais -> xownUsuarioList[] =$usuario;

			$usuario -> fecha_nacimiento = $fecha;
			R::store($rol);
			R::store($pais);
			R::close();
		} else {
			R::close();
			throw new Exception("Error Processing Request", 1);
		}
	}

	public function getAll($filtro='') {
		return R::find("usuarios","email like ?", ["%".$filtro."%"]);
	}

	public function getByID($id) {
		return R::load ( 'usuarios', $id );
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


?>