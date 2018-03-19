<?php
class Empleado_model extends CI_Model {
	public function create_empleado($nombre, $ape1, $ape2, $pwd, $tlf, $idCiudad, $idLPs) {
		$empleado = R::findOne ( 'empleado', 'nombre=?', [ $nombre ] );
		
		if ($empleado == null) {
			$empleado = R::dispense ( 'empleado' );
			
			$empleado->nombre = $nombre;
			$empleado->ape1= $ape1;
			$empleado->ape2 = $ape2;
			$empleado->pwd = $pwd;
			$empleado->tlf = $tlf;
			
			$ciudad = R::load('ciudad',$idCiudad);
			$empleado->ciudad = $ciudad;
			
			foreach ($idLPs as $idLP) {
				$lp = R::load('lp',$idLP);
				$empleado->sharedLpList[] = $lp;
			}
				
			R::store ( $empleado );
			R::close ();
		} else {
			R::close ();
			throw new Exception ();
		}
	}
	
	public function getAll($filtro) {
		return R::find ( 'lp', "nombre like ?", [ 
				'%' . $filtro . '%' 
		] );
	}
	public function borrar($id) {
		$lp = R::load ( 'lp', $id );
		if ($lp->id != 0) {
			R::trash ( $lp );
		}
		R::close ();
	}
	public function getByID($id) {
		return R::load ( 'lp', $id );
	}
	public function update($id, $nombre) {
		$lp = R::load ( 'lp', $id );
		
		$lp->nombre = $nombre;
		
		R::store($lp);
		R::close();
		
	}

	public function comprobar($usuario,$pwd){
		$identidicar = R::find("empleado", "nombre like ? and pwd like ?",[$usuario,$pwd]);

		if($identidicar != null) {
			return $identidicar;
		} else {
			return false;
		}
	}
}
?>