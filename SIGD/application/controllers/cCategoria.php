<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class cCategoria extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('mCategoria');
	}

	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('layout/navegacion');
		$this->load->view('modulos/categorias');
		$this->load->view('layout/footer');
	}

	public function registrarModficarcategoria()
	{
		$info['id']= $this->input->post('idC');
		$info['nombre']= $this->input->post('nombre');

		$res=$this->mCategoria->registrarModficarcategoriaM($info);

		echo $res;
	}

	public function consultarCategorias()
	{
		$id=$this->input->post('id');

		$res=$this->mCategoria->consultarCategoriasM($id);

		echo json_encode($res);
	}

	public function cambiarEstadoCategoria()
	{
		$idC= $this->input->post('id');

		$res=$this->mCategoria->cambiarEstadoCategoriaM($idC);

		echo $res;
	}
}
 ?>