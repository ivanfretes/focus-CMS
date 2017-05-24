<?
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package GestionCMS
 * @subpackage Website/pages
 * @author Ivan Fretes
 */
class Pages extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('General/page_model', 'p_m');

		// Inicializamos widget custom
		$this->load->library('widget_custom');
	}	
	
	/**
	 * View the page, 
	*/
	public function index(){

		$param_url = $this->uri->segment(1);

		/**
		  * Verificamos si no existe parametro
		  * Buscamos la página principal
		  */ 

		if (NULL === $param_url) {
			$data['page_title'] = 'Inicio';
			$data['page'] = $this->p_m->get_index_page();
		}
		else {
			$data['page'] = $this->p_m->get_page_by_url($param_url);

			if (NULL !== $data['page'])
				$data['page_title'] = $data['page']->page_title;
		}


		// Si no existe página
		if (NULL !== $data['page']){

			// setting widget
			$setting['page_id'] = $data['page']->id_page;
			$setting['path_view'] = 'frontend';
			$this->widget_custom->initialize($setting);

			
			$data['list_components'] = $this->widget_custom->get_all_widgets();
			$data['main_content'] = 'frontend/index';

			$this->load->view('frontend/template',$data);
		}
		else show_404();

	}
	
}

?>