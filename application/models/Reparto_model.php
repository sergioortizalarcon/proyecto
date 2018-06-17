<?php
class Reparto_model extends CI_Model {
	//Se guarda en la tabla los datos de la persona, comprueba que ya exista uno creado con los mismos datos
    public function createReparto($nombre, $apellido1, $apellido2, $fechaNacimiento, $id_pais, $biografia, $cadProfesiones, $foto, $estado) {
		if ($apellido2 == "") {
			$reparto = R::find('repartos', 'nombre like ? and apellido1 like ? and fechaNacimiento like ?', [$nombre,$apellido1,$fechaNacimiento]);
			if ($reparto == null) {
				$reparto = R::dispense ( 'repartos' );
				$reparto -> nombre = $nombre;
				$reparto -> apellido1 = $apellido1;
				$reparto -> apellido2 = $apellido2;
				$reparto -> fechaNacimiento = $fechaNacimiento;
				$reparto -> biografia = $biografia;
				$reparto -> rutaFoto = base_url().$foto;
				$reparto -> estado = $estado;
				foreach ($cadProfesiones as $prof) {
					$reparto->sharedGenerosList[] = R::load('profesiones',$prof);
				}
				$pais = R::load("paises", $id_pais);
				$pais -> xownRepartosList[] = $reparto;
				R::store($pais);
			} else {
				throw new Exception("Persona duplicada");
			}
			R::close();
		} else {
			$reparto = R::find('repartos', 'nombre like ? and apellido1 like ? and apellido2 like ? and fechaNacimiento like ?', [$nombre,$apellido1,$apellido2,$fechaNacimiento]);
			if ($reparto == null) {
				$reparto = R::dispense ( 'repartos' );
				$reparto -> nombre = $nombre;
				$reparto -> apellido1 = $apellido1;
				$reparto -> apellido2 = $apellido2;
				$reparto -> fechaNacimiento = $fechaNacimiento;
				$reparto -> biografia = $biografia;
				$reparto -> rutaFoto = base_url().$foto;
				$reparto -> estado = $estado;
				foreach ($cadProfesiones as $prof) {
					$reparto->sharedGenerosList[] = R::load('profesiones',$prof);
				}
				$pais = R::load("paises", $id_pais);
				$pais -> xownRepartosList[] = $reparto;
				R::store($pais);
			} else {
				throw new Exception("persona duplicado");
			}
			R::close();
		}
	}

	//Devuelve todos los datos de todas las personas
	public function getAll() {
		$mostrar = R::find("repartos","order by apellido1,apellido2,nombre");
		return $mostrar;
	}
	
	public function getAllActive() {
	    $mostrar = R::find("repartos","estado like ?", ['Activo']);
	    return $mostrar;
	}

	//Devuelve una persona mediante su id
	public function getRepartoPorId($id_reparto) {
		return R::load ( 'repartos', $id_reparto );
	}

	//Permite editar los datos de la persona, no puede repetir datos ni meterlos vacios
	public function editar($id_reparto, $nombre, $apellido1, $apellido2, $fechaNacimiento, $id_pais, $biografia, $cadProfesiones, $foto, $estado) {
		$reparto = R::load ( 'repartos', $id_reparto );
		R::trash($reparto);

		$reparto = R::dispense ( 'repartos' );
		$reparto -> nombre = $nombre;
		$reparto -> apellido1 = $apellido1;
		$reparto -> apellido2 = $apellido2;
		$reparto -> fechaNacimiento = $fechaNacimiento;
		$reparto -> biografia = $biografia;
		$reparto -> rutaFoto = base_url().$foto;
		$reparto -> estado = $estado;
		$profesiones = explode(",",$cadProfesiones);
		for ($i=0;$i<count($profesiones);$i++) {
			$profesion = R::load("profesiones",$profesiones[$i]);
			$profesion -> sharedGenerosList[] = $reparto;
			R::store($profesion);
		}
		$pais = R::load("paises", $id_pais);
		$pais -> xownRepartosList[] = $reparto;
		R::store($pais);
		
		R::close();
	}

	//Permite desactivar una persona mediante su id
	public function borrar($id_reparto) {
		$reparto = R::load ( 'repartos', $id_reparto );
		$reparto->estado = 'Inactivo';
		R::store ( $reparto );
	}
	
	public function activar($id_reparto) {
	    $reparto = R::load ( 'repartos', $id_reparto );
	    $reparto->estado = 'Activo';
	    R::store ( $reparto );
	}
}
?>