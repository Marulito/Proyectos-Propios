<?php 
/**
 * 
 */
class cCategoria extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('layout/navegacion');
		$this->load->view('modulos/categorias');
		$this->load->view('layout/footer');
	}
}
 ?>