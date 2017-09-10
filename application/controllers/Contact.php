<?

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * -- Modificar --
 * Como se envian y reciben los contactos
 * 
 * @package focusCMS
 * @author Ivan Fretes
 */
class Contact extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('General/contact_model','contact_model');
	}

	/**
	 * Lista todos los contactos Generados en la Gestion, 
	 * Si el usuario desea ver x filas solo debe inicializar rows
	 * 
	 * @param {number} $page_index : Numero de Página
	 * @return {void}
	 */
	public function all($page_index = 1){
		if (!not_value($_GET['rows']))
			$per_page = $this->input->get('rows');
		else 
			$per_page = 10;

		// Listado de contactos
		$data['row_init'] = get_init_row($page_index, $per_page);
		$data['contact_list'] = $this->contact_model->get_all(
			$data['row_init'],
			$per_page
		);		
		$data['total_row'] = $this->contact_model->get_count();
		$data['pagination'] = pagination_custom(
			'focus/contacts/', 
			$data['total_row'],
			$per_page
		);

		$data['main_content'] = 'admin/contacts/contact-list';
		$this->load->view('admin/template',$data);

	}



	/**
	 * Página de Contacto, generada para el frontend
	 */
	public function index(){

		$data = array(
			'page_title' => 'Contactános',
			'page_subtitle' => NULL ,
			'page_portada_url' => NULL
		);
		$data['title'] = 'Contactános';

		// Listamos el navbar menu
		$this->load->model('General/menu_model','menu_model');
		$data['menu_list'] = (array) $this->menu_model->get_all();
		
		// Si se envio el formulario
		if (!not_value($_POST)) {
			$contact_data = fieldname_to_entity(
				array('f-' => 'contact_'), 
				$_POST
			);

			if ($this->contact_model->create($contact_data))
				$data['page_subtitle'] = 'Enviado Correctamente';
		}
		else
			$data['main_content'] = 'frontend/pages/page-contact';
		
		$this->load->view('frontend/template',$data);
	}


	public function create(){
		// ... code
	}


	public function remove($contact_id){

		if (!not_value($_POST['g-submit']))
			msg_boolean_json($this->contact_model->remove($contact_id));
		else
			show_404();

	}

}
?>