<?php
class Actor_model extends CI_Model {
	public function createActor($nombre, $apellido1, $apellido2, $fechaNacimiento, $id_pais, $biografia, $foto) {
		if ($apellido2 == "") {
			$actor = R::find('actor', 'nombre like ? and apellido1 like ? and fechaNacimiento like ?', [$nombre,$apellido1,$fechaNacimiento]);
			if ($actor == null) {
				$actor = R::dispense ( 'actor' );
				$actor -> nombre = $nombre;
				$actor -> apellido1 = $apellido1;
				$actor -> apellido2 = $apellido2;
				$actor -> fechaNacimiento = $fechaNacimiento;
				$actor -> biografia = $biografia;
				$actor -> rutaFoto = $foto;
				$pais = R::load("paises", $id_pais);
				$pais -> xownActorList[] = $actor;
				R::store($pais);
			} else {
				throw new Exception("Actor duplicado");
			}
			R::close();
		} else {
			$actor = R::find('actor', 'nombre like ? and apellido1 like ? and apellido2 like ? and fechaNacimiento like ?', [$nombre,$apellido1,$apellido2,$fechaNacimiento]);
			if ($actor == null) {
				$actor = R::dispense ( 'actor' );
				$actor -> nombre = $nombre;
				$actor -> apellido1 = $apellido1;
				$actor -> apellido2 = $apellido2;
				$actor -> fechaNacimiento = $fechaNacimiento;
				$actor -> biografia = $biografia;
				$actor -> rutaFoto = $foto;
				$pais = R::load("paises", $id_pais);
				$pais -> xownActorList[] = $actor;
				R::store($pais);
			} else {
				throw new Exception("Actor duplicado");
			}
			R::close();
		}
	}

	public function getAll() {
		$mostrar = R::find("actor","order by apellido1,apellido2,nombre");
		return $mostrar;
	}
	
	public function getActorPorId($id_actor) {
		return R::load ( 'actor', $id_actor );
	}
	
	public function editar($id_actor, $nombre, $apellido1, $apellido2, $fechaNacimiento, $id_pais, $biografia, $foto) {
		$actor = R::load ( 'actor', $id_actor );
		$actoresTodos = R::find("actor",'nombre like ? and apellido1 like ? and apellido2 like ? and fechaNacimiento like ?', [$nombre,$apellido1,$apellido2,$fechaNacimiento]);
		$pais = R::load("paises", $id_pais);
		$cambio=false;
		
		if ($actoresTodos == null) {
			if($nombre != $actor->nombre && $nombre != "") {
				$actor->nombre = $nombre;
				$cambio=true;
			}
			if($apellido1 != $actor->apellido1 && $apellido1 != "") {
				$actor->apellido1 = $apellido1;
				$cambio=true;
			}
			if($apellido2 != $actor->apellido2 && $apellido2 != ""){
				$actor->apellido2 = $apellido2;
				$cambio=true;
			}
			if($fechaNacimiento != $actor->fechaNacimiento && $fechaNacimiento != "") {
				$actor->fechaNacimiento = $fechaNacimiento;
				$cambio=true;
			}
			if($biografia != $actor->biografia && $biografia != "") {
			    $actor->biografia = $biografia;
			    $cambio=true;
			}
			if($foto != "") {
			    $actor->rutaFoto = $foto;
			    $cambio=true;
			}
			if($pais != $pais->id) {
				$pais -> xownActorList[] = $actor;
				R::store($pais);
				$cambio=true;
			}
		
			if ($cambio) {
				R::store ( $actor );
			}
		}
	}
	
	public function borrar($id_actor) {
		$actor = R::load ( 'actor', $id_actor );
		R::trash ( $actor );
	}
}
?>