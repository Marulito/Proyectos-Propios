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

// Crear un .htaccess que se encargue esta configuracion o ir a cambiar los valores en php.ini
// php_value upload_max_filesize 40M
// php_value post_max_size 42M
	public function do_upload()	
	{
		// echo ('Nombre: \n'.$_POST["nombreD"]["name"]);
		if (isset($_FILES["userfile"]["name"])) {
			//Hasta acá se llego el 10/09/2018 //Validar el documento antes de cargarlo acá
			$config['upload_path']= './lib/uploads/';
			$config['allowed_types']= 'pdf';
			$config['max_size']     = '4072';// Maxima longitud de archivos es de 4 MB
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('userfile')) {
				// Va a retornar que no se pudo montar el documento
				// echo $mensaje="No subio el documento error: ".$this->upload->display_errors();
			    // echo $config['upload_path'];
				echo "";
			}else{
				// Si se pudo montar el documento
				$data= $this->upload->data();
				echo $data['file_name'];
				// echo ('Nombre: \n'.$_POST["nombreD"]);
			}
			// echo json_encode("1");
		}
	}

	public function registrarModificarInformacionDocumento()
	{
		$info['name']=$this->input->post('nombre');
		$info['categoria']=$this->input->post('categoria');
		$info['vigencia']=$this->input->post('vigencia');
		$info['poseedor']=$this->input->post('poseedor');
		$info['version']=$this->input->post('version');
		$info['proteccion']=$this->input->post('proteccion');
		$info['namePDF']=$this->input->post('namePDF');
		$info['idDocumento']=$this->input->post('idD');
		// Realizar acción

		$res= $this->mDocumento->registrarModificarInfoDocumentoM($info);

		echo $res;
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