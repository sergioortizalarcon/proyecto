<?php
class Director_model extends CI_Model {
    public function createDirector($nombre, $apellido1, $apellido2, $fechaNacimiento, $id_pais, $biografia, $foto) {
		if ($apellido2 == "") {
			$director = R::find('director', 'nombre like ? and apellido1 like ? and fechaNacimiento like ?', [$nombre,$apellido1,$fechaNacimiento]);
			if ($director == null) {
				$director = R::dispense ( 'director' );
				$director -> nombre = $nombre;
				$director -> apellido1 = $apellido1;
				$director -> apellido2 = $apellido2;
				$director -> fechaNacimiento = $fechaNacimiento;
				$director -> biografia = $biografia;
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
				$director = R::dispense('director');
				$director->nombre = $nombre;
				$director->apellido1 = $apellido1;
				$director->apellido2 = $apellido2;
				$director->fechaNacimiento = $fechaNacimiento;
				$director -> biografia = $biografia;
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

    public function getAll() {
    	$mostrar = R::find("director","order by apellido1,apellido2,nombre");
		return $mostrar;
	}
	
	public function getDirectorPorId($id_director) {
		return R::load ( 'director', $id_director );
	}
	
	public function editar($id_director, $nombre, $apellido1, $apellido2, $fechaNacimiento, $id_pais, $biografia, $foto) {
		$director = R::load ( 'director', $id_director );
		$directoresTodos = R::find("director",'nombre like ? and apellido1 like ? and apellido2 like ?', [$nombre,$apellido1,$apellido2]);
		$pais = R::load("paises", $id_pais);
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
	
	public function borrar($id_director) {
		$director = R::load ( 'director', $id_director );
		R::trash ( $director );
	}
}
?>