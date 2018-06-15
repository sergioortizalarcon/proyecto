<?php

class Administrador_model extends CI_Model {

	public function getAll($filtro='') {
		// return R::find("usuarios","email like ?", [$filtro]);
		return R::findAll('usuarios','order by id asc');
	}

	public function getUsuario($filtro) {
		return R::findOne("usuarios","email = ? or alias = ?", [$filtro,$filtro]);
	}

	public function getByID($id) {
		return R::load ( 'usuarios', $id );
	}

	public function editar_estado($id_user,$id_estado,$fechaBan,$messagetext) {
		$status=-1;
		$usuario = $this->getByID($id_user);
		if ($usuario ->id!=0) {
			$comprobar_estado=R::load('estados',$id_estado);
			if($comprobar_estado ->id!= 0){
				$status=2;
				//$usuario -> estados = null;
				//$caja -> ownUsuarioList [] = $comprobar_estado
				$usuario ->estados = R::load('estados',$id_estado);
				if ($id_estado == 1) {
					$usuario ->fecha_ban = 0;
				} else {
					$usuario ->fecha_ban = $fechaBan;
				}
				if ($messagetext==null) {
					$usuario ->observacion = ' ';
				}else {
					$usuario ->observacion = $messagetext;
				}
				
				R::store($usuario);
			} else {
				$status=-1;
			}
		} else {
			$status=-1;
			throw new Exception("Error en la edición del estado de la cuenta al cargar el usuario por Id");
		}
			R::close();
			return $status;
	}


	public function editar_rol_usuario($id_user,$id_rol) {
		$status=0;
		$usuario = $this->getByID($id_user);
		if ($usuario ->id!=0) {
			$comprobar_rol =R::load('roles',$id_rol);
			if($comprobar_rol ->id!= 0){
				$usuario ->roles = R::load('roles',$id_rol);
				R::store($usuario);
			} else {
				$status=-1;
			}
		} else {
			$status=-1;
			throw new Exception("Error en la edición del rol al cargar el usuario por Id");
		}
			R::close();
			return $status;
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


	//esto agrega el token al usuario cuando se pide restaurar pwd, en controller. admin
	public function recuperar_pwd($encriptar_password,$id_user){
		$usuario = R::load("usuarios",$id_user);
		$usuario -> token_pwd = $encriptar_password;
		R::store($usuario);
	}

	//confirmacion del cambio obteniendo el token agregado y la id
	public function confirmacion_reset_password($email,$token_confirmacion,$user_id) {
		$cargar = R::findOne("usuarios","email=? and token_pwd=? and id=?",[$email,$token_confirmacion,$user_id]);
		return $cargar;
	}



	public function update_pwd($hash_passwrd,$id_user){
		$cargar = $this-> getByID($id_user);
		if ($cargar->id!=0) {
			$cargar -> password = $hash_passwrd;
			$cargar->token_pwd = 0;
			R::store($cargar);
			return true;
		} else {
			throw new Exception("Se ha producido algún error");
			return false;
		}
		R::close();
	}




	
		/*
	public function borrar($id) {
		$us = R::load ( 'usuarios', $id );
		if ($us->id != 0) {
			R::trash ( $us );
		}
		R::close ();
	}

	*/
	
	public function update($id, $nombre) {
		$us = R::load ( 'usuarios', $id );
		$us->nombre = $nombre;
		R::store($us);
		R::close();
		
	}

	//envia pwd nuevo
	public function actualizar_datos_uno($user_id,$nombre,$ape1,$ape2,$email,$fecha,$idPais,$pwd) {
		$usuario = R::load ('usuarios',$user_id);
		$usuario -> nombre = $nombre;
		$usuario -> apellido_uno = $ape1;
		$usuario -> apellido_dos = $ape2;
		$usuario -> email = $email;
		$usuario -> fecha_nacimiento = $fecha;
		$usuario -> password = $pwd;
		$pais->paises = R::load("paises",$idPais);

		R::store($usuario);
		R::close();
	}

	//Envia demas datos, todos obligatorios
	public function actualizar_datos_dos($user_id,$nombre,$ape1,$ape2,$email,$fecha,$idPais) {
		$usuario = R::load ('usuarios',$user_id);
		$usuario -> nombre = $nombre;
		$usuario -> apellido_uno = $ape1;
		$usuario -> apellido_dos = $ape2;
		$usuario -> email = $email;
		$usuario -> fecha_nacimiento = $fecha;
		$pais->paises = R::load("paises",$idPais);

		R::store($usuario);
		R::close();
	}




}