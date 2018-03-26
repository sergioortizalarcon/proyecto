<?php

class Login extends CI_Controller{

	public function loginGet() {
		session_start();
		$value = " ";
		$valuePass = " ";
		if (isset($_SESSION["recordar"])) {
			$value = "value=\"". $_SESSION["recordar"] ."\"";
			$valuePass = "value=\"". $_SESSION['usuarios'][$_SESSION["recordar"]]['pwd'] ."\"";
		} else {
			session_destroy();
		}
		$datos["valor"]["usuario"] = $value;
		$datos["valor"]["pwd"] = $valuePass;
		enmarcar($this,"login/loginForm",$datos);
		
	}

	public function loginPost(){
		$this -> load ->model("usuario_model");
		$usuario = isset($_POST["nUsuario"])?$_POST["nUsuario"]:"anonimo";
		$pwd = isset($_POST["pwd"])?$_POST["pwd"]:null;
		$recordar = isset($_POST["recordar"])?$_POST["recordar"]:"";
		if(strcmp($usuario, "anonimo") !== 0) {
			
			try {
				$identificarse = $this -> usuario_model -> comprobar_login($usuario,$pwd);

				if ($identificarse) {
					$aliasLogeado  = $identificarse["alias"];
					setcookie("usuario", $aliasLogeado,0,"/");
					session_start();
					if (strcmp($recordar,"recordar") === 0) {
						
						$_SESSION['usuarios'][$aliasLogeado]=['pwd'=>$pwd];
						$_SESSION['recordar'] = $aliasLogeado;
					} else {
						unset($_SESSION["usuarios"]);
						unset($_SESSION["recordar"]);
						session_destroy();
					}

					header("location:".base_url()."login/loginOk?nombre=".$aliasLogeado);
					
					
				} else {
					header("location:".base_url()."login/loginError");
					
				}

			} catch(Exception $e) {
				$datos["mensaje"]["texto"]="Error en la BD. \n $e";
				$datos["mensaje"]['nivel']="error";
				enmarcar($this, 'login/mensaje',$datos);
			}
		}
	}

	public function loginOk() {
		$datos["mensaje"]["texto"]="Logeado con éxito ".$_GET['nombre'].". Redirigiendo al inicio...";
		$datos["mensaje"]['nivel']="ok";
		enmarcar($this, 'login/mensaje',$datos);
		header("Refresh:3;url=".base_url());
	}
	
	public function loginError() {
		$datos["mensaje"]["texto"]="Usuario o contraseña incorrecta. ¡Prueba otra vez!...";
		$datos["mensaje"]['nivel']="error";
		enmarcar($this, 'login/mensaje',$datos);
		header("Refresh:3;url=".base_url()."login/loginGet");
	}



	public function loginOut(){
		setcookie("usuario","", time() - 3600,'/');
		session_start();
		unset($_SESSION["usuarios"]);
		session_destroy();
		
		header("location:".base_url());
		$datos["mensaje"]["texto"]="Has cerrado sesión con éxito. Hasta la próxima.";
		$datos["mensaje"]['nivel']="ok";
		enmarcar($this, 'login/mensaje',$datos);
	}


	//Acceso a perfil

	public function perfilUsuarioGet(){
		enmarcar($this,"login/perfilUser");
	}

}