<?php

class Administrador extends CI_Controller {

	public function comprobarRol(){
		if($_SESSION['rol']=='administrador'){
			return true;
		} else {
			return false;
		}
	}
	public function editarGet(){
		$this->load->model('administrador_model');
		$this->load->model('usuario_model');
		$idUser = isset($_POST['idUser'])?$_POST['idUser']:null;
		if ($idUser) {
			if ($idUser == $_SESSION['id']) {
				$datos['datos'] = $this->administrador_model->getByID($idUser);
				$this->load->view("administrador/perfilAdmin",$datos);
			} else {
				header("location:".base_url());
			}

		} else {
			$datos['mensaje']['texto'] = "Se ha producido algún error. Vuelve a intentarlo.";
			$datos['mensaje']['nivel'] = 'error';
			enmarcar($this,"administrador/mensaje",$datos);
		}
	}

	//Por ID
	public function datos_user(){
		$idUser = isset($_POST['idUser'])?$_POST['idUser']:null;
		$this->load->model('administrador_model');
		session_start();
		if (strcmp($idUser,$_SESSION['idUser']) === 0) {
			$info = $this->administrador_model->getByID($idUser);
			$envio['info']['alias']=$info->alias;
			$envio['info']['nombre']=$info->nombre;
			$envio['info']['apellido_uno']=$info->apellido_uno;
			$envio['info']['apellido_dos']=$info->apellido_uno;
			$envio['info']['email']=$info->email;
			$envio['info']['fecha_nacimiento']=$info->fecha_nacimiento;
			$envio['info']['nombre']=$info->nombre;
			$this -> load -> model('pais_model');
			$pais = $this -> pais_model -> getPaisPorId($info->paises_id);
			$envio['info']['pais']= $pais -> nombre;
			print_r(json_encode($envio));
		} else {
			$datos['info']['texto'] = "Se ha producido algún error. Vuelve a intentarlo.";
			$datos['info']['nivel'] = 'error';
			print_r(json_encode($datos));
		}
	}


	public function editarRolPost() {
		if ($this->comprobarRol()) {
			$this->load->model('administrador_model');
			$id_user = isset($_POST['idUser'])?$_POST['idUser']:null;
			$id_rol = isset($_POST['idRol'])?$_POST['idRol']:null;
			if ($id_user && $id_rol) {
				try {
					$this -> administrador_model -> editar_rol_usuario($id_user,$id_rol);
				} catch (Exception $e) {
				
				}
			}
		} else{

		}
		
	}

	public function listar($f='') {
		$this->load->model('administrador_model');
		$this->load->model('usuario_model');
		$filtro = isset($_POST['filtro'])?$_POST['filtro']:$f;

		$datos['roles'] = $this->usuario_model->listar_roles();

		$datos['usuarios'] = $this->administrador_model->getAll($filtro);
		$datos['filtro'] = $filtro;
		enmarcar($this, 'administrador/listar',$datos);
	}

	public function forgetPwdAd(){
		$this -> load ->view("templates_admin/forgotPassword");
	}


	/*	RECUPERACION DE PASSWORD */
	
	public function recuperarPwd() {
		enmarcar($this, "usuario/recuperarPwd");
	}
	
	public function resetPasswordUser() {
		$this-> load -> model("administrador_model");
		$correo = isset($_POST['correo'])?$_POST['correo']:null;
		$tokenAdm = isset($_POST["tken"])?1:null;
		$existe = false;
		if ($tokenAdm != null) {
			$existe = $this -> administrador_model ->comprobar_emailAdm($correo);
		}

		if (!$existe) {
			$this -> enviarCorreoAUsuario($correo);
		} else {
			$datos['mensaje']['texto'] = "El correo no es correcto o no existe en nuestros registros. Inténtalo de nuevo.";
			$datos['mensaje']['nivel'] = 'error';
			$this ->load ->view('templates_admin/forgotPassword', $datos);
		}
	}


