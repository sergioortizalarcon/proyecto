<?php
class Reparto_model extends CI_Model {
	//Se guarda en la tabla los datos de la persona, comprueba que ya exista uno creado con los mismos datos
    public function createReparto($nombre, $apellido1, $apellido2, $fechaNacimiento, $id_pais, $biografia, $profesiones, $foto, $activo) {
		if ($apellido2 == "") {
			$reparto = R::find('reparto', 'nombre like ? and apellido1 like ? and fechaNacimiento like ?', [$nombre,$apellido1,$fechaNacimiento]);
			if ($reparto == null) {
				$reparto = R::dispense ( 'reparto' );
				$reparto -> nombre = $nombre;
				$reparto -> apellido1 = $apellido1;
				$reparto -> apellido2 = $apellido2;
				$reparto -> fechaNacimiento = $fechaNacimiento;
				$reparto -> biografia = $biografia;
				
				/*$profesiones = explode(",",$cadProfesiones); 
				for ($i=0;$i<count($profesiones);$i++) {
					$profesion = R::load("profesiones",$profesiones[$i]);
					$profesion -> xownRepartoList[] = $reparto;
				}*/
				//$reparto -> cadProfesiones = $cadProfesiones;
				/*foreach( $profesiones->ownRepartoList as $profesion ) {
					
				}*/
				$profesion = R::load("profesiones", $profesiones);
				$profesion -> xownRepartoList[] = $reparto;
				
				$reparto -> rutaFoto = $foto;
				$reparto -> activo = $activo;
				$pais = R::load("paises", $id_pais);
				$pais -> xownRepartoList[] = $reparto;
				R::storeAll($pais,$profesion);
			} else {
				throw new Exception("Persona duplicada");
			}
			R::close();
		} else {
			$reparto = R::find('reparto', 'nombre like ? and apellido1 like ? and apellido2 like ? and fechaNacimiento like ?', [$nombre,$apellido1,$apellido2,$fechaNacimiento]);
			if ($reparto == null) {
				$reparto = R::dispense ( 'reparto' );
				$reparto -> nombre = $nombre;
				$reparto -> apellido1 = $apellido1;
				$reparto -> apellido2 = $apellido2;
				$reparto -> fechaNacimiento = $fechaNacimiento;
				$reparto -> biografia = $biografia;
				$reparto -> cadProfesiones = $cadProfesiones;
				$reparto -> rutaFoto = $foto;
				$reparto -> activo = $activo;
				$pais = R::load("paises", $id_pais);
				$pais -> xownRepartoList[] = $reparto;
				R::store($pais);
			} else {
				throw new Exception("persona duplicado");
			}
			R::close();
		}
	}

	//Devuelve todos los datos de todas las personas
	public function getAll() {
		$mostrar = R::find("reparto","order by apellido1,apellido2,nombre");
		return $mostrar;
	}

	//Devuelve una persona mediante su id
	public function getRepartoPorId($id_reparto) {
		return R::load ( 'reparto', $id_reparto );
	}

	//Permite editar los datos de la persona, no puede repetir datos ni meterlos vacios
	public function editar($id_reparto, $nombre, $apellido1, $apellido2, $fechaNacimiento, $id_pais, $biografia, $cadProfesiones, $foto) {
		$reparto = R::load ( 'reparto', $id_reparto );
		$repartosTodos = R::find("reparto",'nombre like ? and apellido1 like ? and apellido2 like ? and fechaNacimiento like ?', [$nombre,$apellido1,$apellido2,$fechaNacimiento]);
		$pais = R::load("paises", $id_pais);
		$cambio=false;

		if ($repartosTodos == null) {
			if($nombre != $reparto->nombre && $nombre != "") {
				$reparto->nombre = $nombre;
				$cambio=true;
			}
			if($apellido1 != $reparto->apellido1 && $apellido1 != "") {
				$reparto->apellido1 = $apellido1;
				$cambio=true;
			}
			if($apellido2 != $reparto->apellido2 && $apellido2 != ""){
				$reparto->apellido2 = $apellido2;
				$cambio=true;
			}
			if($fechaNacimiento != $reparto->fechaNacimiento && $fechaNacimiento != "") {
				$reparto->fechaNacimiento = $fechaNacimiento;
				$cambio=true;
			}
			if($biografia != $reparto->biografia && $biografia != "") {
				$reparto->biografia = $biografia;
				$cambio=true;
			}
			if ($cadProfesiones != $reparto->cadProfesiones && $cadProfesiones != "") {
			    $reparto->cadProfesiones = $cadProfesiones;
			    $cambio = true;
			}
			if($foto != "") {
				$reparto->rutaFoto = $foto;
				$cambio=true;
			}
			if($pais != $pais->id) {
				$pais -> xownRepartoList[] = $reparto;
				R::store($pais);
				$cambio=true;
			}

			if ($cambio) {
				R::store ( $reparto );
			}
		}
	}

	//Permite desactivar una persona mediante su id
	public function borrar($id_reparto) {
		$reparto = R::load ( 'reparto', $id_reparto );
		$reparto->activo = 'Inactivo';
		R::store ( $reparto );
	}
	
	public function activar($id_reparto) {
	    $reparto = R::load ( 'reparto', $id_reparto );
	    //$repartosTodos = R::find("reparto",'nombre like ? and apellido1 like ? and apellido2 like ? and fechaNacimiento like ?', [$nombre,$apellido1,$apellido2,$fechaNacimiento]);
	    //R::trash ( $reparto );
	    $reparto->activo = 'Inactivo';
	    R::store ( $reparto );
	}
}
?>