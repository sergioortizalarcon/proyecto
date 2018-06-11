<?php
function enmarcar($controlador, $rutaVista, $datos = []) {
	if (session_status () == PHP_SESSION_NONE) {session_start ();}
	if (isset ( $_SESSION ['rol'] ) && ($_SESSION['rol'] == 'administrador')) {
			if (isset($_SESSION['vista_user']) && ($_SESSION['vista_user']=='permiso')) {
				$controlador->load->view ( 'templates/head',$datos );
				$controlador->load->view ( 'templates/header', $datos );
				$controlador->load->view ( 'templates/nav', $datos );
				$controlador->load->view ( $rutaVista, $datos );
				$controlador->load->view ( 'templates/footer', $datos );
				$controlador->load->view ( 'templates/end' );
			} else {
				$controlador->load->view ( 'templates_admin/head');
				$controlador->load->view ( 'templates_admin/header');
				$controlador->load->view ( 'templates_admin/nav');
				$controlador->load->view ( $rutaVista, $datos );
				$controlador->load->view ( 'templates_admin/includes/footer');
				$controlador->load->view ( 'templates_admin/end');
			}
	}  else {
			$controlador->load->view ( 'templates/head',$datos );
			$controlador->load->view ( 'templates/header', $datos );
			$controlador->load->view ( 'templates/nav', $datos );
			$controlador->load->view ( $rutaVista, $datos );
			$controlador->load->view ( 'templates/footer', $datos );
			$controlador->load->view ( 'templates/end' );
	}
	
}

?>