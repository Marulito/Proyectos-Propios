<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class cUsuario extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('mUsuario');
	}

	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('layout/navegacion');
		$this->load->view('modulos/usuario');
		$this->load->view('layout/footer');
	}

	public function registrarModificarUsuario()
	{
		$info['documento']=$this->input->post('documento');
		$info['nombres']=$this->input->post('names');
		$info['apellidos']=$this->input->post('lastNames');
		$info['contraseña']=$this->input->post('password');
		$info['rol']=$this->input->post('cargo');
		$info['correo']=$this->input->post('email');
		$info['accion']=$this->input->post('opcion');

		$res= $this->mUsuario->registrarModificarUsuarioM($info);

		echo $res;
	}

	public function consultarUsuarios()
	{
		$doc=$this->input->post('documento');

		$result=$this->mUsuario->consultarUsuariosM($doc);

		echo json_encode($result);
	}

	public function cambiarEstadoUsuario()
	{
		$doc=$this->input->post('documento');

		$res=$this->mUsuario->cambiarEstadoUsuarioM($doc);

		echo $res;
	}
}
 ?>