<?php 
/**
  * 
  */
 class cHistorial extends CI_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('mHistorial');
 	}

 	public function index()
 	{
 		if ($this->session->userdata('documento')==false) {
 			redirect('cLogin');
 		}else{
 			$info['tipoUser']= $this->session->userdata('tipo_Usuario');

 			$this->load->view('layout/header');
 			$this->load->view('layout/navegacion',$info);
 			$this->load->view('modulos/historial');
 			$this->load->view('layout/footer');
 		}
 	}

 	public function consultarHistorial()
 	{
 		$info['fechaI']=$this->input->post('fecha1');
 		$info['fechaF']=$this->input->post('fecha2');

 		$result= $this->mHistorial->consultarHistorialFechasM($info);

 		echo json_encode($result);
 	}

 } ?>