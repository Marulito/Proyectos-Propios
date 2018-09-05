<?php
/**
 * 
 */
class mContenido extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function registrarModificarContenidoM($info)//Hacer la validacion de nombre antes de realizar cualquier accion--- Solo para las gestiones
	{
		$query=$this->db->query("CALL PA_RegistrarModificarContenidoVista();");

		$res= $query->row();

		return $res;
	}

	public function ConsultarContenidoM($info)
	{
		
	}

	public function cambiarEstadoContenidoM($info)
	{
		# code...
	}
}
 ?>