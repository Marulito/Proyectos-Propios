<?php
/**
 * 
 */
class cContenido extends CI_Controller
{
	
	function __construct()
	{
	   parent::__construct();
	   $this->load->model('mContenido');
	}

	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('layout/navegacion');
		$this->load->view('layout/content');
		$this->load->view('layout/footer');
	}

	public function registrarModificarContenido()
	{
		$info['']=$this->input->post('');
		$info['']=$this->input->post('');
		$info['']=$this->input->post('');
		$info['']=$this->input->post('');
		$info['']=$this->input->post('');

		$res=$this->mContenido->registrarModificarContenidoM($info);

		echo $res;
	}
}

 ?>