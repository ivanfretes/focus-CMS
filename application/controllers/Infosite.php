<?

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 * Obtiene los datos de l empresa
 * 
 * @package GestionCMS
 * @subpackage website/infosite
 * @author Ivan Fretes
 * 
 */
class Infosite extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if(!$this->session->userdata('logged_in')){
            redirect('gestion/login');
        }

		$this->load->model('General/infosite_model', 'info_model');
		$this->view_path = $this->session->

	}


	public function index(){
		$data['infosite'] = $this->info_model->get_infosite();
		$data['g_category'] = 'Mi Negocio';

		// Si no se ha creado un infosite
		if (NULL === $data['infosite']){
			$this->info_model->create();
			redirect('gestion/infosite');
		}
		
		
		// Cargamos los datos por defecto
		$data['main_content'] = 'admin/pages/page_infosite';
		$this->load->view('admin/template',$data);	
		
		


		//1.  Si la empresa no tiene ningun dato,
		// llamamos el modelo de crear datos, todos vacios

		// 2. Caso contrario, pasamos a editar los datos 
	}

	// /**
	//  * Business profile
	//  */
	// public function profile_business(){
	// 	$data['main_content'] = 'admin/dashboard';
	// 	$this->load->view('admin/template',$data);
	// }



	/**
	 * 
	 */
	public function edit(){

	}







}