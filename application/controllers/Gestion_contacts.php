<?

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package GestionCMS
 * @package Website/contacts
 * @category Contacts
 * @author Ivan Fretes
 */
class Gestion_contacts extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('General/contact_model','contact_model');

		$this->base_url = base_url().'gestion/contacts';
	}

	
	/**
	 * Lista todas las páginas
	 * @return {void}
	 */
	public function index(){
		
		$this->load->library('pagination');
		$data['g_category'] = 'Contactos';

		$config['base_url'] = base_url().'gestion/contacts/';

		/**
		 * @var {number} Refiere al numero de actual de la 
		 * pagina, genera los limit de la consulta
		 */
		$page_num = $this->uri->segment(3);

		/**
		 * Verificamos que estemos en la primera pagina
		 */
		if (NULL === $page_num) $page_num = 1;

		// Cantidad de elementos a ser visualizados
		$data['count_item'] =  $this->contact_model->count_contacts();
		$config['total_rows'] = $data['count_item'];
		$config = pagination_custom($config);

		// Limite de items/pages a ser visualizados		
		$limit_end = ($page_num - 1) * $config['per_page'];

		/**
		 * Valor inicial del primer item
		 * @example page 2 page_init = 11
		 */
		$data['item_init'] = $limit_end + 1;

		// Listado los contacto
		$data['list_contact'] = $this->contact_model->get_contacts(
											$config['per_page'],$limit_end);
		

		
		//initializate the panination helper 
		$this->pagination->initialize($config);

		//load the view
		$data['page_url'] = $this->base_url;
		$data['main_content'] = 'admin/contacts/list';
		$this->load->view('admin/template', $data);
		
	}


	public function get_contact($contact_id){
		$data['contact'] = $this->contact_model->get_contact($contact_id);

		// Cargamos una vista, o directamente retornamos como json
	}


	/**
	 * Creamos un contacto desde la gestion
	 * 
	 * @return {void}
	 */
	public function create(){


		$firstname = $this->input->post('contact_firstname');
		$lastname = $this->input->post('contact_lastname');
		$dni = $this->input->post('contact_dni');
		$phone = $this->input->post('contact_phone');
		$movil = $this->input->post('contacto_movil');
		$mail = $this->input->post('contact_mail');
		$direction = $this->input->post('contact_dir');
		$reference = $this->input->post('contact_reference');
		$description = $this->input->post('contact_description');



		/**
		 * Numero de telefono
		 */
		if (NULL !== $firstname){
			$this->contact_model->create_contact($firstname,$lastname,$dni,
											$phone,$movil,$mail,$direction,
											$reference,$description,$status);	
		}

		

	}



}


?>