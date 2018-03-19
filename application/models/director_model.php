<?php

class Director_model extends CI_Model
{

    public function existeDirector($nombre, $apellido1, $apellido2)
    {
		return R::findOne ( 'director', 'nombre = ?','apellido1 = ?', 'apellido2 = ?' [ 
				$nombre] [$apellido1], [$apellido2
		] ) != null ? true : false;
    }

    public function crear($nombre, $apellido1, $apellido2, $fechaNacimiento)
    {
        $status = 0;
        if (! $this->existeDirector($nombre, $apellido1, $apellido2)) {
            $d = R::dispense('director');
            $d->nombre = $nombre;
            $d->apellido1 = $apellido1;
            $d->apellido2 = $apellido2;
            $d->fechaNacimiento = $fechaNacimiento;
            R::store($d);
            R::close();
        } else {
            $status = - 1;
        }
        return $status;
    }

    public function getTodos()
    {
        return R::findAll('director', 'order by apellido1');
    }
}
?>