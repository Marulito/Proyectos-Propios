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

	public function validarUsuarioM($info)
	{
		$query= $this->db->query("CALL PA_validarUsuario('{$info['user']}','{$info['pass']}',{$info['idD']});");

		$res=$query->row();

		return $res->respuesta;
	}

	public function verificarDescargaM($idH)
	{
		$query= $this->db->query("CALL PA_validarDescarga({$idH});");

		$res=$query->row();

		return $res->respuesta;
	}

	public function consultarDocumentosM($info)
	{
		$query= $this->db->query("CALL PA_ConsultarDocumentos({$info['idDocumento']}, {$info['tipo_ususario']} ,{$info['idProceso']});");
		// ...
		switch ($info['accion']) {
			case 0://Consulta general
			case 1://Consultar info editar documento
				  $result=$query->result();
				  // ...
				  return $result;
			    break;
			case 2://Consultar name_file para descargar
			      $result=$query->row();
			      // ...
			      return $result->nombre_file;		
				break;
		}
	}

	public function cambiarEstadoDocumentoM($idD)
	{
		$query= $this->db->query("CALL PA_CambiarEstadoDocumento({$idD});");

		$result=$query->row();

		return $result->respuesta;
	}
}
 ?>