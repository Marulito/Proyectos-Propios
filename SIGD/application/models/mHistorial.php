<?php /**
 * 
 */
class mHistorial extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	public function consultarHistorialFechasM($fechas)
	{
		$query=$this->db->query("CALL PA_ConsultarHistorialFecha('{$fechas['fechaI']}','{$fechas['fechaF']}');");

		$result=$query->result();

		return $result;
	}

} ?>