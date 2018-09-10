<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class cContenido extends CI_Controller
{
	
	function __construct()
	{
	   parent::__construct();
	   $this->load->model('mContenido');
	}

	public function index()
	{	
		$info['opProceso']=1;//1=Gestiones , 2=Procesos y 3=SubProcesos //Consultar los procesos
		$info['nombreT']='Gestiones';
		//Contenidos
		// ---
		$this->load->view('layout/header');
		$this->load->view('layout/navegacion');
		$this->load->view('layout/content',$info);
		$this->load->view('layout/footer');
	}

	public function documentos()
	{	
		// Enviar los documentos para cargar en la vista

		$view= $this->load->view('layout/documentos');
		echo $view;
	}

	public function registrarModificarContenido()
	{
		$info['idProceso']=$this->input->post('idCon');
		$info['nombre']=$this->input->post('nombre');
		$info['idTipo_proceso']=$this->input->post('tipoProceso');
		$info['idSubProceso']=$this->input->post('idProceso');

		$res=$this->mContenido->registrarModificarContenidoM($info);

		echo $res;
	}

	public function consultarContendio()
	{
		$idCon=$this->input->post('idCon');
		$idTip=$this->input->post('tipoP');
		$idTipoUser=$this->session->userdata('tipo_Usuario');

		$res=$this->mContenido->ConsultarContenidoM($idCon,$idTip,$idTipoUser);

		echo json_encode($res);
	}

	public function cambiarEstadoContenido()
	{
		$info['idProceso']=$this->input->post('idCon');
		// $info['idSubProceso']=$this->input->post('idProceso');

		$res=$this->mContenido->cambiarEstadoContenidoM($info);

		echo $res;
	}
}

 ?>