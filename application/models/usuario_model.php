<?

class usuario_model extends CI_Model {

	public function create_usuario($nombre, $ape1, $ape2, $alias, $email, $pwd, $fecha) {
		$usuario = R::find("usuarios", "alias like ? and email like ?",[$alias,$email]);

		if ($usuario != null) {
			$usuario = R:: dispense("usuarios");
			$usuario -> nombre = $nombre;
			$usuario -> apellido_uno = $ape1;
			$usuario -> apellido_dos = $ape2;
			$usuario -> alias = $alias;
			$usuario -> email = $email;
			$usuario -> password = $pwd;
			$usuario -> fecha_nacimiento = $fecha;

			R::store($usuario);
			R::close();
		} else {
			return $usuario;
		}
	}
}


?>