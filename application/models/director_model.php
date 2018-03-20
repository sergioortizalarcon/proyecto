<?php
class Director_model extends CI_Model {
	public function createDirector($nombre, $apellido1, $apellido2, $fechaNacimiento, $nacionalidad) {
		if ($apellido2 == "") {
			$director = R::find('director', 'nombre like ? and apellido1 like ?', [$nombre,$apellido1]);
			if ($director == null) {
				$d = R::dispense ( 'director' );
				$d -> nombre = $nombre;
				$d -> apellido1 = $apellido1;
				$d -> apellido2 = $apellido2;
				$d -> fechaNacimiento = $fechaNacimiento;
				$d -> nacionalidad = $nacionalidad;
				R::store($d);
			} else {
				throw new Exception("Director duplicado");
			}
		} else {
			$director = R::find('director', 'nombre like ? and apellido1 like ? and apellido2 like ?', [$nombre,$apellido1,$apellido2]);
			if ($director == null) {
	        	$d = R::dispense('director');
	            $d->nombre = $nombre;
	            $d->apellido1 = $apellido1;
	            $d->apellido2 = $apellido2;
	            $d->fechaNacimiento = $fechaNacimiento;
	            $d->nacionalidad = $nacionalidad;
	            R::store($d);
	        } else {
	        	throw new Exception("Director duplicado");
	        }
	        R::close();
	    }
	}

    public function getAll($filtro='') {
    	$mostrar = R::find("director","nombre like ? or apellido1 like ? or apellido2 like? order by apellido1,apellido2,nombre", ["%".$filtro."%","%".$filtro."%","%".$filtro."%"]);
		return $mostrar;
	}
}
?>