<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class mUsuario extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function registrarModificarUsuarioM($info)
	{//Queda pendiente el modificar
		$query= $this->db->query("CALL PA_RegistrarModificarUsuario('{$info['documento']}','{$info['nombres']}','{$info['apellidos']}','{$info['contraseña']}', '{$info['correo']}', {$info['rol']}, {$info['accion']});");

		$rest= $query->row();

		return $rest->respuesta;

	}

	public function consultarUsuariosM($doc)
	{
		$query= $this->db->query("CALL PA_ConsultarUsuarios('{$doc}');");

		$rest= $query->result();

		return $rest;
	}

	public function cambiarEstadoUsuarioM($doc)
	{
		$query= $this->db->query("CALL PA_CambiarEstadoUsuario({$doc});");

		$rest= $query->row();

		return $rest->respuesta;
	}
}
 ?>