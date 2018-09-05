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
		$doc= $this->session->userdata('documento');//Identificador del usuario

		$query=$this->db->query("CALL PA_RegistrarModificarContenidoVista({$info['idProceso']},'{$doc}','{$info['nombre']}',{$info['idTipo_proceso']},{$info['idSubProceso']});");

		$res= $query->row();

		return $res->respuesta;
	}

	public function ConsultarContenidoM($idCon,$tipo,$tipouser)
	{
		$query=$this->db->query("CALL PA_ConsultarProcedimientosS({$tipo}, {$tipouser}, {$idCon});");

		$res= $query->result();

		return $res;
	}

	public function cambiarEstadoContenidoM($info)
	{
		
		$query=$this->db->query("CALL PA_CambiarEstadoContenido({$info['idProceso']}, {$info['idSubProceso']});");

		$res= $query->row();

		return $res->respuesta;
	}
}
 ?>