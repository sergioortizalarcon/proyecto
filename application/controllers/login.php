<?php

class login extends CI_Controller {
	
	public function logginGet() {
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
		enmarcar($this,"login/logginForm",$datos);
		
	}

	public function loginPost(){
		$this -> load ->model("empleado_model");
		$usuario = isset($_POST["nombre"])?$_POST["nombre"]:"anonimo";
		$pwd = isset($_POST["pwd"])?$_POST["pwd"]:"";
		$recordar = isset($_POST["recordar"])?$_POST["recordar"]:"";
		
		if(strcmp($usuario, "anonimo") !== 0) {
			
			try {
				$identificarse = $this -> empleado_model -> comprobar($usuario,$pwd);

				if ($identificarse) {
					setcookie("usuario", $usuario,0,"/");
					session_start();
					foreach ($identificarse as $value) {
						$_SESSION['_activo'] = $value -> id;
					}
					if (strcmp($recordar,"recordar") == 0) {
						$_SESSION['usuarios'][ $usuario ]=['pwd'=>$pwd];
						$_SESSION['recordar'] = $usuario;
					} else {
						unset($_SESSION["usuarios"]);
						unset($_SESSION["recordar"]);
						session_destroy();
					}
					$host  = $_SERVER['HTTP_HOST'];
					$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
					$extra = 'ciClas';
					//header("Location:$host$uri/$extra");
					
					header("location:".base_url());
					header("Refresh:0");
					$datos["mensaje"]["texto"]="Logeado con éxito.";
					$datos["mensaje"]['nivel']="ok";
					enmarcar($this, 'login/mensaje',$datos);
				} else {
					$datos["mensaje"]["texto"]="Usuario o contraseña incorrecta.";
					$datos["mensaje"]['nivel']="error";
					enmarcar($this, 'login/mensaje',$datos);
				}

			} catch(Exception $e) {
				$datos["mensaje"]["texto"]="Error bd.";
				$datos["mensaje"]['nivel']="error";
				enmarcar($this, 'login/mensaje',$datos);
			}
		}
	}

	public function logginOut(){
		setcookie("usuario","", time() - 3600,"/");
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'ciClas';
		//header("Location:$host$uri/$extra");
		
		header("location:".base_url());
		$datos["mensaje"]["texto"]="Has cerrado sesión con éxito. Hasta la próxima.";
		$datos["mensaje"]['nivel']="ok";
		enmarcar($this, 'login/mensaje',$datos);
	}


	//Acceso a perfil

	public function perfilUsuarioGet(){
		session_start();
		enmarcar($this,"login/perfilUser");
	}


	public function datosBasicos() {

	}
}

?>