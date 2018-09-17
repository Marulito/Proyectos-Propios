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
	   $this->load->model('mCategoria');
	}

	public function index()
	{	
		$info['opProceso']=1;//1=Gestiones , 2=Procesos y 3=SubProcesos //Consultar los procesos
		$info['nombreT']='Gestiones';
		//Contenidos
		$info['categorias']= $this->mCategoria->consultarCategoriasM(-1);
		// ---
		$this->load->view('layout/header');
		$this->load->view('layout/navegacion');
		$this->load->view('layout/content',$info);
		$this->load->view('layout/footer');
	}

	public function documentos()
	{	
		$this->load->model('mDocumento');
		// Enviar los documentos para cargar en la vista
		$info['idDocumento'] = $this->input->post('idDoc');;//0=Consulta todos en general, n>0 consulta los datos del documento por el idDocumento
		$info['idProceso'] = $this->input->post('idPro');// Que documentos va a buscar...
		$info['tipo_ususario'] =$this->session->userdata('tipo_Usuario');

		$dato['Documentos']= $this->mDocumento->consultarDocumentosM($info);
		$dato['tipo_ususario']=$this->session->userdata('tipo_Usuario');

		$view= $this->load->view('layout/documentos',$dato);

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