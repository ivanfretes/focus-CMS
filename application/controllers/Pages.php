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

		$this->load->model('General/menu_model','menu_model');
		$this->list_menu = $this->menu_model->get_all_menu();
	}	
	
	/**
	 * View the page, 
	*/
	public function index($param_url = 'index'){		
		$data['page_title'] = 'Inicio';
		$data['page'] = $this->p_m->get_page_by_url($param_url);
		// Listado de menu de la página
		$data['list_menu'] = $this->list_menu;
		

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


	public function contact(){
		$data['list_menu'] = $this->list_menu;
	}

	public function infosite(){
		$data['list_menu'] = $this->list_menu;
	}

	
}

?>