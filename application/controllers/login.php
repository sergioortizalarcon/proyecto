<?php

class Login extends CI_Controller{

	public function loginGet() {
		if (isset($_COOKIE["recordar"])) {
			$recordar = "checked=\"checked\"";
		} else {
			$recordar = " ";
		}
		$datos["recordar"]=$recordar;
		enmarcar($this,"login/loginForm",$datos);
	}

	public function loginPost(){
		$this -> load ->model("usuario_model");
		$usuario = isset($_POST["nUsuario"])?$_POST["nUsuario"]:null;
		$pwd = isset($_POST["hash_passwrd"])?$_POST["hash_passwrd"]:null;
		$recordar = isset($_POST["recordar"])?$_POST["recordar"]:"";
		$tokenAdm = isset($_POST["tken"])?$_POST["tken"]:null;
		//Comparacion de String -> Devuelve < 0 si str1 es menor que str2; > 0 si str1 es mayor que str2 y 0 si son iguales.
		if(strcmp($usuario, null) !== 0) {
			try {
				$identificarse = $this -> usuario_model -> comprobar_login($usuario,$pwd);
				if ($identificarse) {
					$aliasLogeado  = $identificarse["alias"];
					setcookie("usuario", $aliasLogeado,0,"/");
					session_start();
					$this -> load ->model("administrador_model");
					$_SESSION['rol'] = $this -> administrador_model -> obtener_rol_user($identificarse["roles_id"]);
					$_SESSION['idUser'] = $identificarse["id"];
					if (strcmp($recordar,"recordar") === 0) {
						$_SESSION['recordar'] = $aliasLogeado;
						if(!isset($_COOKIE['recordar'])){
							setcookie('recordar','ok',0,"/");
						}
					} else {
						if(isset($_COOKIE['recordar'])){
							setcookie('recordar','',time() - 3600,"/");
						}
					}
					if ($tokenAdm != null ) {
						if ( strcmp($_SESSION['rol'],"administrador") === 0 ) {
							header("location:".base_url()."login/loginOk");
						} else {
							header("location:".base_url()."genero/listar");
							//Denegar acceso si intenta acceder desde el menu de admin y no lo es.
						}
					} else {
						header("location:".base_url()."login/loginOk?nombre=".$aliasLogeado);
					}
				} else {
					if ($tokenAdm != null ) {
						header("location:".base_url()."login/loginError?tken=".$tokenAdm);
					} else {
						header("location:".base_url()."login/loginError");
					}
				}

			} catch(Exception $e) {
				$datos["mensaje"]["texto"]="Error en la BD. \n $e";
				$datos["mensaje"]['nivel']="error";
				enmarcar($this, 'login/mensaje',$datos);
			}
		}
	}

	public function loginOk() {
		if (isset($_GET['nombre']) ) {
			$datos["mensaje"]["texto"]="Logeado con éxito ".$_GET['nombre'].". Redirigiendo al inicio...";
			$datos["mensaje"]['nivel']="ok";
			enmarcar($this, 'login/mensaje',$datos);
			header("Refresh:3;url=".base_url());
		} else {
			// enmarcar($this, 'templates_admin/dashboard',$datos);
			header("location:".base_url());
		}
	}
	
	public function loginError() {
		if (isset($_GET['tken'])) {
			$datos["mensaje"]["texto"]="Usuario o contraseña incorrecta.";
			$datos["mensaje"]['nivel']="error";
			// header("location:".base_url()."templates_admin/loginAdmin".$datos);
			header('location:'.base_url().'login/vista_login_administrador?n=aviso');
		} else {
			$datos["mensaje"]["texto"]="Usuario o contraseña incorrecta. ¡Prueba otra vez!...";
			$datos["mensaje"]['nivel']="error";
			enmarcar($this, 'login/mensaje',$datos);
			header("Refresh:3;url=".base_url()."login/loginGet");
		}
		
	}



	public function loginOut(){
		setcookie("usuario","", time() - 3600,'/');
		//session_start();
		//unset($_SESSION["usuarios"]);
		//session_destroy();
		session_start();
		if ($_SESSION['rol'] == 'administrador') {
			// enmarcar($this, 'templates_admin/loginAdmin');
			header('location:'.base_url().'login/vista_login_administrador');
			session_destroy();
		} else {
			header("location:".base_url());
			$datos["mensaje"]["texto"]="Has cerrado sesión con éxito. Hasta la próxima.";
			$datos["mensaje"]['nivel']="ok";
			enmarcar($this, 'login/mensaje',$datos);
		}
		
	}

	public function vista_login_administrador(){
		$this-> load -> view('templates_admin/loginAdmin');
	}

	//Acceso a perfil

	public function perfilUsuario(){
		enmarcar($this,"login/perfilUser");
	}

}