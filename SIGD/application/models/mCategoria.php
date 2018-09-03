<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class mCategoria extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('layout/navegacion');
		$this->load->view('modulos/categorias');
		$this->load->view('layout/footer');
	}

	public function registrarModficarcategoriaM($info)
	{
		$query= $this->db->query("CALL PA_RegistrarModificarCategoria({$info['id']},'{$info['nombre']}');");
		$res=$query->row();

		return $res->respuesta;
	}

	public function consultarCategoriasM($id)
	{
		$query= $this->db->query("CALL PA_ConsultarCategorias({$id});");

		$res= $query->result();

		return $res;
	}

	public function cambiarEstadoCategoriaM($id)
	{
		$query= $this->db->query("CALL PA_CambiarEstadoCategoria({$id});");
		$res=$query->row();

		return $res->respuesta;
	}

} ?>