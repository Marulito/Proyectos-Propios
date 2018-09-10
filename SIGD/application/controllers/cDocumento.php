<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class cDocumento extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('mDocumento');
	}

	public function registrarModificarInfoDocumento()
	{
		
	}

	public function do_upload()//Primero subir el documento y despues registrar la descripción por manera más segura
	{
		$config['upload_path']= './lib/uploads/';
		$config['allowed_types']= 'pdf';
		$config['max_size']     = '1024';
		// $config['file_name']= 'consecutivo';
		$this->load->library('upload',$config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('userfile')) {
			// Va a retornar que no se pudo montar el documento
			echo  "No subio el documento error: ".$this->upload->display_errors();
			echo $config['upload_path'];
		}else{
			// Si se pudo montar el documento
			echo $this->upload->data();
			echo "Si subio el documento";
		}
	}
}
 ?>