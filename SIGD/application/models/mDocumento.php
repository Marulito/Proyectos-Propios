<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class mDocumento extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function registrarModificarInfoDocumentoM($info)
	{
		$query= $this->db->query("CALL PA_RegistrarModificarDocumento('{$info['name']}', '{$info['version']}', '{$info['vigencia']}', '{$info['poseedor']}','{$info['proteccion']}', '{$info['namePDF']}',{$info['categoria']},{$info['proceso']},{$info['idDocumento']});");

		$res= $query->row();

		return $res->respuesta;
	}

	public function consultarDocumentosM($info)
	{
		$query= $this->db->query("CALL PA_ConsultarDocumentos({$info['idDocumento']}, {$info['tipo_ususario']} ,{$info['idProceso']});");

		$result=$query->result();

		return $result;
	}

	public function cambiarEstadoDocumentoM($idD)
	{
		$query= $this->db->query("CALL ({$idD});");

		$result=$query->row();

		return $result->respuesta;
	}
}
 ?>