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
		if ($this->session->userdata('documento')==false) {
			redirect('cLogin');
		}else{
			$info['opProceso']=1;//1=Gestiones , 2=Procesos y 3=SubProcesos //Consultar los procesos
			$info['nombreT']='Gestiones';
			$info['tipoUser']=$this->session->userdata('tipo_Usuario');//Tipo de ususario
			//Contenidos
			$info['categorias']= $this->mCategoria->consultarCategoriasM(-1);
			// ---
			$this->load->view('layout/header');
			$this->load->view('layout/navegacion',$info);
			$this->load->view('layout/content',$info);
			$this->load->view('layout/footer');
		}		
	}

	public function documentos()
	{	
		$this->load->model('mDocumento');
		// Enviar los documentos para cargar en la vista
		$info['idDocumento'] = $this->input->post('idDoc');;//0=Consulta todos en general, n>0 consulta los datos del documento por el idDocumento
		$info['idProceso'] = $this->input->post('idPro');// Que documentos va a buscar...
		$info['tipo_ususario'] =$this->session->userdata('tipo_Usuario');
		// $info['accion'] =$this->session->userdata('accion');
		$info['accion'] =$this->input->post('accion');

		$dato['Documentos']= $this->mDocumento->consultarDocumentosM($info);
		// 
		if ($info['accion']==0) {//Consulta en general
			// 
			$dato['tipo_ususario']=$this->session->userdata('tipo_Usuario');
			// 
			$view= $this->load->view('layout/documentos',$dato);

			echo $view;
		}else if ($info['accion']==1) {//Consultar info por un id de documento
			echo json_encode($dato['Documentos']);
		}else{
			echo "vacio";
		}
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