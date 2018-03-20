<?php

class Director_model extends CI_Model
{

    public function createDirector($nombre, $apellido1, $apellido2, $fechaNacimiento, $nacionalidad)
    {
    	$director = R::find('director', 'nombre like ? and apellido1 like ? and apellido2 like ?', [$nombre,$apellido1,$apellido2]);
        if ($director == null) {
            $d = R::dispense('director');
            $d->nombre = $nombre;
            $d->apellido1 = $apellido1;
            $d->apellido2 = $apellido2;
            $d->fechaNacimiento = $fechaNacimiento;
            $d->nacionalidad = $nacionalidad;
            R::store($d);
            R::close();
        } else {
        	throw new Exception("Actor duplicado");
        }
        R::close();
    }

    public function getAll($filtro='') {
		$mostrar = R::find("director","nombre like ?", ["%".$filtro."%"]);
		return $mostrar;
	}
}
?>