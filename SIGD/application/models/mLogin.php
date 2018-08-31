<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class mLogin extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	public function iniciarSessionM($info)
	{
		$query=$this->db->query("CALL PA_InicioSessionUsuario('{$info['user']}','{$info['pass']}');");

		$res= $query->row();

		if ($res->respuesta==1) {
			// Variable de session
			$user_session=array('documento' => $res->documento,
								'tipo_Usuario' => $res->rol);
			// ...
			$this->session->set_userdata($user_session);
			// ...
			return $res->respuesta;//Ingreso al sistema
		}else{
		  return  $res->respuesta;//No ingreso al sistema
		}
	}

}
 ?>