	public function perfilUsuario(){
		$this -> load ->model('administrador_model');

		enmarcar($this,"administrador/perfilAdmin");
	}
	





//Para usar esto hay q instalar phpmailer ( con composer en la raiz del proyecto)
	public function enviarCorreoAUsuario ($correo) {
		$the_subject = "Primera prueba mailer";
		$email_user = "usuariodosfilms@gmail.com";
		$email_word = "usuarioDosFilm";
		$cuerpoMensaje = 'Probando etiquetas';
		$cuerpoMensaje .="<h1>Hola Mundo</h1>";
		$cuerpoMensaje .="<p>Acepta es pero entre etiquetas, no tildes</p>";
		$cuerpoMensaje .="Fecha y Hora: ".date("d-m-Y h:i:s");

		$mail = new PHPMailer(true); 
		try {
			$mail->CharSet = 'UTF-8';
				//Server settings
		    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = $email_user;                 // SMTP username
		    $mail->Password = $email_word;                           // SMTP password
		    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 587;                                    // TCP port to connect to
		    //Recipients
		    $mail->setFrom($email_user, 'Admin Films');
		    $mail->addAddress($correo, 'Joe User');     // Add a recipient
		    //$mail->setLanguage('es','includes/phpmailer/language');   no funciona
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = $the_subject;
		    $mail->Body = $cuerpoMensaje;
		    $mail->AltBody = 'Prueba xxx add-25';
			$mail->SMTPOptions = array(
			    'ssl' => array(
			        'verify_peer' => false,
			        'verify_peer_name' => false,
			        'allow_self_signed' => true
			    )
			);
		    $exito =  $mail->send();

			if($exito){
				header('Location:'.base_url().'usuario/recuperacionOk?enviado');
			} else {
				header('Location:'.base_url().'usuario/recuperacionErronea');
			}
			/*
			Los mensajes enviados por smtp no se guardan así q si se quieren guardar se debe usar IMAP

			Los comandos IMAP requieren la extensión PHP IMAP, que se encuentra en: https://php.net/manual/en/imap.setup.php
			Función para llamar que usa las funciones PHP imap _ * () para guardar mensajes: https://php.net/manual/en/book.imap.php
 			Puedes usar imap_getmailboxes ($ imapStream, '/ imap / ssl') para obtener una lista de carpetas o etiquetas disponibles, esto puede
			ser útil si intentas hacer que esto funcione en un servidor IMAP que no sea de Gmail.
			 if ($this->save_mail($mail)) {
			 echo "Message saved!";
			 } 
	*/
		} catch (Exception $e) {
		$datos['mensaje']['texto'] = "Ocurrió un error inesperado con él envió del correo electrónico, inténtelo de nuevo más tarde, disculpa las molestias. $e";
		$datos['mensaje']['nivel'] = 'error';
		$this ->load ->view ('templates_admin/forgotPassword', $datos);
		}
	
	}
/*

	 function save_mail($mail)
	 {
	 //You can change 'Sent Mail' to any other folder or tag
	 $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";
	 //Indique a su servidor que abra una conexión IMAP con el mismo nombre de usuario y contraseña que usó para SMTP
	 $imapStream = imap_open($path, $mail->Username, $mail->Password);
	 $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
	 imap_close($imapStream);
	 return $result;
	 }
	 */
	
	public function recuperacionOk() {
		$datos['mensaje']['texto'] = "Se envió correctamente el correo electrónico.";
		$datos['mensaje']['nivel'] = 'ok';
		$this ->load ->view ('templates_admin/forgotPassword', $datos);
	}
	
	public function recuperacionErronea() {
		$datos['mensaje']['texto'] = "El email ingresado no existe en nuestros registros. ";
		$datos['mensaje']['nivel'] = 'error';
		$this ->load ->view ('templates_admin/forgotPassword', $datos);
	}
}