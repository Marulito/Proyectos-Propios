<?php 
/**
 * 
 */
class mDocumento extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database()
	}

	public function registrarModificarInfoDocumentoM($info)
	{
		$query= $this->db->query("CALL PA_RegistrarModificarDocumento('{$info['name']}', '{$info['version']}', '{$info['vigencia']}', '{$info['poseedor']}','{$info['proteccion']}', '{$info['namePDF']}',{$info['categoria']},{proceso},{$info['idDocumento']});");

		$res= $query->row();

		return $res->respuesta;
	}
}
 ?>