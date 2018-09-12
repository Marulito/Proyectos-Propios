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
		// echo ('Nombre: \n'.$_POST["nombreD"]["name"]);
		if (isset($_FILES["userfile"]["name"])) {
			//Hasta acá se llego el 10/09/2018 //Validar el documento antes de cargarlo acá
			$config['upload_path']= './lib/uploads/';
			$config['allowed_types']= 'pdf';
			$config['max_size']     = '1024';
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('userfile')) {
				// Va a retornar que no se pudo montar el documento
				$mensaje="No subio el documento error: ".$this->upload->display_errors();
			    echo $mensaje.'<br>'.$config['upload_path'];
			}else{
				// Si se pudo montar el documento
				$data= $this->upload->data();
				echo $data['file_name'];
				// echo ('Nombre: \n'.$_POST["nombreD"]);
			}
			// echo json_encode("1");
		}
	}



	// public function do_upload()//Primero subir el documento y despues registrar la descripción por manera más segura
	// {
	// 	$config['upload_path']= './lib/uploads/';
	// 	$config['allowed_types']= 'pdf';
	// 	$config['max_size']     = '1024';
	// 	// $config['file_name']= 'consecutivo';
	// 	$this->load->library('upload',$config);
	// 	$this->upload->initialize($config);

	// 	if (!$this->upload->do_upload('userfile')) {
	// 		// Va a retornar que no se pudo montar el documento
	// 		$mensaje="No subio el documento error: ".$this->upload->display_errors();
	// 		echo $mensaje.'<br>'.$config['upload_path'];
	// 	}else{
	// 		// Si se pudo montar el documento
	// 		echo $this->upload->data();
	// 		echo "Si subio el documento";
	// 	}
	// }
}
 ?>