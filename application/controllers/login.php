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
		$today = isset($_POST["cntrl"])?$_POST["cntrl"]:null;
		$usuario = isset($_POST["nUsuario"])?$_POST["nUsuario"]:null;
		$pwd = isset($_POST["hash_passwrd"])?$_POST["hash_passwrd"]:null;
		$recordar = isset($_POST["recordar"])?$_POST["recordar"]:"";
		$tokenAdm = isset($_POST["tken"])?$_POST["tken"]:null;
		//Comparacion de String -> Devuelve < 0 si str1 es menor que str2; > 0 si str1 es mayor que str2 y 0 si son iguales.
		if($usuario !=null && $today!=null) {
			try {
				$identificarse = $this -> usuario_model -> comprobar_login($usuario,$pwd);
				if ($identificarse) {
					$f_ban = $identificarse['fecha_ban'];
					if ($f_ban > 0) {
						$this->usuario_baneado($f_ban,$today);
					} else {
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
						
						if ( strcmp($_SESSION['rol'],"administrador") === 0 ) {
							header("location:".base_url()."login/loginOk?token=".$tokenAdm);
						}  else {
							header("location:".base_url()."login/loginOk?nombre=".$aliasLogeado);
						}
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
		if (isset($_GET['token'])) {
			$datos["mensaje"]["texto"]="Bienvenido Administrador.Estas siendo redirigido al inicio.";
			$datos["mensaje"]['nivel']="ok";
			$datos["mensaje"]["token"]=true;
			enmarcar($this, 'login/mensaje',$datos);
			header("Refresh:3;url=".base_url());
		} else if (isset($_GET['nombre'])) {
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

	public function usuario_baneado($ban,$today) {

		//Faltaría meter áños, si los hay. o dejarlo solo en días.
		$actual = strtotime(date("d-m-Y H:i:00",($today/1000)));
		$fecha_baneo = strtotime(date("d-m-Y H:i:00",($ban/1000)));
		//Si la fecha de hoy es menor q la del baneo
		if ($actual < $fecha_baneo) {
			$total_ban_fecha = "";
			$resto = ($actual - $fecha_baneo);
			if ($resto < 0) {
				//paso a positivo el resto
				$resto = $resto*(-1);
			}
			//Paso el valor(dado en milisegundos) a días
			$c = $resto / (60*60*24);
			//Redondeo a dos decimales
			$c = round($c, 2);
			//Si hay punto esq hay dos decimales q se convertirán en horas.
			$cortar_dia = explode(".", $c);
			if (count($cortar_dia) > 1) {
				$dia = $cortar_dia[0];
			}
			$hora = $cortar_dia[1];
			while ($hora > 24) {
				$dia +=1;
				$hora = $hora-24;
			}

				$total_ban_fecha.= $dia." días y ".$hora." horas";
			} else {
				$total_ban_fecha.=$c." días";
			}
			$datos["mensaje"]["texto"]="Esta cuenta ha sido bloqueada durante ".$total_ban_fecha.". Para más información contacte pongase en contacto con un administrador.";
			$datos["mensaje"]['nivel']="error";
			enmarcar($this, 'login/mensaje',$datos);
	}



	public function vista_login_administrador(){
		$this-> load -> view('templates_admin/loginAdmin');
	}

	//Acceso a perfil

	public function perfilUsuario(){
		enmarcar($this,"login/perfilUser");
	}

}