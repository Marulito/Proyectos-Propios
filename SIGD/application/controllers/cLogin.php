<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class cLogin extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('mLogin');
	}

	public function index()
	{	
		$dato['session']=$this->session->userdata('tipo_Usuario');

		$this->load->view('layout/header');
		$this->load->view('login',$dato);
		$this->load->view('layout/footer');
	}

	public function index1()//Este metodo va en otro controlador, organizarlo
	{	
		$this->load->view('layout/header');
		$this->load->view('layout/navegacion');
		$this->load->view('layout/content');
		$this->load->view('layout/footer');
	}

	public function iniciarSession()//Falta la implementacion de encriptacion de contraseña
	{
		$info['user']= $this->input->post('user');
		$info['pass']= $this->input->post('pass');

		$res= $this->mLogin->iniciarSessionM($info);

		echo $res;
	}

	public function cerrarSession()
	{
		$this->session->sess_destroy();
		redirect('cLogin');
	}
}

 ?>