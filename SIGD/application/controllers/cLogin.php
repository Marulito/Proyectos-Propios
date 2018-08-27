<?php 
/**
 * 
 */
class cLogin extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('login');
		$this->load->view('layout/footer');
	}

	public function index1()
	{	
		$this->load->view('layout/header');
		$this->load->view('layout/navegacion');
		$this->load->view('layout/content');
		$this->load->view('layout/footer');
	}
}

 ?>