<?php

class Usuario_model extends CI_Model {

	public function comprobar_login($usuario,$pwd) {
		$v_alias = R::findOne("usuarios", "alias = ? and password = ?",[$usuario,$pwd]);
		if($v_alias != null) {
			return $v_alias;
			R::close();
		} else {
			$v_correo =R::findOne("usuarios", "email = ? and password = ?",[$usuario,$pwd]);
			if ($v_correo != null) {
				return $v_correo;
				R::close();
			} else {
			return false;
			throw new Exception("usuario o password erroneas.");
			R::close();
			}
		}
	}



	public function comprobar_alias($alias_user){
		$aliasD = R::findOne("usuarios","alias=?",[$alias_user]);
		if ($aliasD == null) {
			R::close();
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
			$roles_registrados = ['basico','editor','administrador'];
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


	/*---------------------		ESTADO 		---------------------*/

	public function registro_estados($id_estado=""){
		$comprobar_estado = R::load('estados',$id_estado);
		if ($comprobar_estado->id==0) {
			$estado_registrados = ['activa','bloqueada'];
			foreach ( $estado_registrados as $registros ) {
				$nuevo = R::dispense('estados');
				$nuevo -> estado = $registros;
				R::store($nuevo);
			}
			//R::close();
		}
		return R::load('estados',$id_estado);
	}

	public function listar_estados(){
		return R:: findAll('estados');
	}


	/*------------------------------------------*/
	

	public function create_usuario($nombre, $ape1, $ape2, $alias, $email, $pwd, $fecha,$idPais) {
		//id del rol basico q se crea arriba
		$rol_basico = 1;

		//Indica si una cuenta esta baneada o no:  1->activa | 2 -> Ban
		$estado = 1;

		//obtiene el valor devuelto por function
		$id_rol = $this -> registro_roles($rol_basico);

		$id_estado = $this -> registro_estados($estado);

		$comprobNombre = R::findOne("usuarios","alias=?",[$alias]);
		$comprobNEmail = R::findOne("usuarios","email=?",[$email]);
		if ($comprobNombre == null && $comprobNEmail == null) {
			$usuario = R:: dispense("usuarios");
			$usuario -> nombre = $nombre;
			$usuario -> apellido_uno = $ape1;
			$usuario -> apellido_dos = $ape2;
			$usuario -> alias = $alias;
			$usuario -> email = $email;
			$usuario -> estado = $estado;
			$usuario -> fecha_nacimiento = $fecha;
			$usuario -> password = $pwd;
			$usuario -> observacion= ""; //mensaje de ban
			$usuario -> fecha_ban = 0; // pasar este valor a milisegundos al guardar.
			$usuario -> token_pwd = 0;
			$usuario-> desactivado_user=0;//0 activada; 1 desactivada por el usuario.
			$id_rol -> xownUsuarioList[] = $usuario;
			// $estado_cuenta = R::load("estados",$id_estado);
			$id_estado -> xownUsuarioList[] = $usuario;
			//esto guarda el valor
			$pais = R::load("paises",$idPais);
			$pais -> xownUsuarioList[] =$usuario;
			R::store($id_rol);
			R::store($id_estado);
			R::store($pais);
			R::close();
		} else {
			R::close();
			throw new Exception("Error Processing Request", 1);
		}
	}



}


?>