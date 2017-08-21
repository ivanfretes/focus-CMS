<?
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package GestionCMS
 * @author Ivan Fretes
 */
class Pages extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('General/page_model', 'page_model');
		$this->load->model('General/menu_model','menu_model');

		// Inicializamos widget custom
		$this->load->library('widget_custom');
	}	
	
	/**
	 * Vista de la pagina
	*/
	public function index($param_url = NULL){

		/**
		  * Si no existe slug en el base url
		  * Selecciona la pagina principal
		  */ 

		if (NULL === $param_url) {
			$data = (array) $this->page_model->get_index_page();
			$data['page_title'] = 'Inicio';
		}
		else 
			$data = (array) $this->page_model->get_by_slug($param_url);
		

		// Retornamos el menu
		$data['menu_list'] = (array) $this->menu_model->get_all();
		

		// Si existe la pagina
		if (isset($data['id_page'])){

			$data['main_content'] = 'frontend/index';
			$this->load->view('frontend/template',$data);
			
		}
		else 
			show_404();

	}
	
}

?>