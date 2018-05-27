<?php
class Director_model extends CI_Model {
	//Se guarda en la tabla los datos del director, comprueba que ya exista uno creado con los mismos datos
	public function createDirector($nombre, $apellido1, $apellido2, $fechaNacimiento, $id_pais, $biografia, $ambos, $foto) {
		if ($apellido2 == "") {
			$director = R::find('director', 'nombre like ? and apellido1 like ? and fechaNacimiento like ?', [$nombre,$apellido1,$fechaNacimiento]);
			if ($director == null) {
				$director = R::dispense ( 'director' );
				$director -> nombre = $nombre;
				$director -> apellido1 = $apellido1;
				$director -> apellido2 = $apellido2;
				$director -> fechaNacimiento = $fechaNacimiento;
				$director -> biografia = $biografia;
				$director -> ambos = $ambos;
				$director -> rutaFoto = $foto;
				$pais = R::load("paises", $id_pais);
				$pais -> xownDirectorList[] = $director;
				R::store($pais);
			} else {
				throw new Exception("Director duplicado");
			}
			R::close();
		} else {
			$director = R::find('director', 'nombre like ? and apellido1 like ? and apellido2 like ? and fechaNacimiento like ?', [$nombre,$apellido1,$apellido2,$fechaNacimiento]);
			if ($director == null) {
				$director = R::dispense ( 'director' );
				$director -> nombre = $nombre;
				$director -> apellido1 = $apellido1;
				$director -> apellido2 = $apellido2;
				$director -> fechaNacimiento = $fechaNacimiento;
				$director -> biografia = $biografia;
				$director -> ambos = $ambos;
				$director -> rutaFoto = $foto;
				$pais = R::load("paises", $id_pais);
				$pais -> xownDirectorList[] = $director;
				R::store($pais);
			} else {
				throw new Exception("Director duplicado");
			}
			R::close();
		}
	}

	//Devuelve todos los datos de todos los directores
	public function getAll() {
		$mostrar = R::find("director","order by apellido1,apellido2,nombre");
		return $mostrar;
	}

	//TODO
	//Devuelve la id de un director sabiendo sus datos
	public function getDirectorPorDatos($nombre, $apellido1, $apellido2, $fechaNacimiento) {
		$datos = R::load('director', 'nombre like ? and apellido1 like ? and apellido2 like ? and fechaNacimiento like ?', [$nombre,$apellido1,$apellido2,$fechaNacimiento]);
		return $datos;
	}

	//Devuelve un director mediante su id
	public function getDirectorPorId($id_director) {
		return R::load ( 'director', $id_director );
	}

	//Permite editar los datos del director, no puede repetir datos ni meterlos vacios
	public function editar($id_director, $nombre, $apellido1, $apellido2, $fechaNacimiento, $id_pais, $biografia, $ambos, $foto) {
		$director = R::load ( 'director', $id_director );
		$directoresTodos = R::find("director",'nombre like ? and apellido1 like ? and apellido2 like ? and fechaNacimiento like ?', [$nombre,$apellido1,$apellido2,$fechaNacimiento]);
		$pais = R::load("paises", $id_pais);
		$cambio=false;
	  
		if ($directoresTodos == null) {
			if($nombre != $director->nombre && $nombre != "") {
				$director->nombre = $nombre;
				$cambio=true;
			}
			if($apellido1 != $director->apellido1 && $apellido1 != "") {
				$director->apellido1 = $apellido1;
				$cambio=true;
			}
			if($apellido2 != $director->apellido2 && $apellido2 != ""){
				$director->apellido2 = $apellido2;
				$cambio=true;
			}
			if($fechaNacimiento != $director->fechaNacimiento && $fechaNacimiento != "") {
				$director->fechaNacimiento = $fechaNacimiento;
				$cambio=true;
			}
			if($biografia != $director->biografia && $biografia != "") {
				$director->biografia = $biografia;
				$cambio=true;
			}
			if ($ambos != $director->ambos) {
				$director->ambos = $ambos;
				$cambio = true;
			}
			if($foto != "") {
				$director->rutaFoto = $foto;
				$cambio=true;
			}
			if($pais != $pais->id) {
				$pais -> xownDirectorList[] = $director;
				R::store($pais);
				$cambio=true;
			}
			 
			if ($cambio) {
				R::store ( $director );
			}
		}
	}

	//Permite borrar un director mediante su id
	public function borrar($id_director) {
		$director = R::load ( 'director', $id_director );
		R::trash ( $director );
	}
}
?>