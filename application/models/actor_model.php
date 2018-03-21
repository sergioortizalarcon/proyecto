<?php
class Actor_model extends CI_Model {
	public function createActor($nombre, $apellido1, $apellido2, $fechaNacimiento, $id_pais) {
		if ($apellido2 == "") {
			$actor = R::find('actor', 'nombre like ? and apellido1 like ?', [$nombre,$apellido1]);
			if ($actor == null) {
				$actor = R::dispense ( 'actor' );
				$actor -> nombre = $nombre;
				$actor -> apellido1 = $apellido1;
				$actor -> apellido2 = $apellido2;
				$actor -> fechaNacimiento = $fechaNacimiento;
				$pais = R::load("paises", $id_pais);
				$pais -> xownActorList[] = $actor;
				R::store($pais);
			} else {
				throw new Exception("Actor duplicado");
			}
			R::close();
		} else {
			$actor = R::find('actor', 'nombre like ? and apellido1 like ? and apellido2 like ?', [$nombre,$apellido1,$apellido2]);
			if ($actor == null) {
				$actor = R::dispense ( 'actor' );
				$actor -> nombre = $nombre;
				$actor -> apellido1 = $apellido1;
				$actor -> apellido2 = $apellido2;
				$actor -> fechaNacimiento = $fechaNacimiento;
				$pais = R::load("paises", $id_pais);
				$pais -> xownActorList[] = $actor;
				R::store($pais);
			} else {
				throw new Exception("Actor duplicado");
			}
			R::close();
		}
	}

	public function getAll($filtro='') {
		$mostrar = R::find("actor","nombre like ? or apellido1 like ? or apellido2 like? order by apellido1,apellido2,nombre", ["%".$filtro."%","%".$filtro."%","%".$filtro."%"]);
		return $mostrar;
	}
	
	public function getActorPorId($id_actor) {
		return R::load ( 'actor', $id_actor );
	}
	
	public function editar($id_actor, $nombre, $apellido1, $apellido2, $fechaNacimiento, $id_pais) {
		$actor = R::load ( 'actor', $id_actor );
		$pais = R::load("paises", $id_pais);
		$cambio=false;
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
		if($pais != $pais->id) {
			$pais -> xownActorList[] = $actor;
			R::store($pais);
			$cambio=true;
		}
		if ($cambio) {
			R::store ( $actor );
		}
	}
	
	public function borrar($id_actor) {
		$actor = R::load ( 'actor', $id_actor );
		R::trash ( $actor );
	}
}
?>